<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Footer extends Model
{
    use HasFactory;


    public function footerlangfrontend()
    {
        $front_lang = Session::get('front_lang');
        $language = Language::where('is_default', 'Yes')->first();
        if($front_lang == ''){
            $front_lang = Session::put('front_lang', $language->lang_code);
        }
        return $this->belongsTo(FooterLanguage::class, 'id', 'footer_id')->where('lang_code', $front_lang);
    }

    public function footerlangadmin()
    {
        $admin_lang = Session::get('admin_lang');
        return $this->belongsTo(FooterLanguage::class, 'id', 'footer_id')->where('lang_code', $admin_lang);
    }
}
