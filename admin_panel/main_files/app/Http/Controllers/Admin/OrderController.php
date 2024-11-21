<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Setting;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\SupportTicket\Entities\Ticket;
use Modules\SupportTicket\Entities\TicketMessage;
use Illuminate\Pagination\Paginator;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        Paginator::useBootstrap();

        $orders = Order::with('client','provider', 'user')->orderBy('id','desc');

        if($request->provider){
            $orders = $orders->where('provider_id', $request->provider);
        }

        if($request->client){
            $orders = $orders->where('client_id', $request->client);
        }

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);
        $title = trans('admin_validation.All Order');
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        $providers = User::where(['status' => 1, 'is_seller' => 1])->orderBy('name','asc')->get();
        $clients = User::where(['status' => 1, 'is_seller' => 0])->orderBy('name','asc')->get();

        return view('admin.order', compact('orders','title','currency_icon','providers','clients'));
    }

    public function pendingOrder(){
        Paginator::useBootstrap();

        $orders = Order::with('user')->where('order_status', 0)->orderBy('id','desc')->paginate(15);
        $title = trans('admin_validation.Pending orders');
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        return view('admin.order', compact('orders','title'));
    }

    public function completeOrder(){
        Paginator::useBootstrap();

        $orders = Order::with('user')->where('order_status', 1)->orderBy('id','desc')->paginate(15);
        $title = trans('admin_validation.Complete orders');
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        return view('admin.order', compact('orders','title'));
    }



    public function show($id){
        $order = Order::with('user')->find($id);
        $setting = Setting::first();
        return view('admin.show_order',compact('order', 'setting'));
    }

    public function updateOrderStatus(Request $request , $id){
        $rules = [
            'order_status' => 'required',
            'payment_status' => 'required',
        ];
        $this->validate($request, $rules);

        $order = Order::find($id);
        if($request->order_status == 0){
            $order->order_status = 0;
            $order->save();
        }else if($request->order_status == 1){
            $order->order_status = 1;
            $order->save();
        }

        if($request->payment_status == 'pending'){
            $order->payment_status = 'pending';
            $order->save();
        }elseif($request->payment_status == 'success'){
            $order->payment_status = 'success';
            $order->save();
        }

        $notification = trans('admin_validation.Order Status Updated successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id){
        $order = Order::find($id);
        $orderItems = $order->orderItems;
        foreach ($orderItems as $orderItem) {
            $tickets = Ticket::where('order_id', $orderItem->id)->get();
            foreach ($tickets as $ticket) {
                TicketMessage::where('ticket_id', $ticket->id)->delete();
                $ticket->delete();
            }
        }
        $order_item=OrderItem::where('order_id', $id)->delete();
        $order->delete();

        

        $notification = trans('admin_validation.Delete successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.all-booking')->with($notification);
    }

    public function paymentApproved($id){
        $order = Order::find($id);
        $order->payment_status = 'success';
        $order->save();

        $notification= trans('admin_validation.Approved Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

}
