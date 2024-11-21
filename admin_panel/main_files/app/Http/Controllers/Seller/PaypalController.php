<?php

namespace App\Http\Controllers\Seller;

use App\Constants\Status;
use App\Models\PricingPlan;
use App\Models\Setting;
use App\Models\SubscriptionSeller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Models\PaypalPayment;
use App\Mail\OrderSuccessfully;
use App\Http\Controllers\Controller;
use App\Helpers\MailHelper;
use Mahekarim\PaypalPayment\PayPalService;

class PaypalController extends Controller
{
    public function sendMailToUser($user, $order)
    {
        MailHelper::setMailConfig();

        $setting = Setting::first();
        $template = EmailTemplate::where('id', 8)->first();

        $subject = $template->subject;
        $message = $template->description;
        $message = str_replace('{{name}}', $user->name, $message);
        $message = str_replace('{{amount}}', $setting->currency_icon . $order->total_amount, $message);
        $message = str_replace('{{order_id}}', $order->order_id, $message);

        Mail::to($user->email)->send(new OrderSuccessfully($message, $subject));
    }

    public function createPayment(Request $request, $slug)
    {
        $user = Auth::guard('web')->user();

        $pricing_plan = PricingPlan::where('plan_slug', $slug)->first();
        if (!$pricing_plan) {
            return redirect()->back()->withErrors(['error' => 'Pricing Plan not found.']);
        }

        $paypalSetting = PaypalPayment::first();
        if (!$paypalSetting) {
            return redirect()->back()->withErrors(['error' => 'PayPal settings not configured.']);
        }

        $accountMode = $paypalSetting->mode; // Assuming mode column exists
        $paypalService = new PayPalService($paypalSetting->client_id, $paypalSetting->secret_id, $accountMode);

        // Prepare URLs for PayPal return and cancel
        $returnUrl = route('paypal.success', ['slug' => $slug]); // Update route as per your application
        $cancelUrl = route('seller.dashboard'); // Update route as per your application

        // Call to create payment
        $paymentResponse = $paypalService->createPayment($pricing_plan->plan_price, 'USD', $returnUrl, $cancelUrl);

        if ($paymentResponse['success']) {
            return redirect($paymentResponse['approval_link']); // Redirect to PayPal for approval
        } else {
            return redirect()->back()->withErrors(['error' => $paymentResponse['message']]);
        }
    }

    public function executePayment(Request $request, $slug)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');

        $paypalSetting = PaypalPayment::first();
        $accountMode = $paypalSetting->mode; // Assuming mode column exists
        $paypalService = new PayPalService($paypalSetting->client_id, $paypalSetting->secret_id, $accountMode);

        // Execute the payment
        $result = $paypalService->executePayment($paymentId, $payerId);

        // Log the response from PayPal for debugging
        \Log::info('PayPal Execute Payment Response', ['response' => $result]);

        // Check if the payment execution was successful
        if (isset($result['state']) && $result['state'] === 'approved') {
            $user = Auth::guard('web')->user();
            $pricing_plan = PricingPlan::where('plan_slug', $slug)->first();

            // Create the order
            $order = $this->createOrder($user, $pricing_plan, 'PayPal', Status::ACTIVE, $result['transactions'][0]['related_resources'][0]['sale']['id']);

            // Send email confirmation
            $this->sendMailToUser($user, $order);

            // Redirect to the seller's purchase history page
            return redirect()->route('seller.purchase-history')->with('success', 'Payment successful and order created!');
        } else {
            // Handle the case where payment is not approved
            $errorMessage = $result['message'] ?? 'Payment execution failed.';
            return redirect()->route('seller.dashboard')->withErrors(['error' => $errorMessage]);
        }
    }

    private function createOrder($user, $pricing_plan, $payment_method, $payment_status, $tnx_info)
    {
        $expiration_date = match ($pricing_plan->expired_time) {
            'monthly' => date('Y-m-d', strtotime('30 days')),
            'yearly' => date('Y-m-d', strtotime('365 days')),
            'lifetime' => 'lifetime',
        };

        if ($payment_status == Status::ACTIVE) {
            SubscriptionSeller::where('seller_id', $user->id)->update(['status' => Status::ACTIVE_SUBSCRIPTION]);
        }

        $order = new SubscriptionSeller();
        $order->order_id = randomNumber();
        $order->seller_id = $user->id;
        $order->pricing_plan_id = $pricing_plan->id;
        $order->plan_type = $pricing_plan->plan_type;
        $order->plan_price = $pricing_plan->plan_price;
        $order->plan_name = $pricing_plan->plan_name;
        $order->expired_time = $pricing_plan->expired_time;
        $order->upload_limit = $pricing_plan->upload_limit;
        $order->status = $payment_status == Status::ACTIVE ? Status::ACTIVE_SUBSCRIPTION : Status::PENDING_SUBSCRIPTION;
        $order->payment_status = $payment_status;
        $order->transaction_id = $tnx_info;
        $order->payment_method = $payment_method;
        $order->expiration_date = $expiration_date;
        $order->save();

        return $order;
    }
}
