<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Image;
use File;
use Str;
class PartnerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $partners = Partner::latest()->get();
        return view('admin.partner',compact('partners'));
    }

    public function create()
    {
        return view('admin.create_partner');
    }


    public function store(Request $request)
    {
        $rules = [
            'logo' => 'required',
            'link' => 'required',
            'sub_title' => 'required|max:255',
            'title' => 'required|max:255',
        ];

        $customMessages = [
            'logo.required' => trans('admin_validation.Image is required'),
            'title.required' => trans('admin_validation.Title is required'),
            'sub_title.required' => trans('admin_validation.Sub Title is required')
        ];

        $this->validate($request, $rules,$customMessages);

        $partner = new Partner();
        if($request->logo){
            $extention = $request->logo->getClientOriginalExtension();
            $logo_name = 'our-partner'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $logo_name = 'uploads/custom-images/'.$logo_name;
            Image::make($request->logo)
                ->save(public_path().'/'.$logo_name);
            $partner->logo=$logo_name;
        }
        $partner->link = $request->link;
        $partner->status = $request->status;
        $partner->sub_title = $request->sub_title;
        $partner->title = $request->title;
        $partner->save();

        $notification = trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.partner.index')->with($notification);
    }


    public function edit($id)
    {
        $partner = Partner::find($id);
        return view('admin.edit_partner',compact('partner'));
    }


    public function update(Request $request, $id)
    {

        $rules = [
            'link' => 'required',
            'sub_title' => 'required|max:255',
            'title' => 'required|max:255',
        ];

        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            'sub_title.required' => trans('admin_validation.Sub Title is required')
        ];

        $this->validate($request, $rules,$customMessages);

        $partner = Partner::find($id);

        if($request->logo){
            $old_logo = $partner->logo;
            $extention = $request->logo->getClientOriginalExtension();
            $logo_name = Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $logo_name = 'uploads/custom-images/'.$logo_name;
            Image::make($request->logo)
                ->save(public_path().'/'.$logo_name);
            $partner->logo = $logo_name;
            $partner->save();
            if($old_logo){
                if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
            }
        }

        $partner->link = $request->link;
        $partner->status = $request->status;
        $partner->sub_title = $request->sub_title;
        $partner->title = $request->title;
        $partner->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.partner.index')->with($notification);
    }


    public function destroy($id)
    {
        $partner = Partner::find($id);
        $old_logo = $partner->logo;
        $partner->delete();
        if($old_logo){
            if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
        }

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.partner.index')->with($notification);
    }

    public function changeStatus($id){
        $partner = Partner::find($id);
        if($partner->status == 1){
            $partner->status = 0;
            $partner->save();
            $message = trans('admin_validation.InActive Successfully');
        }else{
            $partner->status = 1;
            $partner->save();
            $message = trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }
}
