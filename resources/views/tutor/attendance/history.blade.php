@extends('layouts.tutor')
@section('title', 'Attendance History')

@section('content')
<h5 class="mb-3">Attendance History</h5>

<div class="card p-3">
    <div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Date</th>
                <th>Student</th>
                <th>Subject</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($attendances as $record)
                <tr>
                    <td>{{ $record->date->format('d M, Y') }}</td>
                    <td>{{ $record->student->name }}</td>
                    <td>{{ $record->subject->name }}</td>
                    <td>
                        @if($record->status == 'present')
                            <span class="badge bg-success">Present</span>
                        @elseif($record->status == 'absent')
                            <span class="badge bg-danger">Absent</span>
                        @else
                            <span class="badge bg-warning text-dark">Leave</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted py-4">Abhi tak koi attendance record nahi hai.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
    {{ $attendances->links() }}
</div>
@endsection
