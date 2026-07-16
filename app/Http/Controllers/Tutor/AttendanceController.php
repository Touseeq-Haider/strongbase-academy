<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Subject;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // Step 1: Tutor selects a subject and date
    public function selectForm(Request $request)
    {
        $tutor = $request->user()->tutor;
        $subjects = $tutor->subjects;

        return view('tutor.attendance.select', compact('subjects'));
    }

    // Step 2: Show the list of students enrolled in that subject, for marking
    public function markForm(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
        ]);

        $tutor = $request->user()->tutor;
        $subject = Subject::findOrFail($request->subject_id);
        $date = $request->date;

        // Only students enrolled in this subject through this tutor
        $students = $tutor->enrollments()
            ->where('subject_id', $subject->id)
            ->with('student')
            ->get()
            ->pluck('student');

        // If attendance for this date already exists, load it too (for editing)
        $existing = Attendance::where('tutor_id', $tutor->id)
            ->where('subject_id', $subject->id)
            ->whereDate('date', $date)
            ->pluck('status', 'student_id');

        return view('tutor.attendance.mark', compact('subject', 'students', 'date', 'existing'));
    }

    // Step 3: Save attendance
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'status' => 'required|array',   // ['student_id' => 'present|absent|leave']
        ]);

        $tutor = $request->user()->tutor;

        foreach ($validated['status'] as $studentId => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'subject_id' => $validated['subject_id'],
                    'date' => $validated['date'],
                ],
                [
                    'tutor_id' => $tutor->id,
                    'status' => $status,
                ]
            );
        }

        return redirect()->route('tutor.dashboard')->with('success', 'Attendance has been saved successfully.');
    }

    // View attendance history
    public function history(Request $request)
    {
        $tutor = $request->user()->tutor;

        $attendances = Attendance::where('tutor_id', $tutor->id)
            ->with(['student', 'subject'])
            ->orderByDesc('date')
            ->paginate(30);

        return view('tutor.attendance.history', compact('attendances'));
    }
}
