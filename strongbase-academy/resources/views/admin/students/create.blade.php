@extends('layouts.app')
@section('title', 'Add Student')

@section('content')
<div class="card p-4" style="max-width:700px;">
    <h5 class="mb-3">Naya Student Add Karein</h5>
    <form method="POST" action="{{ route('admin.students.store') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Naam</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Class / Level</label>
                <input type="text" name="class_level" class="form-control" placeholder="e.g. Class 9, FSc Part 1" value="{{ old('class_level') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Parent Name</label>
                <input type="text" name="parent_name" class="form-control" value="{{ old('parent_name') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>
            <div class="col-md-12">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Admission Date</label>
                <input type="date" name="admission_date" class="form-control" value="{{ old('admission_date', date('Y-m-d')) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Monthly Fee (Rs.)</label>
                <input type="number" step="0.01" name="monthly_fee" class="form-control" value="{{ old('monthly_fee') }}" required>
            </div>
        </div>

        <hr class="my-4">
        <label class="form-label fw-semibold">Subjects aur Tutor Assign Karein</label>
        <p class="text-muted small">Jo subject select karenge uske saamne tutor bhi choose karna zaroori hai.</p>

        @foreach ($subjects as $subject)
            <div class="row align-items-center mb-2 border-bottom pb-2">
                <div class="col-md-1">
                    <input type="checkbox" name="subjects[]" value="{{ $subject->id }}" class="form-check-input">
                </div>
                <div class="col-md-4">{{ $subject->name }} <span class="text-muted small">({{ $subject->level }})</span></div>
                <div class="col-md-7">
                    <select name="tutor_for_subject[{{ $subject->id }}]" class="form-select form-select-sm">
                        <option value="">-- Tutor Select Karein --</option>
                        @foreach ($tutors as $tutor)
                            <option value="{{ $tutor->id }}">{{ $tutor->user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endforeach

        <div class="mt-4">
            <button type="submit" class="btn btn-dark">Save Student</button>
            <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
