@extends('layouts.app')
@section('title', 'Students')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="m-0">All Students</h5>
    <a href="{{ route('admin.students.create') }}" class="btn btn-dark btn-sm"><i class="fa-solid fa-plus"></i> Add Student</a>
</div>

<div class="card p-3">
    <div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Class</th>
                <th>Phone</th>
                <th>Monthly Fee</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>{{ $student->student_code }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->class_level }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>Rs. {{ number_format($student->monthly_fee, 0) }}</td>
                    <td>
                        @if($student->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event, '{{ $student->name }}')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No students have been added yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
    {{ $students->links() }}
</div>
@endsection
