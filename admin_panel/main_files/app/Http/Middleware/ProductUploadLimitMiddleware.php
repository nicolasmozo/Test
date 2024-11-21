<?php

namespace App\Http\Middleware;

use App\Constants\Status;
use App\Models\Product;
use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use App\Models\SubscriptionSeller;
use Carbon\Carbon;

class ProductUploadLimitMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $settings = Setting::first();

        if ($settings->payout_type != Status::SUBSCRIPTION_BASED) {
            return $next($request);
        }

        $userId = auth()->guard('web')->user()->id;

        $subscription = SubscriptionSeller::where('seller_id', $userId)
            ->where('expiration_date', '>', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$subscription) {
            $notification = trans('You need to purchase a subscription package to upload products.');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        $currentUploads = Product::where('author_id', $userId)->count();

        if ($subscription->upload_limit !== Status::UNLIMITED && $currentUploads >= $subscription->upload_limit) {
            $notification = trans('You have reached your product upload limit. Please upgrade your subscription package.');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        return $next($request);
    }
}
