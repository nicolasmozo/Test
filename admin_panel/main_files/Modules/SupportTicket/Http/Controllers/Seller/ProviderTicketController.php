<?php

namespace Modules\SupportTicket\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SupportTicket\Entities\Ticket;
use Modules\SupportTicket\Entities\TicketMessage;
use Modules\SupportTicket\Entities\MessageDocument;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;
use File;

class ProviderTicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    
    public function index(){
        $user = Auth::guard('web')->user();
        $tickets = Ticket::with('user','order','unSeenUserMessage')->where('user_id', $user->id)->orderBy('id','desc')->get();


        return view('supportticket::seller.ticket', compact('tickets'));
    }

    public function show($id){
        $ticket = Ticket::with('user','orderItems')->where('ticket_id', $id)->first();
        TicketMessage::where('ticket_id', $ticket->id)->update(['unseen_user' => 1]);
        $messages = TicketMessage::where('ticket_id', $ticket->id)->get();
        return view('supportticket::seller.ticket_show', compact('ticket','messages'));
    }

    public function storeMessage(Request $request){
        $rules = [
            'ticket_id'=>'required',
            'message'=>'required',
            'user_id'=>'required',
            'documents' => 'max:2048'
        ];
        $customMessages = [
            'message.required' => trans('user_validation.Message is required'),
            'ticket_id.required' => trans('user_validation.Ticket is required'),
            'user_id.required' => trans('user_validation.User is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('web')->user();
        $message = new TicketMessage();
        $message->ticket_id = $request->ticket_id;
        $message->admin_id = 0;
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->message_from = 'provider';
        $message->unseen_user = 1;
        $message->unseen_admin = 0;
        $message->save();

        if($request->hasFile('documents')){
            foreach($request->documents as $request_file){
                $extention = $request_file->getClientOriginalExtension();
                $file_name = 'support-file-'.time().'.'.$extention;
                $destinationPath = public_path('uploads/custom-images/');
                $request_file->move($destinationPath,$file_name);

                $document = new MessageDocument();
                $document->ticket_message_id = $message->id;
                $document->file_name = $file_name;
                $document->save();
            }
        }

        $firstSmsExist = TicketMessage::where('admin_id', 0)->count();
        if($firstSmsExist == 0){
            $ticket = Ticket::where(['id' => $request->ticket_id])->first();
            $ticket->status = 1;
            $ticket->save();
        }

        $notification = trans('user_validation.Message Send Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function createNewTicket(){
        $user = Auth::guard('web')->user();
        $orders = OrderItem::with('user')->where('author_id', $user->id)->select('id','order_id','author_id')->latest()->get();
        return view('supportticket::seller.ticket_create',compact('orders'));
    }

    public function storeNewTicket(Request $request){
        $rules = [
            'order_id'=>'required',
            'subject'=>'required',
            'message'=>'required',
        ];

        $customMessages = [
            'order_id.required' => trans('user_validation.Order id is required'),
            'subject.required' => trans('user_validation.Subject is required'),
            'message.required' => trans('user_validation.Message is required')
        ];
        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('web')->user();

        $ticket = new Ticket();
        $ticket->user_id = $user->id;
        $ticket->order_id = $request->order_id;
        $ticket->subject = $request->subject;
        $ticket->ticket_id = substr(rand(0,time()),0,10);
        $ticket->status = 'pending';
        $ticket->ticket_from = 'provider';
        $ticket->save();

        $message = new TicketMessage();
        $message->ticket_id = $ticket->id;
        $message->admin_id = 0;
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->message_from = 'provider';
        $message->unseen_user = 1;
        $message->unseen_admin = 0;
        $message->save();

        $notification= trans('user_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('seller.ticket')->with($notification);
    }


}
