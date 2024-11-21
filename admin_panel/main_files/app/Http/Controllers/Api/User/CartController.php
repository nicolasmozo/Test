<?php

namespace App\Http\Controllers\Api\User;

use Auth;
use Session;
use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Setting;
use App\Models\BankPayment;
use App\Models\Flutterwave;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use App\Models\PaypalPayment;
use App\Models\StripePayment;
use App\Models\ProductVariant;
use App\Models\RazorpayPayment;
use App\Models\InstamojoPayment;
use App\Models\PaystackAndMollie;
use App\Models\SslcommerzPayment;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function translator($lang_code){
        $front_lang = Session::put('front_lang', $lang_code);
        config(['app.locale' => $lang_code]);
    }

    public function add_to_cart(Request $request){

        $this->translator($request->lang_code);

        $rules = [
            'product_id'=>'required',
            'variant_id'=>'required',
            'variant_name'=>'required',
            'option_name'=>'required',
            'option_price'=>'required',
            'qty'=>'required|numeric',
            'item_type'=>'required'
        ];

        $this->validate($request, $rules);

        $product = Product::find($request->product_id);

        if(!$product){
            return response()->json([
                'message' => trans('user_validation.Product not found')
            ], 403);
        }

        $varaint = ProductVariant::where(['id' => $request->variant_id, 'product_id' => $request->product_id])->count();

        if(!$varaint){
            return response()->json([
                'message' => trans('user_validation.Varaint not found')
            ], 403);
        }


        $user = Auth::guard('api')->user();

        if($request->item_type == 'buy_now'){
            ShoppingCart::where(['user_id' => $user->id, 'item_type' => 'buy_now'])->delete();

            $this->store_cart_item($request, $user);

            return response()->json([
                'message' => trans('user_validation.Item added successfully')
            ]);

        }


        $item_exist = ShoppingCart::where(['user_id' => $user->id, 'product_id' => $request->product_id, 'item_type' => 'add_to_cart'])->count();

        if($item_exist > 0){
            return response()->json([
                'message' => trans('user_validation.Item already exist')
            ], 403);
        }

        $this->store_cart_item($request, $user);

        $items = ShoppingCart::where(['user_id' => $user->id, 'item_type' => 'add_to_cart'])->latest()->get();

        return response()->json([
            'message' => trans('user_validation.Item added successfully'),
            'items' => $items,
        ]);

    }

    public function store_cart_item($request, $user){
        $item = new ShoppingCart();
        $item->user_id = $user->id;
        $item->product_id = $request->product_id;
        $item->variant_id = $request->variant_id;
        $item->variant_name = $request->variant_name;
        $item->option_name = $request->option_name;
        $item->option_price = $request->option_price;
        $item->qty = $request->qty;
        $item->item_type = $request->item_type;
        $item->message = $request->message;
        $item->account_id = $request->account_id;
        $item->save();

        return $item;
    }


    public function cart_remove(Request $request, $id){

        $this->translator($request->lang_code);

        $user = Auth::guard('api')->user();
        $item_exist = ShoppingCart::where(['user_id' => $user->id, 'id' => $id, 'item_type' => 'add_to_cart'])->count();

        if($item_exist == 0){
            return response()->json([
                'message' => trans('user_validation.Item not found')
            ], 403);
        }

        $cart = ShoppingCart::find($id);
        $cart->delete();

        $items = ShoppingCart::where(['user_id' => $user->id, 'item_type' => 'add_to_cart'])->latest()->get();

        return response()->json([
            'message' => trans('user_validation.Item removed successfully'),
            'items' => $items,
        ]);


    }

    public function item_increment(Request $request, $id){

        $this->translator($request->lang_code);

        $request->validate([
            'qty' => 'required'
        ]);

        $user = Auth::guard('api')->user();
        $item_exist = ShoppingCart::where(['user_id' => $user->id, 'id' => $id])->count();

        if($item_exist == 0){
            return response()->json([
                'message' => trans('user_validation.Item not found')
            ], 403);
        }

        if($request->qty == 0){
            return response()->json([
                'message' => trans('user_validation.Please provide valid qty')
            ], 403);
        }

        $cart = ShoppingCart::find($id);
        $cart->qty = $request->qty;
        $cart->save();

        $items = ShoppingCart::where(['user_id' => $user->id, 'item_type' => 'add_to_cart'])->latest()->get();

        return response()->json([
            'message' => trans('user_validation.Item increment successfully'),
            'items' => $items,
        ]);

    }

    public function item_decrement(Request $request, $id){

        $this->translator($request->lang_code);

        $user = Auth::guard('api')->user();
        $item_exist = ShoppingCart::where(['user_id' => $user->id, 'id' => $id])->count();

        if($item_exist == 0){
            return response()->json([
                'message' => trans('user_validation.Item not found')
            ], 403);
        }

        $cart = ShoppingCart::find($id);

        if($cart->qty == 1){
            return response()->json([
                'message' => trans('user_validation.Your qty is 1, so you can not decrement')
            ], 403);
        }

        $cart->qty = $cart->qty - 1;
        $cart->save();

        $items = ShoppingCart::where(['user_id' => $user->id, 'item_type' => 'add_to_cart'])->latest()->get();

        return response()->json([
            'message' => trans('user_validation.Item decrement successfully'),
            'items' => $items,
        ]);

    }



    public function cart_items(Request $request){

        $this->translator($request->lang_code);

        $user = Auth::guard('api')->user();

        $items = ShoppingCart::where(['user_id' => $user->id, 'item_type' => 'add_to_cart'])->latest()->get();

        $recomend_products = Product::select('id', 'slug', 'thumbnail_image', 'status', 'regular_price', 'offer_price')->where(['status' => 1])->latest()->take(9)->get();

        return response()->json([
            'items' => $items,
            'recomend_products' => $recomend_products,
        ]);

    }




    public function couponApply(Request $request){
        $this->translator($request->lang_code);
        $rules = [
        'coupon_name' => 'required',
        ];
        $customMessages = [
            'coupon_name.required' => trans('user_validation.Coupon name is required'),
        ];

        $this->validate($request, $rules,$customMessages);

        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity','>=', Carbon::now()->format('Y-m-d'))->where('status', 1)->first();
        $setting=Setting::first();
        $user = Auth::guard('api')->user();
        $carts=ShoppingCart::where('user_id', $user->id)->get();
        if($coupon){
            $coupon_name = $coupon->coupon_name;
            $coupon_discount = $coupon->coupon_discount;

            $notification = trans('user_validation.Coupon apply successfully');

            return response()->json([
                'coupon_name' => $coupon_name,
                'coupon_discount' => $coupon_discount,
                'message' => $notification,
            ]);
        }else{
            $notification = trans('user_validation.Invalid coupon');
            return response()->json(['message' => $notification], 403);
        }
    }

    public function couponCalculation(){
        $this->translator();
        $setting=Setting::select('currency_icon')->first();
        $cartTotal = str_replace(',', '', Cart::total());
        $currencyPosition= session()->get('currency_position');
        $currencyIcon= session()->get('currency_icon');
        if(Session::has('coupon')){
            return response()->json(array(
                'sub_total' => $cartTotal * session()->get('currency_rate'),
                'coupon_name' =>  Session()->get('coupon')['coupon_name'],
                'discount_amount' =>  round(Session()->get('coupon')['discount_amount'] * session()->get('currency_rate'), 2),
                'total_amount' =>  round(Session()->get('coupon')['total_amount'] * session()->get('currency_rate'), 2),
                'setting' =>  $setting,
                'currencyPosition' =>  $currencyPosition,
                'currencyIcon' =>  $currencyIcon,
            ));
        }else{
            return response()->json(array(
                'sub_total' => $cartTotal * session()->get('currency_rate'),
                'setting' =>  $setting,
                'currencyPosition' =>  $currencyPosition,
                'currencyIcon' =>  $currencyIcon,
              ));
        }
    }

    //remove coupon
    public function couponRemove(Request $request){
        $this->translator($request->lang_code);
        $user = Auth::guard('api')->user();
        $carts=ShoppingCart::where('user_id', $user->id)->get();
        $discount =  0;
        $notification = trans('user_validation.Coupon remove successfully');
        return response()->json([
            'discount' => $discount,
            'message' => $notification,
        ]);
    }

    public function checkout(Request $request){
        $this->translator($request->lang_code);
        if(Auth::guard('api')->check()){
            $user = Auth::guard('api')->user();
            $carts=ShoppingCart::where('user_id', $user->id)->get();
            if($carts->count() > 0){
                $personalCarts = Cart::content();
                $author_id_arr = [];
                foreach($carts as $item){
                    $author_id_arr[] = $item->author_id;
                }

                $author_id_arr = array_unique($author_id_arr);

                $is_id=in_array($user->id, $author_id_arr);

                if(!$is_id){
                    $setting=Setting::first();
                    $cartTotal=$carts->sum('price');
                    $product_arr=[];

                    foreach($carts as $cart){
                        $product_arr[]=$cart->product_id;
                    }

                    $products=Product::whereIn('id', $product_arr)->groupBy('category_id')->select('category_id')->get();
                    $category_arr=[];
                    foreach($products as $product){
                        $category_arr[]=$product->category_id;
                    }
                    $products=Product::with('category', 'author', 'variants')->whereIn('category_id', $category_arr)->whereNotIn('id', $product_arr)->where('status', 1)->get()->take(3);
                    $paypal = PaypalPayment::first();
                    $stripe = StripePayment::first();
                    $razorpay = RazorpayPayment::first();
                    $paystack = PaystackAndMollie::first();
                    $mollie = PaystackAndMollie::first();
                    $instamojo = InstamojoPayment::first();
                    $flutterwave = Flutterwave::first();
                    $bankPayment = BankPayment::first();
                    $sslcommerz = SslcommerzPayment::first();
                    return response()->json([
                        'setting' => $setting,
                        'paypal' => $paypal,
                        'stripe' => $stripe,
                        'razorpay' => $razorpay,
                        'related_products' => $products,
                        'paystack' => $paystack,
                        'mollie' => $mollie,
                        'instamojo' => $instamojo,
                        'flutterwave' => $flutterwave,
                        'bankPayment' => $bankPayment,
                        'sslcommerz' => $sslcommerz,
                    ]);
                }else{
                    $notification = trans("You can't purchase personal product");
                    return response()->json(['message' => $notification], 403);
                }
            }else{
                $notification = trans('user_validation.Cart is empty');
                return response()->json(['message' => $notification], 403);
            }
        }else{
            $notification = trans('user_validation.Need to login first');
            return response()->json(['message' => $notification], 403);
        }
    }
}
