<?php

namespace App\Http\Controllers\Admin;

use File;
use Image;
use App\Models\Homepage;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\HomepageLanguage;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function counter(Request $request){
        $homepage = Homepage::with('homelangadmin')->first();
        $languages = Language::get();
        $homepage_language = HomepageLanguage::where(['home_id' => $homepage->id, 'lang_code' => $request->lang_code])->first();

        $counter = (object) array(
            'counter1_value' => $homepage->counter1_value,
            'counter2_value' => $homepage->counter2_value,
            'counter3_value' => $homepage->counter3_value,
            'counter4_value' => $homepage->counter4_value,
            'counter1_title' => $homepage_language->counter1_title,
            'counter2_title' => $homepage_language->counter2_title,
            'counter3_title' => $homepage_language->counter3_title,
            'counter4_title' => $homepage_language->counter4_title,
            'counter1_description' => $homepage->counter1_description,
            'counter2_description' => $homepage->counter2_description,
            'counter3_description' => $homepage->counter3_description,
            'item1_title' => $homepage->counter_item1_title,
            'item1_description' => $homepage->counter_item1_description,
            'item1_link' => $homepage->counter_item1_link,
            'item1_icon' => $homepage->counter_item1_icon,
            'item2_title' => $homepage->counter_item2_title,
            'item2_description' => $homepage->counter_item2_description,
            'item2_link' => $homepage->counter_item2_link,
            'item2_icon' => $homepage->counter_item2_icon,
            'counter_icon1' => $homepage->counter_icon1,
            'counter_icon2' => $homepage->counter_icon2,
            'counter_icon3' => $homepage->counter_icon3,
            'counter_icon4' => $homepage->counter_icon4,
            'counter_icon5' => $homepage->counter_icon5,
            'counter_icon6' => $homepage->counter_icon6,
            'counter_icon7' => $homepage->counter_icon7,
            'counter_icon8' => $homepage->counter_icon8,
            'home1_background' => $homepage->counter_home1_background,
            'home2_background' => $homepage->counter_home2_background,
        );

        return view('admin.create_counter', compact('counter', 'languages'));
    }

    public function update_counter(Request $request){
        $rules = [
            'counter1_value'=>session()->get('admin_lang') == $request->lang_code ? 'required':'',
            'counter2_value'=>session()->get('admin_lang') == $request->lang_code ? 'required':'',
            'counter3_value'=>session()->get('admin_lang') == $request->lang_code ? 'required':'',
            'counter4_value'=>session()->get('admin_lang') == $request->lang_code ? 'required':'',
            'counter1_title'=>'required',
            'counter2_title'=>'required',
            'counter3_title'=>'required',
            'counter4_title'=>'required',
        ];
        $customMessages = [
            'counter1_value.required' => trans('admin_validation.Quantity is required'),
            'counter2_value.required' => trans('admin_validation.Quantity is required'),
            'counter3_value.required' => trans('admin_validation.Quantity is required'),
            'counter4_value.required' => trans('admin_validation.Quantity is required'),
            'counter1_title.required' => trans('admin_validation.Title is required'),
            'counter2_title.required' => trans('admin_validation.Title is required'),
            'counter3_title.required' => trans('admin_validation.Title is required'),
            'counter4_title.required' => trans('admin_validation.Title is required'),

        ];
        $this->validate($request, $rules,$customMessages);

        $homepage = Homepage::with('homelangadmin')->first();
        $homepage_language = HomepageLanguage::where(['home_id' => $homepage->id, 'lang_code' => $request->lang_code])->first();

        if($request->counter1_value){
            $homepage->counter1_value = $request->counter1_value;
        }

        if($request->counter2_value){
            $homepage->counter2_value = $request->counter2_value;
        }

        if($request->counter3_value){
            $homepage->counter3_value = $request->counter3_value;
        }

        if($request->counter4_value){
            $homepage->counter4_value = $request->counter4_value;
        }

        $homepage->save();

        if($request->counter_icon1){
            $old_image = $homepage->counter_icon1;
            $extention=$request->counter_icon1->getClientOriginalExtension();
            $image_name = 'counter-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->counter_icon1)
                ->save(public_path().'/'.$image_name);
            $homepage->counter_icon1 = $image_name;
            $homepage->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->counter_icon2){
            $old_image = $homepage->counter_icon2;
            $extention=$request->counter_icon2->getClientOriginalExtension();
            $image_name = 'counter-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->counter_icon2)
                ->save(public_path().'/'.$image_name);
            $homepage->counter_icon2 = $image_name;
            $homepage->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->counter_icon3){
            $old_image = $homepage->counter_icon3;
            $extention=$request->counter_icon3->getClientOriginalExtension();
            $image_name = 'counter-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->counter_icon3)
                ->save(public_path().'/'.$image_name);
            $homepage->counter_icon3 = $image_name;
            $homepage->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->counter_icon4){
            $old_image = $homepage->counter_icon4;
            $extention=$request->counter_icon4->getClientOriginalExtension();
            $image_name = 'counter-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->counter_icon4)
                ->save(public_path().'/'.$image_name);
            $homepage->counter_icon4 = $image_name;
            $homepage->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->counter_icon5){
            $old_image = $homepage->counter_icon5;
            $extention=$request->counter_icon5->getClientOriginalExtension();
            $image_name = 'counter-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->counter_icon5)
                ->save(public_path().'/'.$image_name);
            $homepage->counter_icon5 = $image_name;
            $homepage->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->counter_icon6){
            $old_image = $homepage->counter_icon6;
            $extention=$request->counter_icon6->getClientOriginalExtension();
            $image_name = 'counter-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->counter_icon6)
                ->save(public_path().'/'.$image_name);
            $homepage->counter_icon6 = $image_name;
            $homepage->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->counter_icon7){
            $old_image = $homepage->counter_icon7;
            $extention=$request->counter_icon7->getClientOriginalExtension();
            $image_name = 'counter-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->counter_icon7)
                ->save(public_path().'/'.$image_name);
            $homepage->counter_icon7 = $image_name;
            $homepage->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->counter_icon8){
            $old_image = $homepage->counter_icon8;
            $extention=$request->counter_icon8->getClientOriginalExtension();
            $image_name = 'counter-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->counter_icon8)
                ->save(public_path().'/'.$image_name);
            $homepage->counter_icon8 = $image_name;
            $homepage->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->home2_background){
            $old_image = $homepage->counter_home2_background;
            $extention=$request->home2_background->getClientOriginalExtension();
            $image_name = 'counter-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->home2_background)
                ->save(public_path().'/'.$image_name);
            $homepage->counter_home2_background = $image_name;
            $homepage->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        $homepage_language->counter1_title = $request->counter1_title;
        $homepage_language->counter2_title = $request->counter2_title;
        $homepage_language->counter3_title = $request->counter3_title;
        $homepage_language->counter4_title = $request->counter4_title;
        $homepage_language->save();

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
