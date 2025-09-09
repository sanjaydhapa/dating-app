@extends('admin.admin_master')
@section('css')
    <link href="{{ asset('backend/assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
@endsection

@section('admin')


	  <div class="container-full">
		<!-- Content Header (Page header) -->


		

        <!-- /////////////////  Start Thambnail Image Update Area ///////// -->

        <section class="content">

             <form method="post" action="{{ route('setting.store')}}" enctype="multipart/form-data" >
                            @csrf
            
             <!-- Basic Forms -->
              <div class="box">
                <div class="box-header with-border" style="border-bottom: 0;">
                  <!--<h4 class="box-title">Add Page </h4>-->
                    <ul class="nav nav-tabs">
                     <li class="nav-item"><a href="#content" data-toggle="tab" class="nav-link active"><strong>General</strong></a></li>
                     <li class="nav-item"><a class="nav-link" href="#metatag" data-toggle="tab"><strong>Social</strong></a></li>
                     <li class="nav-item"><a class="nav-link" href="#design" data-toggle="tab"><strong>Design</strong></a></li>
                     <li class="nav-item"><a class="nav-link" href="#script" data-toggle="tab"><strong>Script</strong></a></li>
                    </ul>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="tab-content">
                        <div class="tab-pane active" id="content" role="tabpanel">
                            <div class="row"> <!-- start 1nd row  -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Phone <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="phone" value="{{ getSetting('phone')??'' }}" class="form-control">
                                            
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Email <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="email" value="{{ getSetting('email')??'' }}" class="form-control">
                                            
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Address <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="address" value="{{ getSetting('address')??'' }}" class="form-control">
                                            
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                               
                                
                            </div> <!-- end 1nd row  -->

                            
                            
                            

                            
                            <div class="row"> <!-- start 7th row  -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Description </h5>
                                        <div class="controls">
                                            <textarea name="description" id="textarea1" class="form-control textarea1 " placeholder="Textarea text" >{{ getSetting('description')??'' }}</textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                            </div> <!-- end 7th row  -->
                            
                        </div>
                        <div class="tab-pane" id="metatag" role="tabpanel">
                            <div class="row"> <!-- start 1nd row  -->

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Facebook</h5>
                                        <div class="controls">
                                            <input type="text" name="facebook" value="{{ getSetting('facebook')??'' }}" class="form-control">
                                            @error('meta_title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Twitter</h5>
                                        <div class="controls">
                                        <input type="text" name="twitter"  class="form-control" value="{{ getSetting('twitter') }}">
                                           
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Meta Keyword</h5>
                                        <div class="controls">
                                            <input type="text" name="linkedin"  class="form-control" value="{{ getSetting('linkedin') }}">
                                            
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                            </div>
                        </div>
                        <div class="tab-pane" id="design" role="tabpanel">
                            <div class="row"> <!-- start 7th row  -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Css </h5>
                                        <div class="controls">
                                            <textarea name="css" id="textarea" class="form-control textarea " placeholder="Textarea text" >{{ getSetting('css') }}</textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                            </div> <!-- end 7th row  -->
                        </div>
                        <div class="tab-pane" id="script" role="tabpanel">
                            <div class="row"> <!-- start 7th row  -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Script </h5>
                                        <div class="controls">
                                            <textarea name="js" id="textarea" class="form-control textarea " placeholder="Textarea text" >{{ getSetting('js') }}</textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                            </div> <!-- end 7th row  -->

                        </div>
                    </div>
              
                </div><!-- /.box-body -->
                <div class="box-footer text-right">
                    <button type="submit" class="btn btn-rounded btn-primary">Submit</button>
                    <button class="btn btn-rounded btn-secondary">Cancel</button>
                </div>
              </div><!-- /.box -->
            </form>
        </section>
        <!-- ///////////////// Start Thambnail Image Update Area ///////// -->




        <section class="content">
            <div class="box">
             
            
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="{{ route('upload.image')}}" enctype="multipart/form-data" >
                        @csrf
                        <div class="row"> <!-- start 6th row  -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Header Logo <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="logo" class="form-control" onChange="mainThamUrl(this)" require>
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->
                            <div class="col-md-4">
                                <img src="{{ getSetting('logo')??'' }}" id="mainThmb">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-rounded btn-primary">Submit</button>
                                <button class="btn btn-rounded btn-dengar">Delete</button>
                            </div>
                        </div> <!-- end 6th row  -->
                    </form>
                    <form method="post" action="{{ route('upload.image')}}" enctype="multipart/form-data" >
                        @csrf
                        <div class="row"> <!-- start 6th row  -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Footer Logo <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="footer_logo" class="form-control" onChange="mainThamUrl(this)" require>
                                    </div>
                                </div>
                            </div> <!-- end col md 4 -->
                            <div class="col-md-4">
                                <img src="{{ getSetting('footer_logo')??'' }}" id="mainThmb">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-rounded btn-primary">Submit</button>
                                <button class="btn btn-rounded btn-dengar">Delete</button>
                            </div>
                        </div> <!-- end 6th row  -->
                    </form>
                            
                            
              
                </div><!-- /.box-body -->
                
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

    CKEDITOR.replace('textarea');
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
/*
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data

          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });

      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
*/
  </script>

<script>
    /*
$(document).ready(function() {
    var child_cateid={{--$product->subcategory_id--}};
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
                        $("#subcategory_id").append('<option>---- Select Subcategory---</option>');
                            $.each(data,function(key,value){
                                console.log(value.subcategory_name);
                            $("#subcategory_id").append('<option value="'+value.id+'" '+(value.id==child_cateid?'selected':'')+'>'+value.subcategory_name+'</option>');
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
    if(child_cateid!=null){
        $('select[name="category_id"]').change();
    }
});*/
</script>

@endsection
