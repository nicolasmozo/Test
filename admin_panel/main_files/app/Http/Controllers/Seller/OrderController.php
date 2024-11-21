<?php

namespace App\Http\Controllers\Seller;

use Auth;
use Session;
use App\Models\User;
use App\Models\Order;
use App\Models\Message;
use App\Models\Language;
use App\Models\OrderItem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;

class OrderController extends Controller
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


    public function index(Request $request){

        $this->translator();

        Paginator::useBootstrap();

        $user = Auth::guard('web')->user();

        $order_items = OrderItem::with('user')->where('author_id', $user->id)->latest()->get();

        $title = trans('admin_validation.Order Items');

        return view('seller.order', ['order_items' => $order_items, 'title' => $title]);


    }

    public function pendingOrder(){
        $this->translator();

        Paginator::useBootstrap();

        $user = Auth::guard('web')->user();

        $order_items = OrderItem::with('user')->where('author_id', $user->id)->where('approve_by_user', 'pending')->latest()->get();

        $title = trans('admin_validation.Pending Order Items');

        return view('seller.order', ['order_items' => $order_items, 'title' => $title]);
    }

    public function completeOrder(){
        $this->translator();

        Paginator::useBootstrap();

        $user = Auth::guard('web')->user();

        $order_items = OrderItem::with('user')->where('author_id', $user->id)->where('approve_by_user', 'approved')->latest()->get();

        $title = trans('admin_validation.Complete Order Items');

        return view('seller.order', ['order_items' => $order_items, 'title' => $title]);
    }


    public function order_show(Request $request, $item_id, $order_id){

        $this->translator();

        $user = Auth::guard('web')->user();

        $order = Order::where('order_id', $order_id)->first();

        if(!$order){
            $notification = trans('admin_validation.Order item not found');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('seller.all-booking')->with($notification);
        }

        $item = OrderItem::where(['author_id' => $user->id, 'id' => $item_id, 'order_id' => $order->id])->first();

        if(!$item){
            $notification = trans('admin_validation.Order item not found');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('seller.all-booking')->with($notification);
        }

        $messages = Message::where(['seller_id' => $user->id, 'order_item_id' => $item_id])->get();

        $seller = Auth::guard('web')->user();
        $customer = User::find($order->user_id);

        return view('seller.order_details', [
            'item' => $item,
            'messages' => $messages,
            'customer' => $customer,
            'seller' => $seller,
        ]);

    }


    public function store_product_message(Request $request, $id){


        $this->translator();

        $rules = [
            'message'=>'required|max:1000',
        ];

        $customMessages = [
            'message.required' => trans('admin_validation.Message is required'),
        ];

        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('web')->user();

        $item = OrderItem::where(['id' => $id])->first();

        $new_message = new Message();
        $new_message->user_id = $item->user_id;
        $new_message->seller_id = $item->author_id;
        $new_message->message = $request->message;
        $new_message->seller_read_msg = 1;
        $new_message->send_seller = 1;
        $new_message->order_item_id = $item->id;
        $new_message->save();

        $notification = trans('admin_validation.Message send successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }
}
