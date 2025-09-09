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
                    <h3 class="box-title">User List</h3>
                    
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Verify</th>
                                <th>Freeze</th>
                                <th>Status</th>
                                                                                            
                                <th>Action</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if($user->user_verify == 1)
                                    <span class="badge badge-pill badge-success"> Active </span>
                                    @else
                                   <span class="badge badge-pill badge-danger"> InActive </span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->freeze_account == 1)
                                    <span class="badge badge-pill badge-success"> Active </span>
                                    @else
                                   <span class="badge badge-pill badge-danger"> InActive </span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->status == 1)
                                    <span class="badge badge-pill badge-success"> Active </span>
                                    @else
                                   <span class="badge badge-pill badge-danger"> InActive </span>
                                    @endif
                                </td> 
                                                               
                                <td>
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-circle btn-info btn-sm mb-1" title="Edit">
                                        <i class="fa fa-edit" style="font-size:1rem"></i>
                                    </a>
                                
                                    <a href="{{ route('user.delete', $user->id) }}" class="btn btn-circle btn-danger btn-sm mb-1" id="delete" title="Delete">
                                        <i class="fa fa-trash" style="font-size:1rem"></i>
                                    </a>
                                
                                    {{-- Toggle Verify/Unverify --}}
                                    <a href="{{ route('user.toggleVerify', $user->id) }}" class="btn btn-sm btn-warning mb-1">
                                        {{ $user->user_verify ? 'Unverify' : 'Verify' }}
                                    </a>
                                
                                    {{-- Toggle Freeze/Unfreeze --}}
                                    <a href="{{ route('user.toggleFreeze', $user->id) }}" class="btn btn-sm btn-secondary mb-1">
                                        {{ $user->freeze_account ? 'Unfreeze' : 'Freeze' }}
                                    </a>
                                
                                    {{-- Toggle Active/Inactive --}}
                                    <a href="{{ route('user.toggleStatus', $user->id) }}" class="btn btn-sm btn-primary mb-1">
                                        {{ $user->status!=1 ? 'Deactivate' : 'Activate' }}
                                    </a>
                                    
                                </td>                              
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