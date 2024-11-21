<?php

namespace App\Http\Controllers\Api;
use Str;

use Mail;
use Session;
use Exception;
use App\Models\Ad;
use App\Models\Faq;
use App\Models\Blog;
use App\Models\User;
use App\Models\Footer;
use App\Models\Review;
use App\Models\AboutUs;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Homepage;
use App\Models\Language;
use App\Models\TawkChat;
use App\Models\ErrorPage;
use App\Models\SeoSetting;
use App\Models\Subscriber;

use App\Helpers\MailHelper;
use App\Models\BlogComment;
use App\Models\ContactPage;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\CookieConsent;
use App\Models\EmailTemplate;
use App\Models\FacebookPixel;
use App\Models\MultiCurrency;
use App\Models\PrivacyPolicy;
use App\Models\ContactMessage;
use App\Models\GoogleAnalytic;
use App\Models\ProductVariant;
use App\Models\GoogleRecaptcha;

use App\Models\ProductLanguage;
use App\Models\CustomPagination;
use App\Models\FooterSocialLink;
use App\Models\MaintainanceText;
use App\Models\TermsAndCondition;
use App\Http\Controllers\Controller;
use App\Mail\SubscriptionVerification;
use App\Mail\ContactMessageInformation;

class HomeController extends Controller
{
    public function translator($lang_code){

        if($lang_code){
            $lang_code = $lang_code;
        }else{
            $default_lang = Language::where('id', '1')->first();
            if($default_lang){
                $lang_code = $default_lang->lang_code;
            }else{
                $lang_code = 'en';
            }
        }

        Session::put('front_lang', $lang_code);
        config(['app.locale' => $lang_code]);
    }


    public function website_setup(Request $request){

        $setting = Setting::select('id','logo','favicon','default_avatar', 'topbar_phone', 'topbar_email', 'topbar_address', 'theme_one_color as primary_background', 'theme_two_color as primary_foreground')->first();
        $languages = Language::where('status', 1)->get();
        $currencies = MultiCurrency::where('status', 1)->get();

        if($request->lang_code){
            $lang_code = $request->lang_code;
        }else{
            $default_lang = Language::where('id', 1)->first();
            if($default_lang){
                $lang_code = $default_lang->lang_code;
            }else{
                $lang_code = 'en';
            }
        }


        $this->translator($lang_code);

        try{

            $localizations = include(lang_path($lang_code.'/user.php'));
        }catch(Exception $ex){
            return response()->json([
                'message' => trans('user_validation.Something went wrong')
            ],403);
        }



        $categories = Category::select('id', 'slug', 'icon', 'status')->where('status', 1)->latest()->get();

        $links = FooterSocialLink::all();

        $homepage_ads = Ad::where('id', 1)->first();
        $shoppage_ads = Ad::where('id', 2)->first();
        $shop_detail_ads = Ad::where('id', 3)->first();

        $maintainance = MaintainanceText::first();
        $cookieConsent = CookieConsent::first();
        $googleRecaptcha = GoogleRecaptcha::first();
        $tawkChat = TawkChat::first();
        $googleAnalytic = GoogleAnalytic::first();
        $facebookPixel = FacebookPixel::first();

        $errorpage = ErrorPage::first();

        $footer = Footer::select('id', 'copyright', 'description')->first();

$languages = Language::where('status', 1)->orderBy('is_default', 'desc')->get();

        return response()->json([
            'setting' => $setting,
            'languages' => $languages,
            'localizations' => $localizations,
            'currencies' => $currencies,
            'categories' => $categories,
            'social_links' => $links,
            'homepage_ads' => $homepage_ads,
            'shoppage_ads' => $shoppage_ads,
            'shop_detail_ads' => $shop_detail_ads,
            'maintainance' => $maintainance,
            'cookieConsent' => $cookieConsent,
            'googleRecaptcha' => $googleRecaptcha,
            'tawkChat' => $tawkChat,
            'googleAnalytic' => $googleAnalytic,
            'facebookPixel' => $facebookPixel,
            'errorpage' => $errorpage,
            'footer' => $footer,
        ]);
    }

    public function index(Request $request)
    {

        $this->translator($request->lang_code);

        $homepage = Homepage::with('homelangfrontend')->first();

        $slider_banners = Partner::where('status', 1)->select('link', 'logo as image', 'status', 'title', 'sub_title')->latest()->get();

        $categories = Category::select('id', 'slug', 'icon', 'status')->where('status', 1)->latest()->get();

        $home_category = $homepage;

        $home_category_one =  Category::select('id', 'slug', 'icon', 'status')->where('status', 1)->where('id', $home_category->category_one)->first();

        $category_one_products = Product::select('id', 'slug', 'thumbnail_image', 'status', 'category_id', 'regular_price', 'offer_price')->where(['status' => 1, 'category_id' => $home_category->category_one])->limit(9)->get();

        $category_one = (object) array(
            'category' => $home_category_one,
            'products' => $category_one_products,
        );

        $trending_categories = Category::select('id', 'slug', 'icon', 'status')->where('status', 1)->whereIn('id', json_decode($home_category->trending_categories))->get();

        $trending_products = Product::with('reviews')->select('id', 'slug', 'thumbnail_image', 'status', 'regular_price', 'offer_price', 'category_id')->where(['status' => 1])->whereIn('category_id', json_decode($home_category->trending_categories))->limit(15)->get();

        $trending = (object) array(
            'categories' => $trending_categories,
            'products' => $trending_products,
        );


        $home_category_three =  Category::select('id', 'slug', 'icon', 'status')->where('status', 1)->where('id', $home_category->category_three)->first();

        $category_three_products = Product::select('id', 'slug', 'thumbnail_image', 'status', 'category_id', 'regular_price', 'offer_price')->where([ 'status' => 1, 'category_id' => $home_category->category_three])->limit(9)->get();

        $category_three = (object) array(
            'category' => $home_category_three,
            'products' => $category_three_products,
        );

        $home_category_four =  Category::select('id', 'slug', 'icon', 'status')->where('status', 1)->where('id', $home_category->category_four)->first();

        $category_four_products = Product::select('id', 'slug', 'thumbnail_image', 'status', 'category_id', 'regular_price', 'offer_price')->where(['status' => 1, 'category_id' => $home_category->category_four])->limit(9)->get();

        $category_four = (object) array(
            'category' => $home_category_four,
            'products' => $category_four_products,
        );

        $counter = (object) array(
            'counter1_title' => $homepage->homelangfrontend->counter1_title,
            'counter2_title' => $homepage->homelangfrontend->counter2_title,
            'counter3_title' => $homepage->homelangfrontend->counter3_title,
            'counter4_title' => $homepage->homelangfrontend->counter4_title,
            'counter1_value' => (int) $homepage->counter1_value,
            'counter2_value' => (int) $homepage->counter2_value,
            'counter3_value' => (int) $homepage->counter3_value,
            'counter4_value' => (int) $homepage->counter4_value,
        );

        $recommend_products = Product::select('id', 'slug', 'thumbnail_image', 'status', 'category_id', 'regular_price', 'offer_price')->where(['status' => 1])->limit(9)->get();

        $seo_setting = SeoSetting::where('id', 1)->select('id', 'page_name', 'seo_title', 'seo_description')->first();

        return response()->json([
            'seo_setting' => $seo_setting,
            'slider_banners' => $slider_banners,
            'categories' => $categories,
            'category_one' => $category_one,
            'trending' => $trending,
            'category_three' => $category_three,
            'category_four' => $category_four,
            'counter' => $counter,
            'recommend_products' => $recommend_products,
        ]);

    }

    public function about_us(Request $request){

        $this->translator($request->lang_code);

        $about_us = AboutUs::select('id', 'banner_image as about_image', 'image as owner_image', 'signature')->first();

        $homepage = Homepage::with('homelangfrontend')->first();

        $counter = (object) array(
            'counter1_icon' => $homepage->counter_icon1,
            'counter2_icon' => $homepage->counter_icon2,
            'counter3_icon' => $homepage->counter_icon3,
            'counter4_icon' => $homepage->counter_icon4,
            'counter1_title' => $homepage->homelangfrontend->counter1_title,
            'counter2_title' => $homepage->homelangfrontend->counter2_title,
            'counter3_title' => $homepage->homelangfrontend->counter3_title,
            'counter4_title' => $homepage->homelangfrontend->counter4_title,
            'counter1_value' => (int) $homepage->counter1_value,
            'counter2_value' => (int) $homepage->counter2_value,
            'counter3_value' => (int) $homepage->counter3_value,
            'counter4_value' => (int) $homepage->counter4_value,
        );

        $testimonials = Testimonial::select('id', 'image', 'rating', 'status')->where('status',1)->latest()->get();

        $seo_setting = SeoSetting::where('id', 2)->select('id', 'page_name', 'seo_title', 'seo_description')->first();

        return response()->json([
            'seo_setting' => $seo_setting,
            'about_us' => $about_us,
            'counter' => $counter,
            'testimonials' => $testimonials,

        ]);

    }

    public function blogs(Request $request){

        $this->translator($request->lang_code);

        $seo_setting = SeoSetting::where('id', 6)->select('id', 'page_name', 'seo_title', 'seo_description')->first();

        $paginate_qty = CustomPagination::whereId('1')->first()->qty;

        $blogs = Blog::with('admin')->select('id', 'admin_id', 'slug', 'image', 'status', 'created_at')->where(['status' => 1])->orderBy('id','desc')->paginate($paginate_qty);

        return response()->json([
            'seo_setting' => $seo_setting,
            'blogs' => $blogs
        ]);
    }


    public function blog_show(Request $request, $slug){

        $this->translator($request->lang_code);

        $blog = Blog::with('admin')->select('id', 'admin_id', 'slug', 'image', 'status', 'created_at')->where(['status' => 1, 'slug' => $slug])->first();

        if(!$blog){
            return response()->json([
                'message' => trans('user_validation.Blog not found')
            ], 403);
        }

        $total_comment = BlogComment::where(['blog_id' => $blog->id, 'status' => 1])->count();

        $blog_tags = json_decode($blog->tags);

        return response()->json([
            'blog' => $blog,
            'blog_tags' => $blog_tags,
            'total_comment' => $total_comment,
        ]);

    }

    public function store_blog_comment(Request $request, $blog_id){

        $this->translator($request->lang_code);

        $rules = [
            'name'=>'required',
            'email'=>'required',
            'comment'=>'required'
        ];

        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'email.required' => trans('user_validation.Email is required'),
            'comment.required' => trans('user_validation.Comment is required'),
        ];

        $this->validate($request, $rules,$customMessages);

        $comment = new BlogComment();
        $comment->blog_id = $blog_id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->status = 1;
        $comment->save();

        $notification = trans('user_validation.Blog comment submited successfully');
        return response()->json(['message' => $notification]);
    }

    public function blog_comment_list(Request $request, $id){
        $this->translator($request->lang_code);

        $blog = Blog::with('admin')->select('id', 'admin_id', 'slug', 'image', 'status', 'created_at')->where(['status' => 1, 'id' => $id])->first();

        if(!$blog){
            return response()->json([
                'message' => trans('user_validation.Blog not found')
            ], 403);
        }


        $blog_pagiante_qty = CustomPagination::whereId('4')->first()->qty;

        $comments = BlogComment::where(['blog_id' => $blog->id, 'status' => 1])->select('id', 'blog_id', 'name', 'comment', 'created_at', 'status')->latest()->paginate($blog_pagiante_qty);


        return response()->json([
            'comments' => $comments,
        ]);
    }

    public function faq(Request $request){

        $this->translator($request->lang_code);

        $faqs = Faq::where('status',1)->get();

        $testimonials = Testimonial::select('id', 'image', 'rating', 'status')->where('status',1)->latest()->get();

        return response()->json([
            'faqs' => $faqs,
            'testimonials' => $testimonials,
        ]);
    }

    public function terms_conditions(Request $request){

        $this->translator($request->lang_code);

        $terms_conditions = TermsAndCondition::first();
        $terms_conditions = $terms_conditions?->termslangfrontend?->terms_and_condition;

        return response()->json([
            'terms_conditions' => $terms_conditions,
        ]);
    }

    public function privacy_policy(Request $request){

        $this->translator($request->lang_code);

        $privacy_policy = PrivacyPolicy::with('privacylangfrontend')->first();
        $privacy_policy = $privacy_policy?->privacylangfrontend?->privacy_policy;

        return response()->json([
            'privacy_policy' => $privacy_policy,
        ]);
    }


    public function contact_us(Request $request){

        $this->translator($request->lang_code);

        $contact = ContactPage::select('id', 'time', 'image', 'email', 'map', 'email2', 'phone', 'phone2')->first();

        $seo_setting = SeoSetting::where('id', 3)->first();

        return response()->json([
            'seo_setting' => $seo_setting,
            'contact' => $contact
        ]);
    }

    public function send_contact_message(Request $request){
        $this->translator($request->lang_code);

        $rules = [
            'name'=>'required',
            'email'=>'required',
            'subject'=>'required',
            'message'=>'required',
        ];

        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'email.required' => trans('user_validation.Email is required'),
            'subject.required' => trans('user_validation.Subject is required'),
            'message.required' => trans('user_validation.Message is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $setting = Setting::first();

        if($setting->enable_save_contact_message == 1){
            $contact = new ContactMessage();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->phone = $request->phone;
            $contact->message = $request->message;
            $contact->save();
        }

        MailHelper::setMailConfig();
        $template = EmailTemplate::where('id',2)->first();
        $message = $template->description;
        $subject = $request->subject;
        $user_email = $request->email;

        $message = str_replace('{{name}}',$request->name,$message);
        $message = str_replace('{{email}}',$request->email,$message);
        $message = str_replace('{{phone}}',$request->phone,$message);
        $message = str_replace('{{subject}}',$request->subject,$message);
        $message = str_replace('{{message}}',$request->message,$message);

        try{
            Mail::to($setting->contact_email)->send(new ContactMessageInformation($message,$subject,$user_email));
        }catch(Exception $ex){}

        $notification = trans('user_validation.Message send successfully');
        return response()->json(['message' => $notification]);
    }


    public function product(Request $request){
        $this->translator($request->lang_code);

        $paginate_qty = CustomPagination::whereId('6')->first()->qty;

        $products =  Product::select('id', 'slug', 'thumbnail_image', 'status', 'regular_price', 'offer_price', 'category_id', 'popular_item', 'trending_item', 'featured_item', 'average_rating')->where(['status' => 1]);


        if($request->category){
            $category = Category::where('slug', $request->category)->first();
            if($category){
                $products = $products->where('category_id', $category->id);
            }
        }

        if($request->min_price){
            if($request->min_price == 0){
                $min_price = $request->min_price;
            }else{
                $min_price = $request->min_price / $request->currency_rate;
            }
            $products = $products->where('regular_price', '>=', $min_price);
        }

        if($request->max_price){
            $max_price = $request->max_price / $request->currency_rate;
            $products = $products->where('regular_price', '<=', $max_price);
        }

        if($request->sorting == 'popular_item'){
            $products = $products->where('popular_item', 1);
        }

        if($request->sorting == 'trending_item'){
            $products = $products->where('trending_item', 1);
        }

        if($request->sorting == 'featured_item'){
            $products = $products->where('featured_item', 1);
        }

        if($request->ratings){
            $products = $products->where(function($query) use ($request){
                foreach ($request->ratings as $rating) {
                    $query->orWhere(function($query) use ($rating) {
                        $query->where('average_rating', '>=', $rating)
                              ->where('average_rating', '<', $rating + 1);
                    });
                }
            });
        }

        if($request->keyword){
            $products = $products->whereHas('productlangfrontend', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('description', 'like', '%' . $request->keyword . '%');
            })
            ->orWhere(function ($query) use ($request) {
                $query->whereJsonContains('tags', ['value' => $request->keyword]);
            });
        }


        $products = $products->latest()->paginate($paginate_qty);
        $products = $products->appends($request->all());

        $categories = Category::select('id', 'slug', 'icon', 'status')->where('status', 1)->latest()->get();

        $get_max_product_price = Product::OrderBy('regular_price', 'DESC')->first();
        $get_max_product_price = $get_max_product_price?->regular_price;

        $seo_setting = SeoSetting::where('id', 5)->select('id', 'page_name', 'seo_title', 'seo_description')->first();

        return response()->json([
            'seo_setting' => $seo_setting,
            'products' => $products,
            'categories' => $categories,
            'max_price' => $get_max_product_price ? $get_max_product_price : 0,
        ]);

    }


    public function product_detail(Request $request, $slug){

        $this->translator($request->lang_code);

        $product = Product::where('slug', $slug)->select('id', 'author_id', 'category_id', 'slug', 'regular_price', 'offer_price', 'thumbnail_image', 'tags')->first();

        if(!$product){
            return response()->json([
                'message' => trans('user_validation.user.Product Not Found'),
            ], 403);
        }

        $product_lang = ProductLanguage::where('product_id', $product->id)->where('lang_code', $request->lang_code)->first();

        $product->short_description = $product_lang?->short_description;
        $product->description = $product_lang?->description;
        $product->tags = json_decode($product->tags);

        $variant_of_services = ProductVariant::where('product_id', $product->id)->select('id', 'product_id', 'variant_name', 'options', 'file_name')->get();



        $author = User::where('id', $product->author_id)->select('id', 'name', 'user_name', 'image', 'created_at')->first();

        $author_average_rating = Review::where(['author_id'=> $author->id, 'status' => 1])->avg('rating');
        $author->average_rating =  sprintf('%0.1f', $author_average_rating);

        $related_products = Product::select('id', 'slug', 'thumbnail_image', 'status', 'regular_price', 'offer_price')->where(['status' => 1, 'category_id' => $product->category_id])->latest()->take(9)->get();

        return response()->json([
            'product' => $product,
            'variant_of_services' => $variant_of_services,
            'author' => $author,
            'related_products' => $related_products,
        ]);
    }


    public function product_review_list(Request $request, $id){
        $this->translator($request->lang_code);

        $product = Product::where('id', $id)->select('id', 'author_id', 'category_id', 'slug', 'regular_price', 'offer_price', 'thumbnail_image', 'tags')->first();

        if(!$product){
            return response()->json([
                'message' => trans('user_validation.user.Product Not Found'),
            ], 403);
        }

        $paginate_review_qty = CustomPagination::whereId('8')->first()->qty;
        $reviews = Review::with('user')->where(['product_id'=>$product->id, 'status'=>1])->select('id', 'product_id', 'user_id', 'review', 'rating', 'status', 'created_at')->latest()->paginate($paginate_review_qty);

        return response()->json([
            'reviews' => $reviews,
        ]);
    }


    public function author_detail(Request $request, $user_name){

        $this->translator($request->lang_code);

        $author = User::where('user_name', $user_name)->select('id', 'name', 'user_name', 'image', 'about_me', 'created_at')->first();

        if(!$author){
            return response()->json([
                'message' => trans('user_validation.Author Not Found'),
            ], 403);
        }

        $total_sale = (int) 0;

        $author_average_rating = Review::where(['author_id'=> $author->id, 'status' => 1])->avg('rating');
        $total_review = Review::where(['author_id'=> $author->id, 'status' => 1])->count();

        $paginate_qty = CustomPagination::whereId('6')->first()->qty;

        $products = Product::select('id', 'slug', 'thumbnail_image', 'status', 'regular_price', 'offer_price')->where(['status' => 1, 'author_id' => $author->id])->latest()->paginate($paginate_qty);

        return response()->json([
            'author' => $author,
            'total_sale' => $total_sale,
            'average_rating' => sprintf('%0.1f', $author_average_rating),
            'total_review' => $total_review,
            'products' => $products,
        ]);
    }

    public function author_review(Request $request, $user_name){

        $this->translator($request->lang_code);

        $author = User::where('user_name', $user_name)->select('id', 'name', 'user_name', 'image', 'about_me')->first();

        if(!$author){
            return response()->json([
                'message' => trans('user_validation.Author Not Found'),
            ], 403);
        }

        $paginate_review_qty = CustomPagination::whereId('8')->first()->qty;
        $reviews = Review::with('user')->where(['author_id'=>$author->id, 'status'=>1])->select('id', 'product_id', 'user_id', 'review', 'rating', 'status', 'created_at')->latest()->paginate($paginate_review_qty);

        return response()->json([
            'reviews' => $reviews
        ]);
    }

    public function newsletter_request(Request $request){

        $this->translator($request->lang_code);

        $rules = [
            'email'=>'required|unique:subscribers',
            'redirect_url'=>'required',
        ];

        $customMessages = [
            'email.required' => trans('user_validation.Email is required'),
            'redirect_url.required' => trans('user_validation.Url is required')
        ];

        $this->validate($request, $rules,$customMessages);

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->verified_token = Str::random(25);
        $subscriber->save();

        MailHelper::setMailConfig();

        $template = EmailTemplate::where('id',3)->first();
        $message = $template->description;
        $subject = $template->subject;

        $verification_link = route('newsletter-verification').'?verification_link='.$subscriber->verified_token.'&email='.$subscriber->email.'&redirect_url='.$request->redirect_url;
        $verification_link = '<a href="'.$verification_link.'">'.$verification_link.'</a>';

        try{
            Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber,$message,$subject, $verification_link));
        }catch(Exception $ex){}

        return response()->json(['message' => trans('user_validation.A verification link send to your mail, please check and verify it')]);

    }



    public function newsletter_verifcation(Request $request){

        $subscriber = Subscriber::where('verified_token',$request->verification_link)->first();
        $verified = 'no';
        $message = '';
        $message = trans('user_validation.Something went wrong');

        if($subscriber){
            $subscriber->verified_token = null;
            $subscriber->is_verified = 1;
            $subscriber->save();

            $verified = 'yes';
            $message = trans('user_validation.Newsletter verification successful');
        }

        $redirect_url = $request->redirect_url.'?verified='.$verified .'&message='.$message;

        return redirect($redirect_url);

    }

    public function downloadListingFile($file){
        $filepath= public_path() . "/uploads/custom-images/".$file;
        return response()->download($filepath);
    }

}
