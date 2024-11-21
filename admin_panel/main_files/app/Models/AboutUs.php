<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class AboutUs extends Model
{
    use HasFactory;

    public function aboutlangfrontend()
    {
        $front_lang = Session::get('front_lang');
        $language = Language::where('is_default', 'Yes')->first();
        if($front_lang == ''){
            $front_lang = Session::put('front_lang', $language->lang_code);
        }
        return $this->belongsTo(AboutUsLanguage::class, 'id', 'about_id')->where('lang_code', $front_lang);
    }

    public function aboutlangadmin()
    {
        $admin_lang = Session::get('admin_lang');
        return $this->belongsTo(AboutUsLanguage::class, 'id', 'about_id')->where('lang_code', $admin_lang);
    }



    protected $hidden = ['aboutlangfrontend'];

    protected $appends = ['title', 'header', 'name', 'designation', 'about_us'];



    public function getTitleAttribute()
    {
        return $this->aboutlangfrontend?->title;
    }

    public function getHeaderAttribute()
    {
        return $this->aboutlangfrontend?->header1;
    }

    public function getNameAttribute()
    {
        return $this->aboutlangfrontend?->name;
    }

    public function getDesignationAttribute()
    {
        return $this->aboutlangfrontend?->designation;
    }

    public function getAboutUsAttribute()
    {
        return $this->aboutlangfrontend?->about_us;
    }




}
