<?php

namespace App\Http\Controllers\Admin;

use File;
use Mail;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\OrderItem;

use App\Helpers\MailHelper;
use Illuminate\Http\Request;
use App\Mail\SendSingleSellerMail;
use App\Http\Controllers\Controller;
use Modules\SupportTicket\Entities\Ticket;
use Modules\SupportTicket\Entities\TicketMessage;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $customers = User::orderBy('id','desc')->where('status',1)->get();

        return view('admin.customer', compact('customers'));
    }

    public function pendingCustomerList(){
        $customers = User::orderBy('id','desc')->where('status',0)->get();
        return view('admin.customer', compact('customers'));
    }

    public function show($id){
        $customer = User::find($id);
        if($customer){
            return view('admin.show_customer',compact('customer'));
        }else{
            $notification='Something went wrong';
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('admin.customer-list')->with($notification);
        }

    }

    public function destroy($id)
    {

        $products = Product::where('author_id',$id)->count();

        if($products > 0){
            $notification=trans('admin_validation.You can not delete this seller, mulitple product available under this seller');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $user = User::find($id);
        $user_image = $user->image;
        $user->delete();
        if($user_image){
            if(File::exists(public_path().'/'.$user_image))unlink(public_path().'/'.$user_image);
        }

        Review::where('user_id',$id)->delete();
        Wishlist::where('user_id',$id)->delete();
        Order::where('user_id',$id)->delete();
        OrderItem::where('user_id',$id)->delete();
        Ticket::where('user_id',$id)->delete();
        TicketMessage::where('user_id',$id)->delete();


        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function changeStatus($id){
        $customer = User::find($id);
        if($customer->status == 1){
            $customer->status = 0;
            $customer->save();
            $message = trans('admin_validation.Inactive Successfully');
        }else{
            $customer->status = 1;
            $customer->save();
            $message = trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }

    public function sendEmailToAllUser(){
        return view('admin.send_email_to_all_customer');
    }

    public function sendMailToAllUser(Request $request){
        $rules = [
            'subject'=>'required',
            'message'=>'required'
        ];
        $customMessages = [
            'subject.required' => trans('admin_validation.Subject is required'),
            'message.required' => trans('admin_validation.Message is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $users = User::where('status',1)->get();
        MailHelper::setMailConfig();
        foreach($users as $user){
            Mail::to($user->email)->send(new SendSingleSellerMail($request->subject,$request->message));
        }

        $notification = trans('admin_validation.Email Send Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function sendMailToSingleUser(Request $request, $id){
        $rules = [
            'subject'=>'required',
            'message'=>'required'
        ];
        $customMessages = [
            'subject.required' => trans('admin_validation.Subject is required'),
            'message.required' => trans('admin_validation.Message is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = User::find($id);
        MailHelper::setMailConfig();
        Mail::to($user->email)->send(new SendSingleSellerMail($request->subject,$request->message));

        $notification = trans('admin_validation.Email Send Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

}
