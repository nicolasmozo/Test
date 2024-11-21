<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Testimonial extends Model
{
    use HasFactory;

    public function testimoniallangfrontend()
    {
        $front_lang = Session::get('front_lang');
        $language = Language::where('is_default', 'Yes')->first();
        if($front_lang == ''){
            $front_lang = Session::put('front_lang', $language->lang_code);
        }
        return $this->belongsTo(TestimonialLanguage::class, 'id', 'testimonial_id')->where('lang_code', $front_lang);
    }

    public function testimoniallangadmin()
    {
        $admin_lang = Session::get('admin_lang');
        return $this->belongsTo(TestimonialLanguage::class, 'id', 'testimonial_id')->where('lang_code', $admin_lang);
    }

    protected $hidden = ['testimoniallangfrontend'];

    protected $casts = [
        'rating' => 'int'
    ];

    protected $appends = ['name', 'designation', 'comment'];

    public function getNameAttribute()
    {
        return $this->testimoniallangfrontend?->name;
    }

    public function getDesignationAttribute()
    {
        return $this->testimoniallangfrontend?->designation;
    }

    public function getCommentAttribute()
    {
        return $this->testimoniallangfrontend?->comment;
    }
}
