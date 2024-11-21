<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Language;

class OrderItem extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id')->with('productlangfrontend');
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function author(){
        return $this->belongsTo(User::class,'author_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }



    public function productlangfrontend()
    {
        $front_lang = Session::get('front_lang');
        $language = Language::where('is_default', 'Yes')->first();
        if($front_lang == ''){
            $front_lang = Session::put('front_lang', $language->lang_code);
        }
        return $this->belongsTo(ProductLanguage::class, 'id', 'product_id')->where('lang_code', $front_lang);
    }

    protected $hidden = ['order', 'variant', 'product'];

    protected $appends = ['track_id', 'product_image', 'product_name', 'variant_image'];

    public function getTrackIdAttribute()
    {
        return $this->order?->order_id;
    }

    protected $casts = [
        'option_price' => 'float',
        'qty' => 'int'
    ];

    public function getProductImageAttribute()
    {
        return $this->product?->thumbnail_image;
    }

    public function getProductNameAttribute()
    {
        return $this->product?->name;
    }

    public function getVariantImageAttribute()
    {
        return $this->variant?->file_name;
    }



}
