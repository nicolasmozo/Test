<?php

namespace App\Http\Controllers\Api\User;

use Auth;
use Session;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function translator($lang_code){
        $front_lang = Session::put('front_lang', $lang_code);
        config(['app.locale' => $lang_code]);
    }

    public function wishlist(Request $request){
        $this->translator($request->lang_code);

        $user = Auth::guard('api')->user();

        $wishlists = Wishlist::where('user_id', $user->id)->get();

        $wishlist_arr = array();

        foreach($wishlists as $wishlist){
            $wishlist_arr[] = $wishlist->product_id;
        }

        $products = Product::select('id', 'slug', 'thumbnail_image', 'status', 'regular_price', 'offer_price', 'category_id', 'popular_item', 'average_rating')->whereIn('id', $wishlist_arr)->where(['status' => 1])->limit(9)->get();

        return response()->json([
            'products' => $products,
        ]);
    }

    public function add_wishlist(Request $request, $product_id){

        $this->translator($request->lang_code);

        $product = Product::where('id', $product_id)->first();
        $user_id = Auth::guard('api')->user()->id;

        $exist = Wishlist::where('product_id', $product_id)->where('user_id', $user_id)->first();
        if(!$exist){
            $insert = new Wishlist();
            $insert->user_id = $user_id;
            $insert->product_id = $product_id;
            $insert->save();
            $message = trans('user_validation.Successfully added your wishlist');
            return response()->json(['message' => $message]);
        }else{
            $message = trans('user_validation.This product already exist');
            return response()->json(['message' => $message], 403);
        }

    }

    public function delete_wishlist(Request $request, $id){
        $this->translator($request->lang_code);

        $user_id = Auth::guard('api')->user()->id;

        $wishlist = Wishlist::where(['product_id' => $id, 'user_id' => $user_id])->delete();

        $notification = trans('user_validation.Successfully deleted');
        return response()->json(['message' => $notification]);
     }
}
