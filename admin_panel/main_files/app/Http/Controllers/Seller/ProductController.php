<?php

namespace App\Http\Controllers\Seller;

use App\Models\Review;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Language;
use App\Models\Wishlist;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ProductLanguage;
use Auth, Session, Image, File;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
        $this->middleware('productUpload', ['except' => ['store']]);
    }


    public function translator(){
        $front_lang = Session::get('front_lang');
        $language = Language::where('is_default', 'Yes')->first();
        if($front_lang == ''){
            $front_lang = Session::put('front_lang', $language->lang_code);
        }
        config(['app.locale' => $front_lang]);
    }


    public function index(Request $request){

        $user = Auth::guard('web')->user();

        $products = Product::with('category', 'productlangadmin')->where('author_id',$user->id)->orderBy('id','desc')->get();

        $title = trans('admin_validation.All Products');

        return view('seller.product', compact('products', 'title'));
    }

    public function active_product(){

        $user = Auth::guard('web')->user();

        $products = Product::with('category', 'productlangadmin')->where('status', 1)->where('author_id',$user->id)->orderBy('id','desc')->get();

        $title = trans('admin_validation.Active Products');

        return view('seller.product', compact('products', 'title'));

    }

    public function pending_product(){

        $user = Auth::guard('web')->user();

        $products = Product::with('category', 'productlangadmin')->where('status', 0)->where('author_id',$user->id)->orderBy('id','desc')->get();

        $title = trans('admin_validation.Pending Products');

        return view('seller.product', compact('products', 'title'));

    }


    public function create(Request $request){
        $categories = Category::with('catlangadmin')->where('status', 1)->get();

        return view('seller.create_product', compact('categories'));

    }


    public function store(Request $request){
        $rules = [
            'thumb_image'=>'required',
            'category'=>'required',
            'name'=>'required',
            'slug'=>'required|unique:products',
            'regular_price'=>'required|numeric',
            'offer_price'=> $request->offer_price ? 'numeric' : '',
            'short_description'=>'required',
            'description'=>'required',
            'status'=>'required'
        ];

        $customMessages = [
            'thumb_image.required' => trans('admin_validation.Thumbnail is required'),
            'author.required' => trans('admin_validation.Author is required'),
            'category.required' => trans('admin_validation.Category is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            'regular_price.required' => trans('admin_validation.Regular price is required'),
            'extend_price.numeric' => trans('admin_validation.Offer should be numeric value'),
            'regular_price.numeric' => trans('admin_validation.Regular price should be numeric value'),
            'description.required' => trans('admin_validation.Description is required'),
            'short_description.required' => trans('admin_validation.Short description is required'),
            'status.required' => trans('admin_validation.Status is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $product = new Product();

        if($request->thumb_image){
            $extention = $request->thumb_image->getClientOriginalExtension();
            $image_name = 'thumb_image'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name = 'uploads/custom-images/'.$image_name;
            Image::make($request->thumb_image)
                ->save(public_path().'/'.$image_name);
            $product->thumbnail_image = $image_name;
        }

        $user = Auth::guard('web')->user();

        $product->author_id = $user->id;
        $product->slug = $request->slug;
        $product->category_id = $request->category;
        $product->regular_price = $request->regular_price;
        $product->offer_price = $request->offer_price;
        $product->status = $request->status;
        $product->tags = $request->tags;
        $product->seo_title = $request->seo_title ? $request->seo_title : $request->name;
        $product->seo_description = $request->seo_description ? $request->seo_description : $request->name;
        $product->save();

        $languages = Language::get();
        foreach($languages as $language){
            $product_language = new ProductLanguage();
            $product_language->product_id = $product->id;
            $product_language->lang_code = $language->lang_code;
            $product_language->name = $request->name;
            $product_language->description = $request->description;
            $product_language->short_description = $request->short_description;
            $product_language->save();
        }


        $notification = trans('admin_validation.Created successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('seller.product.edit', ['product' => $product->id, 'lang_code' => 'en'])->with($notification);

    }

    public function edit(Request $request,$id){

        $product = Product::find($id);
        $product_language = ProductLanguage::where(['product_id' => $id, 'lang_code' => $request->lang_code])->first();
        $languages = Language::get();

        $categories = Category::with('catlangadmin')->where('status', 1)->get();

        return view('seller.edit_product', compact('categories', 'product','languages','product_language'));


    }

    public function update(Request $request, $id){

        if(session()->get('admin_lang') == $request->lang_code){

            $rules = [
                'category'=>'required',
                'name'=>'required',
                'regular_price'=>'required|numeric',
                'offer_price'=> $request->offer_price ? 'numeric' : '',
                'short_description'=>'required',
                'description'=>'required',
                'status'=>'required'
            ];
        }else{
            $rules = [
                'name'=>'required',
                'short_description'=>'required',
                'description'=>'required',
            ];
        }

        $customMessages = [
            'author.required' => trans('admin_validation.Author is required'),
            'category.required' => trans('admin_validation.Category is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'regular_price.required' => trans('admin_validation.Regular price is required'),
            'offer_price.numeric' => trans('admin_validation.Offer price should be numeric value'),
            'regular_price.numeric' => trans('admin_validation.Regular price should be numeric value'),
            'description.required' => trans('admin_validation.Description is required'),
            'short_description.required' => trans('admin_validation.Short description is required'),
            'status.required' => trans('admin_validation.Status is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $product = Product::find($id);

        $product_language = ProductLanguage::where(['product_id' => $id, 'lang_code' => $request->lang_code])->first();

        if(session()->get('admin_lang') == $request->lang_code){
            if($request->thumb_image){
                $old_image = $product->thumbnail_image;
                $extention = $request->thumb_image->getClientOriginalExtension();
                $image_name = 'thumb_image'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
                $image_name = 'uploads/custom-images/'.$image_name;
                Image::make($request->thumb_image)
                    ->save(public_path().'/'.$image_name);
                $product->thumbnail_image = $image_name;
                $product->save();

                if($old_image){
                    if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
                }
            }

            $product->category_id = $request->category;
            $product->regular_price = $request->regular_price;
            $product->offer_price = $request->offer_price;
            $product->status = $request->status;
            $product->tags = $request->tags;
            $product->seo_title = $request->seo_title ? $request->seo_title : $request->name;
            $product->seo_description = $request->seo_description ? $request->seo_description : $request->name;
            $product->save();

        }

        $product_language->name = $request->name;
        $product_language->description = $request->description;
        $product_language->short_description = $request->short_description;
        $product_language->save();

        $notification = trans('admin_validation.Updated successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function product_variant($id){

        $product = Product::findOrFail($id);

        $categories = Category::where('status', 1)->get();
        $product_variants = ProductVariant::where('product_id', $id)->get();
        $setting = Setting::first();

        return view('seller.product_variant', compact('categories','product','product_variants','setting'));

    }

    public function store_product_variant(Request $request, $id){

        $rules = [
            'variant_name'=>'required',
            'file_name'=>'required',
        ];

        $customMessages = [
            'variant_name.required' => trans('admin_validation.Variant name is required'),
            'file_name.required' => trans('admin_validation.Image file is required'),
        ];

        $this->validate($request, $rules,$customMessages);

        $variant = new ProductVariant();

        if($request->file('file_name')){
            $extention = $request->file_name->getClientOriginalExtension();
            $image_name = 'variant'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $request->file_name->move(public_path('uploads/custom-images/'),$image_name);
            $variant->file_name = 'uploads/custom-images/'.$image_name;
        }

        $variant_options = array();

        foreach($request->titles as $index => $title){
            if($request->titles[$index] && $request->prices[$index]){
                $option = array(
                    'title' => $title,
                    'price' => is_numeric($request->prices[$index]) ? $request->prices[$index] : 0.00,
                );

                $variant_options[] = $option;
            }

        }

        $variant->variant_name = $request->variant_name;
        $variant->product_id = $id;
        $variant->options = json_encode($variant_options);
        $variant->save();

        $notification = trans('admin_validation.Created successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function update_product_variant(Request $request, $id){
        $rules = [
            'variant_name'=>'required',
        ];

        $customMessages = [
            'variant_name.required' => trans('admin_validation.Variant name is required'),
        ];

        $this->validate($request, $rules,$customMessages);

        $variant = ProductVariant::find($id);

        if($request->file('file_name')){
            $old_download_file = $variant->file_name;
            $extention = $request->file_name->getClientOriginalExtension();
            $image_name = 'variant'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $request->file_name->move(public_path('uploads/custom-images/'),$image_name);
            $variant->file_name = 'uploads/custom-images/'.$image_name;
            $variant->save();

            if($old_download_file){
                if(File::exists(public_path().'/uploads/custom-images/'.$old_download_file)){
                    unlink(public_path().'/uploads/custom-images/'.$old_download_file);
                }
            }
        }

        $variant_options = array();

        foreach($request->titles as $index => $title){
            if($request->titles[$index] && $request->prices[$index]){
                $option = array(
                    'title' => $title,
                    'price' => is_numeric($request->prices[$index]) ? $request->prices[$index] : 0.00,
                );

                $variant_options[] = $option;
            }

        }

        $variant->variant_name = $request->variant_name;
        $variant->options = json_encode($variant_options);
        $variant->save();

        $notification = trans('admin_validation.Updated successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function delete_product_variant($id){
        $order_item = OrderItem::where('variant_id', $id)->first();

        $variant = ProductVariant::find($id);
        $old_download_file = $variant->file_name;
        $variant->delete();
        if($old_download_file){
            if(File::exists(public_path().'/'.$old_download_file)){
                unlink(public_path().'/'.$old_download_file);
            }
        }

        $notification = trans('admin_validation.Deleted successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }


    public function destroy($id){

        $product = Product::findOrFail($id);
        $product->delete();
        if($product->thumbnail_image){
            $old_image = $product->thumbnail_image;
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($product->product_icon){
            $old_icon = $product->product_icon;

            if($old_icon){
                if(File::exists(public_path().'/'.$old_icon))unlink(public_path().'/'.$old_icon);
            }
        }

        if($product->download_file){
            $old_download_file = $product->download_file;
            if($old_download_file){
                if(File::exists(public_path().'/uploads/custom-images/'.$old_download_file))unlink(public_path().'/uploads/custom-images/'.$old_download_file);
            }
        }

        if($product->product_type!='script'){
            $variants = ProductVariant::where('product_id', $id)->get();
            foreach($variants as $variant){
                $old_download_file = $variant->file_name;
                $variant->delete();
                if($old_download_file){
                    if(File::exists(public_path().'/uploads/custom-images/'.$old_download_file)){
                        unlink(public_path().'/uploads/custom-images/'.$old_download_file);
                    }
                }
            }
        }

        $product_language = ProductLanguage::where('product_id', $id)->delete();
        $product_review = Review::where('product_id', $id)->delete();
        $wishlist = Wishlist::where('product_id', $id)->delete();

        $notification = trans('admin_validation.Deleted successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
