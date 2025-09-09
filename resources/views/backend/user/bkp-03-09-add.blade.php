@extends('admin.admin_master')
@section('css')
    <!--<link href="{{ asset('backend/assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />-->
@endsection

@section('admin')


	<div class="container-full">
		<!-- Content Header (Page header) -->

		<!-- Main content -->
		<section class="content">
            <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data" >
                            @csrf
    		 <!-- Basic Forms -->
    		  <div class="box">
    		
    			<!-- /.box-header -->
    			<div class="box-body">

                    <div class="tab-content">
                        <div class="tab-pane active" id="content" role="tabpanel">
                            <div class="row"> <!-- start 1nd row  -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>User Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" value="" class="form-control">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Nick Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="nick_name" value="" class="form-control">
                                            @error('nick_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Email<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="email" value="" class="form-control">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->

                                
                            </div> <!-- end 1nd row  -->

                            
                            <div class="row"> <!-- start 6th row  -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Password<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="password" value="" class="form-control">
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                                
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Main Thambnail <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="thambnail" class="form-control" onChange="mainThamUrl(this)" require>
                                            @error('thambnail')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            

                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                                

                            </div> <!-- end 6th row  -->

                            
                            
                        
                    </div>
			  
    			</div><!-- /.box-body -->
                <div class="box-footer text-right">
                    <button type="submit" class="btn btn-rounded btn-primary">Submit</button>
                    <button class="btn btn-rounded btn-secondary">Cancel</button>
                </div>
    		  </div><!-- /.box -->
            </form>
		</section>
		<!-- /.content -->
	</div>



@endsection
@section('js')
<!-- /// Tgas Input Script -->
<script src="{{ asset('./assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('./assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
<!-- // CK EDITOR  -->
 <script src="{{ asset('./assets/vendor_components/ckeditor/ckeditor.js') }}"></script>
 <script src="{{ asset('./assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>

 <script>
 $(function () {
    "use strict";

    //Initialize Select2 Elements
    $('.select2').select2();

    CKEDITOR.replace('textarea', {
      height: 360,
      //width: 100,
      removeButtons: 'PasteFromWord'
    });
	//bootstrap WYSIHTML5 - text editor
	//$('.textarea').wysihtml5();

 });
 </script>
 <script type="text/javascript">
	function mainThamUrl(input){
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#mainThmb').attr('src',e.target.result).width(80).height(80);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>



<script>
$(document).ready(function() {

    $('select[name="category_id"]').on('change', function(){
        var category_id = $(this).val();
        if(category_id) {
            $.ajax({
                url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                type:"GET",
                //dataType:"json",
                success:function(data) {
                    if(data){
                        console.log(data);
                        $("#subcategory_id").empty();
                        $("#subcategory_id").append('<option value="">---- Select Subcategory---</option>');
                            $.each(data,function(key,value){
                                console.log(value.subcategory_name);
                            $("#subcategory_id").append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');
                            });
                            console.log($("#subcategory_id"));
                        }else{
                            $("#subcategory_id").empty();
                        }
                    //$('.subcategory').html(data);

                    //$("#subcategory_id").niceSelect('update');
                    //$("#subcategory_id").niceSelect('refresh');
                },
            });
        } else {
            alert('danger');
        }
    });

});
</script>

@endsection
