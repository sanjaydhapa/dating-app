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
                    <h3 class="box-title">Contact Messages</h3>                 
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Message</th>
                                    <th>Reply</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $msg)
                                <tr>
                                    <td>{{ $msg->user->name ?? 'N/A' }}</td>
                                    <td>{{ $msg->message }}</td>
                                    <td>{{ $msg->reply ?? 'No reply yet' }}</td>
                                    <td>
                                        <a href="{{ route('admin.contact.replyForm', $msg->id) }}" class="btn btn-sm btn-primary">
                                            Reply
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
    //$('.select2').select2();
    
    
     
     
 });

 </script>
@endsection