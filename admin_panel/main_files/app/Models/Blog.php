<?php

namespace App\Models;

use Session;
use App\Models\Language;
use App\Models\BlogLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(BlogCategory::class,'blog_category_id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class)->select('id', 'name', 'image');
    }

    public function comments(){
        return $this->hasMany(BlogComment::class);
    }

    public function activeComments(){
        return $this->hasMany(BlogComment::class)->where('status',1);
    }

    public function getTotalCommentAttribute()
    {
        return $this->activeComments()->count();
    }


    public function bloglanguagefrontend()
    {
        $front_lang = Session::get('front_lang');
        $language = Language::where('is_default', 'Yes')->first();
        if($front_lang == ''){
            $front_lang = Session::put('front_lang', $language->lang_code);
        }
        return $this->belongsTo(BlogLanguage::class, 'id', 'blog_id')->where('lang_code', $front_lang);
    }

    public function bloglanguageadmin()
    {
        $admin_lang = Session::get('admin_lang');
        return $this->belongsTo(BlogLanguage::class, 'id', 'blog_id')->where('lang_code', $admin_lang);
    }


    protected $hidden = ['bloglanguagefrontend', 'activeComments'];

    protected $appends = ['title', 'short_description', 'description', 'tags', 'seo_title', 'seo_description'];

    public function getTitleAttribute()
    {
        return $this->bloglanguagefrontend?->title;
    }

    public function getShortDescriptionAttribute()
    {
        return $this->bloglanguagefrontend?->short_description;
    }

    public function getDescriptionAttribute()
    {
        return $this->bloglanguagefrontend?->description;
    }

    public function getTagsAttribute()
    {
        return $this->bloglanguagefrontend?->tag;
    }


    public function getSeoTitleAttribute()
    {
        return $this->bloglanguagefrontend?->seo_title;
    }


    public function getSeoDescriptionAttribute()
    {
        return $this->bloglanguagefrontend?->seo_description;
    }


}
