<?php

namespace App\Models;

use Session;
use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogCategory extends Model
{
    use HasFactory;


    protected $appends = ['totalBlog'];

    public function blogs(){
        return $this->hasMany(Blog::class)->where('status',1);
    }

    public function getTotalBlogAttribute()
    {
        return $this->blogs()->count();
    }

    public function blogcategorylanguagefrontend()
    {
        $front_lang = Session::get('front_lang');
        $language = Language::where('is_default', 'Yes')->first();
        if($front_lang == ''){
            $front_lang = Session::put('front_lang', $language->lang_code);
        }

        return $this->belongsTo(BlogCategoryLanguage::class, 'id', 'category_id')->where('lang_code', $front_lang);
    }

    public function blogcategorylanguageadmin()
    {
        $admin_lang = Session::get('admin_lang');
        return $this->belongsTo(BlogCategoryLanguage::class, 'id', 'category_id')->where('lang_code', $admin_lang);
    }
}
