<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;


    public function provider(){
        return $this->belongsTo(User::class,'provider_id')->select('id','name','email','image','phone','designation','status','is_seller','country','state','city','address','created_at');
    }

    public function service(){
        return $this->belongsTo(Service::class,'service_id')->select('id','name','slug','image');
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id')->select('id', 'name', 'image', 'user_name','kyc_status');
    }

    protected $casts = [
        'rating' => 'int'
    ];


}
