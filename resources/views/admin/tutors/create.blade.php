@extends('layouts.app')
@section('title', 'Add Tutor')

@section('content')
<div class="card p-4" style="max-width:650px;">
    <h5 class="mb-3">Add New Tutor</h5>
    <form method="POST" action="{{ route('admin.tutors.store') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Email (Login ID)</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="col-md-12">
                <label class="form-label">Qualification</label>
                <input type="text" name="qualification" class="form-control" value="{{ old('qualification') }}">
            </div>
            <div class="col-md-12">
                <label class="form-label">Bio</label>
                <textarea name="bio" class="form-control" rows="2">{{ old('bio') }}</textarea>
            </div>
        </div>

        <hr class="my-3">
        <label class="form-label fw-semibold">Subjects (this tutor is qualified to teach)</label>
        <div class="row">
            @foreach ($subjects as $subject)
                <div class="col-md-6">
                    <div class="form-check">
                        <input type="checkbox" name="subjects[]" value="{{ $subject->id }}" class="form-check-input" id="subj{{ $subject->id }}">
                        <label class="form-check-label" for="subj{{ $subject->id }}">{{ $subject->name }} ({{ $subject->level }})</label>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-dark">Save Tutor</button>
            <a href="{{ route('admin.tutors.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
