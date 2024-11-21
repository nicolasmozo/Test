<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicyLanguage;

class PrivacyPolicyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $privacyPolicy = PrivacyPolicy::first();
        $languages = Language::get();
        $privacy_policy_language = PrivacyPolicyLanguage::where(['privacy_id' => $privacyPolicy->id, 'lang_code' => $request->lang_code])->first();

        $isPrivacyPolicy = false;
        if($privacyPolicy){
            $isPrivacyPolicy = true;
        }
        return view('admin.privacy_policy',compact('privacyPolicy','isPrivacyPolicy', 'languages', 'privacy_policy_language'));
    }

    public function update(Request $request, $id)
    {
        $privacyPolicy = PrivacyPolicy::find($id);
        $privacy_policy_language = PrivacyPolicyLanguage::where(['privacy_id' => $privacyPolicy->id, 'lang_code' => $request->lang_code])->first();

        $rules = [
            'privacy_policy' => 'required',
        ];
        $customMessages = [
            'privacy_policy.required' => trans('admin_validation.Privacy policy is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $privacy_policy_language->privacy_policy = $request->privacy_policy;
        $privacy_policy_language->save();

        $notification = trans('admin_validation.Updated Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
