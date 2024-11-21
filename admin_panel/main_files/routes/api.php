<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;

// frontend start

use App\Http\Controllers\Api\User\PaymentController;
use App\Http\Controllers\Api\User\CartController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\User\WishlistController;
use App\Http\Controllers\Api\User\UserProfileController;
use App\Http\Controllers\Api\User\OrderController;



Route::group(['middleware' => ['demo','XSS', 'HtmlSpecialchars']], function () {

    Route::get('/website-setup', [HomeController::class, 'website_setup'])->name('website-setup');

    Route::group(['middleware' => ['maintainance']], function () {

        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::get('/about-us', [HomeController::class, 'about_us'])->name('about-us');
        Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
        Route::get('/blog/{slug}', [HomeController::class, 'blog_show'])->name('blog');
        Route::post('/store-blog-comment/{blog_id}', [HomeController::class, 'store_blog_comment'])->name('store-blog-comment');
        Route::get('/blog-comment-list/{blog_id}', [HomeController::class, 'blog_comment_list'])->name('blog-comment-list');

        Route::get('/terms-and-conditions', [HomeController::class, 'terms_conditions'])->name('terms-and-conditions');
        Route::get('/privacy-policy', [HomeController::class, 'privacy_policy'])->name('privacy-policy');

        Route::get('/contact-us', [HomeController::class, 'contact_us'])->name('contact-us');
        Route::post('/send-contact-message', [HomeController::class, 'send_contact_message'])->name('send-contact-message');

        Route::get('/products', [HomeController::class, 'product'])->name('products');
        Route::get('/product/{slug}', [HomeController::class, 'product_detail'])->name('product-detail');
        Route::get('/product-review-list/{product_id}', [HomeController::class, 'product_review_list'])->name('product-review-list');

        Route::get('/author/{user_name}', [HomeController::class, 'author_detail'])->name('author-detail');
        Route::get('/author-review/{user_name}', [HomeController::class, 'author_review'])->name('author-review');

        Route::post('/newsletter-request', [HomeController::class, 'newsletter_request'])->name('newsletter-request');
        Route::get('/newsletter-verification', [HomeController::class, 'newsletter_verifcation'])->name('newsletter-verification');

        Route::get('/faq', [HomeController::class, 'faq'])->name('faq');


        // api auth start

        Route::post('/store-login', [LoginController::class, 'store_login'])->name('store-login');
        Route::post('/store-register', [RegisterController::class, 'store_register'])->name('store-register');
        Route::post('/resend-register', [RegisterController::class, 'resend_register_code'])->name('resend-register');
        Route::post('/user-verification', [RegisterController::class, 'user_verification'])->name('user-verification');
        Route::post('/send-forget-password', [LoginController::class, 'send_forget_password'])->name('send-forget-password');

        Route::post('/verify-reset-password-token', [LoginController::class, 'verify_reset_password_token'])->name('verify-reset-password-token');
        Route::post('/store-reset-password', [LoginController::class, 'store_reset_password_page'])->name('store-reset-password');

        Route::get('/user-logout', [LoginController::class, 'user_logout'])->name('user.logout');

        // api auth end

        //profile start

        Route::prefix('user')->group(function () {

            Route::get('/edit-profile', [UserProfileController::class, 'my_profile'])->name('edit-profile');


            Route::post('update-profile', [UserProfileController::class, 'update_profile'])->name('update-profile');
            Route::post('update-password', [UserProfileController::class, 'update_password'])->name('update-password');

            Route::post('make-review/{id}', [UserProfileController::class, 'make_review'])->name('make-review');


            Route::get('order-items', [OrderController::class, 'order_items'])->name('order-items');
            Route::get('order-item/{item_id}/{order_id}', [OrderController::class, 'order_item'])->name('order-items');
            Route::post('send-message/{id}', [OrderController::class, 'send_message'])->name('send-message');

            Route::get('get-message-list/{id}', [OrderController::class, 'get_message_list'])->name('get-message-list');

            Route::put('make-item-approval/{id}', [OrderController::class, 'make_item_approval'])->name('make-item-approval');


            Route::get('wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
            Route::post('/add/wishlist/{product_id}', [WishlistController::class, 'add_wishlist'])->name('add-wishlist');
            Route::delete('/delete/wishlist/{id}', [WishlistController::class, 'delete_wishlist'])->name('delete-wishlist');

            // add to cart start
            Route::post('add-to-cart', [CartController::class, 'add_to_cart'])->name('add-to-cart');
            Route::delete('/cart-remove/{cart_id}', [CartController::class, 'cart_remove'])->name('cart-remove');
            Route::put('/cart-item-increment/{id}', [CartController::class, 'item_increment'])->name('cart-item-increment');
            Route::put('/cart-item-decrement/{id}', [CartController::class, 'item_decrement'])->name('cart-item-decrement');
            Route::get('/cart-items', [CartController::class, 'cart_items'])->name('cart-items');


            // payment route

            Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');
            Route::post('/make-order', [PaymentController::class, 'make_order'])->name('make-order');

            Route::post('/bank-payment', [PaymentController::class, 'bank_payment'])->name('bank-payment');

            // payment route end

            Route::post('join-as-seller', [UserProfileController::class, 'join_as_seller'])->name('join-as-seller');

        });


        Route::post('update-user-photo', [UserProfileController::class, 'updateUserPhoto'])->name('update-user-photo');

        Route::get('download-script/{id}', [UserProfileController::class, 'download_script'])->name('download-script');
        Route::get('download-variant/{id}', [UserProfileController::class, 'download_variant'])->name('download-variant');

        Route::get('my-profile', [UserProfileController::class, 'my_profile'])->name('my-profile');
        Route::get('portfolio', [UserProfileController::class, 'portfolio'])->name('portfolio');
        Route::get('download', [UserProfileController::class, 'download'])->name('download');
        Route::get('collection', [UserProfileController::class, 'collection'])->name('collection');

        Route::post('/user-product-review', [UserProfileController::class, 'productReview'])->name('user-product-review');

        Route::get('select-product-type', [UserProfileController::class, 'select_product_type'])->name('select-product-type');
        Route::get('product-create', [UserProfileController::class, 'product_create'])->name('product-create');
        Route::post('product-store', [UserProfileController::class, 'store'])->name('product-store');
        Route::post('store-image-type-product', [UserProfileController::class, 'store_image_type_product'])->name('store-image-type-product');
        Route::get('product-edit/{id}', [UserProfileController::class, 'edit'])->name('product-edit');
        Route::post('product-update/{id}', [UserProfileController::class, 'update'])->name('product-update');
        Route::post('image-product-update/{id}', [UserProfileController::class, 'image_product_update'])->name('image-product-update');
        Route::get('product-variant/{id}', [UserProfileController::class, 'product_variant'])->name('product-variant');

        Route::get('payment-success', [UserProfileController::class, 'payment_success'])->name('payment-success');

        Route::post('store-product-variant/{product_id}', [UserProfileController::class, 'store_product_variant'])->name('store-product-variant');

        Route::post('update-product-variant/{variant_id}', [UserProfileController::class, 'update_product_variant'])->name('update-product-variant');

        Route::delete('delete-product-variant/{variant_id}', [UserProfileController::class, 'delete_product_variant'])->name('delete-product-variant');

        Route::delete('delete-product/{id}', [UserProfileController::class, 'delete_product'])->name('delete-product');

        Route::get('download-existing-file/{file_name}', [UserProfileController::class, 'download_existing_file'])->name('download-existing-file');

    });

});



