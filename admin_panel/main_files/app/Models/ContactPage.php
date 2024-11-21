<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class ContactPage extends Model
{
    use HasFactory;

    public function contactlangfrontend()
    {
        $front_lang = Session::get('front_lang');
        $language = Language::where('is_default', 'Yes')->first();
        if($front_lang == ''){
            $front_lang = Session::put('front_lang', $language->lang_code);
        }
        return $this->belongsTo(ContactPageLanguage::class, 'id', 'contact_id')->where('lang_code', $front_lang);
    }

    public function contactlangadmin()
    {
        $admin_lang = Session::get('admin_lang');
        return $this->belongsTo(ContactPageLanguage::class, 'id', 'contact_id')->where('lang_code', $admin_lang);
    }

    protected $hidden = ['contactlangfrontend'];

    protected $appends = ['title1', 'title2', 'time', 'off_day', 'address', 'phone'];

    public function getTitle1Attribute()
    {
        return $this->contactlangfrontend?->title1;
    }

    public function getTitle2Attribute()
    {
        return $this->contactlangfrontend?->title2;
    }

    public function getTimeAttribute()
    {
        return $this->contactlangfrontend?->time;
    }

    public function getOffDayAttribute()
    {
        return $this->contactlangfrontend?->off_day;
    }

    public function getAddressAttribute()
    {
        return $this->contactlangfrontend?->address;
    }

    public function getPhoneAttribute()
    {
        return $this->contactlangfrontend?->phone;
    }

}
