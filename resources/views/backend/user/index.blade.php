@extends('admin.admin_master')

@section('admin')
<div class="content">
    <div class="box">
        <div class="box-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-bordered table-striped">
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
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- jQuery DataTables -->
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>

    $(function () {
       $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('users.data') }}',
            order: [[0, 'desc']], // Optional: fallback sorting (0 = first column)
            columns: [
                { data: 'name' },
                { data: 'email' },
                { data: 'verify', name: 'user_verify', orderable: false, searchable: false },
                { data: 'freeze', name: 'freeze_account', orderable: false, searchable: false },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection
