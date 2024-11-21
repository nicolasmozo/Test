<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use Mail, File;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use App\Models\Setting;
use App\Models\OrderItem;
use App\Helpers\MailHelper;
use Illuminate\Http\Request;

use App\Models\EmailTemplate;
use App\Models\SellerRequest;
use App\Mail\SellerApprovalMail;
use App\Models\ProviderWithdraw;
use App\Mail\SendSingleSellerMail;
use App\Http\Controllers\Controller;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function seller_requests(){
        $seller_requests = SellerRequest::latest()->get();

        return view('admin.seller_requests', ['seller_requests' => $seller_requests]);
    }

    public function seller_request_show($id){

        $seller_request = SellerRequest::findOrFail($id);

        return view('admin.seller_request_show', ['seller_request' => $seller_request]);
    }

    public function approved_seller_request($id){

        $seller_request = SellerRequest::findOrFail($id);
        $seller_request->status = 'approved';
        $seller_request->save();

        $seller = User::findOrFail($seller_request->user_id);
        $seller->is_seller = 'yes';
        $seller->save();


        MailHelper::setMailConfig();

        $message = trans('admin_validation.Your seller request has been approved, please login to visit your seller panel');

        $redirect_link = $seller_request->redirect_url.'?seller_approval=yes' .'&message='.$message;
        $anchor_redirect_link = '<a href="'.$redirect_link.'">'.$redirect_link.'</a>';

        $template = EmailTemplate::where('id',13)->first();
        $message = $template->description;
        $subject = $template->subject;

        $message = str_replace('{{redirect_link}}',$anchor_redirect_link,$message);
        $message = str_replace('{{name}}',$seller->name,$message);


        Mail::to($seller->email)->send(new SellerApprovalMail($subject,$message));


        $notification = trans('admin_validation.Seller request approval successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function reject_seller_request($id){

        $seller_request = SellerRequest::findOrFail($id);
        $seller_request->status = 'rejected';
        $seller_request->save();

        $seller = User::findOrFail($seller_request->user_id);
        $seller->is_seller = 'no';
        $seller->save();


        MailHelper::setMailConfig();

        $template = EmailTemplate::where('id',14)->first();
        $message = $template->description;
        $subject = $template->subject;

        $message = str_replace('{{name}}',$seller->name,$message);

        Mail::to($seller->email)->send(new SellerApprovalMail($subject,$message));


        $notification = trans('admin_validation.Seller request rejected successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function delete_seller_request($id){

        $seller_request = SellerRequest::findOrFail($id);

        $seller = User::findOrFail($seller_request->user_id);
        $seller->is_seller = 'no';
        $seller->save();

        $existing_logo = $seller_request->logo;
        if($existing_logo){
            if(File::exists(public_path().'/'.$existing_logo))unlink(public_path().'/'.$existing_logo);
        }

        $existing_document = $seller_request->document;
        if($existing_document){
            if(File::exists(public_path().'/'.$existing_document))unlink(public_path().'/'.$existing_document);
        }


        $seller_request->delete();

        $notification = trans('admin_validation.Deleted successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.seller-requests')->with($notification);
    }


    public function index(){
        $products=Product::where('status', 1)->get();
        $author_arr=[];
        foreach($products as $product){
            $author_arr[] = $product->author_id;
        }
        $author_arr = array_unique($author_arr);

        $sellers = User::whereIn('id', $author_arr)->orderBy('id','desc')->where('status', 1)->get();

        return view('admin.provider', compact('sellers'));
    }

    public function sendEmailToAllProvider(){
        return view('admin.send_email_to_all_provider');
    }

    public function sendMailToAllProvider(Request $request){
        $rules = [
            'subject'=>'required',
            'message'=>'required'
        ];
        $customMessages = [
            'subject.required' => trans('admin_validation.Subject is required'),
            'message.required' => trans('admin_validation.Message is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $providers = User::where('is_seller', 'yes')->orderBy('id','desc')->get();
        MailHelper::setMailConfig();
        foreach($providers as $provider){
            Mail::to($provider->email)->send(new SendSingleSellerMail($request->subject,$request->message));
        }

        $notification = trans('admin_validation.Email Send Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function sendEmailToProvider($id){
        $user = User::find($id);
        return view('admin.send_provider_email', compact('user'));
    }

    public function sendMailtoSingleProvider(Request $request, $id){
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

    public function show($id){
        $seller = User::where('id', $id)->first();
        $setting = Setting::first();

        $default_avatar = array(
            'image' => $setting->default_avatar
        );
        $default_avatar = (object) $default_avatar;

        $order_items = OrderItem::with('user')->where('author_id', $seller->id)->where('approve_by_user', 'approved')->latest()->get();

        $total_earning = 0;
        foreach($order_items as $order_item){
            $sub_total = $order_item->qty * $order_item->option_price;
            $total_earning += $sub_total;
        }

        $total_balance = $total_earning;

        $total_withdraw = ProviderWithdraw::where('user_id', $seller->id)->sum('total_amount');

        $current_balance = $total_balance - $total_withdraw;

        $products = Product::where('author_id', $seller->id)->where('status', 1)->get();
        $total_product = $products->count();
        $total_sold_product = $order_items->count('qty');

        return view('admin.show_provider',compact('seller','setting','default_avatar','total_sold_product','total_withdraw','current_balance','total_balance', 'total_product'));

    }

    public function updateProvider(Request $request , $id){
        $provider = User::find($id);
        $rules = [
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$provider->id,
            'phone'=>'required',
            'address'=>'required',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'email.required' => trans('admin_validation.Email is required'),
            'email.unique' => trans('admin_validation.Email already exist'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'address.required' => trans('admin_validation.Address is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $provider->name = $request->name;
        $provider->phone = $request->phone;
        $provider->address = $request->address;
        $provider->save();

        $notification=trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id){

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

        Review::where('author_id',$id)->delete();
        $order_item=OrderItem::where('author_id',$id)->get();
        $order_id = [];
        foreach($order_item as $item){
            $order_id[] = $item->order_id;
        }
        $order_id =  array_unique($order_id);

        $orders=Order::whereIn('id',$order_id)->delete();
        OrderItem::where('author_id',$id)->delete();
        Product::where('author_id',$id)->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function changeStatus($id){
        $provider = User::find($id);
        if($provider->status == Status::ENABLE){
            $provider->status = Status::DISABLE;
            $provider->save();
            $message= trans('admin_validation.Inactive Successfully');
        }else{
            $provider->status=1;
            $provider->save();
            $message= trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }

}
