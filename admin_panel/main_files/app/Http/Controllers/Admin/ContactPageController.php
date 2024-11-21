<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use App\Models\Language;
use App\Models\ContactPage;
use Illuminate\Http\Request;
use App\Models\ContactPageLanguage;
use App\Http\Controllers\Controller;

class ContactPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $contact = ContactPage::first();
        $languages = Language::get();
        $contact_language = ContactPageLanguage::where(['contact_id' => $contact->id, 'lang_code' => $request->lang_code])->first();

        return view('admin.contact_page', compact('contact', 'languages', 'contact_language'));
    }

    public function update(Request $request, $id){
        $rules = [
            'email' => session()->get('admin_lang') == $request->lang_code ? 'required':'',
            'address' => 'required',
            'phone' => 'required',
            'title1' => 'required',
            'time' => 'required',
            'off_day' => 'required',
            'title2' => 'required',
            'google_map' => session()->get('admin_lang') == $request->lang_code ? 'required':''
        ];
        $customMessages = [
            'email.required' => trans('admin_validation.Email is required'),
            'address.required' => trans('admin_validation.Address is required'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'title1.required' => trans('admin_validation.Title is required'),
            'time.required' => trans('admin_validation.Office time is required'),
            'off_day.required' => trans('admin_validation.Off day is required'),
            'title2.required' => trans('admin_validation.Title is required'),
            'google_map.unique' => trans('admin_validation.Google Map is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $contact = ContactPage::find($id);
        $contact_language = ContactPageLanguage::where(['contact_id' => $contact->id, 'lang_code' => $request->lang_code])->first();

        if($request->email){
            $contact->email = $request->email;
            $contact->email2 = $request->email2;
            $contact->phone = $request->phone;
            $contact->phone2 = $request->phone2;
            $contact->save();
        }

        if($request->google_map){
            $contact->map = $request->google_map;
            $contact->save();
        }


        if($request->image){
            $exist_banner = $contact->image;
            $extention = $request->image->getClientOriginalExtension();
            $banner_name = 'contact_us'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            Image::make($request->image)
                ->save(public_path().'/'.$banner_name);
            $contact->image = $banner_name;
            $contact->save();
            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        $contact_language->title1 = $request->title1;
        $contact_language->title2 = $request->title2;
        $contact_language->time = $request->time;
        $contact_language->off_day = $request->off_day;
        $contact_language->address = $request->address;
        $contact_language->phone = $request->phone;
        $contact_language->save();

        $notification = trans('admin_validation.Updated Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

}
