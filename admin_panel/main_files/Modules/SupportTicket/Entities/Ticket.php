<?php

namespace Modules\SupportTicket\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;

class Ticket extends Model
{
    use HasFactory;

    protected $appends = ['unSeenUserMessage'];

    public function getUnSeenUserMessageAttribute()
    {
        return $this->unSeenUserMessage()->count();
    }


    public function user(){
        return $this->belongsTo(User::class,'user_id')->select('id','name','email','image','phone','address');
    }

    public function orderItems(){
        return $this->belongsTo(OrderItem::class,'order_id');
    }

    public function order(){
        return $this->belongsTo(Order::class)->select('id','order_id','total_amount');
    }

    public function messages(){
        return $this->hasMany(TicketMessage::class);
    }


    public function unSeenUserMessage(){
        return $this->hasMany(TicketMessage::class)->where('unseen_user',0);
    }



}
