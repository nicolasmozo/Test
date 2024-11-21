<?php

namespace App\Http\Controllers\Seller;

use App\Constants\Status;
use App\Helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Models\BankPayment;
use App\Models\EmailTemplate;
use App\Models\Flutterwave;
use App\Models\InstamojoPayment;
use App\Models\PaypalPayment;
use App\Models\PaystackAndMollie;
use App\Models\PricingPlan;
use App\Models\RazorpayPayment;
use App\Models\Setting;
use App\Models\StripePayment;
use App\Models\SubscriptionSeller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderSuccessfully;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;
use Razorpay\Api\Api;
use Mollie\Laravel\Facades\Mollie;


class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function freeEnroll($slug)
    {

        if (env('APP_MODE') == 'DEMO') {
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        $user = Auth::guard('web')->user();

        $free_order = SubscriptionSeller::where(['seller_id' => $user->id, 'plan_type' => 'free'])->count();

        if ($free_order == Status::NO) {
            $pricing_plan = PricingPlan::where(['plan_slug' => $slug])->first();
            $order = $this->createOrder($user, $pricing_plan, 'Free', Status::ACTIVE, 'free_enroll');

            $this->sendMailToClient($user, $order);

            $notification = trans('user_validation.You have successfully enrolled this package');
            $notification = array('messege' => $notification, 'alert-type' => 'success');
            return redirect()->route('seller.dashboard')->with($notification);
        } else {
            $notification = trans('user_validation.You have already enrolled trial version');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }

    private function createOrder($user, $pricing_plan, $payment_method, $payment_status, $tnx_info)
    {

        if ($pricing_plan->expired_time == 'monthly') {
            $expiration_date = date('Y-m-d', strtotime('30 days'));
        } elseif ($pricing_plan->expired_time == 'yearly') {
            $expiration_date = date('Y-m-d', strtotime('365 days'));
        } elseif ($pricing_plan->expired_time == 'lifetime') {
            $expiration_date = 'lifetime';
        }

        if ($payment_status == Status::ACTIVE) {
            SubscriptionSeller::where('seller_id', $user->id)->update(['status' => Status::ACTIVE_SUBSCRIPTION]);
        }

        $order = new SubscriptionSeller();
        $order->order_id = randomNumber();
        $order->seller_id = $user->id;
        $order->pricing_plan_id = $pricing_plan->id;
        $order->plan_type = $pricing_plan->plan_type;
        $order->plan_price = $pricing_plan->plan_price ?? 0;
        $order->plan_name = $pricing_plan->plan_name;
        $order->expired_time = $pricing_plan->expired_time;

        $order->upload_limit = $pricing_plan->upload_limit;
        if ($payment_status == Status::ACTIVE) {
            $order->status = Status::ACTIVE_SUBSCRIPTION;
        } else {
            $order->status = Status::PENDING_SUBSCRIPTION;
        }
        $order->payment_status = $payment_status;
        $order->transaction_id = $tnx_info;
        $order->payment_method = $payment_method;
        $order->expiration_date = $expiration_date;
        $order->save();

        return $order;
    }

    private function sendMailToClient($user, $order)
    {
        MailHelper::setMailConfig();

        $setting = Setting::first();

        $template = EmailTemplate::where('id', 6)->first();
        $subject = $template->subject;
        $message = $template->description;
        $message = str_replace('{{user_name}}', $user->name, $message);
        $message = str_replace('{{total_amount}}', $setting->currency_icon . $order->plan_price, $message);
        $message = str_replace('{{payment_method}}', $order->payment_method, $message);
        $message = str_replace('{{payment_status}}', $order->payment_status, $message);
        Mail::to($user->email)->send(new OrderSuccessfully($message, $subject));
    }


    public function payment($slug)
    {

        $pageTitle = 'Purchase Plan Payment';
        $user = Auth::guard('web')->user();
        $user = User::findOrFail($user->id);

        $plan = PricingPlan::where(['plan_slug' => $slug])->first();

        if ($plan->expired_time == 'monthly') {
            $plan_expired_date = date('Y-m-d', strtotime('30 days'));
        } elseif ($plan->expired_time == 'yearly') {
            $plan_expired_date = date('Y-m-d', strtotime('365 days'));
        } elseif ($plan->expired_time == 'lifetime') {
            $plan_expired_date = 'lifetime';
        }

        $bank_payment = BankPayment::select('id', 'status', 'account_info', 'image')->first();
        $stripe = StripePayment::first();
        $paypal = PaypalPayment::first();
        $razorpay = RazorpayPayment::first();
        $flutterwave = Flutterwave::first();
        $mollie = PaystackAndMollie::first();
        $paystack = $mollie;
        $instamojo = InstamojoPayment::first();

        return view('seller.purchase_plan.payment')->with([
            'user' => $user,
            'pageTitle' => $pageTitle,
            'plan' => $plan,
            'plan_expired_date' => $plan_expired_date,
            'bank_payment' => $bank_payment,
            'stripe' => $stripe,
            'paypal' => $paypal,
            'razorpay' => $razorpay,
            'flutterwave' => $flutterwave,
            'mollie' => $mollie,
            'instamojo' => $instamojo,
            'paystack' => $paystack,
        ]);
    }

    public function payWithStripe(Request $request, $slug)
    {


        if (env('APP_MODE') == 'DEMO') {
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            $notification = array('messege' => $notification, 'alert-type' => 'error');

            return redirect()->back()->with($notification);
        }

        $pricing_plan = PricingPlan::where(['plan_slug' => $slug])->first();

        $user = Auth::guard('web')->user();

        $stripe = StripePayment::first();
        $payableAmount = round($pricing_plan->plan_price * $stripe->currency_rate, 2);
        Stripe\Stripe::setApiKey($stripe->stripe_secret);

        $result = Stripe\Charge::create([
            "amount" => $payableAmount * 100,
            "currency" => $stripe->currency_code,
            "source" => $request->stripeToken,
            "description" => env('APP_NAME')
        ]);

        $order = $this->createOrder($user, $pricing_plan, 'Stripe', Status::SUCCESS, $result->balance_transaction);

        $this->sendMailToClient($user, $order);

        $notification = trans('user_validation.You have successfully enrolled this package');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->route('seller.dashboard')->with($notification);
    }

    public function payWithFlutterwave(Request $request, $slug)
    {

        if (env('APP_MODE') == 'DEMO') {
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        $flutterwave = Flutterwave::first();
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
        if ($response->status == 'success') {

            $pricing_plan = PricingPlan::where(['plan_slug' => $slug])->first();
            $user = Auth::guard('web')->user();
            $order = $this->createOrder($user, $pricing_plan, 'Flutterwave', Status::ACTIVE, $tnx_id);
            $this->sendMailToClient($user, $order);

            $notification = trans('user_validation.You have successfully enrolled this package');
            return response()->json(['status' => 'success', 'message' => $notification]);
        } else {
            $notification = trans('user_validation.Payment Faild');
            return response()->json(['status' => 'faild', 'message' => $notification]);
        }
    }

    public function payWithRazorpay(Request $request, $slug)
    {
        if (env('APP_MODE') == 'DEMO') {
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        $razorpay = RazorpayPayment::first();
        $input = $request->all();
        $api = new Api($razorpay->key, $razorpay->secret_key);
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                $payId = $response->id;

                $pricing_plan = PricingPlan::where(['plan_slug' => $slug])->first();

                $user = Auth::guard('web')->user();
                $order = $this->createOrder($user, $pricing_plan, 'Razorpay', Status::SUCCESS, $payId);

                $this->sendMailToClient($user, $order);

                $notification = trans('user_validation.You have successfully enrolled this package');
                $notification = array('messege' => $notification, 'alert-type' => 'success');
                return redirect()->route('seller.dashboard')->with($notification);
            } catch (Exception $e) {
                $pricing_plan = PricingPlan::where(['plan_slug' => $slug])->first();
                $notification = trans('user_validation.Payment Failed');
                $notification = array('messege' => $notification, 'alert-type' => 'error');
                return redirect()->route('payment', $pricing_plan->plan_slug)->with($notification);
            }
        } else {
            $pricing_plan = PricingPlan::where(['plan_slug' => $slug])->first();
            $notification = trans('user_validation.Payment Failed');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->route('payment', $pricing_plan->plan_slug)->with($notification);
        }
    }

    public function payWithMollie(Request $request, $slug)
    {

        if (env('APP_MODE') == 'DEMO') {
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        $pricing_plan = PricingPlan::where(['plan_slug' => $slug])->first();
        //        $user = Auth::guard('web')->user();

        $mollie = PaystackAndMollie::first();
        $price = $pricing_plan->plan_price * $mollie->mollie_currency_rate;
        $price = round($price, 2);
        $price = sprintf('%0.2f', $price);

        $mollie_api_key = $mollie->mollie_key;
        $currency = strtoupper($mollie->mollie_currency_code);
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $currency,
                'value' => '' . $price . '',
            ],
            'description' => env('APP_NAME'),
            'redirectUrl' => route('mollie-payment-success'),
        ]);

        $payment = Mollie::api()->payments()->get($payment->id);
        session()->put('payment_id', $payment->id);
        session()->put('pricing_plan', $pricing_plan);
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function molliePaymentSuccess(Request $request)
    {
        $pricing_plan = Session::get('pricing_plan');
        $mollie = PaystackAndMollie::first();
        $mollie_api_key = $mollie->mollie_key;
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments->get(session()->get('payment_id'));

        if ($payment->isPaid()) {
            $user = Auth::guard('web')->user();
            $order = $this->createOrder($user, $pricing_plan, 'Mollie', Status::SUCCESS, session()->get('payment_id'));
            $this->sendMailToClient($user, $order);

            $notification = trans('user_validation.You have successfully enrolled this package');
            $notification = array('messege' => $notification, 'alert-type' => 'success');
            return redirect()->route('seller.dashboard')->with($notification);
        } else {
            $notification = trans('user_validation.Payment Failed');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->route('payment', $pricing_plan->plan_slug)->with($notification);
        }
    }


    public function payWithInstamojo(Request $request, $slug)
    {
        try {
            if (env('APP_MODE') == 'DEMO') {
                return redirect()->back()->with([
                    'messege' => trans('user_validation.This Is Demo Version. You Can Not Change Anything'),
                    'alert-type' => 'error'
                ]);
            }

            $pricing_plan = PricingPlan::where(['plan_slug' => $slug])->firstOrFail();
            $user = Auth::guard('web')->user();
            $instamojoPayment = InstamojoPayment::firstOrFail();

            // Validate required configuration
            if (!$instamojoPayment->api_key || !$instamojoPayment->auth_token) {
                throw new \Exception('Instamojo configuration is incomplete');
            }

            $price = round($pricing_plan->plan_price * $instamojoPayment->currency_rate, 2);

            $baseUrl = $instamojoPayment->account_mode == 'Sandbox'
                ? 'https://test.instamojo.com/api/1.1/'
                : 'https://www.instamojo.com/api/1.1/';

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $baseUrl . 'payment-requests/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => [
                    "X-Api-Key:" . $instamojoPayment->api_key,
                    "X-Auth-Token:" . $instamojoPayment->auth_token,
                    "Content-Type: application/x-www-form-urlencoded"
                ],
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_SSL_VERIFYPEER => true,
            ]);

            $payload = [
                'purpose' => env("APP_NAME") . ' - ' . $pricing_plan->plan_name,
                'amount' => $price,
                'buyer_name' => $user->name,
                'email' => $user->email,
                'redirect_url' => route('response-instamojo'),
                'send_email' => true,
                'send_sms' => false,
                'allow_repeated_payments' => false,
                'webhook' => route('instamojo.webhook')  // Make sure to create this route
            ];

            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));

            $response = curl_exec($ch);
            $err = curl_error($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if ($err) {
                throw new \Exception('cURL Error: ' . $err);
            }

            $response = json_decode($response);

            if (!$response || !isset($response->payment_request)) {
                if (isset($response->message)) {
                    throw new \Exception('Instamojo Error: ' . $response->message);
                }
                throw new \Exception('Invalid response from Instamojo');
            }

            // Store necessary data in session
            Session::put('pricing_plan', $pricing_plan);
            Session::put('instamojo_payment_id', $response->payment_request->id);

            return redirect($response->payment_request->longurl);
        } catch (\Exception $e) {
            \Log::error('Instamojo Payment Error: ' . $e->getMessage());
            return redirect()->back()->with([
                'messege' => trans('user_validation.Payment initialization failed. Please try again'),
                'alert-type' => 'error'
            ]);
        }
    }

    public function instamojoResponse(Request $request)
    {
        try {
            if (!$request->get('payment_id')) {
                throw new \Exception('Payment ID not found');
            }

            $pricing_plan = Session::get('pricing_plan');
            if (!$pricing_plan) {
                throw new \Exception('Session expired or invalid');
            }

            $instamojoPayment = InstamojoPayment::firstOrFail();
            $baseUrl = $instamojoPayment->account_mode == 'Sandbox'
                ? 'https://test.instamojo.com/api/1.1/'
                : 'https://www.instamojo.com/api/1.1/';

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $baseUrl . 'payments/' . $request->get('payment_id'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => [
                    "X-Api-Key:" . $instamojoPayment->api_key,
                    "X-Auth-Token:" . $instamojoPayment->auth_token
                ],
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_SSL_VERIFYPEER => true,
            ]);

            $response = curl_exec($ch);
            $err = curl_error($ch);

            curl_close($ch);

            if ($err) {
                throw new \Exception('cURL Error: ' . $err);
            }

            $data = json_decode($response);

            if (!$data || !isset($data->success)) {
                throw new \Exception('Invalid response from Instamojo');
            }

            if ($data->success && $data->payment->status == 'Credit') {
                $user = Auth::guard('web')->user();
                $order = $this->createOrder($user, $pricing_plan, 'Instamojo', Status::SUCCESS, $request->get('payment_id'));

                $this->sendMailToClient($user, $order);

                Session::forget(['pricing_plan', 'instamojo_payment_id']);

                return redirect()->route('user.dashboard')->with([
                    'messege' => trans('user_validation.You have successfully enrolled this package'),
                    'alert-type' => 'success'
                ]);
            }

            throw new \Exception('Payment verification failed');
        } catch (\Exception $e) {
            \Log::error('Instamojo Response Error: ' . $e->getMessage());
            return redirect()->route('payment', $pricing_plan->plan_slug)->with([
                'messege' => trans('user_validation.Payment Failed'),
                'alert-type' => 'error'
            ]);
        }
    }


    public function bankPayment(Request $request, $slug)
    {

        if (env('APP_MODE') == 'DEMO') {
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        $rules = [
            'transaction_id' => 'required',
        ];
        $customMessages = [
            'transaction_id.required' => trans('user_validation.Transaction is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $pricing_plan = PricingPlan::where(['plan_slug' => $slug])->first();
        $user = Auth::guard('web')->user();
        $order = $this->createOrder($user, $pricing_plan, 'Bank payment', Status::PENDING, $request->tnx_info);
        $this->sendMailToClient($user, $order);

        $notification = trans('user_validation.Your order has been placed. please wait for admin payment approval');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->route('seller.dashboard')->with($notification);
    }


    public function payWithPayStack(Request $request, $slug)
    {

        if (env('APP_MODE') == 'DEMO') {
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        $paystack = PaystackAndMollie::first();

        $reference = $request->reference;
        $transaction = $request->tnx_id;
        $secret_key = $paystack->paystack_secret_key;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
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
        if ($final_data->status == true) {
            $pricing_plan = PricingPlan::where(['plan_slug' => $slug])->first();
            $user = Auth::guard('web')->user();
            $order = $this->createOrder($user, $pricing_plan, 'Paystack', Status::ACTIVE, $transaction);
            $this->sendMailToClient($user, $order);

            $notification = trans('user_validation.You have successfully enrolled this package');
            return response()->json(['status' => 'success', 'message' => $notification]);
        } else {
            $notification = trans('user_validation.Payment Failed');
            return response()->json(['status' => 'failed', 'message' => $notification]);
        }
    }
}
