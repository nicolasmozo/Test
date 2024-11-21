<?php

namespace App\Http\Controllers\Api\User;


use Auth;
use Session;
use App\Models\Order;
use App\Models\Message;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function translator($lang_code){
        $front_lang = Session::put('front_lang', $lang_code);
        config(['app.locale' => $lang_code]);
    }


    public function order_items(Request $request){

        $this->translator($request->lang_code);

        $user = Auth::guard('api')->user();

        $order_items = OrderItem::where('user_id', $user->id)->latest()->paginate(10);

        return response()->json([
            'items' => $order_items
        ]);

    }


    public function order_item(Request $request, $item_id, $order_id){

        $this->translator($request->lang_code);

        $user = Auth::guard('api')->user();

        $order = Order::where('order_id', $order_id)->first();

        if(!$order){
            return response()->json([
                'message' => trans('user_validation.Order item not found')
            ], 403);
        }

        $item = OrderItem::where(['user_id' => $user->id, 'id' => $item_id, 'order_id' => $order->id])->first();

        if(!$item){
            return response()->json([
                'message' => trans('user_validation.Order item not found')
            ], 403);
        }

        $messages = Message::where(['user_id' => $user->id, 'order_item_id' => $item_id])->get();


        return response()->json([
            'item' => $item,
            'messages' => $messages,
        ]);

    }

    public function send_message(Request $request, $id){

        $this->translator($request->lang_code);

        $rules = [
            'message'=>'required|max:1000',
        ];

        $customMessages = [
            'message.required' => trans('user_validation.Message is required'),
        ];

        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('api')->user();

        $item = OrderItem::where(['id' => $id])->first();

        $new_message = new Message();
        $new_message->user_id = $user->id;
        $new_message->seller_id = $item->author_id;
        $new_message->message = $request->message;
        $new_message->customer_read_msg = 1;
        $new_message->send_customer = 1;
        $new_message->order_item_id = $item->id;
        $new_message->save();

        return response()->json([
            'message' => trans('user_validation.Message send successfully'),
            'new_message' => $new_message
        ]);

    }


    public function get_message_list(Request $request, $item_id){

        $item = OrderItem::where(['id' => $item_id])->first();

        if(!$item){
            return response()->json([
                'message' => trans('user_validation.Order item not found')
            ], 403);
        }

        $user = Auth::guard('api')->user();

        $messages = Message::where(['user_id' => $user->id, 'order_item_id' => $item_id])->get();

        return response()->json([
            'messages' => $messages,
        ]);
    }


    public function make_item_approval(Request $request, $item_id){
        $this->translator($request->lang_code);


        $user = Auth::guard('api')->user();


        $item = OrderItem::where(['user_id' => $user->id, 'id' => $item_id])->first();

        if(!$item){
            return response()->json([
                'message' => trans('user_validation.Order item not found')
            ], 403);
        }

        if($item->approve_by_user != 'pending'){
            return response()->json([
                'message' => trans('user_validation.Item already approved or rejected')
            ], 403);
        }

        $item->approve_by_user = 'approved';
        $item->save();

        return response()->json([
            'message' => trans('user_validation.Item approval successful'),
            'item' => $item,
        ]);



    }

}
