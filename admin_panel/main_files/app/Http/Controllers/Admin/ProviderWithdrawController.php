<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProviderWithdraw;
use App\Models\Setting;
use App\Models\EmailTemplate;
use App\Helpers\MailHelper;
use App\Mail\ProviderWithdrawApproval;
use Mail;

class ProviderWithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $withdraws = ProviderWithdraw::with('provider')->approved()->orderBy('id','desc')->get();

        if($request->provider_id){
            $withdraws = $withdraws->where('user_id', $request->provider_id);
        }
        $setting = Setting::first();

        return view('admin.provider_withdraw', compact('withdraws','setting'));
    }

    public function pendingProviderWithdraw(){
        $withdraws = ProviderWithdraw::orderBy('id','desc')->pending()->get();
        $setting = Setting::first();
        return view('admin.provider_withdraw', compact('withdraws','setting'));
    }

    public function rejectedProviderWithdraw()
    {
        $withdraws = ProviderWithdraw::with('provider')->rejected()->orderBy('id','desc')->get();

        return view('admin.provider_withdraw', compact('withdraws'));
    }

    public function show($id){
        $setting = Setting::first();
        $withdraw = ProviderWithdraw::find($id);
        return view('admin.show_provider_withdraw', compact('withdraw','setting'));
    }

    public function destroy($id){
        $withdraw = ProviderWithdraw::find($id);
        $withdraw->delete();
        $notification = trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.provider-withdraw')->with($notification);
    }

    public function approvedWithdraw($id){
        $withdraw = ProviderWithdraw::find($id);
        $withdraw->status = 1;
        $withdraw->approved_date = date('Y-m-d');
        $withdraw->save();

        $setting = Setting::first();

        $user = $withdraw->provider;
        $template=EmailTemplate::where('id',5)->first();
        $message=$template->description;
        $subject=$template->subject;
        $message=str_replace('{{seller_name}}',$user->name,$message);
        $message=str_replace('{{withdraw_method}}',$withdraw->method,$message);
        $message=str_replace('{{total_amount}}',$setting->currency_icon .$withdraw->total_amount,$message);
        $message=str_replace('{{withdraw_charge}}',$setting->currency_icon .($withdraw->total_amount - $withdraw->withdraw_amount),$message);
        $message=str_replace('{{withdraw_amount}}',$setting->currency_icon .$withdraw->withdraw_amount,$message);
        $message=str_replace('{{approval_date}}',$withdraw->approved_date,$message);
        MailHelper::setMailConfig();
        Mail::to($user->email)->send(new ProviderWithdrawApproval($subject,$message));

        $notification = trans('admin_validation.Withdraw request approval successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.provider-withdraw')->with($notification);
    }


    public function rejectWithdraw(Request $request,$id)
    {
        $withdraw = ProviderWithdraw::find($id);
        $withdraw->status = Status::REJECTED;
        $withdraw->feedback = $request->feedback;
        $withdraw->save();

        $setting = Setting::first();

        $user = $withdraw->provider;
        $template=EmailTemplate::where('id',15)->first();
        $message=$template->description;
        $subject=$template->subject;
        $message=str_replace('{{seller_name}}',$user->name,$message);
        $message=str_replace('{{withdraw_method}}',$withdraw->method,$message);
        $message=str_replace('{{total_amount}}',$setting->currency_icon .$withdraw->total_amount,$message);
        $message=str_replace('{{withdraw_charge}}',$setting->currency_icon .($withdraw->total_amount - $withdraw->withdraw_amount),$message);
        $message=str_replace('{{withdraw_amount}}',$setting->currency_icon .$withdraw->withdraw_amount,$message);
        $message=str_replace('{{feedback}}',$withdraw->feedback,$message);
        MailHelper::setMailConfig();
        Mail::to($user->email)->send(new ProviderWithdrawApproval($subject,$message));

        $notification = trans('admin_validation.Withdraw request rejected');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.provider-withdraw')->with($notification);
    }


}
