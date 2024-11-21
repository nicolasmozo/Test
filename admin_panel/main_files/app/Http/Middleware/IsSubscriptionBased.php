<?php

namespace App\Http\Middleware;

use App\Constants\Status;
use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;

class IsSubscriptionBased
{

    public function handle(Request $request, Closure $next)
    {
        $setting = Setting::first();
        $type = $setting->payout_type;
        if ($type == Status::SUBSCRIPTION_BASED) {
            return $next($request);
        }

        if ($type == Status::COMMISSION_BASED) {
            $notification = trans('user_validation.Purchase Plan Only For Subscription Based');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

    }
}
