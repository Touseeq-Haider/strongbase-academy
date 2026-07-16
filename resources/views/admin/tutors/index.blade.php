@extends('layouts.app')
@section('title', 'Tutors')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="m-0">All Tutors</h5>
    <a href="{{ route('admin.tutors.create') }}" class="btn btn-dark btn-sm"><i class="fa-solid fa-plus"></i> Add Tutor</a>
</div>

<div class="card p-3">
    <div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subjects</th>
                <th>Qualification</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tutors as $tutor)
                <tr>
                    <td>{{ $tutor->user->name }}</td>
                    <td>{{ $tutor->user->email }}</td>
                    <td>{{ $tutor->subjects->pluck('name')->join(', ') ?: '—' }}</td>
                    <td>{{ $tutor->qualification ?? '—' }}</td>
                    <td>
                        @if($tutor->user->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.tutors.edit', $tutor) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.tutors.destroy', $tutor) }}" method="POST" class="d-inline" onsubmit="return confirm('Pakka delete karna hai?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Koi tutor abhi tak add nahi hua.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
    {{ $tutors->links() }}
</div>
@endsection
