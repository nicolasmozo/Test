<?php

namespace App\Http\Controllers\Admin;

use File;
use  Image;
use Session;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Language;
use App\Models\Homepage;
use Illuminate\Http\Request;
use App\Models\CategoryLanguage;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::with('catlangadmin')->get();
        $setting = Setting::first();
        $selected_theme = $setting->selected_theme;

        return view('admin.category',compact('categories','selected_theme'));
    }


    public function create()
    {
        $setting = Setting::first();
        $selected_theme = $setting->selected_theme;

        return view('admin.create_product_category', compact('selected_theme'));
    }


    public function store(Request $request)
    {

        $setting = Setting::first();
        $selected_theme = $setting->selected_theme;

        $rules = [
            'name'=>'required|unique:category_languages',
            'slug'=>'required|unique:categories',
            'status'=>'required',
            'icon'=>'required',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'name.unique' => trans('admin_validation.Name already exist'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            'icon.required' => trans('admin_validation.Icon is required'),
            'image.required' => trans('admin_validation.Image is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $category = new Category();
        if($request->icon){
            $extention = $request->icon->getClientOriginalExtension();
            $logo_name = 'category'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $logo_name = 'uploads/custom-images/'.$logo_name;
            Image::make($request->icon)
                ->save(public_path().'/'.$logo_name);
            $category->icon=$logo_name;
        }



        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->save();

        $languages = Language::get();

        foreach($languages as $language){
            $category_language = new CategoryLanguage();
            $category_language->category_id = $category->id;
            $category_language->lang_code = $language->lang_code;
            $category_language->name = $request->name;
            $category_language->save();
        }

        $notification = trans('admin_validation.Created Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.category.index')->with($notification);
    }

    public function edit(Request $request, $id)
    {
        $category = Category::with('catlangadmin')->find($id);

        $languages = Language::get();

        $category_language = CategoryLanguage::where(['category_id' => $id, 'lang_code' => $request->lang_code])->first();

        $setting = Setting::first();
        $selected_theme = $setting->selected_theme;

        return view('admin.edit_category',compact('category','selected_theme','languages','category_language',));
    }


    public function update(Request $request,$id)
    {
        $category = Category::find($id);
        $category_language = CategoryLanguage::where(['category_id' => $id, 'lang_code' => $request->lang_code])->first();
        $rules = [
            'name'=>'required',
            'status'=> session()->get('admin_lang') == $request->lang_code ? 'required':'',
        ];

        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        if(session()->get('admin_lang') == $request->lang_code){
            $category->status = $request->status;
            $category->save();
            if($request->icon){
                $old_logo = $category->icon;
                $extention = $request->icon->getClientOriginalExtension();
                $logo_name = 'category'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
                $logo_name = 'uploads/custom-images/'.$logo_name;
                Image::make($request->icon)
                    ->save(public_path().'/'.$logo_name);
                $category->icon=$logo_name;
                $category->save();
                if($old_logo){
                    if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
                }
            }
        }

        $category_language->name = $request->name;
        $category_language->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $old_logo = $category->icon;
        $category->delete();
        if($old_logo){
            if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
        }

        $category_language = CategoryLanguage::where('category_id', $id)->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.category.index')->with($notification);
    }

    public function changeStatus($id){
        $category = Category::find($id);
        if($category->status==1){
            $category->status=0;
            $category->save();
            $message = trans('admin_validation.Inactive Successfully');
        }else{
            $category->status=1;
            $category->save();
            $message= trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }

    public function assign_home_category(){

        Session::put('front_lang', 'en');

        $categories = Category::select('id', 'slug', 'icon', 'status')->where('status', 1)->latest()->get();

        $home_category = Homepage::select('category_one', 'category_three', 'category_four', 'trending_categories')->first();

        return view('admin.assign_home_category', ['home_category' => $home_category, 'categories' => $categories]);

    }

    public function update_assign_home_category(Request $request){

        $request->validate([
            'trending_categories' => 'required'
        ]);

        $home_category = Homepage::first();
        $home_category->category_one = $request->category_one;
        $home_category->category_three = $request->category_three;
        $home_category->category_four = $request->category_four;
        $home_category->trending_categories = json_encode($request->trending_categories);
        $home_category->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);


    }


}
