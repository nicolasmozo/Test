<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompleteRequest extends Model
{
    use HasFactory;

    public function provider(){
        return $this->belongsTo(User::class,'provider_id')->select('id','name','email','image','phone','address');
    }

    public function order(){
        return $this->belongsTo(Order::class)->select('id','order_id','total_amount');
    }
}
