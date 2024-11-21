<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    public function client(){
        return $this->belongsTo(User::class,'client_id')->select('id','name','email','image','phone','address');
    }

    public function provider(){
        return $this->belongsTo(User::class,'provider_id')->select('id','name','email','image','phone','address','designation','is_seller','user_name');
    }

    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

    public function refundRequest(){
        return $this->hasOne(RefundRequest::class);
    }

    public function completeRequest(){
        return $this->hasOne(CompleteRequest::class);
    }




}

