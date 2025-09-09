<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
class SettingController extends Controller
{
    ///use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function generalSettings(Request $request)
    { 
         $setting = Setting::get();
         $globalSetting=[];
        foreach($setting as $key=>$value){
            $globalSetting[$value->key] = $value->value;
        } 
        
        return view('backend.setting.general-setting', compact('globalSetting'));
    }

    public function updateSetting(Request $request)
    {
     $data['setting'] = request()->all();
     $updateSettings = Setting::pluck('key')->toArray();
     foreach($data['setting'] as $key => $value)
        { 
         if(in_array($key, $updateSettings)){
                Setting::where('key', $key)->update(['value' => $value]);
            } else{
                $settings = new Setting;
                $settings->key    = $key;
                $settings->value  = $value;
                $settings->save();       
            } 
        }    
       return redirect()->back()->with('msg','Setting saved successfully');
    }
    public function updateImageSetting(){
        if($request->file('logo')) {
            $file = $request->file('logo');
            $filename = time().'_'.$file->getClientOriginalName();
            $location = 'public/uploads';                    
            $file->move($location,$filename);
            Image::insert(
                [
                    'name'=>$filename,
                    'path'=>'uploads/'.$filename,
                ]
            );
            // Response
            $data['success'] = 1;
            $data['message'] = 'Uploaded Successfully!';

       }else{
             // Response
             $data['success'] = 0;
             $data['message'] = 'File not uploaded.'; 
       }

        return view('backend.setting.general-setting', compact('globalSetting'));
    }
}
