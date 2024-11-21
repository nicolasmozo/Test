<?php

namespace App\Http\Controllers\Admin;
use App\Models\Language;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        $languages = Language::paginate(10);
        return view('admin.language.index', compact('languages'));
    }


    public function destroy($id)
    {
        Language::find($id)->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege' => $notification, 'alert-type' =>'success');
        return redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $language = Language::findOrFail($id);

        return view('admin.language.form', compact('language'));
    }

    public function update(Request $request, $id)
    {
        $language = Language::findOrFail($id);

        $language->lang_name = $request->lang_name;
        $language->is_default = $request->is_default;
        $language->status = $request->status;
        $language->lang_direction = $request->lang_direction;

        $language->save();

        if ($request->is_default === 'Yes') {
            Language::where('id', '!=', $id)->update(['is_default' => 'No']);
        }

        $notification = trans('admin.Update Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');

        return redirect()->route('admin.languages')->with($notification);
    }


    public function create()
    {
        return view('admin.language.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lang_name' => 'required|unique:languages,lang_name',
            'lang_code' => 'required|unique:languages,lang_code',
            'is_default' => 'required',
            'status' => 'required|numeric',
            'lang_direction' => 'required',
        ]);

        $language = new Language();
        $language->lang_code = $request->lang_code;
        $language->lang_name = $request->lang_name;
        $language->is_default = $request->is_default;
        $language->status = $request->status;
        $language->lang_direction = $request->lang_direction;
        $language->save();

        $sourcePath = base_path('lang/en');
        $destPath = base_path('lang/' . $request->lang_code);

        if (!is_dir($destPath)) {
            File::copyDirectory($sourcePath, $destPath);
        }

        $notification = trans('admin.Add Successfully');
        $notification = array('messege' => $notification, 'alert-type' =>'success');
        return redirect()->route('admin.languages')->with($notification);
    }



    public function adminLnagugae(Request $request){
        $data = include(lang_path($request->lang_code.'/admin.php'));
        $languages = Language::get();
        return view('admin.admin_language', compact('data', 'languages'));
    }

    public function updateAdminLanguage(Request $request){
        $dataArray = [];
        foreach($request->values as $index => $value){
            $dataArray[$index] = $value;
        }
        file_put_contents(lang_path($request->lang_code.'/admin.php'), "");
        $dataArray = var_export($dataArray, true);
        file_put_contents(lang_path($request->lang_code.'/admin.php'), "<?php\n return {$dataArray};\n ?>");

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function adminValidationLnagugae(Request $request){
        $data = include(lang_path($request->lang_code.'/admin_validation.php'));
        $languages = Language::get();
        return view('admin.admin_validation_language', compact('data','languages'));
    }

    public function updateAdminValidationLnagugae(Request $request){
        $dataArray = [];
        foreach($request->values as $index => $value){
            $dataArray[$index] = $value;
        }
        file_put_contents(lang_path($request->lang_code.'/admin_validation.php'), "");
        $dataArray = var_export($dataArray, true);
        file_put_contents(lang_path($request->lang_code.'/admin_validation.php'), "<?php\n return {$dataArray};\n ?>");

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function websiteLanguage(Request $request){

        $data = include(lang_path($request->lang_code.'/user.php'));
        $languages = Language::get();
        return view('admin.language', compact('data','languages'));
    }

    public function updateLanguage(Request $request){

        $dataArray = [];
        foreach($request->values as $index => $value){
            $dataArray[$index] = $value;
        }
        file_put_contents(lang_path($request->lang_code.'/user.php'), "");
        $dataArray = var_export($dataArray, true);
        file_put_contents(lang_path($request->lang_code.'/user.php'), "<?php\n return {$dataArray};\n ?>");

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function websiteValidationLanguage(Request $request){
        $data = include(lang_path($request->lang_code.'/user_validation.php'));
        $languages = Language::get();
        return view('admin.website_validation_language', compact('data','languages'));
    }

    public function updateValidationLanguage(Request $request){

        $dataArray = [];
        foreach($request->values as $index => $value){
            $dataArray[$index] = $value;
        }
        file_put_contents(lang_path($request->lang_code.'/user_validation.php'), "");
        $dataArray = var_export($dataArray, true);
        file_put_contents(lang_path($request->lang_code.'/user_validation.php'), "<?php\n return {$dataArray};\n ?>");

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


}
