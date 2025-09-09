<a href="{{ route('user.edit', $user->id) }}" class="btn btn-info btn-sm" title="Edit">
    <i class="fa fa-edit"></i>
</a>

<a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger btn-sm" id="delete" title="Delete">
    <i class="fa fa-trash"></i>
</a>

<a href="{{ route('user.toggleVerify', $user->id) }}" class="btn btn-warning btn-sm">
    {{ $user->user_verify ? 'Unverify' : 'Verify' }}
</a>

<a href="{{ route('user.toggleFreeze', $user->id) }}" class="btn btn-secondary btn-sm">
    {{ $user->freeze_account ? 'Unfreeze' : 'Freeze' }}
</a>

<a href="{{ route('user.toggleStatus', $user->id) }}" class="btn btn-primary btn-sm">
    {{ $user->status != 1 ? 'Activate' : 'Deactivate' }}
</a>
