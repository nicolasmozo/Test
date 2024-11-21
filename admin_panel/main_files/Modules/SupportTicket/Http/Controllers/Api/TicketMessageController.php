<?php

namespace Modules\SupportTicket\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SupportTicket\Entities\Ticket;
use Modules\SupportTicket\Entities\TicketMessage;
use Modules\SupportTicket\Entities\MessageDocument;
use App\Models\OrderItem;
use Auth;
use Str;
use File;
use Hash;
use Image;
use Session;

class TicketMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function translator($lang_code){
        $front_lang = Session::put('front_lang', $lang_code);
        config(['app.locale' => $lang_code]);
    }

    public function ticket_list(Request $request){
        $this->translator($request->lang_code);
        $user = Auth::guard('api')->user();

        $tickets = Ticket::with('user','order','unSeenUserMessage')->where('user_id', $user->id)->orderBy('id','desc')->paginate(10);

        return response()->json([
            'tickets' => $tickets,
        ]);
    }

    public function create_ticket(Request $request){
        $this->translator($request->lang_code);
        $user = Auth::guard('api')->user();

        $order_lists = OrderItem::orderBy('id','desc')->select('id', 'order_id')->where('user_id', $user->id)->get();

        return response()->json([
            'order_lists' => $order_lists,
        ]);
    }

    public function show_ticket(Request $request, $id){
        $this->translator($request->lang_code);
        $user = Auth::guard('api')->user();

        $ticket = Ticket::with('user','order')->where('ticket_id', $id)->first();
        TicketMessage::where('ticket_id', $ticket->id)->update(['unseen_user' => 1]);
        $messages = TicketMessage::with('documents')->where('ticket_id', $ticket->id)->get();

        return response()->json([
            'ticket' => $ticket,
            'messages' => $messages,
        ]);
    }

    public function send_ticket_message(Request $request){
        $this->translator($request->lang_code);
        $rules = [
            'ticket_id'=>'required',
            'message'=>'required',
            'documents' => 'max:2048'
        ];
        $customMessages = [
            'message.required' => trans('user_validation.Message is required'),
            'ticket_id.required' => trans('user_validation.Ticket is required'),
            'user_id.required' => trans('user_validation.User is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $ticket = Ticket::where('ticket_id',$request->ticket_id)->first();

        $user = Auth::guard('api')->user();
        $message = new TicketMessage();
        $message->ticket_id = $ticket->id;
        $message->admin_id = 0;
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->message_from = 'client';
        $message->unseen_user = 1;
        $message->unseen_admin = 0;
        $message->save();

        if($request->hasFile('documents')){

            // foreach($request->documents as $request_file){
                $extention = $request->documents->getClientOriginalExtension();
                $file_name = 'support-file-'.time().'.'.$extention;
                $destinationPath = public_path('uploads/custom-images/');
                $request->documents->move($destinationPath,$file_name);

                $document = new MessageDocument();
                $document->ticket_message_id = $message->id;
                $document->file_name = $file_name;
                $document->save();
            // }
        }


        $ticket = Ticket::with('user','order')->where('id', $request->ticket_id)->first();
        $messages = TicketMessage::with('documents')->where('ticket_id', $request->ticket_id)->get();

        return response()->json([
            'ticket' => $ticket,
            'messages' => $messages,
        ]);
    }

    public function ticket_request(Request $request){
        $this->translator($request->lang_code);
        $user = Auth::guard('api')->user();
        $rules = [
            'order_id'=>'required',
            'subject'=>'required',
            'message'=>'required',
        ];
        $customMessages = [
            'order_id.required' => trans('user_validation.Order id is required'),
            'subject.required' => trans('user_validation.Subject is required'),
            'message.required' => trans('user_validation.Message is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $order = OrderItem::where('id', $request->order_id)->first();
        if($order){
            $ticket = new Ticket();
            $ticket->user_id = $user->id;
            $ticket->order_id = $request->order_id;
            $ticket->subject = $request->subject;
            $ticket->ticket_id = substr(rand(0,time()),0,10);
            $ticket->status = 'pending';
            $ticket->ticket_from = 'Client';
            $ticket->save();

            $message = new TicketMessage();
            $message->ticket_id = $ticket->id;
            $message->admin_id = 0;
            $message->user_id = $user->id;
            $message->message = $request->message;
            $message->message_from = 'client';
            $message->unseen_user = 1;
            $message->unseen_admin = 0;
            $message->save();

            $ticket = Ticket::with('user','order')->where('id', $ticket->id)->first();

            $notification = trans('user_validation.Ticket created successfully');
             return response()->json([
                'ticket' => $ticket,
                'messages' => $notification,
            ]);
            return response()->json(['message' => $notification]);
        }else{
            $notification = trans('user_validation.Order Not Found!');
            return response()->json(['message' => $notification], 400);

        }
        return response()->json(['message' => $notification]);
    }
}
