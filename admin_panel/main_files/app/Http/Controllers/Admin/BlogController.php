<?php

namespace App\Http\Controllers\Admin;

use Auth;
use File;
use  Image;
use App\Models\Blog;
use App\Models\Language;
use App\Models\BlogComment;
use App\Models\PopularPost;
use App\Models\BlogCategory;
use App\Models\BlogLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $blogs = Blog::with('bloglanguageadmin', 'category')->orderBy('id','desc')->get();

        return view('admin.blog',compact('blogs'));
    }


    public function create()
    {
        $categories = BlogCategory::with('blogcategorylanguageadmin')->where('status',1)->get();
        return view('admin.create_blog',compact('categories'));
    }


    public function store(Request $request)
    {
        $rules = [
            'title'=>'required|unique:blog_languages',
            'slug'=>'required|unique:blogs',
            'image'=>'required',
            'short_description'=>'required',
            'description'=>'required',
            'category'=>'required',
            'status'=>'required',
        ];
        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            'title.unique' => trans('admin_validation.Title already exist'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            'image.required' => trans('admin_validation.Image is required'),
            'short_description.required' => trans('admin_validation.Short description is required'),
            'description.required' => trans('admin_validation.Description is required'),
            'category.required' => trans('admin_validation.Category is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $admin = Auth::guard('admin')->user();
        $blog = new Blog();
        if($request->image){
            $extention=$request->image->getClientOriginalExtension();
            $image_name = 'blog-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/custom-images/'.$image_name;
            Image::make($request->image)
                ->save(public_path().'/'.$image_name);
            $blog->image = $image_name;
        }

        $blog->admin_id = $admin->id;
        $blog->slug = $request->slug;
        $blog->blog_category_id = $request->category;
        $blog->status = $request->status;
        $blog->save();

        $languages = Language::get();
        foreach($languages as $language){
            $blog_language = new BlogLanguage();
            $blog_language->blog_id = $blog->id;
            $blog_language->lang_code = $language->lang_code;

            $blog_language->title = $request->title;

            $blog_language->tag = $request->tag;
            $blog_language->short_description = $request->short_description;
            $blog_language->description = $request->description;
            $blog_language->seo_title = $request->seo_title ? $request->seo_title : $request->title;
            $blog_language->seo_description = $request->seo_description ? $request->seo_description : $request->title;
            $blog_language->save();
        }

        $notification= trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.blog.index')->with($notification);
    }

    public function edit(Request $request, $id)
    {
        $categories = BlogCategory::with('blogcategorylanguageadmin')->where('status',1)->get();
        $languages = Language::get();
        $blog_language = BlogLanguage::where(['blog_id' => $id, 'lang_code' => $request->lang_code])->first();
        $blog = Blog::findOrFail($id);

        return view('admin.edit_blog',compact('categories','blog', 'blog_language', 'languages'));
    }


    public function update(Request $request,$id)
    {

        $blog = Blog::find($id);
        $blog_language = BlogLanguage::where(['blog_id' => $id, 'lang_code' => $request->lang_code])->first();


        $rules = [
            'title'=>'required',
            'short_description'=>'required',
            'description'=>'required',
            'category'=> session()->get('admin_lang') == $request->lang_code ? 'required':'',
            'status'=> session()->get('admin_lang') == $request->lang_code ? 'required':'',
        ];
        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            'short_description.required' => trans('admin_validation.Short description is required'),
            'description.required' => trans('admin_validation.Description is required'),
            'category.required' => trans('admin_validation.Category is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        if(session()->get('admin_lang') == $request->lang_code){
            if($request->image){
                $old_image = $blog->image;
                $extention=$request->image->getClientOriginalExtension();
                $image_name = 'blog-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
                $image_name ='uploads/custom-images/'.$image_name;
                Image::make($request->image)
                    ->save(public_path().'/'.$image_name);
                $blog->image = $image_name;
                $blog->save();
                if($old_image){
                    if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
                }
            }

            if($request->banner_image){
                $exist_banner = $blog->banner_image;
                $extention = $request->banner_image->getClientOriginalExtension();
                $banner_name = 'blog-banner'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
                $banner_name = 'uploads/custom-images/'.$banner_name;
                Image::make($request->banner_image)
                    ->save(public_path().'/'.$banner_name);
                $blog->banner_image = $banner_name;
                $blog->save();
                if($exist_banner){
                    if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
                }
            }

            $blog->blog_category_id = $request->category;
            $blog->status = $request->status;
            $blog->save();
        }

        $blog_language->title = $request->title;
        $blog_language->tag = $request->tag;
        $blog_language->short_description = $request->short_description;
        $blog_language->description = $request->description;
        $blog_language->seo_title = $request->seo_title ? $request->seo_title : $request->title;
        $blog_language->seo_description = $request->seo_description ? $request->seo_description : $request->title;
        $blog_language->save();

        $notification= trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        $old_image = $blog->image;
        $old_banner = $blog->banner_image;
        $blog->delete();
        if($old_image){
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
        }
        if($old_banner){
            if(File::exists(public_path().'/'.$old_banner))unlink(public_path().'/'.$old_banner);
        }
        BlogComment::where('blog_id',$id)->delete();
        PopularPost::where('blog_id',$id)->delete();
        $blog_language = BlogLanguage::where('blog_id', $id)->delete();

        $notification=  trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.blog.index')->with($notification);
    }

    public function changeStatus($id){
        $blog = Blog::find($id);
        if($blog->status==1){
            $blog->status=0;
            $blog->save();
            $message= trans('admin_validation.Inactive Successfully');
        }else{
            $blog->status=1;
            $blog->save();
            $message= trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }
}
