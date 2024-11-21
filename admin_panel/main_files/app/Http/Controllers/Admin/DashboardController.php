<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;

use App\Models\OrderItem;
use App\Models\Subscriber;
use App\Models\ProviderWithdraw;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashobard(){
        // start total
        $totalOrders = Order::orderBy('id','desc')->get();

        $total_total_order = $totalOrders->count();
        $totalProduct = Product::orderBy('id','desc')->get();
        $total_total_product = $totalProduct->count();
        $total_total_earning = $totalOrders->sum('total_amount');

        $total_withdraws = ProviderWithdraw::get();
        $total_withdraw_request = $total_withdraws->sum('total_amount');
        $total_withdraw_approved = $total_withdraws->where('status', 1)->sum('total_amount');


        // end total

        $setting = Setting::first();
        $currency_icon = (object) array('icon' => $setting->currency_icon);



        // start monthly
        $monthly_lable = array();
        $monthly_data_for_order = array();
        $monthly_data_for_jobpost = array();
        $start = new Carbon('first day of this month');
        $last = new Carbon('last day of this month');
        $first_date = $start->format('Y-m-d');
        $last_date = $last->format('Y-m-d');
        $today = date('Y-m-d');
        $length = date('d')-$start->format('d');
        $length = $last->format('d') - $start->format('d');

        for($i=1; $i <= $length+1; $i++){

            $date = '';
            if($i == 1){
                $date = $first_date;
            }else{
                $date = $start->addDays(1)->format('Y-m-d');
            };

            $sum = Order::whereDate('created_at', $date)->sum('total_amount');

            $monthly_data_for_order[] = $sum;
            $monthly_lable[] = $i;
        }

        $monthly_data_for_order = json_encode($monthly_data_for_order);
        $monthly_lable = json_encode($monthly_lable);

        // end monthly


        // start weekly
        $weekly_lable = array();
        $weekly_data_for_order = array();


        // Get the start and end of the current week
        $startOfWeek = Carbon::now()->startOfWeek(); // Monday
        $endOfWeek = Carbon::now()->endOfWeek(); // Sunday

        // Loop through each day of the week
        $currentDate = $startOfWeek->copy();
        while ($currentDate->lessThanOrEqualTo($endOfWeek)) {
            $date = $currentDate->format('Y-m-d');

            // Sum the orders for the current day
            $sum = Order::whereDate('created_at', $date)->sum('total_amount');

            // Store the sum and label
            $weekly_data_for_order[] = $sum;
            $weekly_lable[] = $currentDate->format('D'); // Use day of the week as label (e.g., Mon, Tue)



            // Move to the next day
            $currentDate->addDay();
        }

        $weekly_data_for_order = json_encode($weekly_data_for_order);
        $weekly_lable = json_encode($weekly_lable);

        // end weekly

        $order_items = OrderItem::with('user')->latest()->take(6)->get();


        return view('admin.dashboard', [
            'currency_icon' => $currency_icon,
            'total_total_order' => $total_total_order,
            'total_total_earning' => $total_total_earning,
            'total_withdraw_approved' => $total_withdraw_approved,
            'total_total_product' => $total_total_product,
            'monthly_lable' => $monthly_lable,
            'monthly_data_for_order' => $monthly_data_for_order,
            'weekly_lable' => $weekly_lable,
            'weekly_data_for_order' => $weekly_data_for_order,
            'order_items' => $order_items,
        ]);

    }




}
