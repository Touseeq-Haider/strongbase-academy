<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Subject;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // Step 1: Tutor subject aur date choose karta hai
    public function selectForm(Request $request)
    {
        $tutor = $request->user()->tutor;
        $subjects = $tutor->subjects;

        return view('tutor.attendance.select', compact('subjects'));
    }

    // Step 2: Us subject ke enrolled students ki list dikhana, marking ke liye
    public function markForm(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
        ]);

        $tutor = $request->user()->tutor;
        $subject = Subject::findOrFail($request->subject_id);
        $date = $request->date;

        // Sirf wo students jo is tutor ke through, is subject me enrolled hain
        $students = $tutor->enrollments()
            ->where('subject_id', $subject->id)
            ->with('student')
            ->get()
            ->pluck('student');

        // Agar is date ki attendance pehle se maujood hai to wo bhi le aayein (edit ke liye)
        $existing = Attendance::where('tutor_id', $tutor->id)
            ->where('subject_id', $subject->id)
            ->whereDate('date', $date)
            ->pluck('status', 'student_id');

        return view('tutor.attendance.mark', compact('subject', 'students', 'date', 'existing'));
    }

    // Step 3: Attendance save karna
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

        return redirect()->route('tutor.dashboard')->with('success', 'Attendance save ho gayi.');
    }

    // History dekhne ke liye
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
