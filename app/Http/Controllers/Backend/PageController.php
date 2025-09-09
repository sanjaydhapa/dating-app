<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Category;
use App\Models\Template;
class PageController extends Controller
{
    public function view(Request $request){
        
        $pages=Page::where('category_id',$request->category)->get();
        $categories=Category::latest()->get();
        return view('backend.page.list',compact('pages','categories'));
    }
    public function add(){
        $categories=Category::latest()->get();
        $templates=Template::latest()->get();
        
        return view('backend.page.add',compact('categories','templates'));
    }
    public function store(Request $request){
        
        $thumb_url='';
        $request->validate([
            'title'=>'required',
            
        ]/*,[
            'category_name_en.required' =>'Input Category EN Name',
            'cagegory_icon.required' =>'Input Icon Name',
        ]*/);
        if($request->hasFile('thambnail')){
            $file = $request->file('thambnail');
            $filename = time().'_'.$file->getClientOriginalName();
            $location = 'public/uploads';                    
            $file->move($location,$filename);
            $thumb_url = 'uploads/'.$filename;
        }
        Page::insert([
            'title'=>$request->title,
            'slug'=>Str::slug($request->title, '-'),
            'category_id'=>$request->category_id,
            'template_id'=>$request->template_id,
            'content'=>$request->content,
            'description'=>$request->description,
            'thambnail'=>$thumb_url,
            'meta_title'=>$request->meta_title,
            'meta_keyword'=>$request->meta_keyword,
            'meta_desc'=>$request->meta_desc,
            'css'=>$request->css,
            'js'=>$request->js,

        ]);
        $notification=array(
            'message'=>'Page save successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.page')->with($notification);
    }
    public function edit($id){
        $page=Page::find($id);
        $categories=Category::latest()->get();
        $templates=Template::latest()->get();
        return view('backend.page.edit',compact('page','categories','templates'));
    }
    public function update(Request $request){
        //dd($request);
        $id=$request->id;
        /*$request->validate([
            'category_name_en'=>'required',
            'cagegory_icon' =>'required'
        ],[
            'category_name_en.required' =>'Input Category EN Name',
            'cagegory_icon.required' =>'Input Icon Name',
        ]);*/
        $data=array();
        if($request->hasFile('thambnail')){

            $page=Page::where('id',$id)->first();
            if ($page->thambnail && is_file(public_path($page->thambnail))) {
                unlink(public_path($page->thambnail));
            }
            $file = $request->file('thambnail');
            $filename = time().'_'.$file->getClientOriginalName();
            $location = 'public/uploads';                    
            $file->move($location,$filename);            
            $thumb_url = 'uploads/'.$filename;
            $data['thambnail']=$thumb_url;
        }
        $data['title']=$request->title;
        $data['slug']=Str::slug($request->title, '-');
        $data['category_id']=$request->category_id;
        $data['template_id']=$request->template_id;
        $data['content']=$request->content;
        $data['description']=$request->description;        
        $data['meta_title']=$request->meta_title;
        $data['meta_keyword']=$request->meta_keyword;
        $data['meta_desc']=$request->meta_desc;
        $data['css']=$request->css;
        $data['js']=$request->js;
          // dd($data) ;
        
        Page::findOrFail($id)->update($data);
        $notification=array(
            'message'=>'Page update successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.page')->with($notification);
    }
    public function delete($id){
        Page::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Page Delete Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
    public function ProductInactive($id){
        Page::findOrFail($id)->update(['status' => 0]);
        $notification = array(
           'message' => 'Page Inactive',
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification);
    }


    public function ProductActive($id){
        Page::findOrFail($id)->update(['status' => 1]);
        $notification = array(
           'message' => 'Page Active',
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification);

    }

}
