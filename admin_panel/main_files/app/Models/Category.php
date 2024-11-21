<?php

namespace App\Models;

use Session;
use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public function catlangfrontend()
    {
        $front_lang = Session::get('front_lang');
        $language = Language::where('is_default', 'Yes')->first();
        if($front_lang == ''){
            $front_lang = Session::put('front_lang', $language->lang_code);
        }
        return $this->belongsTo(CategoryLanguage::class, 'id', 'category_id')->where('lang_code', $front_lang);
    }

    public function catlangadmin()
    {
        $admin_lang = Session::get('admin_lang');
        return $this->belongsTo(CategoryLanguage::class, 'id', 'category_id')->where('lang_code', $admin_lang);
    }

    protected $hidden = ['catlangfrontend'];


    protected $appends = ['name', 'total_product'];

    public function getNameAttribute()
    {
        return $this->catlangfrontend->name;
    }

    public function produdcts(){
        return $this->hasMany(Product::class)->where('status', 1);
    }

    public function getTotalProductAttribute()
    {
        return $this->produdcts()->count();
    }


}
