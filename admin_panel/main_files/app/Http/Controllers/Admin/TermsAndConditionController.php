<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\TermsAndCondition;
use App\Http\Controllers\Controller;
use App\Models\TermsAndConditionLanguage;

class TermsAndConditionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $termsAndCondition = TermsAndCondition::first();
        $languages = Language::get();
        $terms_condition_language = TermsAndConditionLanguage::where(['terms_id' => $termsAndCondition->id, 'lang_code' => $request->lang_code])->first();

        $isTermsCondition = false;
        if($termsAndCondition){
            $isTermsCondition = true;
        }
        return view('admin.terms_and_condition',compact('termsAndCondition','isTermsCondition', 'languages', 'terms_condition_language'));
    }


    public function update(Request $request, $id)
    {
        $termsAndCondition = TermsAndCondition::find($id);
        $terms_condition_language = TermsAndConditionLanguage::where(['terms_id' => $termsAndCondition->id, 'lang_code' => $request->lang_code])->first();


        $rules = [
            'terms_and_condition' => 'required',
        ];
        $customMessages = [
            'terms_and_condition.required' => trans('admin_validation.Terms and condition is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $terms_condition_language->terms_and_condition = $request->terms_and_condition;
        $terms_condition_language->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }



}
