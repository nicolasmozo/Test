<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;


    protected $hidden = ['product', 'variant'];

    protected $appends = ['product_image', 'product_name', 'variant_image'];

    public function author(){
        return $this->belongsTo(User::class, 'author_id')->select('id', 'name', 'user_name');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id')->with('catlangfrontend');
    }

    public function variant(){
        return $this->belongsTo(ProductVariant::class, 'variant_id')->select('id','product_id','variant_name','file_name', 'options');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id')->with('productlangfrontend');
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

