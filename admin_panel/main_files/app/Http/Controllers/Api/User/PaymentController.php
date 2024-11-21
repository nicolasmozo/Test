<?php

namespace App\Http\Controllers\Api\User;


use Auth;

use Mail;
use Session;
use Redirect;
use Exception;
use Carbon\Carbon;
use App\Models\Order;
use Razorpay\Api\Api;
use App\Models\Coupon;
use App\Models\Message;
use App\Models\Product;
use App\Models\Setting;

Use Stripe;
use App\Models\OrderItem;
use App\Helpers\MailHelper;
use App\Models\BankPayment;
use App\Models\Flutterwave;
use App\Models\ShoppingCart;

use Illuminate\Http\Request;


use App\Models\EmailTemplate;
use App\Models\PaypalPayment;
use App\Models\StripePayment;
use App\Mail\OrderSuccessfully;
use App\Models\RazorpayPayment;
use App\Models\InstamojoPayment;
use App\Models\PaystackAndMollie;
use Mollie\Laravel\Facades\Mollie;
use App\Http\Controllers\Controller;

use Stripe\Checkout\Session as StripSession;
use Stripe\Price;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('order_store', 'store_message', 'webview_success_payment', 'webview_faild_payment', 'razorpay_webview_payment', 'mollie_webview_payment', 'webview_stripe_success', 'webview_stripe_faild', 'paystack_webview_payment');
    }

    public function translator($lang_code){
        $front_lang = Session::put('front_lang', $lang_code);
        config(['app.locale' => $lang_code]);
    }

    public function payment(Request $request){


        $user = Auth::guard('api')->user();

        $items = ShoppingCart::where(['user_id' => $user->id])->latest()->get();

        if($items->count() == 0){
            return response()->json([
                'message' => trans('user_validation.Your shopping cart is empty, so you can not make payment')
            ], 403);
        }

        $paypal = PaypalPayment::active()->with('currency')->first();
        $stripe = StripePayment::active()->with('currency')->first();
        $razorpay = RazorpayPayment::active()->with('currency')->first();
        $paystack = PaystackAndMollie::active()->with('paystackcurrency')->first();
        $mollie = PaystackAndMollie::active()->with('molliecurrency')->first();
        $instamojo = InstamojoPayment::active()->with('currency')->first();
        $flutterwave = Flutterwave::active()->with('currency')->first();
        $bankPayment = BankPayment::active()->first();

        return response()->json([
            'items' => $items,
            'paypal' => $paypal,
            'stripe' => $stripe,
            'razorpay' => $razorpay,
            'paystack' => $paystack,
            'mollie' => $mollie,
            'instamojo' => $instamojo,
            'flutterwave' => $flutterwave,
            'bankPayment' => $bankPayment,
        ]);
    }


    public function make_order(Request $request){

        $user = Auth::guard('api')->user();

        $items = ShoppingCart::where(['user_id' => $user->id])->latest()->get();

        if($items->count() == 0){
            return response()->json([
                'message' => trans('user_validation.Your shopping cart is empty, so you can not make payment')
            ], 403);
        }

        $message = $request->message;
        $account_id = $request->account_id;

        $order_type = 'add_to_cart';
        if($request->order_type){
            if($request->order_type == 'buy_now'){
                $order_type = 'buy_now';
            }
        }

        $order = $this->order_store($order_type, $user, 'hand_cash', 'success', 'transection_id', $message, $account_id);

        return response()->json([
            'message' => trans('user_validation.Your order has been placed, thanks for new order'),
            'order' => $order,
        ]);

    }

    public function bank_payment(Request $request){

        $this->translator($request->lang_code);

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            return response()->json(['message' => $notification], 403);
        }

        $rules = [
            'tnx_info'=>'required',
        ];

        $customMessages = [
            'tnx_info.required' => trans('user_validation.Transaction is required'),
        ];

        $this->validate($request, $rules,$customMessages);

        $user=Auth::guard('api')->user();

        $items = ShoppingCart::where(['user_id' => $user->id])->latest()->get();

        if($items->count() == 0){
            return response()->json([
                'message' => trans('user_validation.Your shopping cart is empty, so you can not make payment')
            ], 403);
        }

        $message = $request->message;
        $account_id = $request->account_id;

        $order_type = 'add_to_cart';
        if($request->order_type){
            if($request->order_type == 'buy_now'){
                $order_type = 'buy_now';
            }
        }

        $order = $this->order_store($order_type, $user, 'bank_payment', 'pending', $request->tnx_info, $message, $account_id);

        $notification = trans('user_validation.Your order has been submited, wait for admin approval');
        return response()->json(['message' => $notification]);


    }

    public function webview_stripe_success(Request $request){

        $lang_code = Session::get('lang_code');

        $this->translator($lang_code);

        $stripe = StripePayment::with('currency')->first();

        Stripe\Stripe::setApiKey($stripe->stripe_secret);

        $checkoutSessionId = Session::get('checkoutSessionId');
        $callback_success_url = Session::get('callback_success_url');
        $callback_faild_url = Session::get('callback_faild_url');
        $user = Session::get('auth_user');
        $order_type = Session::get('order_type');

        if($checkoutSessionId){

            try {
                $stripe_session = StripSession::retrieve($checkoutSessionId);

                if($stripe_session->payment_status == 'paid'){
                    $transaction_id = $stripe_session->payment_intent;

                    $calculate_amount = $this->calculate_total_price($order_type, $user);

                    $items = ShoppingCart::where(['user_id' => $user->id])->latest()->get();

                    if($items->count() == 0){

                        $message = trans('user_validation.Your shopping cart is empty, so you can not make payment');
                        $callback_faild_url = $callback_faild_url."?message=".$message."&status=faild";

                        return redirect($callback_faild_url);

                    }

                    $message = $order_type = Session::get('req_message');
                    $account_id = $order_type = Session::get('req_account_id');

                    $order = $this->order_store($order_type, $user, 'stripe', 'success', $transaction_id, $message, $account_id);

                    $message = trans('user_validation.Your order has been placed, thanks for new order');
                    $callback_success_url = $callback_success_url."?message=".$message."&status=success";
                    return redirect($callback_success_url);

                }else{
                    $message = trans('user_validation.Your payment is faild, please try again');
                    $callback_faild_url = $callback_faild_url."?message=".$message."&status=faild";

                    return redirect($callback_faild_url);
                }
            } catch (\Exception $e) {
                $message = trans('user_validation.Server error occured, please try again');
                $callback_faild_url = $callback_faild_url."?message=".$message."&status=faild";

                return redirect($callback_faild_url);
            }
        }else{

            $message = trans('user_validation.Something went wrong, please try again');
            $callback_faild_url = $callback_faild_url."?message=".$message."&status=faild";

            return redirect($callback_faild_url);
        }

    }

    public function webview_stripe_faild(Request $request){

        $callback_faild_url = Session::get('callback_faild_url');
        $message = trans('user_validation.Your payment is faild, please try again');
        $callback_faild_url = $callback_faild_url."?message=".$message."&status=faild";

        return redirect($callback_faild_url);
    }


    public function pay_with_stripe(Request $request){

        $this->translator($request->lang_code);

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            return response()->json(['message' => $notification], 403);
        }


        $stripe = StripePayment::with('currency')->first();

        Stripe\Stripe::setApiKey($stripe->stripe_secret);

        $user = Auth::guard('api')->user();

        $order_type = 'add_to_cart';
        if($request->order_type){
            if($request->order_type == 'buy_now'){
                $order_type = 'buy_now';
            }
        }

        $calculate_amount = $this->calculate_total_price($order_type, $user);

        $items = [];

        if($order_type == 'buy_now'){
            $items = ShoppingCart::where(['user_id' => $user->id, 'item_type' => 'buy_now'])->latest()->get();
        }else{
            $items = ShoppingCart::where(['user_id' => $user->id, 'item_type' => 'add_to_cart'])->latest()->get();
        }

        $lineItems = [];

        foreach ($items as $item) {

            $sub_total = $item->option_price * $item->qty;

            $product = Product::find($item->product_id);

            $price = Price::create([
                'unit_amount' => $sub_total * 100, // Price in cents
                'currency' => $stripe->currency->currency_code,
                'product_data' => [
                    'name' => $product?->name ? $product?->name : 'Test name' ,
                ],
            ]);

            $priceId = $price->id;

            $lineItems[] = [
                'price' => $priceId,
                'quantity' => $item->qty,
            ];
        }

        $checkoutSession = StripSession::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('payment-api.webview-stripe-success'),
            'cancel_url' => route('payment-api.webview-stripe-faild'),
        ]);

        $setting = Setting::first();
        $callback_success_url = $setting->frontend_url."/payment/success";
        $callback_faild_url = $setting->frontend_url."/payment/failed";

        Session::put('auth_user', $user);
        Session::put('checkoutSessionId', $checkoutSession->id);
        Session::put('payment_intent', $checkoutSession->payment_intent);
        Session::put('callback_success_url', $callback_success_url);
        Session::put('callback_faild_url', $callback_faild_url);
        Session::put('order_type', $order_type);
        Session::put('req_message', $request->message);
        Session::put('req_account_id', $request->account_id);
        Session::put('lang_code', $request->lang_code);


        return redirect($checkoutSession->url);

    }

    public function order_store($order_type, $user, $payment_method, $payment_status, $transection_id, $message = null, $account_id = null){

        if($order_type == 'buy_now'){
            $items = ShoppingCart::where(['user_id' => $user->id, 'item_type' => 'buy_now'])->latest()->get();
        }else{
            $items = ShoppingCart::where(['user_id' => $user->id, 'item_type' => 'add_to_cart'])->latest()->get();
        }

        $calculate_amount = $this->calculate_total_price($order_type, $user);

        $order = new Order();
        $order->order_id = mt_rand(100000,999999).date('Ymdhis');
        $order->user_id = $user->id;
        $order->total_amount = $calculate_amount['total_amount'];
        $order->discount_amount = $calculate_amount['discount_amount'];
        $order->payable_amount = $calculate_amount['payable_amount'];
        $order->payment_method = $payment_method;
        $order->payment_status = $payment_status;
        $order->transection_id = $transection_id;
        $order->order_status = 0;
        $order->cart_qty = $calculate_amount['cart_qty'];
        $order->message = $message;
        $order->account_id = $account_id;
        $order->save();

        foreach($items as $item){
            $product = Product::find($item->product_id);
            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $order_item->product_id = $item->product_id;
            $order_item->author_id = $product?->author_id;
            $order_item->user_id = $item->user_id;
            $order_item->option_name = $item->option_name;
            $order_item->option_price = $item->option_price;
            $order_item->variant_id = $item->variant_id;
            $order_item->variant_name = $item->variant_name;
            $order_item->qty = $item->qty;
            $order_item->message = $item->message;
            $order_item->account_id = $item->account_id;
            $order_item->save();

            if($item->account_id){
                $this->store_message($user->id, $product?->author_id, 'Account Id : '. $item->account_id, $order_item->id);
            }

            if($item->message){
                $this->store_message($user->id, $product?->author_id, $item->message, $order_item->id);
            }

            if($order->account_id){
                $this->store_message($user->id, $product?->author_id, 'Account Id : '. $order->account_id, $order_item->id);
            }

            if($order->message){
                $this->store_message($user->id, $product?->author_id, $order->message, $order_item->id);
            }

        }

        if($order_type){
            if($order_type == 'buy_now'){
                $items = ShoppingCart::where(['user_id' => $user->id, 'item_type' => 'buy_now'])->delete();
            }else{
                ShoppingCart::where(['user_id' => $user->id])->delete();
            }
        }else{
            ShoppingCart::where(['user_id' => $user->id])->delete();
        }

        return $order;

    }


    public function calculate_total_price($order_type, $user){

        if($order_type == 'buy_now'){
            $items = ShoppingCart::where(['user_id' => $user->id, 'item_type' => 'buy_now'])->latest()->get();
        }else{
            $items = ShoppingCart::where(['user_id' => $user->id, 'item_type' => 'add_to_cart'])->latest()->get();
        }

        $total_amount = 0;
        $discount_amount = 0;
        $cart_qty = 0;

        foreach($items as $item){
            $sub_total = $item->option_price * $item->qty;
            $total_amount += $sub_total;
            $cart_qty += $item->qty;
        }

        $payable_amount = $total_amount - $discount_amount;

        return array(
            'total_amount' => $total_amount,
            'discount_amount' => $discount_amount,
            'payable_amount' => $payable_amount,
            'cart_qty' => $cart_qty,
        );
    }


    public function store_message($user_id, $author_id = 0, $message, $order_item_id){
        $new_message = new Message();
        $new_message->user_id = $user_id;
        $new_message->seller_id = $author_id;
        $new_message->message = $message;
        $new_message->customer_read_msg = 1;
        $new_message->send_customer = 1;
        $new_message->order_item_id = $order_item_id;
        $new_message->save();

    }

    public function razorpay_webview(Request $request){

        $this->translator($request->lang_code);
        Session::forget('lang_code');
        $razorpay = RazorpayPayment::with('currency')->first();

        $user = Auth::guard('api')->user();

        Session::put('auth_user', $user);

        $order_type = 'add_to_cart';
        if($request->order_type){
            if($request->order_type == 'buy_now'){
                $order_type = 'buy_now';
            }
        }


        $calculate_amount = $this->calculate_total_price($order_type, $user);

        $setting = Setting::first();
        $callback_success_url = $setting->frontend_url."/payment/success";
        $callback_faild_url = $setting->frontend_url."/payment/failed";

        Session::put('order_type', $order_type);
        Session::put('callback_success_url', $callback_success_url);
        Session::put('callback_faild_url', $callback_faild_url);
        Session::put('req_message', $request->message);
        Session::put('req_account_id', $request->account_id);

        Session::put('lang_code', $request->lang_code);

        return view('razorpay_webview', compact('razorpay','user','calculate_amount'));
    }

    public function razorpay_webview_payment(Request $request){

        $user = Session::get('auth_user');
        $razorpay = RazorpayPayment::with('currency')->first();
        $input = $request->all();
        $api = new Api($razorpay->key,$razorpay->secret_key);
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
                $payId = $response->id;



                $order_type = Session::get('order_type');
                $message = Session::get('req_message');
                $account_id = Session::get('req_account_id');

                $order = $this->order_store($order_type, $user, 'Razorpay', 'success', $payId, $message, $account_id);

                return redirect()->route('payment-api.webview-success-payment');

            }catch (Exception $e) {
                return redirect()->route('payment-api.webview-faild-payment');
            }
        }else{
            return redirect()->route('payment-api.webview-faild-payment');
        }
    }


    public function flutterwave_webview(Request $request){

        $this->translator($request->lang_code);
        Session::forget('lang_code');
        Session::put('lang_code', $request->lang_code);

        $flutterwave = Flutterwave::with('currency')->first();

        $user = Auth::guard('api')->user();

        Session::put('auth_user', $user);

        $order_type = 'add_to_cart';
        if($request->order_type){
            if($request->order_type == 'buy_now'){
                $order_type = 'buy_now';
            }
        }

        $calculate_amount = $this->calculate_total_price($order_type, $user);

        $setting = Setting::first();
        $callback_success_url = $setting->frontend_url."/payment/success";
        $callback_faild_url = $setting->frontend_url."/payment/failed";

        Session::put('callback_success_url', $callback_success_url);
        Session::put('callback_faild_url', $callback_faild_url);

        Session::put('order_type', $order_type);

        Session::put('req_message', $request->message);
        Session::put('req_account_id', $request->account_id);

        return view('flutterwave_webview', compact('flutterwave','user','calculate_amount'));
    }

    public function flutterwave_webview_payment(Request $request){
        $lang_code = Session::get('lang_code');

        $this->translator($lang_code);

        $user = Session::get('auth_user');

        $flutterwave = Flutterwave::with('currency')->first();
        $curl = curl_init();
        $tnx_id = $request->tnx_id;
        $url = "https://api.flutterwave.com/v3/transactions/$tnx_id/verify";
        $token = $flutterwave->secret_key;
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer $token"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        if($response->status == 'success'){

            $order_type = Session::get('order_type');
            $message = Session::get('req_message');
            $account_id = Session::get('req_account_id');

            $order = $this->order_store($order_type, $user, 'Flutterwave', 'success', $tnx_id, $message, $account_id);

            $notification = trans('user_validation.Thanks for your new order');
            return response()->json(['status' => 'success' , 'message' => $notification]);
        }else{
            $notification = trans('user_validation.Payment Faild');
            return response()->json(['status' => 'faild' , 'message' => $notification]);
        }
    }

    public function mollie_webview(Request $request){
        $this->translator($request->lang_code);
        Session::forget('lang_code');
        Session::put('lang_code', $request->lang_code);
        $user = Auth::guard('api')->user();

        $order_type = 'add_to_cart';
        if($request->order_type){
            if($request->order_type == 'buy_now'){
                $order_type = 'buy_now';
            }
        }

        $calculate_amount = $this->calculate_total_price($order_type, $user);

        $mollie = PaystackAndMollie::with('molliecurrency')->first();
        $price = $calculate_amount['payable_amount'] * $mollie->molliecurrency->currency_rate;
        $price = round($price,2);
        $price = sprintf('%0.2f', $price);

        $mollie_api_key = $mollie->mollie_key;
        $currency = strtoupper($mollie->molliecurrency->currency_code);
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $currency,
                'value' => ''.$price.'',
            ],
            'description' => env('APP_NAME'),
            'redirectUrl' => route('payment-api.mollie-webview-payment'),
        ]);

        $payment = Mollie::api()->payments()->get($payment->id);
        session()->put('payment_id',$payment->id);
        session()->put('auth_user',$user);

        $setting = Setting::first();
        $callback_success_url = $setting->frontend_url."/payment/success";
        $callback_faild_url = $setting->frontend_url."/payment/failed";

        Session::put('callback_success_url', $callback_success_url);
        Session::put('callback_faild_url', $callback_faild_url);

        Session::put('order_type', $order_type);
        Session::put('req_message', $request->message);
        Session::put('req_account_id', $request->account_id);

        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function mollie_webview_payment(Request $request){

        $user = Session::get('auth_user');
        $mollie = PaystackAndMollie::with('molliecurrency')->first();
        $mollie_api_key = $mollie->mollie_key;
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments->get(session()->get('payment_id'));
        if ($payment->isPaid()){
            $order_type = Session::get('order_type');
            $message = Session::get('req_message');
            $account_id = Session::get('req_account_id');

            $order = $this->order_store($order_type, $user, 'Mollie', 'success', session()->get('payment_id'), $message, $account_id);

            return redirect()->route('payment-api.webview-success-payment');

        }else{
            return redirect()->route('payment-api.webview-faild-payment');
        }
    }

    public function paystack_webview(Request $request){

        $this->translator($request->lang_code);
        Session::forget('lang_code');
        Session::put('lang_code', $request->lang_code);


        $user = Auth::guard('api')->user();

        $order_type = 'add_to_cart';
        if($request->order_type){
            if($request->order_type == 'buy_now'){
                $order_type = 'buy_now';
            }
        }

        $calculate_amount = $this->calculate_total_price($order_type, $user);

        $mollie = PaystackAndMollie::with('paystackcurrency')->first();
        $paystack = $mollie;

        $setting = Setting::first();
        $callback_success_url = $setting->frontend_url."/payment/success";
        $callback_faild_url = $setting->frontend_url."/payment/failed";

        Session::put('callback_success_url', $callback_success_url);
        Session::put('callback_faild_url', $callback_faild_url);

        Session::put('auth_user', $user);
        Session::put('order_type', $order_type);
        Session::put('req_message', $request->message);
        Session::put('req_account_id', $request->account_id);

        return view('paystack_webview', compact('paystack','user','calculate_amount'));
    }

    public function paystack_webview_payment(Request $request){

        $lang_code = Session::get('lang_code');
        $this->translator($lang_code);

        $user = Session::get('auth_user');
        $paystack = PaystackAndMollie::with('paystackcurrency')->first();

        $reference = $request->reference;
        $transaction = $request->tnx_id;
        $secret_key = $paystack->paystack_secret_key;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST =>0,
            CURLOPT_SSL_VERIFYPEER =>0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $secret_key",
                "Cache-Control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $final_data = json_decode($response);
        if($final_data->status == true) {

            $order_type = Session::get('order_type');
            $message = Session::get('req_message');
            $account_id = Session::get('req_account_id');

            $order = $this->order_store($order_type, $user, 'Paystack', 'success', $transaction, $message, $account_id);

            $notification = trans('user_validation.Thanks for your new order');
            return response()->json(['status' => 'success' , 'message' => $notification]);
        }else{
            $notification = trans('user_validation.Payment Faild');
            return response()->json(['status' => 'faild' , 'message' => $notification]);
        }
    }


    public function instamojo_webview(Request $request){

        $this->translator($request->lang_code);
        Session::forget('lang_code');
        Session::put('lang_code', $request->lang_code);

        $user = Auth::guard('api')->user();

        $order_type = 'add_to_cart';
        if($request->order_type){
            if($request->order_type == 'buy_now'){
                $order_type = 'buy_now';
            }
        }

        $calculate_amount = $this->calculate_total_price($order_type, $user);

        $instamojoPayment = InstamojoPayment::with('currency')->first();
        $price = $calculate_amount['payable_amount'] * $instamojoPayment->currency->currency_rate;
        $price = round($price,2);

        $environment = $instamojoPayment->account_mode;
        $api_key = $instamojoPayment->api_key;
        $auth_token = $instamojoPayment->auth_token;

        if($environment == 'Sandbox') {
            $url = 'https://test.instamojo.com/api/1.1/';
        } else {
            $url = 'https://www.instamojo.com/api/1.1/';
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url.'payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:$api_key",
                "X-Auth-Token:$auth_token"));
        $payload = Array(
            'purpose' => env("APP_NAME"),
            'amount' => $price,
            'phone' => '918160651749',
            'buyer_name' => Auth::user()->name,
            'redirect_url' => route('payment-api.instamojo-webview-payment'),
            'send_email' => true,
            'webhook' => 'http://www.example.com/webhook/',
            'send_sms' => true,
            'email' => Auth::user()->email,
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        $setting = Setting::first();
        $callback_success_url = $setting->frontend_url."/payment/success";
        $callback_faild_url = $setting->frontend_url."/payment/failed";

        Session::put('callback_success_url', $callback_success_url);
        Session::put('callback_faild_url', $callback_faild_url);

        Session::put('auth_user', $user);
        Session::put('order_type', $order_type);
        Session::put('req_message', $request->message);
        Session::put('req_account_id', $request->account_id);

        return redirect($response->payment_request->longurl);
    }

    public function instamojo_webview_payment(Request $request){

        $lang_code = Session::get('lang_code');
        $this->translator($lang_code);

        $user = Session::get('auth_user');

        $input = $request->all();
        $instamojoPayment = InstamojoPayment::with('currency')->first();
        $environment = $instamojoPayment->account_mode;
        $api_key = $instamojoPayment->api_key;
        $auth_token = $instamojoPayment->auth_token;

        if($environment == 'Sandbox') {
            $url = 'https://test.instamojo.com/api/1.1/';
        } else {
            $url = 'https://www.instamojo.com/api/1.1/';
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url.'payments/'.$request->get('payment_id'));
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:$api_key",
                "X-Auth-Token:$auth_token"));
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return redirect()->route('payment-api.webview-faild-payment');
        } else {
            $data = json_decode($response);
        }

        if($data->success == true) {
            if($data->payment->status == 'Credit') {

                $order_type = Session::get('order_type');
                $message = Session::get('req_message');
                $account_id = Session::get('req_account_id');

                $order = $this->order_store($order_type, $user, 'Instamojo', 'success', $request->get('payment_id'), $message, $account_id);

                return redirect()->route('payment-api.webview-success-payment');

            }
        }else{
            return redirect()->route('payment-api.webview-faild-payment');
        }
    }

    public function webview_success_payment(){
        $lang_code = Session::get('lang_code');

        $this->translator($lang_code);

        $callback_url = Session::get('callback_success_url');

        $callback_url = $callback_url ."?status=success&message=".trans('user_validation.Your order has been placed, thanks for new order');;

        return redirect($callback_url);

    }

    public function webview_faild_payment(){

        $lang_code = Session::get('lang_code');

        $this->translator($lang_code);

        $callback_url = Session::get('callback_faild_url');

        $callback_url = $callback_url ."?status=faild&message=".trans('user_validation.Payment failed, please try again');

        return redirect($callback_url);
    }

    public function store_order($user, $payment_method, $payment_status, $transection, $coupon_code, $coupon_amount){
        $carts = ShoppingCart::with('author','category','variant','product')->where('user_id', $user->id)->get();

        $sub_total_amount = 0.00;
        foreach($carts as $cart){
            if($cart->product_type == 'script'){
                if($cart->price_type == 'regular_price'){
                    $sub_total_amount += $cart->product->regular_price;
                }elseif($cart->price_type == 'extend_price'){
                    $sub_total_amount += $cart->product->extend_price;
                }
            }else{
                $sub_total_amount += $cart->variant->price;
            }
        }

        $discount_amount = 0.00;

        if($coupon_code){
            $coupon = Coupon::where('coupon_name', $coupon_code)->where('coupon_validity','>=', Carbon::now()->format('Y-m-d'))->where('status', 1)->first();
            if($coupon){
                $discount_amount = $coupon_amount;
            }
        }

        $total_amount = $sub_total_amount - $discount_amount;

        $order= new Order();
        $order->order_id=mt_rand(100000,999999);
        $order->user_id=$user->id;
        $order->total_amount = $total_amount;
        $order->discount_amount = $discount_amount;
        $order->sub_total_amount = $sub_total_amount;
        $order->payment_method=$payment_method;
        $order->payment_status= $payment_status;
        $order->transection_id= $transection;
        $order->order_status= $payment_status == 'pending' ? 0 : 1;
        $order->order_date=Carbon::now()->format('Y-m-d');
        $order->order_month=Carbon::now()->format('m');
        $order->order_year=Carbon::now()->format('Y');
        $order->cart_qty=$carts->count();
        $order->save();

        foreach($carts as $cart){
            $product=Product::where('id', $cart->product_id)->first();

            $single_price = 0.00;

            if($cart->product_type == 'script'){
                if($cart->price_type == 'regular_price'){
                    $single_price = $cart->product->regular_price;
                }elseif($cart->price_type == 'extend_price'){
                    $single_price = $cart->product->extend_price;
                }
            }else{
                $single_price = $cart->variant->price;
            }


            $orderItem = new OrderItem();
            $orderItem->order_id=$order->id;
            $orderItem->product_id=$cart->product_id;
            $orderItem->author_id=$product->author_id;
            $orderItem->user_id=$user->id;
            $orderItem->product_type=$cart->product_type;
            $orderItem->price_type=$cart->price_type;
            $orderItem->variant_id=$cart->variant_id;
            $orderItem->variant_name= $cart->variant ? $cart->variant->name : '';
            $orderItem->price=$single_price;
            $orderItem->qty=1;
            $orderItem->save();
        }
        $this->sendMailToUser($user, $order);

        Session::forget('coupon_code');
        Session::forget('coupon_amount');

        ShoppingCart::where('user_id', $user->id)->delete();
    }


    public function sendMailToUser($user, $order){
        MailHelper::setMailConfig();

        $setting = Setting::first();

        $template=EmailTemplate::where('id',8)->first();
        $subject=$template->subject;
        $message=$template->description;
        $message = str_replace('{{name}}',$user->name,$message);
        $message = str_replace('{{amount}}',$setting->currency_icon.$order->total_amount,$message);
        $message = str_replace('{{order_id}}',$order->order_id,$message);
        Mail::to($user->email)->send(new OrderSuccessfully($message,$subject));
    }


}
