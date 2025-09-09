@extends('admin.admin_master')
@section('css')
    <link href="{{ asset('backend/assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
@endsection
@section('admin')
<div class="container-full">
    
    <section class="content">
		<div class="row">
            <div class="col-12">

                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Page List</h3>
                    <div class="pull-right">
                        <form action="" method="get" >
                            <select name="category" class="select2" id="cat">
                                <option>---select category----</option>
                                @foreach($categories as $category)
                                   <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>slug</th>
                                <th>Status</th>
                                                                                            
                                <th>Action</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pages as $page)
                            <tr>
                                <td>{{$page->title}}</td>
                                <td>{{$page->slug}}</td>
                                <td>
                                    @if($page->status == 1)
                                    <span class="badge badge-pill badge-success"> Active </span>
                                    @else
                                   <span class="badge badge-pill badge-danger"> InActive </span>
                                    @endif</td> 
                                                               
                                <td><a href="{{ route('page.edit',$page->id)}}" class="btn btn-circle btn-info btn-sm mb-5" title="Edit"><i class="fa fa-edit" aria-hidden="true" style="font-size:1rem"></i></a><a href="{{ route('page.delete',$page->id)}}" class="btn btn-circle btn-danger btn-sm mb-5" id="delete" title="Delete"><i class="fa fa-trash" style="font-size:1rem"></i></a></td>                                
                            </tr>
                            @endforeach
                        </tbody>
                        
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
                </div>
                        
            </div>
            
        <div>
    </section>
</div>


@endsection
@section('js')
<script src="{{ asset('./assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
 <script>
 $(function () {
  

    //Initialize Select2 Elements
    $('.select2').select2();
    
    
     $('#cat').on('change',function(){
         this.form.submit();
     })
     
 });

 </script>
@endsection