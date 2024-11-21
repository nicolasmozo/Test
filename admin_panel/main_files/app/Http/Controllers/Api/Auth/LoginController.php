<?php

namespace App\Http\Controllers\Api\Auth;

use Str;
use Auth;
use Hash;
use Mail;
use Carbon\Carbon;
use Session;
use App\Models\User;
use App\Rules\Captcha;
use App\Helpers\MailHelper;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Http\Controllers\Controller;
use App\Mail\UserForgetPasswordForOTP;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers;
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest:api')->except('user_logout');
    }

    public function translator($lang_code){
        $front_lang = Session::put($lang_code);
        config(['app.locale' => $lang_code]);
    }

    public function store_login(Request $request){
        $this->translator($request->lang_code);
        $rules = [
            'email'=>'required',
            'password'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'email.required' => trans('user_validation.Email is required'),
            'password.required' => trans('user_validation.Password is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $credential=[
            'email'=> $request->email,
            'password'=> $request->password
        ];

        $user = User::where('email',$request->email)->select('id','name','email','phone','user_name','status','image','address','about_me', 'password')->first();

        if($user){
            if($user->status==1){
                if(Hash::check($request->password,$user->password)){

                    $expiration = Carbon::now()->addMinutes(1)->timestamp;


                    if($token = Auth::guard('api')->attempt($credential)){
                        return $this->respondWithToken($token,$user);
                    }else{
                        return response()->json(['message' => 'Unauthorized'], 401);
                    }
                }else{
                    $notification = trans('user_validation.Credentials does not exist');
                    return response()->json(['message' => $notification], 403);
                }

            }else{
                $notification = trans('user_validation.Disabled Account');
                return response()->json(['message' => $notification], 403);
            }
        }else{
            $notification = trans('user_validation.Email does not exist');
            return response()->json(['message' => $notification], 403);
        }
    }

    protected function respondWithToken($token,$user)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => $user
        ]);
    }

    public function send_forget_password(Request $request){
        $this->translator($request->lang_code);
        $rules = [
            'email'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'email.required' => trans('user_validation.Email is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = User::where('email', $request->email)->first();

        if($user){
            $user->forget_password_otp = random_int(100000, 999999);
            $user->save();

            try{
                MailHelper::setMailConfig();
                $template = EmailTemplate::where('id',11)->first();
                $subject = $template->subject;
                $message = $template->description;
                $message = str_replace('{{name}}',$user->name,$message);
                Mail::to($user->email)->send(new UserForgetPasswordForOTP($message,$subject,$user));

            }catch(Exception $ex){}

            $notification = trans('user_validation.Reset password OTP send to your email.');
            return response()->json(['message' => $notification]);

        }else{
            $notification = trans('user_validation.Email does not exist');
            return response()->json(['message' => $notification],403);
        }
    }

    public function verify_reset_password_token(Request $request){
        $this->translator($request->lang_code);

        $rules = [
            'email'=>'required',
            'token'=>'required'
        ];
        $customMessages = [
            'email.required' => trans('user_validation.Email is required'),
            'token.required' => trans('user_validation.Token is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = User::where(['email' => $request->email, 'forget_password_otp' => $request->token])->first();
        if($user){
            $notification = trans('user_validation.OTP verified, please set new password');
            return response()->json(['message' => $notification]);
        }else{
            $notification = trans('user_validation.Email or OTP does not match, please try again');
            return response()->json(['message' => $notification],403);
        }

    }

    public function store_reset_password_page(Request $request){
        $this->translator($request->lang_code);

        $rules = [
            'email'=>'required',
            'token'=>'required',
            'password'=>'required|min:4|max:100|confirmed',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'email.required' => trans('user_validation.Email is required'),
            'password.required' => trans('user_validation.Password is required'),
            'password.min' => trans('user_validation.Password must be 4 characters'),
            'c_password.required' => trans('user_validation.Confirm password is required'),
            'c_password.same' => trans('user_validation.Confirm password does not match'),
            'token.required' => trans('user_validation.Token is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = User::where(['email' => $request->email, 'forget_password_otp' => $request->token])->first();
        if($user){
            $user->password=Hash::make($request->password);
            $user->forget_password_token=null;
            $user->forget_password_otp=null;
            $user->save();

            $notification = trans('user_validation.Password Reset successfully');
            return response()->json(['message' => $notification]);
        }else{
            $notification = trans('user_validation.Email or OTP does not match, please try again');
            return response()->json(['message' => $notification],403);
        }
    }


    public function user_logout(Request $request){
        $this->translator($request->lang_code);
        Auth::guard('api')->logout();
        $notification= trans('user_validation.Logout Successfully');
        return response()->json(['message' => $notification]);
    }
}
