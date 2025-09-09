@extends('admin.admin_master')

@section('admin')
<div class="content">
    <div class="box">
        <div class="box-body">
             <h3>Reply to Message</h3>

            <div class="mb-3">
                <strong>Message from User:</strong>
                <p>{{ $message->message }}</p>
            </div>

            
            <form action="{{ route('admin.contact.sendReply', $message->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="reply">Your Reply</label>
                    <textarea name="reply" id="reply" rows="4" class="form-control">{{ old('reply', $message->reply) }}</textarea>
                    @error('reply')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-success mt-2">Send Reply</button>
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
