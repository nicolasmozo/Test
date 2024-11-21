<?php

use App\Http\Controllers\Admin\PricingPlanController;
use App\Http\Controllers\Seller\PaymentController;
use App\Http\Controllers\Seller\PaypalController;
use App\Http\Controllers\Seller\PricingController;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\AdController;


use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\FooterController;

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\LanguageController;

use App\Http\Controllers\Admin\ProviderController;

use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\ErrorPageController;
use App\Http\Controllers\Admin\FooterLinkController;
use App\Http\Controllers\Admin\SubscriberController;


// seller part start
use App\Http\Controllers\Admin\BlogCommentController;
use App\Http\Controllers\Admin\ContactPageController;

// seller part end


// frontend start

use App\Http\Controllers\Admin\TestimonialController;

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\PaymentMethodController;


use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\ProductReviewController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\WithdrawMethodController;

use App\Http\Controllers\Admin\Auth\AdminLoginController;

use App\Http\Controllers\Admin\FooterSocialLinkController;
use App\Http\Controllers\Admin\ProviderWithdrawController;
use App\Http\Controllers\Admin\TermsAndConditionController;
use App\Http\Controllers\Admin\EmailConfigurationController;
use App\Http\Controllers\Admin\Auth\AdminForgotPasswordController;

use App\Http\Controllers\Seller\OrderController as SellerOrderController;

use App\Http\Controllers\Seller\PaypalController as SellerPaypalController;
use App\Http\Controllers\Api\User\PaymentController as SellerPaymentController;
use App\Http\Controllers\Api\User\PaypalController as APIPaypalController;
use App\Http\Controllers\Api\User\PaymentController as APIPaymentController;
use App\Http\Controllers\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Seller\ProfileController as SellerProfileController;
use App\Http\Controllers\Seller\WithdrawController as SellerWithdrawController;
use App\Http\Controllers\Seller\DashbaordController as SellerDashbaordController;

Route::group(['middleware' => ['demo', 'XSS']], function () {

    Route::group(['middleware' => ['maintainance']], function () {

        Route::group(['middleware' => ['HtmlSpecialchars']], function () {


            Route::get('/', function (Request $request) {
                return redirect()->route('admin.login');
            });

            Route::group(['as' => 'payment-api.', 'prefix' => 'payment-api'], function () {


                Route::get('/pay-with-stripe', [APIPaymentController::class, 'pay_with_stripe'])->name('pay-with-stripe');

                Route::get('/webview-stripe-success', [APIPaymentController::class, 'webview_stripe_success'])->name('webview-stripe-success');
                Route::get('/webview-stripe-faild', [APIPaymentController::class, 'webview_stripe_faild'])->name('webview-stripe-faild');

                Route::get('/webview-success-payment', [APIPaymentController::class, 'webview_success_payment'])->name('webview-success-payment');
                Route::get('/webview-faild-payment', [APIPaymentController::class, 'webview_faild_payment'])->name('webview-faild-payment');


                Route::get('/paypal-webview', [APIPaypalController::class, 'paypal_webview'])->name('paypal-webview');
                Route::get('/paypal-webview-success', [APIPaypalController::class, 'paypal_webview_success'])->name('paypal-webview-success');

                Route::get('/razorpay-webview/', [APIPaymentController::class, 'razorpay_webview'])->name('razorpay-webview');
                Route::get('/razorpay-webview-payment', [APIPaymentController::class, 'razorpay_webview_payment'])->name('razorpay-webview-payment');

                Route::get('/flutterwave-webview', [APIPaymentController::class, 'flutterwave_webview'])->name('flutterwave-webview');
                Route::post('/flutterwave-webview-payment', [APIPaymentController::class, 'flutterwave_webview_payment'])->name('flutterwave-webview-payment');

                Route::get('/mollie-webview', [APIPaymentController::class, 'mollie_webview'])->name('mollie-webview');
                Route::get('/mollie-webview-payment', [APIPaymentController::class, 'mollie_webview_payment'])->name('mollie-webview-payment');

                Route::get('/paystack-webview', [APIPaymentController::class, 'paystack_webview'])->name('paystack-webview');
                Route::get('/paystack-webview-payment', [APIPaymentController::class, 'paystack_webview_payment'])->name('paystack-webview-payment');

                Route::get('/instamojo-webview', [APIPaymentController::class, 'instamojo_webview'])->name('instamojo-webview');
                Route::get('/instamojo-webview-payment', [APIPaymentController::class, 'instamojo_webview_payment'])->name('instamojo-webview-payment');
            });
        });

        // Seller Webview Payment Route
        Route::get('/free-enroll/{slug}', [PaymentController::class, 'freeEnroll'])->name('freeEnroll');
        Route::get('/payment/{slug}', [PaymentController::class, 'payment'])->name('payment');
        Route::post('/pay-with-stripe/{slug}', [PaymentController::class, 'payWithStripe'])->name('pay-with-stripe');

        // Seller Paypal Working Start
        Route::get('/webview-success-payment', [APIPaymentController::class, 'webview_success_payment'])->name('webview-success-payment');
        Route::get('/webview-faild-payment', [APIPaymentController::class, 'webview_faild_payment'])->name('webview-faild-payment');

        Route::get('/create-payment/{slug}', [PaypalController::class, 'createPayment'])->name('paypal.create');
        Route::get('/paypal/success/{slug}', [PaypalController::class, 'executePayment'])->name('paypal.success');
        Route::get('/payment-cancel', function () {
            return response()->json(['status' => 'Payment was canceled by the user.']);
        })->name('paypal.cancel');

        Route::post('/bank-payment/{slug}', [PaymentController::class, 'bankPayment'])->name('bank-payment');

        Route::post('/pay-with-razorpay/{slug}', [PaymentController::class, 'payWithRazorpay'])->name('pay-with-razorpay');

        Route::post('/pay-with-flutterwave/{slug}', [PaymentController::class, 'payWithFlutterwave'])->name('pay-with-flutterwave');
        Route::get('/pay-with-mollie/{slug}', [PaymentController::class, 'payWithMollie'])->name('pay-with-mollie');
        Route::get('/mollie-payment-success', [PaymentController::class, 'molliePaymentSuccess'])->name('mollie-payment-success');
        Route::get('/pay-with-paystack/{slug}', [PaymentController::class, 'payWithPayStack'])->name('pay-with-paystack');
        Route::get('/pay-with-instamojo/{slug}', [PaymentController::class, 'payWithInstamojo'])->name('pay-with-instamojo');
        Route::get('/response-instamojo', [PaymentController::class, 'instamojoResponse'])->name('response-instamojo');
    });

    // Seller Dashboard Route

    Route::group(['as' => 'seller.', 'prefix' => 'seller'], function () {

        Route::get('/login', [LoginController::class, 'loginPage'])->name('login');
        Route::post('/store-login', [LoginController::class, 'storeLogin'])->name('store-login');

        Route::post('/logout', [LoginController::class, 'userLogout'])->name('logout');

        Route::get('/', [SellerDashbaordController::class, 'dashboard']);
        Route::get('/dashboard', [SellerDashbaordController::class, 'dashboard'])->name('dashboard');

        Route::get('/download-file/{file}', [SellerDashbaordController::class, 'downloadListingFile'])->name('download-file');

        Route::get('edit-profile', [SellerProfileController::class, 'profileEdit'])->name('edit-profile');
        Route::put('profile-update', [SellerProfileController::class, 'updateProfile'])->name('profile-update');
        Route::post('password-update', [SellerProfileController::class, 'updatePassword'])->name('password-update');

        Route::resource('product', SellerProductController::class)->middleware('productUpload');

        Route::get('active-product', [SellerProductController::class, 'active_product'])->name('active.product');
        Route::get('pending-product', [SellerProductController::class, 'pending_product'])->name('pending.product');

        Route::get('product-variant/{product_id}', [SellerProductController::class, 'product_variant'])->name('product-variant');

        Route::post('store-product-variant/{product_id}', [SellerProductController::class, 'store_product_variant'])->name('store-product-variant');
        Route::put('update-product-variant/{variant_id}', [SellerProductController::class, 'update_product_variant'])->name('update-product-variant');
        Route::delete('delete-product-variant/{variant_id}', [SellerProductController::class, 'delete_product_variant'])->name('delete-product-variant');
        Route::get('download-existing-file/{file_name}', [SellerProductController::class, 'download_existing_file'])->name('download-existing-file');


        Route::get('all-booking', [SellerOrderController::class, 'index'])->name('all-booking');
        Route::get('order-show/{item_id}/{order_id}', [SellerOrderController::class, 'order_show'])->name('order-show');
        Route::post('store-product-message/{id}', [SellerOrderController::class, 'store_product_message'])->name('store-product-message');


        Route::get('pending-order', [SellerOrderController::class, 'pendingOrder'])->name('pending-order');
        Route::get('complete-order', [SellerOrderController::class, 'completeOrder'])->name('complete-order');


        Route::get('active-booking', [SellerOrderController::class, 'activeBooking'])->name('active-booking');


        Route::get('awaiting-booking', [SellerOrderController::class, 'awaitingBooking'])->name('awaiting-booking');
        Route::get('completed-booking', [SellerOrderController::class, 'completeBooking'])->name('completed-booking');
        Route::get('declined-booking', [SellerOrderController::class, 'declineBooking'])->name('declined-booking');
        Route::put('booking-declined/{id}', [SellerOrderController::class, 'bookingDecilendRequest'])->name('booking-declined');
        Route::put('booking-approved/{id}', [SellerOrderController::class, 'bookingApprovedRequest'])->name('booking-approved');
        Route::put('payment-approved/{id}', [SellerOrderController::class, 'paymentApproved'])->name('payment-approved');

        Route::put('booking-mark-as-complete/{id}', [SellerOrderController::class, 'bookingCompleteRequest'])->name('booking-mark-as-complete');
        Route::get('complete-request', [SellerOrderController::class, 'completeRequest'])->name('complete-request');

        Route::get('order-show/{id}', [SellerOrderController::class, 'show'])->name('order-show');
        Route::delete('delete-order/{id}', [SellerOrderController::class, 'destroy'])->name('delete-order');
        Route::put('update-order-status/{id}', [SellerOrderController::class, 'updateOrderStatus'])->name('update-order-status');

        Route::resource('my-withdraw', SellerWithdrawController::class);
        Route::get('get-withdraw-account-info/{id}', [SellerWithdrawController::class, 'getWithDrawAccountInfo'])->name('get-withdraw-account-info');



        Route::middleware('isSubscriptionBased')->controller(PricingController::class)->group(function () {
            Route::get('purchase-plan', 'index')->name('purchase-plan');
            Route::get('purchase-history', 'purchaseHistory')->name('purchase-history');
        });
    });

    // start admin routes
    Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {

        // start auth route
        Route::get('login', [AdminLoginController::class, 'adminLoginPage'])->name('login');
        Route::post('login', [AdminLoginController::class, 'storeLogin'])->name('store-login');
        Route::post('logout', [AdminLoginController::class, 'adminLogout'])->name('logout');
        Route::get('forget-password', [AdminForgotPasswordController::class, 'forgetPassword'])->name('forget-password');
        Route::post('send-forget-password', [AdminForgotPasswordController::class, 'sendForgetEmail'])->name('send.forget.password');
        Route::get('reset-password/{token}', [AdminForgotPasswordController::class, 'resetPassword'])->name('reset.password');
        Route::post('password-store/{token}', [AdminForgotPasswordController::class, 'storeResetData'])->name('store.reset.password');
        // end auth route

        Route::resource('admin', AdminController::class);
        Route::put('admin-status/{id}', [AdminController::class, 'changeStatus'])->name('admin-status');
        Route::get('profile', [AdminProfileController::class, 'index'])->name('profile');
        Route::put('profile-update', [AdminProfileController::class, 'update'])->name('profile.update');

        Route::get('/download-file/{file}', [AdminProfileController::class, 'downloadListingFile'])->name('download-file');

        Route::get('subscriber', [SubscriberController::class, 'index'])->name('subscriber');
        Route::delete('delete-subscriber/{id}', [SubscriberController::class, 'destroy'])->name('delete-subscriber');
        Route::post('specification-subscriber-email/{id}', [SubscriberController::class, 'specificationSubscriberEmail'])->name('specification-subscriber-email');
        Route::post('each-subscriber-email', [SubscriberController::class, 'eachSubscriberEmail'])->name('each-subscriber-email');

        Route::get('contact-message', [ContactMessageController::class, 'index'])->name('contact-message');
        Route::delete('delete-contact-message/{id}', [ContactMessageController::class, 'destroy'])->name('delete-contact-message');
        Route::put('enable-save-contact-message', [ContactMessageController::class, 'handleSaveContactMessage'])->name('enable-save-contact-message');

        Route::get('general-setting', [SettingController::class, 'index'])->name('general-setting');
        Route::put('update-general-setting', [SettingController::class, 'updateGeneralSetting'])->name('update-general-setting');

        Route::put('update-theme-color', [SettingController::class, 'updateThemeColor'])->name('update-theme-color');


        Route::put('update-logo-favicon', [SettingController::class, 'updateLogoFavicon'])->name('update-logo-favicon');
        Route::put('update-cookie-consent', [SettingController::class, 'updateCookieConset'])->name('update-cookie-consent');
        Route::put('update-tawk-chat', [SettingController::class, 'updateTawkChat'])->name('update-tawk-chat');
        Route::put('update-google-recaptcha', [SettingController::class, 'updateGoogleRecaptcha'])->name('update-google-recaptcha');

        Route::put('update-google-analytic', [SettingController::class, 'updateGoogleAnalytic'])->name('update-google-analytic');
        Route::put('update-custom-pagination', [SettingController::class, 'updateCustomPagination'])->name('update-custom-pagination');
        Route::put('update-facebook-pixel', [SettingController::class, 'updateFacebookPixel'])->name('update-facebook-pixel');
        Route::put('update-pusher', [SettingController::class, 'updatePusher'])->name('update-pusher');
        Route::put('update-payout-setting', [SettingController::class, 'updatePayout'])->name('update-payout-setting');


        Route::get('languages', [LanguageController::class, 'index'])->name('languages');
        Route::get('edit-language/{id}', [LanguageController::class, 'edit'])->name('languageEdit');
        Route::post('update-language/{id}', [LanguageController::class, 'update'])->name('language.update');
        Route::get('create-language', [LanguageController::class, 'create'])->name('language.create');
        Route::post('store-language', [LanguageController::class, 'store'])->name('language.store');
        Route::delete('delete-language/{id}', [LanguageController::class, 'destroy'])->name('languageDestroy');
        Route::get('admin-language', [LanguageController::class, 'adminLnagugae'])->name('admin-language');
        Route::post('update-admin-language', [LanguageController::class, 'updateAdminLanguage'])->name('update-admin-language');

        Route::get('admin-validation-language', [LanguageController::class, 'adminValidationLnagugae'])->name('admin-validation-language');
        Route::post('update-admin-validation-language', [LanguageController::class, 'updateAdminValidationLnagugae'])->name('update-admin-validation-language');

        Route::get('website-language', [LanguageController::class, 'websiteLanguage'])->name('website-language');
        Route::post('update-language', [LanguageController::class, 'updateLanguage'])->name('update-language');

        Route::get('website-validation-language', [LanguageController::class, 'websiteValidationLanguage'])->name('website-validation-language');
        Route::post('update-validation-language', [LanguageController::class, 'updateValidationLanguage'])->name('update-validation-language');

        Route::get('email-configuration', [EmailConfigurationController::class, 'index'])->name('email-configuration');
        Route::put('update-email-configuraion', [EmailConfigurationController::class, 'update'])->name('update-email-configuraion');

        Route::get('email-template', [EmailTemplateController::class, 'index'])->name('email-template');
        Route::get('edit-email-template/{id}', [EmailTemplateController::class, 'edit'])->name('edit-email-template');
        Route::put('update-email-template/{id}', [EmailTemplateController::class, 'update'])->name('update-email-template');

        Route::resource('blog-category', BlogCategoryController::class);
        Route::get('blog-category-edit', [BlogCategoryController::class, 'blog_category_edit'])->name('edit.blog.category');
        Route::put('blog-category-status/{id}', [BlogCategoryController::class, 'changeStatus'])->name('blog.category.status');

        Route::resource('blog', BlogController::class);
        Route::put('blog-status/{id}', [BlogController::class, 'changeStatus'])->name('blog.status');

        Route::resource('blog-comment', BlogCommentController::class);
        Route::put('blog-comment-status/{id}', [BlogCommentController::class, 'changeStatus'])->name('blog-comment.status');

        Route::resource('about-us', AboutUsController::class);
        Route::put('update-about-us', [AboutUsController::class, 'update_aboutUs'])->name('update-about-us');

        Route::resource('contact-us', ContactPageController::class);

        Route::resource('terms-and-condition', TermsAndConditionController::class);
        Route::resource('privacy-policy', PrivacyPolicyController::class);

        Route::resource('error-page', ErrorPageController::class);

        Route::get('footer', [FooterController::class, 'index'])->name('footer.index');
        Route::put('footer-update/{id}', [FooterController::class, 'update'])->name('footer.update');

        Route::resource('social-link', FooterSocialLinkController::class);
        Route::resource('footer-link', FooterLinkController::class);
        Route::get('second-col-footer-link', [FooterLinkController::class, 'secondColFooterLink'])->name('second-col-footer-link');
        Route::get('third-col-footer-link', [FooterLinkController::class, 'thirdColFooterLink'])->name('third-col-footer-link');
        Route::put('update-col-title/{id}', [FooterLinkController::class, 'updateColTitle'])->name('update-col-title');

        Route::get('header-info', [FooterSocialLinkController::class, 'header_info'])->name('header-info');
        Route::post('update-header-info', [FooterSocialLinkController::class, 'update_header_info'])->name('update-header-info');

        Route::resource('testimonial', TestimonialController::class);
        Route::put('testimonial-status/{id}', [TestimonialController::class, 'changeStatus'])->name('template.status');

        Route::get('ad', [AdController::class, 'ad'])->name('ad');
        Route::put('update-ad/{id}', [AdController::class, 'updateAd'])->name('update-ad');

        Route::get('customer-list', [CustomerController::class, 'index'])->name('customer-list');
        Route::get('customer-show/{id}', [CustomerController::class, 'show'])->name('customer-show');
        Route::put('customer-status/{id}', [CustomerController::class, 'changeStatus'])->name('customer-status');
        Route::delete('customer-delete/{id}', [CustomerController::class, 'destroy'])->name('customer-delete');
        Route::get('pending-customer-list', [CustomerController::class, 'pendingCustomerList'])->name('pending-customer-list');
        Route::get('send-email-to-all-customer', [CustomerController::class, 'sendEmailToAllUser'])->name('send-email-to-all-customer');
        Route::post('send-mail-to-all-user', [CustomerController::class, 'sendMailToAllUser'])->name('send-mail-to-all-user');
        Route::post('send-mail-to-single-user/{id}', [CustomerController::class, 'sendMailToSingleUser'])->name('send-mail-to-single-user');

        Route::resource('withdraw-method', WithdrawMethodController::class);
        Route::put('withdraw-method-status/{id}', [WithdrawMethodController::class, 'changeStatus'])->name('withdraw-method-status');

        Route::get('seller-withdraw', [ProviderWithdrawController::class, 'index'])->name('provider-withdraw');
        Route::get('pending-seller-withdraw', [ProviderWithdrawController::class, 'pendingProviderWithdraw'])->name('pending-provider-withdraw');
        Route::get('rejected-provider-withdrawal', [ProviderWithdrawController::class, 'rejectedProviderWithdraw'])->name('rejectedProviderWithdraw');

        Route::get('show-seller-withdraw/{id}', [ProviderWithdrawController::class, 'show'])->name('show-provider-withdraw');
        Route::delete('delete-seller-withdraw/{id}', [ProviderWithdrawController::class, 'destroy'])->name('delete-provider-withdraw');
        Route::put('approved-seller-withdraw/{id}', [ProviderWithdrawController::class, 'approvedWithdraw'])->name('approved-provider-withdraw');
        Route::put('reject-seller-withdraw/{id}', [ProviderWithdrawController::class, 'rejectWithdraw'])->name('reject-provider-withdraw');

        Route::get('payment-method', [PaymentMethodController::class, 'index'])->name('payment-method');
        Route::put('update-paypal', [PaymentMethodController::class, 'updatePaypal'])->name('update-paypal');
        Route::put('update-stripe', [PaymentMethodController::class, 'updateStripe'])->name('update-stripe');
        Route::put('update-razorpay', [PaymentMethodController::class, 'updateRazorpay'])->name('update-razorpay');
        Route::put('update-bank', [PaymentMethodController::class, 'updateBank'])->name('update-bank');
        Route::put('update-mollie', [PaymentMethodController::class, 'updateMollie'])->name('update-mollie');
        Route::put('update-paystack', [PaymentMethodController::class, 'updatePayStack'])->name('update-paystack');
        Route::put('update-flutterwave', [PaymentMethodController::class, 'updateflutterwave'])->name('update-flutterwave');
        Route::put('update-instamojo', [PaymentMethodController::class, 'updateInstamojo'])->name('update-instamojo');
        Route::put('update-paymongo', [PaymentMethodController::class, 'updatePaymongo'])->name('update-paymongo');
        Route::put('update-sslcommerz', [PaymentMethodController::class, 'updateSslcommerz'])->name('update-sslcommerz');
        Route::put('update-cash-on-delivery', [PaymentMethodController::class, 'updateCashOnDelivery'])->name('update-cash-on-delivery');

        Route::resource('partner', PartnerController::class);
        Route::put('partner-status/{id}', [PartnerController::class, 'changeStatus'])->name('partner-status');

        Route::resource('category', CategoryController::class);
        Route::put('category-status/{id}', [CategoryController::class, 'changeStatus'])->name('category.status');

        Route::get('assign-home-category', [CategoryController::class, 'assign_home_category'])->name('assign-home-category');
        Route::put('update-assign-home-category', [CategoryController::class, 'update_assign_home_category'])->name('update-assign-home-category');

        Route::resource('currency', CurrencyController::class);
        Route::put('currency-status/{id}', [CurrencyController::class, 'changeStatus'])->name('coupon.status');

        Route::get('seller', [ProviderController::class, 'index'])->name('provider');
        Route::get('seller-show/{id}', [ProviderController::class, 'show'])->name('provider-show');
        Route::put('provider-update/{id}', [ProviderController::class, 'updateProvider'])->name('provider-update');
        Route::delete('provider-delete/{id}', [ProviderController::class, 'destroy'])->name('provider-delete');
        Route::put('provider-status/{id}', [ProviderController::class, 'changeStatus'])->name('provider-status');

        Route::get('seller-requests', [ProviderController::class, 'seller_requests'])->name('seller-requests');
        Route::get('seller-request/{id}', [ProviderController::class, 'seller_request_show'])->name('seller-request');
        Route::post('approved-seller-request/{id}', [ProviderController::class, 'approved_seller_request'])->name('approved-seller-request');
        Route::post('reject-seller-request/{id}', [ProviderController::class, 'reject_seller_request'])->name('reject-seller-request');
        Route::delete('delete-seller-request/{id}', [ProviderController::class, 'delete_seller_request'])->name('delete-seller-request');


        Route::get('send-email-to-all-provider', [ProviderController::class, 'sendEmailToAllProvider'])->name('send-email-to-all-provider');
        Route::post('send-mail-to-all-provider', [ProviderController::class, 'sendMailToAllProvider'])->name('send-mail-to-all-provider');
        Route::get('send-email-to-provider/{id}', [ProviderController::class, 'sendEmailToProvider'])->name('send-email-to-provider');
        Route::post('send-mail-to-single-provider/{id}', [ProviderController::class, 'sendMailtoSingleProvider'])->name('send-mail-to-single-provider');

        Route::get('default-avatar', [ContentController::class, 'defaultAvatar'])->name('default-avatar');
        Route::put('update-default-avatar', [ContentController::class, 'updateDefaultAvatar'])->name('update-default-avatar');


        Route::get('maintainance-mode', [ContentController::class, 'maintainanceMode'])->name('maintainance-mode');
        Route::put('maintainance-mode-update', [ContentController::class, 'maintainanceModeUpdate'])->name('maintainance-mode-update');

        Route::get('seo-setup', [ContentController::Class, 'seoSetup'])->name('seo-setup');
        Route::put('update-seo-setup/{id}', [ContentController::Class, 'updateSeoSetup'])->name('update-seo-setup');

        Route::get('all-booking', [OrderController::class, 'index'])->name('all-booking');
        Route::get('pending-order', [OrderController::class, 'pendingOrder'])->name('pending-order');
        Route::get('complete-order', [OrderController::class, 'completeOrder'])->name('complete-order');
        Route::put('payment-approved/{id}', [OrderController::class, 'paymentApproved'])->name('payment-approved');

        Route::get('order-show/{id}', [OrderController::class, 'show'])->name('order-show');
        Route::delete('delete-order/{id}', [OrderController::class, 'destroy'])->name('delete-order');
        Route::put('update-order-status/{id}', [OrderController::class, 'updateOrderStatus'])->name('update-order-status');

        Route::get('reports', [OrderController::class, 'providerClientReport'])->name('reports');
        Route::delete('delete-client-provider-report/{id}', [OrderController::class, 'deleteProviderClientReport'])->name('delete-client-provider-report');


        Route::get('/', [DashboardController::class, 'dashobard']);
        Route::get('dashboard', [DashboardController::class, 'dashobard'])->name('dashboard');

        Route::get('clear-database', [SettingController::class, 'showClearDatabasePage'])->name('clear-database');
        Route::delete('delete-clear-database', [SettingController::class, 'clearDatabase'])->name('delete-clear-database');

        Route::get('counter', [HomepageController::class, 'counter'])->name('counter');
        Route::put('update-counter', [HomepageController::class, 'update_counter'])->name('update-counter');

        Route::resource('product', ProductController::class);

        Route::get('active-product', [ProductController::class, 'active_product'])->name('active.product');
        Route::get('pending-product', [ProductController::class, 'pending_product'])->name('pending.product');

        Route::resource('product-review', ProductReviewController::class);
        Route::put('product-review-status/{id}', [ProductReviewController::class, 'changeStatus'])->name('product-review.status');

        Route::post('store-image-type-product', [ProductController::class, 'store_image_type_product'])->name('store-image-type-product');
        Route::put('image-product-update/{id}', [ProductController::class, 'image_product_update'])->name('image-product-update');

        Route::get('product-variant/{product_id}', [ProductController::class, 'product_variant'])->name('product-variant');

        Route::post('store-product-variant/{product_id}', [ProductController::class, 'store_product_variant'])->name('store-product-variant');
        Route::put('update-product-variant/{variant_id}', [ProductController::class, 'update_product_variant'])->name('update-product-variant');
        Route::delete('delete-product-variant/{variant_id}', [ProductController::class, 'delete_product_variant'])->name('delete-product-variant');
        Route::get('download-existing-file/{file_name}', [ProductController::class, 'download_existing_file'])->name('download-existing-file');

        Route::resource('faq', FaqController::class);
        Route::put('faq-status/{id}', [FaqController::class, 'changeStatus'])->name('faq-status');

        Route::get('download-existing-file/{file_name}', [ProductController::class, 'download_existing_file'])->name('download-existing-file');

        Route::resource('pricing-plan', PricingPlanController::class);
        Route::put('pricing-plan/status/{id}', [PricingPlanController::class, 'changeStatus'])->name('pricing-plan.status');
        Route::get('purchase-list', [PricingPlanController::class, 'purchaseList'])->name('purchase-list');
    });
});



Route::get('/migrate', function () {

    Artisan::call('migrate');

    $setting = Setting::first();
    $setting->app_version = '2.0.0';
    $setting->save();

    Artisan::call('optimize:clear');

    $notification = trans('Version updated successful');
    $notification = array('message' => $notification, 'alert-type' => 'success');
    return redirect()->route('admin.dashboard')->with($notification);
});
