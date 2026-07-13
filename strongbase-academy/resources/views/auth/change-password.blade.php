@extends(auth()->user()->isAdmin() ? 'layouts.app' : 'layouts.tutor')
@section('title', 'Change Password')

@section('content')
<div class="card p-4" style="max-width:450px;">
    <h5 class="mb-3"><i class="fa-solid fa-lock text-muted me-1"></i> Change Password</h5>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Current Password</label>
            <input type="password" name="current_password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" name="new_password" class="form-control" required minlength="6">
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm New Password</label>
            <input type="password" name="new_password_confirmation" class="form-control" required minlength="6">
        </div>
        <button type="submit" class="btn btn-dark">Update Password</button>
    </form>
</div>
@endsection
