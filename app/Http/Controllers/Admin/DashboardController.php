<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Fee;
use App\Models\Inquiry;
use App\Models\Student;
use App\Models\Tutor;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_students' => Student::where('is_active', true)->count(),
            'total_tutors' => Tutor::count(),
            'unpaid_fees_count' => Fee::where('status', '!=', 'paid')->count(),
            'unpaid_fees_amount' => Fee::where('status', '!=', 'paid')->sum('amount'),
            'new_inquiries' => Inquiry::where('status', 'new')->count(),
        ];

        // Overdue fees: due date has passed and the fee is not yet fully paid
        $overdueFees = Fee::with('student')
            ->where('status', '!=', 'paid')
            ->whereDate('due_date', '<', now())
            ->orderBy('due_date')
            ->get();

        // Chart 1: Students by class level
        $studentsByLevel = Student::where('is_active', true)
            ->selectRaw('class_level, count(*) as total')
            ->groupBy('class_level')
            ->pluck('total', 'class_level');

        // Chart 2: Fee collection trend - last 6 months
        $feeMonths = [];
        $feeCollected = [];
        $feePending = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('Y-m');
            $feeMonths[] = Carbon::now()->subMonths($i)->format('M Y');
            $feeCollected[] = (float) Fee::where('month', $month)->sum('paid_amount');
            $feePending[] = (float) Fee::where('month', $month)->sum('amount') - (float) Fee::where('month', $month)->sum('paid_amount');
        }

        // Chart 3: Attendance last 7 days
        $attendanceDays = [];
        $presentCounts = [];
        $absentCounts = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $attendanceDays[] = $date->format('D');
            $presentCounts[] = Attendance::whereDate('date', $date)->where('status', 'present')->count();
            $absentCounts[] = Attendance::whereDate('date', $date)->where('status', 'absent')->count();
        }

        $chartData = [
            'studentsByLevel' => [
                'labels' => $studentsByLevel->keys(),
                'data' => $studentsByLevel->values(),
            ],
            'feeTrend' => [
                'labels' => $feeMonths,
                'collected' => $feeCollected,
                'pending' => $feePending,
            ],
            'attendance' => [
                'labels' => $attendanceDays,
                'present' => $presentCounts,
                'absent' => $absentCounts,
            ],
        ];

        return view('admin.dashboard', compact('stats', 'chartData', 'overdueFees'));
    }
}
