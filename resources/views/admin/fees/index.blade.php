@extends('layouts.app')
@section('title', 'Fee Management')

@section('content')

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-stat p-3 d-flex flex-row align-items-center gap-3">
            <div class="rounded-circle bg-dark bg-opacity-10 d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                <i class="fa-solid fa-sack-dollar text-dark"></i>
            </div>
            <div>
                <div class="text-muted small">Total Amount (Is Month)</div>
                <div class="fs-4 fw-bold">Rs. {{ number_format($summary['total'], 0) }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat p-3 d-flex flex-row align-items-center gap-3">
            <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                <i class="fa-solid fa-check text-success"></i>
            </div>
            <div>
                <div class="text-muted small">Collected (Is Month)</div>
                <div class="fs-4 fw-bold text-success">Rs. {{ number_format($summary['collected'], 0) }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat p-3 d-flex flex-row align-items-center gap-3">
            <div class="rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                <i class="fa-solid fa-triangle-exclamation text-danger"></i>
            </div>
            <div>
                <div class="text-muted small">Pending Entries</div>
                <div class="fs-4 fw-bold text-danger">{{ $summary['pending'] }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card p-3 mb-4">
    <h6 class="mb-3"><i class="fa-solid fa-plus text-muted me-1"></i> Naye Month Ki Fees Generate Karein</h6>
    <form method="POST" action="{{ route('admin.fees.generate') }}" class="row g-2 align-items-end">
        @csrf
        <div class="col-md-3">
            <label class="form-label small">Month</label>
            <input type="month" name="month" class="form-control" value="{{ date('Y-m') }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label small">Due Day (1-28)</label>
            <input type="number" name="due_day" class="form-control" min="1" max="28" value="10" required>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-dark">Generate Fees</button>
        </div>
    </form>
    <p class="text-muted small mt-2 mb-0">Ye har active student ke liye us month ki fee entry bana dega (agar pehle se nahi bani).</p>
</div>

<div class="card p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0">Fee Records</h6>
        <form method="GET" class="d-flex gap-2">
            <input type="month" name="month" value="{{ $month }}" class="form-control form-control-sm">
            <select name="status" class="form-select form-select-sm">
                <option value="">Sab Status</option>
                <option value="unpaid" {{ $status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="partial" {{ $status == 'partial' ? 'selected' : '' }}>Partial</option>
                <option value="paid" {{ $status == 'paid' ? 'selected' : '' }}>Paid</option>
            </select>
            <button class="btn btn-sm btn-outline-dark">Filter</button>
        </form>
    </div>

    <div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Student</th>
                <th>Amount</th>
                <th>Paid</th>
                <th>Due Date</th>
                <th>Status</th>
                <th style="width:300px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($fees as $fee)
                @php $isOverdue = $fee->status != 'paid' && $fee->due_date->isPast(); @endphp
                <tr class="{{ $isOverdue ? 'table-danger' : '' }}">
                    <td>
                        {{ $fee->student->name }} <span class="text-muted small">({{ $fee->student->student_code }})</span>
                        @if($isOverdue)
                            <span class="badge bg-danger ms-1"><i class="fa-solid fa-clock"></i> Overdue</span>
                        @endif
                    </td>
                    <td>Rs. {{ number_format($fee->amount, 0) }}</td>
                    <td>Rs. {{ number_format($fee->paid_amount, 0) }}</td>
                    <td>{{ $fee->due_date->format('d M') }}</td>
                    <td>
                        @if($fee->status == 'paid')
                            <span class="badge bg-success">Paid</span>
                        @elseif($fee->status == 'partial')
                            <span class="badge bg-warning text-dark">Partial</span>
                        @else
                            <span class="badge bg-danger">Unpaid</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.fees.updateStatus', $fee) }}" method="POST" class="d-flex gap-1 mb-1">
                            @csrf
                            <input type="number" step="0.01" name="amount" value="{{ $fee->amount }}"
                                   class="form-control form-control-sm" style="width:85px;" placeholder="Amount" title="Fee Amount">
                            <input type="number" step="0.01" name="paid_amount" value="{{ $fee->paid_amount }}"
                                   class="form-control form-control-sm" style="width:85px;" placeholder="Paid" title="Paid Amount">
                            <button class="btn btn-sm btn-outline-success" title="Save"><i class="fa-solid fa-check"></i></button>
                        </form>
                        <div class="d-flex gap-1">
                            @if($fee->paid_amount > 0)
                                <a href="{{ route('admin.fees.receipt', $fee) }}" target="_blank" class="btn btn-sm btn-outline-dark">
                                    <i class="fa-solid fa-receipt"></i> Receipt
                                </a>
                            @endif
                            @if($fee->status != 'paid')
                                @php
                                    $balance = $fee->amount - $fee->paid_amount;
                                    $msg = "Assalam o Alaikum! {$fee->student->name} ki {$fee->due_date->translatedFormat('F')} ki fee Rs. " . number_format($balance, 0) . " abhi baaki hai. Barah e karam jald ada karein. - Strong Base Academy";
                                @endphp
                                <a href="https://wa.me/{{ $fee->student->whatsappPhone() }}?text={{ urlencode($msg) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                    <i class="fa-brands fa-whatsapp"></i> Remind
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Is month/status ke liye koi fee record nahi mila. Upar se generate karein.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
    {{ $fees->links() }}
</div>
@endsection
