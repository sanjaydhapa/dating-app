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
                    <h3 class="box-title">User Data</h3> 

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <a href="{{ route('admin.userdata.create') }}" class="btn btn-success mb-3">+ Add New</a>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataList as $data)
                                    <tr>
                                        <td>{{ $data->user->name ?? 'N/A' }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->phone }}</td>
                                        <td>
                                            <form action="{{ route('admin.userdata.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Delete this data?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
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
    //$('.select2').select2();
    
    
     
     
 });

 </script>
@endsection