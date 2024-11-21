<?php

namespace App\Http\Controllers\Seller;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\ProviderWithdraw;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;

class DashbaordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function dashboard(){


        $user = Auth::guard('web')->user();

        $order_items = OrderItem::with('user')->where('author_id', $user->id)->where('approve_by_user', 'approved')->latest()->get();

        $total_earning = 0;
        foreach($order_items as $order_item){
            $sub_total = $order_item->qty * $order_item->option_price;
            $total_earning += $sub_total;
        }

        $total_balance = $total_earning;

        $total_withdraw = ProviderWithdraw::where('user_id', $user->id)->sum('total_amount');

        $complete_withdraw = ProviderWithdraw::where('user_id', $user->id)->where('status', 1)->sum('total_amount');

        $current_balance = $total_balance - $total_withdraw;


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

            $order_items = OrderItem::with('user')->where('author_id', $user->id)->where('approve_by_user', 'approved')->whereDate('created_at', $date)->get();

            $sum = 0;
            foreach($order_items as $order_item){
                $sub_total = $order_item->qty * $order_item->option_price;
                $sum += $sub_total;
            }

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
            $order_items = OrderItem::with('user')->where('author_id', $user->id)->where('approve_by_user', 'approved')->whereDate('created_at', $date)->get();

            $sum = 0;
            foreach($order_items as $order_item){
                $sub_total = $order_item->qty * $order_item->option_price;
                $sum += $sub_total;
            }

            // Store the sum and label
            $weekly_data_for_order[] = $sum;
            $weekly_lable[] = $currentDate->format('D'); // Use day of the week as label (e.g., Mon, Tue)



            // Move to the next day
            $currentDate->addDay();
        }

        $weekly_data_for_order = json_encode($weekly_data_for_order);
        $weekly_lable = json_encode($weekly_lable);

        // end weekly

        $order_items = OrderItem::with('user')->where('author_id', $user->id)->latest()->take(6)->get();

        return view('seller.dashboard', [
            'total_balance' => $total_balance,
            'current_balance' => $current_balance,
            'total_withdraw' => $total_withdraw,
            'complete_withdraw' => $complete_withdraw,
            'monthly_lable' => $monthly_lable,
            'monthly_data_for_order' => $monthly_data_for_order,
            'weekly_lable' => $weekly_lable,
            'weekly_data_for_order' => $weekly_data_for_order,
            'order_items' => $order_items,
        ]);
    }

    public function downloadListingFile($file){
        $filepath= public_path() . "/uploads/custom-images/".$file;
        return response()->download($filepath);
    }
}
