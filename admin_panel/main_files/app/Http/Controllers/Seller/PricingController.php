<?php

namespace App\Http\Controllers\Seller;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use App\Models\Setting;
use App\Models\SubscriptionSeller;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $pageTitle = 'Pricing Plans';
        $plans = PricingPlan::active()->get();

        return view('seller.purchase_plan.index', compact('plans', 'pageTitle'));
    }

    public function purchaseHistory()
    {
        $pageTitle = 'Purchase History';
        $userId = auth()->guard('web')->user();
        $orders = SubscriptionSeller::where('seller_id', $userId->id)->paginate(10);

        return view('seller.purchase_plan.history', compact('orders', 'pageTitle'));
    }
}






