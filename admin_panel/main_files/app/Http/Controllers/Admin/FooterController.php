<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use App\Models\Footer;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\FooterLanguage;
use App\Http\Controllers\Controller;

class FooterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $footer = Footer::first();

        $languages = Language::get();

        $footer_language = FooterLanguage::where(['footer_id' => $footer->id, 'lang_code' => $request->lang_code])->first();

        return view('admin.website_footer', compact('footer', 'languages', 'footer_language'));
    }

    public function update(Request $request, $id){
        $rules = [
            'copyright' =>'required',
            'description' =>'required',
        ];
        $customMessages = [
            'copyright.required' => trans('admin_validation.Copyright is required'),
            'description.required' => trans('admin_validation.Description is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $footer = Footer::first();
        $footer_language = FooterLanguage::where(['footer_id' => $footer->id, 'lang_code' => $request->lang_code])->first();

        $footer->copyright = $request->copyright;
        $footer->description = $request->description;
        $footer->save();

        $footer_language->copyright = $request->copyright;
        $footer_language->description = $request->description;
        $footer_language->save();

        if($request->card_image){
            $old_logo=$footer->payment_image;
            $image=$request->card_image;
            $ext=$image->getClientOriginalExtension();
            $logo_name= 'payment-card-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $logo_name='uploads/website-images/'.$logo_name;
            $logo=Image::make($image)
                    ->save(public_path().'/'.$logo_name);
            $footer->payment_image=$logo_name;
            $footer->save();
            if($old_logo){
                if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
            }
        }


        $notification = trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }
}
