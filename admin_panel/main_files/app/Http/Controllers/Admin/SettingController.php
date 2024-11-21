<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use File;
use Image;
use Artisan;
use Session;
use Validator;
use App\Models\Faq;
use App\Models\Blog;
use App\Models\User;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Review;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Language;
use App\Models\TawkChat;
use App\Models\Wishlist;
use App\Models\OrderItem;

use App\Models\Subscriber;
use App\Models\BlogComment;
use App\Models\FaqLanguage;
use App\Models\Testimonial;
use App\Models\BlogCategory;
use App\Models\BlogLanguage;
use Illuminate\Http\Request;
use App\Models\CookieConsent;
use App\Models\FacebookPixel;

use App\Models\SellerRequest;
use App\Models\ContactMessage;
use App\Models\FooterLanguage;
use App\Models\GoogleAnalytic;
use App\Models\ProductVariant;
use App\Models\WithdrawMethod;
use App\Models\AboutUsLanguage;
use App\Models\GoogleRecaptcha;
use App\Models\ProductLanguage;
use App\Models\SettingLanguage;
use App\Models\CategoryLanguage;
use App\Models\CustomPagination;
use App\Models\FooterSocialLink;
use App\Models\HomepageLanguage;
use App\Models\ProviderWithdraw;
use App\Models\PusherCredentail;
use App\Models\ContactPageLanguage;
use App\Models\TestimonialLanguage;
use App\Http\Controllers\Controller;
use App\Models\BlogCategoryLanguage;
use App\Models\PrivacyPolicyLanguage;
use App\Models\TermsAndConditionLanguage;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function clearDatabase(){



        Blog::truncate();
        BlogCategory::truncate();
        BlogCategoryLanguage::truncate();
        BlogComment::truncate();
        BlogLanguage::truncate();
        Category::truncate();
        CategoryLanguage::truncate();
        ContactMessage::truncate();
        FooterSocialLink::truncate();
        Faq::truncate();
        FaqLanguage::truncate();
        Order::truncate();
        OrderItem::truncate();
        Partner::truncate();
        Product::truncate();
        ProductLanguage::truncate();
        ProductVariant::truncate();
        ProviderWithdraw::truncate();
        Review::truncate();
        SellerRequest::truncate();
        Subscriber::truncate();
        Testimonial::truncate();
        TestimonialLanguage::truncate();
        User::truncate();
        Wishlist::truncate();
        WithdrawMethod::truncate();


        // pending ----
        $admins = Admin::where('id', '!=', 1)->get();
        foreach($admins as $admin){
            $admin_image = $admin->image;
            $admin->delete();
            if($admin_image){
                if(File::exists(public_path().'/'.$admin_image))unlink(public_path().'/'.$admin_image);
            }
        }



        $homepage_language = HomepageLanguage::where('lang_code', '!=', 'en')->get();
        foreach($homepage_language as $homepage){
            $homepage->delete();
        }

        $setting_languages = SettingLanguage::where('lang_code', '!=', 'en')->get();
        foreach($setting_languages as $setting){
            $setting->delete();
        }

        $footer_languages = FooterLanguage::where('lang_code', '!=', 'en')->get();
        foreach($footer_languages as $footer){
            $footer->delete();
        }

        $about_languages = AboutUsLanguage::where('lang_code', '!=', 'en')->get();
        foreach($about_languages as $about){
            $about->delete();
        }

        $contact_page_languages = ContactPageLanguage::where('lang_code', '!=', 'en')->get();
        foreach($contact_page_languages as $contact_page){
            $contact_page->delete();
        }

        $terms_condition_languages = TermsAndConditionLanguage::where('lang_code', '!=', 'en')->get();
        foreach($terms_condition_languages as $terms_condition_language){
            $terms_condition_language->delete();
        }

        $privacy_policy_languages = PrivacyPolicyLanguage::where('lang_code', '!=', 'en')->get();
        foreach($privacy_policy_languages as $privacy_policy_language){
            $privacy_policy_language->delete();
        }

        $languages = Language::where('id', '!=', 1)->get();
        foreach($languages as $language){

            $path = base_path().'/lang'.'/'.$language->lang_code;
            if (File::exists($path)) {
                File::deleteDirectory($path);
            }

            $language->delete();
        }

        $language = Language::first();
        $language->is_default = 'Yes';
        $language->save();

        $folderPath = public_path('uploads/custom-images');
        $response = File::deleteDirectory($folderPath);

        $path = public_path('uploads/custom-images');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        Session::forget('front_lang');

        $notification = trans('admin_validation.Database Cleared Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function index(){
        $setting = Setting::first();
        $cookieConsent = CookieConsent::first();
        $googleRecaptcha = GoogleRecaptcha::first();
        $tawkChat = TawkChat::first();
        $googleAnalytic = GoogleAnalytic::first();
        $customPaginations = CustomPagination::all();

        $facebookPixel = FacebookPixel::first();
        $currencies = Currency::orderBy('name','asc')->get();
        $selected_theme = $setting->selected_theme;
        $currentPayoutType = $setting->payout_type;
        $currentCommissionPercentage = $setting->commission_percentage;

        $jsonPath = resource_path('views/admin/timezones.json');
        $timezones = json_decode(file_get_contents($jsonPath), true)['timezones'];

        return view('admin.setting',compact('setting','cookieConsent','googleRecaptcha','tawkChat','googleAnalytic','customPaginations','facebookPixel','currencies','selected_theme','currentPayoutType','currentCommissionPercentage', 'timezones'));
    }

    public function updateThemeColor(Request $request){
        $setting = Setting::first();
        $setting->theme_one_color = $request->theme_one_color;
        $setting->theme_two_color = $request->theme_two_color;
        $setting->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function updateCustomPagination(Request $request){

        foreach($request->quantities as $index => $quantity){
            if($request->quantities[$index]==''){
                $notification=array(
                    'messege'=> trans('admin_validation.Every field is required'),
                    'alert-type'=>'error'
                );

                return redirect()->back()->with($notification);
            }

            $customPagination=CustomPagination::find($request->ids[$index]);
            $customPagination->qty=$request->quantities[$index];
            $customPagination->save();
        }

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function updateGeneralSetting(Request $request){
        $rules = [
            'lg_header' => 'required',
            'timezone' => 'required',
            'frontend_url' => 'required',
        ];
        $customMessages = [
            'lg_header.required' => trans('admin_validation.Sidebar large header is required'),
            'timezone.required' => trans('admin_validation.Timezone is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $setting = Setting::first();
        $setting->sidebar_lg_header = $request->lg_header;
        $setting->timezone = $request->timezone;
        $setting->frontend_url  = $request->frontend_url;
        $setting->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function updateCookieConset(Request $request){
        $rules = [
            'message' => 'required',
        ];
        $customMessages = [
            'message.required' => trans('admin_validation.Message is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $cookieConsent = CookieConsent::first();
        $cookieConsent->message = $request->message;
        $cookieConsent->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function updateTawkChat(Request $request){

        $rules = [
            'allow' => 'required',
            'widget_id' => $request->allow == 1 ?  'required' : '',
            'property_id' => $request->allow == 1 ?  'required' : ''
        ];

        $customMessages = [
            'allow.required' => trans('admin_validation.Allow is required'),
            'chat_link.required' => trans('admin_validation.Chat link is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $tawkChat = TawkChat::first();
        $tawkChat->status = $request->allow;
        $tawkChat->widget_id = $request->widget_id;
        $tawkChat->property_id = $request->property_id;
        $tawkChat->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function updateGoogleAnalytic(Request $request){
        $rules = [
            'allow' => 'required',
            'analytic_id' => $request->allow == 1 ?  'required' : ''
        ];
        $customMessages = [
            'allow.required' => trans('admin_validation.Allow is required'),
            'analytic_id.required' => trans('admin_validation.Analytic id is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $googleAnalytic = GoogleAnalytic::first();
        $googleAnalytic->status = $request->allow;
        $googleAnalytic->analytic_id = $request->analytic_id;
        $googleAnalytic->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function updateGoogleRecaptcha(Request $request){

        $rules = [
            'site_key' => $request->allow == 1 ?  'required' : '',
            'secret_key' => $request->allow == 1 ?  'required' : '',
            'allow' => 'required',
        ];
        $customMessages = [
            'site_key.required' => trans('admin_validation.Site key is required'),
            'secret_key.required' => trans('admin_validation.Secret key is required'),
            'allow.required' => trans('admin_validation.Allow is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $googleRecaptcha = GoogleRecaptcha::first();
        $googleRecaptcha->status = $request->allow;
        $googleRecaptcha->site_key = $request->site_key;
        $googleRecaptcha->secret_key = $request->secret_key;
        $googleRecaptcha->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function updateLogoFavicon(Request $request){
        $setting = Setting::first();
        if($request->logo){
            $old_logo=$setting->logo;
            $image=$request->logo;
            $ext=$image->getClientOriginalExtension();
            $logo_name= 'logo-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $logo_name='uploads/website-images/'.$logo_name;
            $logo=Image::make($image)
                    ->save(public_path().'/'.$logo_name);
            $setting->logo=$logo_name;
            $setting->save();
            if($old_logo){
                if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
            }
        }

        if($request->favicon){
            $old_favicon=$setting->favicon;
            $favicon=$request->favicon;
            $ext=$favicon->getClientOriginalExtension();
            $favicon_name= 'favicon-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $favicon_name='uploads/website-images/'.$favicon_name;
            Image::make($favicon)
                    ->save(public_path().'/'.$favicon_name);
            $setting->favicon=$favicon_name;
            $setting->save();
            if($old_favicon){
                if(File::exists(public_path().'/'.$old_favicon))unlink(public_path().'/'.$old_favicon);
            }
        }

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function showClearDatabasePage(){
        return view('admin.clear_database');
    }


    public function updateFacebookPixel(Request $request){

        $rules = [
            'app_id' => $request->allow_facebook_pixel ?  'required' : '',
        ];
        $customMessages = [
            'app_id.required' => trans('admin_validation.App id is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $facebookPixel = FacebookPixel::first();
        $facebookPixel->app_id = $request->app_id;
        $facebookPixel->status = $request->allow_facebook_pixel ? 1 : 0;
        $facebookPixel->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function updatePayout(Request $request)
    {
        $rules = [
            'payout_type' => 'required|in:' . Status::COMMISSION_BASED . ',' . Status::SUBSCRIPTION_BASED,
            'commission_percentage' => 'required_if:payout_type,' . Status::COMMISSION_BASED . '|nullable|numeric|min:0',
        ];

        $customMessages = [
            'payout_type.required' => trans('admin_validation.Payout type is required'),
            'payout_type.in' => trans('admin_validation.Invalid payout type'),
            'commission_percentage.required_if' => trans('admin_validation.Commission percentage is required when payout type is commission-based'),
            'commission_percentage.numeric' => trans('admin_validation.Commission percentage must be a number'),
            'commission_percentage.min' => trans('admin_validation.Commission percentage must be at least 0'),
        ];

        $this->validate($request, $rules, $customMessages);

        $settings = Setting::first();

        $settings->payout_type = $request->payout_type;

        if ($request->payout_type == Status::COMMISSION_BASED) {
            $settings->commission_percentage = $request->commission_percentage;
        } else {
            $settings->commission_percentage = null;
        }

        $settings->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }


}
