@extends('layouts.app')
@section('title', 'Edit Student')

@section('content')
<div class="card p-4" style="max-width:700px;">
    <h5 class="mb-3">Edit Student — {{ $student->student_code }}</h5>
    <form method="POST" action="{{ route('admin.students.update', $student) }}">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Class / Level</label>
                <input type="text" name="class_level" class="form-control" value="{{ old('class_level', $student->class_level) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Parent Name</label>
                <input type="text" name="parent_name" class="form-control" value="{{ old('parent_name', $student->parent_name) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $student->phone) }}" required>
            </div>
            <div class="col-md-12">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $student->address) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Monthly Fee (Rs.)</label>
                <input type="number" step="0.01" name="monthly_fee" class="form-control" value="{{ old('monthly_fee', $student->monthly_fee) }}" required>
            </div>
            <div class="col-md-6 d-flex align-items-end">
                <div class="form-check">
                    <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive" {{ $student->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="isActive">Active Student</label>
                </div>
            </div>
        </div>

        <hr class="my-4">
        <label class="form-label fw-semibold">Subjects aur Tutor</label>

        @foreach ($subjects as $subject)
            <div class="row align-items-center mb-2 border-bottom pb-2">
                <div class="col-md-1">
                    <input type="checkbox" name="subjects[]" value="{{ $subject->id }}" class="form-check-input"
                        {{ in_array($subject->id, $enrolledSubjectIds) ? 'checked' : '' }}>
                </div>
                <div class="col-md-4">{{ $subject->name }} <span class="text-muted small">({{ $subject->level }})</span></div>
                <div class="col-md-7">
                    <select name="tutor_for_subject[{{ $subject->id }}]" class="form-select form-select-sm">
                        <option value="">-- Select Tutor --</option>
                        @foreach ($tutors as $tutor)
                            <option value="{{ $tutor->id }}" {{ ($currentTutorMap[$subject->id] ?? null) == $tutor->id ? 'selected' : '' }}>
                                {{ $tutor->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endforeach

        <div class="mt-4">
            <button type="submit" class="btn btn-dark">Update Student</button>
            <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
