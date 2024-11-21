<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;

class Setting extends Model
{

    public function settinglangfrontend()
    {
        $front_lang = Session::get('front_lang');
        $language = Language::where('is_default', 'Yes')->first();
        if($front_lang == ''){
            $front_lang = Session::put('front_lang', $language->lang_code);
        }
        return $this->belongsTo(SettingLanguage::class, 'id', 'setting_id')->where('lang_code', $front_lang);
    }

    public function settinglangadmin()
    {
        $admin_lang = Session::get('admin_lang');
        return $this->belongsTo(SettingLanguage::class, 'id', 'setting_id')->where('lang_code', $admin_lang);
    }
}
