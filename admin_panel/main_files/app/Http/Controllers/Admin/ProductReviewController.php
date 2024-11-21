<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        if($request->author_id){
            $productReviews = Review::with('product')->where('author_id', $request->author_id)->orderBy('id','desc')->get();
        }else{
            $productReviews = Review::with('product')->orderBy('id','desc')->get();
        }

        return view('admin.product_review', compact('productReviews'));
    }

    public function destroy($id)
    {
        $productReview = Review::find($id);
        $productReview->delete();

        $notification= trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.product-review.index')->with($notification);
    }

    public function changeStatus($id){
        $productReview = Review::find($id);
        if($productReview->status == 1){
            $productReview->status = 0;
            $productReview->save();
            $message = trans('admin_validation.Inactive Successfully');
        }else{
            $productReview->status = 1;
            $productReview->save();
            $message = trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }
}
