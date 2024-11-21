<?php

namespace App\Http\Controllers\Admin;

use Str;
use File;
use Image;
use App\Models\Language;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\TestimonialLanguage;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $testimonials = Testimonial::with('testimoniallangadmin')->get();
        return view('admin.testimonial',compact('testimonials'));
    }

    public function create()
    {
        return view('admin.create_testimonial');
    }


    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'designation' => 'required',
            'image' => 'required',
            'status' => 'required',
            'comment' => 'required',
            'rating' => 'required',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'designation.required' => trans('admin_validation.Designation is required'),
            'image.required' => trans('admin_validation.Image is required'),
            'comment.required' => trans('admin_validation.Comment is required'),
            'rating.required' => trans('admin_validation.Rating is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $testimonial = new Testimonial();

        if($request->image){
            $extention = $request->image->getClientOriginalExtension();
            $image_name = Str::slug($request->name).date('-Ymdhis').'.'.$extention;
            $image_name = 'uploads/custom-images/'.$image_name;
            Image::make($request->image)
                ->save(public_path().'/'.$image_name);
        }

        $testimonial->image = $image_name;
        $testimonial->status = $request->status;
        $testimonial->rating = $request->rating;
        $testimonial->save();

        $languages = Language::get();
        foreach($languages as $language){
            $testimonial_language = new TestimonialLanguage();
            $testimonial_language->testimonial_id = $testimonial->id;
            $testimonial_language->lang_code = $language->lang_code;
            $testimonial_language->name = $request->name;
            $testimonial_language->designation = $request->designation;
            $testimonial_language->comment = $request->comment;
            $testimonial_language->save();
        }


        $notification = trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.testimonial.index')->with($notification);
    }


    public function edit(Request $request, $id)
    {
        $testimonial = Testimonial::find($id);
        $languages = Language::get();
        $testimonial_language = TestimonialLanguage::where(['testimonial_id' => $testimonial->id, 'lang_code' => $request->lang_code])->first();
        return view('admin.edit_testimonial',compact('testimonial', 'languages', 'testimonial_language'));
    }


    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::find($id);
        $testimonial_language = TestimonialLanguage::where(['testimonial_id' => $testimonial->id, 'lang_code' => $request->lang_code])->first();
        $rules = [
            'name' => 'required',
            'designation' => 'required',
            'status' => session()->get('admin_lang') == $request->lang_code ? 'required':'',
            'comment' => 'required',
            'rating' => session()->get('admin_lang') == $request->lang_code ? 'required':'',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'designation.required' => trans('admin_validation.Designation is required'),
            'comment.required' => trans('admin_validation.Comment is required'),
            'rating.required' => trans('admin_validation.Rating is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        if($request->image){
            $existing_image = $testimonial->image;
            $extention = $request->image->getClientOriginalExtension();
            $image_name = Str::slug($request->name).date('Ymdhis').'.'.$extention;
            $image_name = 'uploads/custom-images/'.$image_name;
            Image::make($request->image)
                    ->save(public_path().'/'.$image_name);
                $testimonial->image= $image_name;
                $testimonial->save();
                if($existing_image){
                    if(File::exists(public_path().'/'.$existing_image))unlink(public_path().'/'.$existing_image);
                }
        }


        if (session()->get('admin_lang') == $request->lang_code) {
            $testimonial->status = $request->status;
        }


        if($request->rating){
            $testimonial->rating = $request->rating;
        }

        $testimonial->save();

        $testimonial_language->name = $request->name;
        $testimonial_language->designation = $request->designation;
        $testimonial_language->comment = $request->comment;
        $testimonial_language->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
        $existing_image = $testimonial->image;
        $testimonial->delete();

        if($existing_image){
            if(File::exists(public_path().'/'.$existing_image))unlink(public_path().'/'.$existing_image);
        }

        $testimonial_language = TestimonialLanguage::where('testimonial_id', $id)->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.testimonial.index')->with($notification);
    }

    public function changeStatus($id){
        $item = Testimonial::find($id);
        if($item->status == 1){
            $item->status = 0;
            $item->save();
            $message = trans('admin_validation.Inactive Successfully');
        }else{
            $item->status = 1;
            $item->save();
            $message = trans('admin_validation.Active Successfully');
        }

        return response()->json($message);
    }
}
