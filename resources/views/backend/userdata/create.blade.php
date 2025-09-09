@extends('admin.admin_master')

@section('admin')
<div class="content">
    <div class="box">
        <div class="box-body">
             <h3>Add User Data</h3>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            
            <form action="{{ route('admin.userdata.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="user_id">Select User</label>
                    <select name="user_id" class="form-control" required>
                        <option value="">-- Select User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Name</label>
                    <input name="name" class="form-control" value="{{ old('name') }}" required />
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control" value="{{ old('email') }}" required />
                </div>

                <div class="mb-3">
                    <label>Phone</label>
                    <input name="phone" class="form-control" value="{{ old('phone') }}" required />
                </div>

                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- jQuery DataTables -->
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>

   
</script>
@endsection
