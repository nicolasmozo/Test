<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use File;

class AdController extends Controller
{
    public function ad(){
        $ads = Ad::all();
        return view('admin.ad', compact('ads'));
    }

    public function updateAd(Request $request, $id){
        $rules = [
            'link'=>'required',
        ];
        $customMessages = [
            'link.required' => trans('admin_validation.Link is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $ad = Ad::find($id);
        $ad->link=$request->link;
        $ad->status=$request->status;
        $ad->save();

        if($request->image){
            $old_image = $ad->image;
            $extention=$request->image->getClientOriginalExtension();
            $image_name = 'ad-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->image)
                ->save(public_path().'/'.$image_name);
            $ad->image = $image_name;
            $ad->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
