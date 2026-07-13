<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tutor = $request->user()->tutor()->with('subjects')->firstOrFail();

        // Har subject ke liye kitne students enrolled hain (isi tutor ke through)
        $subjectStats = $tutor->subjects->map(function ($subject) use ($tutor) {
            $count = $tutor->enrollments()->where('subject_id', $subject->id)->count();
            return [
                'subject' => $subject,
                'student_count' => $count,
            ];
        });

        $todayAttendanceCount = $tutor->attendances()->whereDate('date', today())->count();

        return view('tutor.dashboard', compact('tutor', 'subjectStats', 'todayAttendanceCount'));
    }
}
