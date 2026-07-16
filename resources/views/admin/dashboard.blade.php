@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

@if($overdueFees->count() > 0)
<div class="alert alert-danger d-flex align-items-start gap-3 mb-4" style="border-radius:10px;">
    <i class="fa-solid fa-triangle-exclamation fs-4 mt-1"></i>
    <div class="flex-grow-1">
        <strong>{{ $overdueFees->count() }} fee(s) overdue</strong> — total Rs. {{ number_format($overdueFees->sum(fn($f) => $f->amount - $f->paid_amount), 0) }} pending.
        <div class="mt-2 d-flex flex-wrap gap-2">
            @foreach ($overdueFees->take(5) as $fee)
                <span class="badge bg-white text-danger border border-danger">
                    {{ $fee->student->name }} — Rs. {{ number_format($fee->amount - $fee->paid_amount, 0) }}
                </span>
            @endforeach
            @if($overdueFees->count() > 5)
                <span class="badge bg-danger">+{{ $overdueFees->count() - 5 }} more</span>
            @endif
        </div>
    </div>
    <a href="{{ route('admin.fees.index') }}" class="btn btn-sm btn-danger">View Fees</a>
</div>
@endif

<div class="row g-3">
    <div class="col-md-3">
        <div class="card card-stat p-3 d-flex flex-row align-items-center gap-3">
            <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                <i class="fa-solid fa-user-graduate text-primary"></i>
            </div>
            <div>
                <div class="text-muted small">Active Students</div>
                <div class="fs-3 fw-bold">{{ $stats['total_students'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3 d-flex flex-row align-items-center gap-3">
            <div class="rounded-circle bg-info bg-opacity-10 d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                <i class="fa-solid fa-chalkboard-user text-info"></i>
            </div>
            <div>
                <div class="text-muted small">Total Tutors</div>
                <div class="fs-3 fw-bold">{{ $stats['total_tutors'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3 d-flex flex-row align-items-center gap-3">
            <div class="rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                <i class="fa-solid fa-money-bill-wave text-danger"></i>
            </div>
            <div>
                <div class="text-muted small">Unpaid Fee Entries</div>
                <div class="fs-3 fw-bold text-danger">{{ $stats['unpaid_fees_count'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3 d-flex flex-row align-items-center gap-3">
            <div class="rounded-circle bg-warning bg-opacity-10 d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                <i class="fa-solid fa-envelope text-warning"></i>
            </div>
            <div>
                <div class="text-muted small">New Inquiries</div>
                <div class="fs-3 fw-bold text-primary">{{ $stats['new_inquiries'] }}</div>
            </div>
        </div>
    </div>
</div>

<div class="mt-3 mb-4">
    <a href="{{ route('admin.students.create') }}" class="btn btn-dark btn-sm me-2"><i class="fa-solid fa-plus"></i> Add Student</a>
    <a href="{{ route('admin.tutors.create') }}" class="btn btn-outline-dark btn-sm me-2"><i class="fa-solid fa-plus"></i> Add Tutor</a>
    <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-envelope"></i> View Inquiries</a>
</div>

<div class="row g-3">
    <div class="col-lg-6">
        <div class="card card-stat p-3">
            <h6 class="mb-3">Fee Collection — Last 6 Months</h6>
            <canvas id="feeChart" height="220"></canvas>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-stat p-3">
            <h6 class="mb-3">Students by Class Level</h6>
            <canvas id="levelChart" height="220"></canvas>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card card-stat p-3">
            <h6 class="mb-3">Attendance — Last 7 Days</h6>
            <canvas id="attendanceChart" height="100"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
const feeCtx = document.getElementById('feeChart');
new Chart(feeCtx, {
    type: 'bar',
    data: {
        labels: @json($chartData['feeTrend']['labels']),
        datasets: [
            {
                label: 'Collected',
                data: @json($chartData['feeTrend']['collected']),
                backgroundColor: '#198754',
                borderRadius: 4,
            },
            {
                label: 'Pending',
                data: @json($chartData['feeTrend']['pending']),
                backgroundColor: '#dc3545',
                borderRadius: 4,
            }
        ]
    },
    options: {
        responsive: true,
        scales: { x: { stacked: true }, y: { stacked: true, beginAtZero: true } },
        plugins: { legend: { position: 'bottom' } }
    }
});

const levelCtx = document.getElementById('levelChart');
new Chart(levelCtx, {
    type: 'doughnut',
    data: {
        labels: @json($chartData['studentsByLevel']['labels']),
        datasets: [{
            data: @json($chartData['studentsByLevel']['data']),
            backgroundColor: ['#D9A441','#182642','#3c4a68','#198754','#0d6efd','#dc3545','#6f42c1','#20c997'],
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } }
    }
});

const attCtx = document.getElementById('attendanceChart');
new Chart(attCtx, {
    type: 'line',
    data: {
        labels: @json($chartData['attendance']['labels']),
        datasets: [
            {
                label: 'Present',
                data: @json($chartData['attendance']['present']),
                borderColor: '#198754',
                backgroundColor: 'rgba(25,135,84,.15)',
                tension: .3,
                fill: true,
            },
            {
                label: 'Absent',
                data: @json($chartData['attendance']['absent']),
                borderColor: '#dc3545',
                backgroundColor: 'rgba(220,53,69,.15)',
                tension: .3,
                fill: true,
            }
        ]
    },
    options: {
        responsive: true,
        scales: { y: { beginAtZero: true } },
        plugins: { legend: { position: 'bottom' } }
    }
});
</script>
@endsection
