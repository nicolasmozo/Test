<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Http\Request;
use App\Mail\AdminForgetPassword;
use App\Helpers\MailHelper;
use App\Models\Admin;
use App\Models\EmailTemplate;
use Str;
use Mail;
use Hash;
use Auth;
use App\Models\Setting;
class AdminForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function forgetPassword(){
        $setting = Setting::first();
       return view('admin.auth.forget',compact('setting'));
   }


   public function sendForgetEmail(Request $request){
        $rules = [
            'email'=>'required'
        ];

        $customMessages = [
            'email.required' => trans('admin_validation.Email is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        MailHelper::setMailConfig();
        $admin=Admin::where('email',$request->email)->first();
        if($admin){
            $admin->forget_password_token=Str::random(100);
            $admin->save();

            $template=EmailTemplate::where('id',1)->first();
            $message=$template->description;
            $subject=$template->subject;
            $message=str_replace('{{name}}',$admin->name,$message);

            Mail::to($admin->email)->send(new AdminForgetPassword($admin,$message,$subject));

            $notification= trans('admin_validation.Forget password link send your email');
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return Redirect()->back()->with($notification);

        }else {
            $notification= trans('admin_validation.Email does not exist');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return Redirect()->back()->with($notification);
        }
    }


    public function resetPassword($token){
        $admin=Admin::where('forget_password_token',$token)->first();
        if($admin){
            $setting = Setting::first();
            return view('admin.auth.reset-pass',compact('admin','token','setting'));
        }else{
            $notification='invalid token';
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return Redirect()->route('admin.forget.password')->with($notification);
        }
    }

    public function storeResetData(Request $request,$token){

        $rules = [
            'email'=>'required',
            'password'=>'required|confirmed|min:4'
        ];
        $customMessages = [
            'email.required' => trans('admin_validation.Email is required'),
            'password.required' => trans('admin_validation.Password is required'),
            'password.confirmed' => trans('admin_validation.Password does not match'),
            'password.min' => trans('admin_validation.Password must be 4 characters'),
        ];
        $this->validate($request, $rules,$customMessages);

        $admin=Admin::where('forget_password_token',$token)->first();
        if($admin->email==$request->email){
            $admin->password=Hash::make($request->password);
            $admin->forget_password_token=null;
            $admin->save();

            $notification= trans('admin_validation.Password Reset Successfully');
            $notification=array('messege'=>$notification,'alert-type'=>'success');
            return Redirect()->route('admin.login')->with($notification);
        }else{
            $notification= trans('admin_validation.Something went wrong');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return back()->with($notification);
        }
    }


}
