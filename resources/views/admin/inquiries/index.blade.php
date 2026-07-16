@extends('layouts.app')
@section('title', 'Admission Inquiries')

@section('content')
<h5 class="mb-3">Admission Inquiries</h5>

<div class="card p-3">
    <div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Class</th>
                <th>Message</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inquiries as $inquiry)
                <tr>
                    <td>{{ $inquiry->created_at->format('d M') }}</td>
                    <td>{{ $inquiry->name }}</td>
                    <td>{{ $inquiry->phone }}</td>
                    <td>{{ $inquiry->class_level }}</td>
                    <td class="small text-muted">{{ $inquiry->message ?: '—' }}</td>
                    <td>
                        <form action="{{ route('admin.inquiries.updateStatus', $inquiry) }}" method="POST" class="d-flex gap-1">
                            @csrf
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="new" {{ $inquiry->status == 'new' ? 'selected' : '' }}>New</option>
                                <option value="contacted" {{ $inquiry->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                                <option value="enrolled" {{ $inquiry->status == 'enrolled' ? 'selected' : '' }}>Enrolled</option>
                                <option value="not_interested" {{ $inquiry->status == 'not_interested' ? 'selected' : '' }}>Not Interested</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No inquiries have been received yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
    {{ $inquiries->links() }}
</div>
@endsection
