<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use App\Models\AboutUs;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\AboutUsLanguage;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $about = AboutUs::with('aboutlangadmin')->first();
        $languages = Language::get();
        $about_language = AboutUsLanguage::where(['about_id' => $about->id, 'lang_code' => $request->lang_code])->first();

        return view('admin.about-us',compact('about', 'languages', 'about_language'));
    }

    public function update_aboutUs(Request $request){
        $rules = [
            'title' => 'required',
            'header1' => 'required',
            'name' => 'required',
            'desgination' => 'required',
            'about_us' => 'required',
        ];
        $customMessages = [
            'header1.required' => trans('admin_validation.Title is required'),
            'header1.required' => trans('admin_validation.Header is required'),
            'header2.required' => trans('admin_validation.Header is required'),
            'header3.required' => trans('admin_validation.Header is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'desgination.required' => trans('admin_validation.Designation is required'),
            'about_us.required' => trans('admin_validation.About us is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $about = AboutUs::with('aboutlangadmin')->first();

        $about_language = AboutUsLanguage::where(['about_id' => $about->id, 'lang_code' => $request->lang_code])->first();

        $about_language->name = $request->name;
        $about_language->desgination = $request->desgination;
        $about_language->title = $request->title;
        $about_language->header1 = $request->header1;
        $about_language->about_us = $request->about_us;
        $about_language->save();

        if($request->banner_image){
            $exist_banner = $about->banner_image;
            $extention = $request->banner_image->getClientOriginalExtension();
            $banner_name = 'about-us'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            Image::make($request->banner_image)
                ->save(public_path().'/'.$banner_name);
            $about->banner_image = $banner_name;
            $about->save();
            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->image){
            $exist_image= $about->image;
            $extention = $request->image->getClientOriginalExtension();
            $image_name = 'about-us'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name = 'uploads/website-images/'.$image_name;
            Image::make($request->image)
                ->save(public_path().'/'.$image_name);
            $about->image = $image_name;
            $about->save();
            if($exist_image){
                if(File::exists(public_path().'/'.$exist_image))unlink(public_path().'/'.$exist_image);
            }
        }

        if($request->signature){
            $exist_signature = $about->signature;
            $extention = $request->signature->getClientOriginalExtension();
            $signature_name = 'about-us'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $signature_name = 'uploads/website-images/'.$signature_name;
            Image::make($request->signature)
                ->save(public_path().'/'.$signature_name);
            $about->signature = $signature_name;
            $about->save();
            if($exist_signature){
                if(File::exists(public_path().'/'.$exist_signature))unlink(public_path().'/'.$exist_signature);
            }
        }
        $notification = trans('admin_validation.Updated Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

}
