<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogCategoryLanguage;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories=BlogCategory::with('blogs', 'blogcategorylanguageadmin')->get();

        return view('admin.blog_category',compact('categories'));
    }


    public function create()
    {
        return view('admin.create_blog_category');
    }


    public function store(Request $request)
    {
        $rules = [
            'name'=>'required|unique:blog_categories',
            'slug'=>'required|unique:blog_categories',
            'status'=>'required',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'name.unique' => trans('admin_validation.Name already exist'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
        ];
        $this->validate($request, $rules,$customMessages);

        $category = new BlogCategory();
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->save();

        $languages = Language::get();
        foreach($languages as $language){
            $blog_category_language = new BlogCategoryLanguage();
            $blog_category_language->category_id = $category->id;
            $blog_category_language->lang_code = $language->lang_code;
            $blog_category_language->category_name = $request->name;
            $blog_category_language->save();
        }

        $notification= trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.blog-category.index')->with($notification);
    }

    public function blog_category_edit(Request $request)
    {
        $blog_category = BlogCategory::where('id', $request->edit_id)->first();


        $blog_category_language = BlogCategoryLanguage::where(['category_id' => $request->edit_id, 'lang_code' => $request->lang_code])->first();

        $languages = Language::get();
        return view('admin.edit_blog_category',compact('blog_category', 'languages', 'blog_category_language'));
    }


    public function update(Request $request,$id)
    {
        $blog_category = BlogCategory::findOrFail($id);
        $blog_category_language = BlogCategoryLanguage::where(['category_id' => $id, 'lang_code' => $request->lang_code])->first();

        $rules = [
            'name'=>'required',
            'status'=> session()->get('admin_lang') == $request->lang_code ? 'required':'',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        if(session()->get('admin_lang') == $request->lang_code){
            $blog_category->status = $request->status;
            $blog_category->save();
        }

        $blog_category_language->category_name = $request->name;
        $blog_category_language->save();

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        $category = BlogCategory::find($id);
        $category->delete();

        $category_language = BlogCategoryLanguage::where('category_id', $id)->delete();

        $notification= trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.blog-category.index')->with($notification);
    }

    public function changeStatus($id){
        $category = BlogCategory::find($id);
        if($category->status==1){
            $category->status=0;
            $category->save();
            $message= trans('admin_validation.Inactive Successfully');
        }else{
            $category->status=1;
            $category->save();
            $message= trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }
}
