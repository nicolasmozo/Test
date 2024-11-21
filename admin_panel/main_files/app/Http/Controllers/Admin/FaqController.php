<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Models\Language;
use App\Models\FaqLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $faqs=Faq::with('faqlangadmin')->get();
        return view('admin.faq', compact('faqs'));
    }


    public function create()
    {
        return view('admin.create_faq');
    }


    public function store(Request $request)
    {
        $rules = [
            'question'=>'required|unique:faq_languages',
            'answer'=>'required',
            'status'=>'required',
        ];
        $customMessages = [
            'question.required' => trans('admin_validation.Question is required'),
            'question.unique' => trans('admin_validation.Question already exist'),
            'answer.required' => trans('admin_validation.Answer is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $faq = new Faq();
        $faq->status = $request->status;
        $faq->save();

        $languages = Language::get();
        foreach($languages as $language){
            $faq_language = new FaqLanguage();
            $faq_language->faq_id = $faq->id;
            $faq_language->lang_code = $language->lang_code;
            $faq_language->question = $request->question;
            $faq_language->answer = $request->answer;
            $faq_language->save();
        }

        $notification= trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.faq.index')->with($notification);
    }

    public function edit(Request $request, $id)
    {
        $faq = Faq::find($id);
        $languages = Language::get();
        $faq_language = FaqLanguage::where(['faq_id' => $faq->id, 'lang_code' => $request->lang_code])->first();

        return view('admin.edit_faq', compact('faq', 'languages', 'faq_language'));
    }


    public function update(Request $request,$id)
    {
        $faq = Faq::find($id);
        $faq_language = FaqLanguage::where(['faq_id' => $faq->id, 'lang_code' => $request->lang_code])->first();

        $rules = [
            'question'=>'required|unique:faq_languages,question,'.$faq_language->id,
            'answer'=>'required',
            'status'=> session()->get('admin_lang') == $request->lang_code ? 'required':'',
        ];
        $customMessages = [
            'question.required' => trans('admin_validation.Question is required'),
            'question.unique' => trans('admin_validation.Question already exist'),
            'answer.required' => trans('admin_validation.Answer is required'),
        ];
        $this->validate($request, $rules,$customMessages);


        if (session()->get('admin_lang') == $request->lang_code) {
            $faq->status = $request->status;
            $faq->save();
        }

        $faq_language->question = $request->question;
        $faq_language->answer = $request->answer;
        $faq_language->save();

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        $faq = Faq::find($id);
        $faq->delete();

        $faq_language = FaqLanguage::where('faq_id', $id)->delete();

        $notification= trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.faq.index')->with($notification);
    }

    public function changeStatus($id){
        $faq = Faq::find($id);
        if($faq->status==1){
            $faq->status=0;
            $faq->save();
            $message= trans('admin_validation.Inactive Successfully');
        }else{
            $faq->status=1;
            $faq->save();
            $message= trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }
}
