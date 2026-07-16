@extends('layouts.tutor')
@section('title', 'Tutor Dashboard')

@section('content')
<h4 class="mb-1">Welcome, {{ auth()->user()->name }} 👋</h4>
<p class="text-muted">Today's overview and your assigned subjects</p>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-stat p-3">
            <div class="text-muted small">Total Subjects</div>
            <div class="fs-3 fw-bold">{{ $subjectStats->count() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat p-3">
            <div class="text-muted small">Total Students (all subjects)</div>
            <div class="fs-3 fw-bold">{{ $subjectStats->sum('student_count') }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat p-3">
            <div class="text-muted small">Attendance Marked Today</div>
            <div class="fs-3 fw-bold {{ $todayAttendanceCount > 0 ? 'text-success' : 'text-danger' }}">
                {{ $todayAttendanceCount }}
            </div>
        </div>
    </div>
</div>

<div class="card p-3">
    <h6 class="mb-3">Your Subjects</h6>
    <div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Level</th>
                <th>Students</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($subjectStats as $row)
                <tr>
                    <td>{{ $row['subject']->name }}</td>
                    <td>{{ $row['subject']->level }}</td>
                    <td>{{ $row['student_count'] }}</td>
                    <td>
                        <a href="{{ route('tutor.attendance.mark', ['subject_id' => $row['subject']->id, 'date' => date('Y-m-d')]) }}"
                           class="btn btn-sm btn-dark">Mark Attendance</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted py-3">No subjects have been assigned yet. Please contact the administrator.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
@endsection
