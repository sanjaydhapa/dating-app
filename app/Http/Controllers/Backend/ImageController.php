<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Image;
class ImageController extends Controller
{
    public function index(){
         $images=Image::latest()->paginate(15)->withQueryString();
          return view('backend/image/forms_dropzone',compact('images'));
    }

    public function dropZone(Request $request){

          $data = array();

          $validator = Validator::make($request->all(), [
               'file' => 'required|mimes:png,jpg,jpeg,pdf|max:2048'
          ]);

          if ($validator->fails()) {
 
              $data['success'] = 0;
              $data['error'] = $validator->errors()->first('file');// Error response

          }else{
               if($request->file('file')) {

                    $file = $request->file('file');
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
          }

           return response()->json($data);
    }

    public function delete($id){
        $image=Image::where('id',$id)->first();
       
        Image::findOrFail($id)->delete();
        if ($image->path && is_file(public_path($image->path))) {
            unlink($image->path);
        }
        $notification=array(
            'message'=>'Image Delete Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
}
