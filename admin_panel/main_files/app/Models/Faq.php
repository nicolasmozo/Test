<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Faq extends Model
{
    use HasFactory;

    public function faqlangfrontend()
    {
        $front_lang = Session::get('front_lang');
        $language = Language::where('is_default', 'Yes')->first();
        if($front_lang == ''){
            $front_lang = Session::put('front_lang', $language->lang_code);
        }
        return $this->belongsTo(FaqLanguage::class, 'id', 'faq_id')->where('lang_code', $front_lang);
    }

    public function faqlangadmin()
    {
        $admin_lang = Session::get('admin_lang');
        return $this->belongsTo(FaqLanguage::class, 'id', 'faq_id')->where('lang_code', $admin_lang);
    }

    protected $hidden = ['faqlangfrontend'];

    protected $appends = ['question', 'answer'];

    public function getQuestionAttribute()
    {
        return $this->faqlangfrontend?->question;
    }

    public function getAnswerAttribute()
    {
        return $this->faqlangfrontend?->answer;
    }


}
