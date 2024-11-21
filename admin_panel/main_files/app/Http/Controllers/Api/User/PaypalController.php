<?php

namespace App\Http\Controllers\Api\User;

use Auth;
use Mail;
use Session;

use PayPal\Api\Payer;
use PayPal\Api\Amount;
use App\Models\Setting;
use PayPal\Api\Payment;

use App\Helpers\MailHelper;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;

use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use App\Models\EmailTemplate;
use App\Models\PaypalPayment;
use App\Mail\OrderSuccessfully;
use PayPal\Api\PaymentExecution;
use App\Http\Controllers\Controller;
use PayPal\Auth\OAuthTokenCredential;

use App\Http\Controllers\Api\User\PaymentController;

class PaypalController extends Controller
{

    private $apiContext;
    public function __construct()
    {
        $account = PaypalPayment::first();
        $paypal_conf = \Config::get('paypal');
        $this->apiContext = new ApiContext(new OAuthTokenCredential(
            $account->client_id,
            $account->secret_id,
            )
        );

        $setting=array(
            'mode' => $account->account_mode,
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path() . '/logs/paypal.log',
            'log.LogLevel' => 'ERROR'
        );
        $this->apiContext->setConfig($setting);
    }

    public function translator($lang_code){
        $front_lang = Session::put('front_lang', $lang_code);
        config(['app.locale' => $lang_code]);
    }

    public function paypal_webview(Request $request){

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

        $payment_order = new PaymentController();

        $calculate_amount = $payment_order->calculate_total_price($order_type, $user);

        $paypalSetting = PaypalPayment::with('currency')->first();
        $payableAmount = round($calculate_amount['payable_amount'] * $paypalSetting->currency->currency_rate,2);

        $name = env('APP_NAME');

        // set payer
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        // set amount total
        $amount = new Amount();
        $amount->setCurrency($paypalSetting->currency->currency_code)
            ->setTotal($payableAmount);

        // transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription(env('APP_NAME'));

        // redirect url
        $redirectUrls = new RedirectUrls();

        $redirectUrls->setReturnUrl(route('payment-api.paypal-webview-success'))
            ->setCancelUrl(route('payment-api.webview-faild-payment'));


        // payment
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try {

            $payment->create($this->apiContext);

        } catch (\PayPal\Exception\PPConnectionException $ex) {
            return redirect()->route('payment-api.webview-faild-payment');
        }

        // get paymentlink
        $approvalUrl = $payment->getApprovalLink();

        $setting = Setting::first();
        $callback_success_url = $setting->frontend_url."/payment/success";
        $callback_faild_url = $setting->frontend_url."/payment/failed";

        Session::put('callback_success_url', $callback_success_url);
        Session::put('callback_faild_url', $callback_faild_url);

        Session::put('auth_user', $user);
        Session::put('order_type', $order_type);
        Session::put('req_message', $request->message);
        Session::put('req_account_id', $request->account_id);


        return redirect($approvalUrl);
    }

    public function paypal_webview_success(Request $request){

        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            return redirect()->route('payment-api.webview-faild-payment');
        }

        $payment_id = $request->get('paymentId');
        $payment = Payment::get($payment_id, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() == 'approved') {

            $user = Session::get('auth_user');
            $order_type = Session::get('order_type');
            $message = Session::get('req_message');
            $account_id = Session::get('req_account_id');

            $payment_order = new PaymentController();

            $order = $payment_order->order_store($order_type, $user, 'Paypal', 'success', $payment_id, $message, $account_id);

            return redirect()->route('payment-api.webview-success-payment');

        }else{
            return redirect()->route('payment-api.webview-faild-payment');
        }
    }


    public function calculate_total_price($order_type, $user){

        if($order_type == 'buy_now'){
            $items = ShoppingCart::where(['user_id' => $user->id, 'item_type' => 'buy_now'])->latest()->get();
        }else{
            $items = ShoppingCart::where(['user_id' => $user->id, 'item_type' => 'add_to_cart'])->latest()->get();
        }

        $total_amount = 0;
        $discount_amount = 0;

        foreach($items as $item){
            $sub_total = $item->option_price * $item->qty;
            $total_amount += $sub_total;
        }

        $payable_amount = $total_amount - $discount_amount;

        return array(
            'total_amount' => $total_amount,
            'discount_amount' => $discount_amount,
            'payable_amount' => $payable_amount,
        );
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
