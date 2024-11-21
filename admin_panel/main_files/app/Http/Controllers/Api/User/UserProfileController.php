<?php

namespace App\Http\Controllers\Api\User;

use Str;
use Auth;
use File;
use Hash;
use Image;
use Session;
use App\Models\User;
use App\Models\Review;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\SellerRequest;

use App\Http\Controllers\Controller;
class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function translator($lang_code){
        $front_lang = Session::put('front_lang', $lang_code);
        config(['app.locale' => $lang_code]);
    }


    public function my_profile(Request $request){

        $this->translator($request->lang_code);

        $user = Auth::guard('api')->user();

        $user = User::where('email',$user->email)->select('id','name','email','phone','user_name','status','image','address','about_me', 'password')->first();

        return response()->json([
            'user' => $user,
        ]);
    }

    public function update_profile(Request $request){

        $this->translator($request->lang_code);

        $user = Auth::guard('api')->user();

        $rules = [
            'name'=>'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048',
        ];

        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'image.mimes' => trans('user_validation.File type must be: png, jpg,jpeg'),
            'image.max' => trans('user_validation.Maximum file size 2MB'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->about_me = $request->about_me;
        $user->save();
        $image_upload = false;

        if($request->file('image')){
            $old_image = $user->image;
            $user_image = $request->image;
            $extention = $user_image->getClientOriginalExtension();
            $image_name = Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name = 'uploads/custom-images/'.$image_name;

            Image::make($user_image)
                ->save(public_path().'/'.$image_name);

            $user->image = $image_name;
            $user->save();

            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
            $image_upload = true;
        }

        $user = User::where('email',$user->email)->select('id','name','email','phone','user_name','status','image','address','about_me')->first();


        $notification = trans('user_validation.Update Successfully');
        return response()->json(['message' => $notification, 'user' => $user]);
    }

    public function update_password(Request $request){
        $this->translator($request->lang_code);
        $rules = [
            'current_password'=>'required',
            'password'=>'required|min:4|max:10|confirmed',
        ];
        $customMessages = [
            'current_password.required' => trans('user_validation.Current password is required'),
            'password.required' => trans('user_validation.Password is required'),
            'password.min' => trans('user_validation.Password minimum 4 character'),
            'password.confirmed' => trans('user_validation.Confirm password does not match'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('api')->user();
        if(Hash::check($request->current_password, $user->password)){
            $user->password = Hash::make($request->password);
            $user->save();

            $notification = trans('user_validation.Password change successfully');
            return response()->json(['message' => $notification]);

        }else{
            $notification = trans('user_validation.Current password does not match');
            return response()->json(['message' => $notification]);
        }
    }

    public function make_review(Request $request, $id){
        $this->translator($request->lang_code);

        $user = Auth::guard('api')->user();

        $rules = [
            'rating'=>'required|numeric',
            'review'=>'required',
        ];

        $customMessages = [
            'rating.required' => trans('user_validation.Rating is required'),
            'review.required' => trans('user_validation.Review is required'),
        ];

        $this->validate($request, $rules,$customMessages);

        $find_item = OrderItem::where(['id' => $id, 'user_id' => $user->id])->first();

        if($find_item->approve_by_user != 'approved'){
            return response()->json([
                'message' => trans('user_validation.Before make review, please approval this product')
            ], 403);
        }

        if($find_item->has_review == 'yes'){
            return response()->json([
                'message' => trans('user_validation.Review already submited under this order and item')
            ], 403);
        }



        $review = new Review();
        $review->user_id = $user->id;
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->product_id = $find_item->product_id;
        $review->variant_id = $find_item->variant_id;
        $review->author_id = $find_item->author_id;
        $review->order_id = $find_item->order_id;
        $review->save();

        $find_item->has_review = 'yes';
        $find_item->save();

        return response()->json([
            'message' => trans('user_validation.Review has has submited.')
        ]);




    }

    public function join_as_seller(Request $request){
        $this->translator($request->lang_code);


        $rules = [
            'company_name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'document_type'=>'required',
            'document'=>'required',
            'logo'=>'required',
            'callback_url'=>'required',

        ];

        $customMessages = [
            'company_name.required' => trans('user_validation.Company name is required'),
            'email.required' => trans('user_validation.Email is required'),
            'phone.required' => trans('user_validation.Phone is required'),
            'address.required' => trans('user_validation.Address is required'),
            'document_type.required' => trans('user_validation.Document type is required'),
            'document.required' => trans('user_validation.Document is required'),
            'logo.required' => trans('user_validation.Logo is required'),
        ];

        $this->validate($request, $rules,$customMessages);



        $user = Auth::guard('api')->user();

        $is_requested = SellerRequest::where('user_id', $user->id)->count();

        if($is_requested > 0){
            $notification = trans('user_validation.Your request has already been submitted');
            return response()->json(['message' => $notification],403);
        }

        $seller_request = new SellerRequest();

        if($request->file('document')){
            $user_image = $request->document;
            $extention = $user_image->getClientOriginalExtension();
            $image_name = Str::slug($request->company_name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name = 'uploads/custom-images/'.$image_name;

            Image::make($user_image)
                ->save(public_path().'/'.$image_name);

            $seller_request->document = $image_name;

        }

        if($request->file('logo')){
            $user_image = $request->document;
            $extention = $user_image->getClientOriginalExtension();
            $image_name = Str::slug($request->company_name).'-logo'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name = 'uploads/custom-images/'.$image_name;

            Image::make($user_image)
                ->save(public_path().'/'.$image_name);

            $seller_request->logo = $image_name;

        }



        $seller_request->user_id = $user->id;
        $seller_request->company_name = $request->company_name;
        $seller_request->email = $request->email;
        $seller_request->phone = $request->phone;
        $seller_request->address = $request->address;
        $seller_request->document_type = $request->document_type;
        $seller_request->about_us = $request->about_us;
        $seller_request->redirect_url = $request->callback_url;
        $seller_request->save();

        $notification = trans('user_validation.Your request has successfully submited, please wait for admin approval');
        return response()->json(['message' => $notification]);


    }

}
