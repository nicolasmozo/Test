<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
class DemoHandler
{
    public function handle(Request $request, Closure $next)
    {
        if(Route::is('admin.store-login') || Route::is('store-login') || Route::is('admin.logout') || Route::is('seller.store-login') || Route::is('seller.logout') || Route::is('add-to-cart') || Route::is('cart-item-increment') || Route::is('cart-item-decrement') || Route::is('cart-remove')){
            return $next($request);
         }else{
            if(env('APP_MODE') == 'DEMO'){
                if($request->isMethod('post') || $request->isMethod('delete') || $request->isMethod('put') || $request->isMethod('patch')){
                    $notification = trans('This Is Demo Version. You Can Not Change Anything');
                    $notification=array('messege'=>$notification,'alert-type'=>'error');
                    return redirect()->back()->with($notification);
                }
                if(Route::is('user.remove-wishlist')){
                    $notification = trans('This Is Demo Version. You Can Not Change Anything');
                    $notification=array('messege'=>$notification,'alert-type'=>'error');
                    return redirect()->back()->with($notification);
                }
            }
         }
        return $next($request);
    }
}
