@extends('layouts.tutor')
@section('title', 'Mark Attendance')

@section('content')
<div class="card p-4" style="max-width:500px;">
    <h5 class="mb-3">Attendance Mark Karne Ke Liye Subject Aur Date Chunein</h5>
    <form method="GET" action="{{ route('tutor.attendance.mark') }}">
        <div class="mb-3">
            <label class="form-label">Subject</label>
            <select name="subject_id" class="form-select" required>
                <option value="">-- Select Subject --</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }} ({{ $subject->level }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>
        <button type="submit" class="btn btn-dark">Aage Barhein</button>
    </form>
</div>
@endsection
