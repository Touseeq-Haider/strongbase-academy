@extends('layouts.tutor')
@section('title', 'Mark Attendance')

@section('content')
<div class="card p-4" style="max-width:650px;">
    <h5 class="mb-1">{{ $subject->name }} ({{ $subject->level }})</h5>
    <p class="text-muted mb-3">Date: {{ \Carbon\Carbon::parse($date)->format('d M, Y') }}</p>

    <form method="POST" action="{{ route('tutor.attendance.store') }}">
        @csrf
        <input type="hidden" name="subject_id" value="{{ $subject->id }}">
        <input type="hidden" name="date" value="{{ $date }}">

        <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Student</th>
                    <th class="text-center">Present</th>
                    <th class="text-center">Absent</th>
                    <th class="text-center">Leave</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    @php $current = $existing[$student->id] ?? 'present'; @endphp
                    <tr>
                        <td>{{ $student->name }} <span class="text-muted small">({{ $student->student_code }})</span></td>
                        <td class="text-center">
                            <input type="radio" name="status[{{ $student->id }}]" value="present" {{ $current == 'present' ? 'checked' : '' }}>
                        </td>
                        <td class="text-center">
                            <input type="radio" name="status[{{ $student->id }}]" value="absent" {{ $current == 'absent' ? 'checked' : '' }}>
                        </td>
                        <td class="text-center">
                            <input type="radio" name="status[{{ $student->id }}]" value="leave" {{ $current == 'leave' ? 'checked' : '' }}>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted py-3">No students are enrolled in this subject.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>

        @if ($students->count() > 0)
            <button type="submit" class="btn btn-dark">Save Attendance</button>
        @endif
        <a href="{{ route('tutor.attendance.select') }}" class="btn btn-outline-secondary">Back</a>
    </form>
</div>
@endsection
