<?php

namespace App\Http\Controllers\Seller;

use App\Constants\Status;
use Illuminate\Support\Facades\Auth;
use Session;

use App\Models\Setting;
use App\Models\Language;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\WithdrawMethod;
use App\Models\ProviderWithdraw;
use App\Http\Controllers\Controller;


class WithdrawController extends Controller
{
    public function translator(){
        $front_lang = Session::get('front_lang');
        $language = Language::where('is_default', 'Yes')->first();
        if($front_lang == ''){
            $front_lang = Session::put('front_lang', $language->lang_code);
        }
        config(['app.locale' => $front_lang]);
    }


    public function __construct()
    {
        $this->middleware('auth:web');
    }


    public function index(){

        $user = Auth::guard('web')->user();
        $withdraws = ProviderWithdraw::where('user_id',$user->id)->orderBy('id','desc')->get();


        $order_items = OrderItem::with('user')->where('author_id', $user->id)->where('approve_by_user', 'approved')->latest()->get();

        $total_earning = 0;
        foreach($order_items as $order_item){
            $sub_total = $order_item->qty * $order_item->option_price;
            $total_earning += $sub_total;
        }

        $total_balance = $total_earning;

        $total_withdraw = ProviderWithdraw::where('user_id', $user->id)->sum('total_amount');

        $current_balance = $total_balance - $total_withdraw;



        return view('seller.withdraw', compact('withdraws', 'total_balance', 'current_balance', 'total_withdraw'));
    }

    public function show($id){
        $withdraw = ProviderWithdraw::find($id);

        return view('seller.withdraw_show', compact('withdraw'));
    }

    public function create(){
        $methods = WithdrawMethod::whereStatus('1')->get();

        $user = Auth::guard('web')->user();

        $order_items = OrderItem::with('user')->where('author_id', $user->id)->where('approve_by_user', 'approved')->latest()->get();

        $total_earning = 0;
        foreach($order_items as $order_item){
            $sub_total = $order_item->qty * $order_item->option_price;
            $total_earning += $sub_total;
        }

        $total_balance = $total_earning;

        $total_withdraw = ProviderWithdraw::where('user_id', $user->id)->sum('total_amount');

        $current_balance = $total_balance - $total_withdraw;

        return view('seller.withdraw_create', compact('methods', 'total_balance', 'current_balance', 'total_withdraw'));
    }

    public function getWithDrawAccountInfo($id){
        $method = WithdrawMethod::whereId($id)->first();
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;
        return view('seller.withdraw_account_info', compact('method','currency_icon'));
    }

    public function store(Request $request){
        $rules = [
            'method_id' => 'required',
            'withdraw_amount' => 'required|numeric',
            'account_info' => 'required',
        ];

        $customMessages = [
            'method_id.required' => trans('admin_validation.Payment Method filed is required'),
            'withdraw_amount.required' => trans('admin_validation.Withdraw amount filed is required'),
            'withdraw_amount.numeric' => trans('admin_validation.Please provide valid numeric number'),
            'account_info.required' => trans('admin_validation.Account filed is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $user = Auth::guard('web')->user();

        $settings  = Setting::first();

        $order_items = OrderItem::with('user')->where('author_id', $user->id)->where('approve_by_user', 'approved')->latest()->get();

        $total_earning = 0;
        foreach($order_items as $order_item){
            $sub_total = $order_item->qty * $order_item->option_price;
            $total_earning += $sub_total;
        }

        $total_balance = $total_earning;

        $total_withdraw = ProviderWithdraw::where('user_id', $user->id)->sum('total_amount');
        $current_balance = $total_balance - $total_withdraw;

        if($request->withdraw_amount > $current_balance){
            $notification = trans('admin_validation.Sorry! Your Payment request is more then your current balance');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $method = WithdrawMethod::whereId($request->method_id)->first();
        if($request->withdraw_amount >= $method->min_amount && $request->withdraw_amount <= $method->max_amount){

            if($settings->payout_type == Status::COMMISSION_BASED){
                $withdrawCharge = ($method->withdraw_charge / 100) + ($settings->commission_percentage / 100);
                $withdraw_request = $request->withdraw_amount;
                $withdraw_amount = $withdrawCharge * $withdraw_request;

                $widthdraw = new ProviderWithdraw();
                $widthdraw->user_id = $user->id;
                $widthdraw->method = $method->name;
                $widthdraw->total_amount = $request->withdraw_amount;
                $widthdraw->withdraw_amount = $request->withdraw_amount - $withdraw_amount;
                $widthdraw->withdraw_charge = $method->withdraw_charge;
                $widthdraw->charge_amount = $withdraw_amount;
                $widthdraw->account_info = $request->account_info;
                $widthdraw->save();
            } else {
                $withdraw_request = $request->withdraw_amount;
                $withdraw_amount = ($method->withdraw_charge / 100) * $withdraw_request;

                $widthdraw = new ProviderWithdraw();
                $widthdraw->user_id = $user->id;
                $widthdraw->method = $method->name;
                $widthdraw->total_amount = $request->withdraw_amount;
                $widthdraw->withdraw_amount = $request->withdraw_amount - $withdraw_amount;
                $widthdraw->withdraw_charge = $method->withdraw_charge;
                $widthdraw->charge_amount = $withdraw_amount;
                $widthdraw->account_info = $request->account_info;
                $widthdraw->save();
            }


            $notification = trans('admin_validation.Withdraw request send successfully, please wait for admin approval');
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('seller.my-withdraw.index')->with($notification);

        }else{
            $notification = trans('admin_validation.Your amount range is not available');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

    }


}
