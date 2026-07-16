<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Tutor;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderByDesc('id')->paginate(15);
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $subjects = Subject::orderBy('name')->get();
        $tutors = Tutor::with('user')->get();
        return view('admin.students.create', compact('subjects', 'tutors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_level' => 'required|string|max:100',
            'parent_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'admission_date' => 'required|date',
            'monthly_fee' => 'required|numeric|min:0',
            'subjects' => 'required|array|min:1',
            'subjects.*' => 'exists:subjects,id',
            'tutor_for_subject' => 'required|array',
        ]);

        $student = Student::create([
            'student_code' => Student::generateStudentCode(),
            'name' => $validated['name'],
            'class_level' => $validated['class_level'],
            'parent_name' => $validated['parent_name'] ?? null,
            'phone' => $validated['phone'],
            'address' => $validated['address'] ?? null,
            'admission_date' => $validated['admission_date'],
            'monthly_fee' => $validated['monthly_fee'],
        ]);

        // Enroll student in each chosen subject with its assigned tutor
        foreach ($validated['subjects'] as $subjectId) {
            $tutorId = $validated['tutor_for_subject'][$subjectId] ?? null;
            if ($tutorId) {
                $student->enrollments()->create([
                    'subject_id' => $subjectId,
                    'tutor_id' => $tutorId,
                ]);
            }
        }

        return redirect()->route('admin.students.index')
            ->with('success', "Student '{$student->name}' has been added successfully (Code: {$student->student_code}).");
    }

    public function edit(Student $student)
    {
        $subjects = Subject::orderBy('name')->get();
        $tutors = Tutor::with('user')->get();
        $enrolledSubjectIds = $student->enrollments()->pluck('subject_id')->toArray();
        $currentTutorMap = $student->enrollments()->pluck('tutor_id', 'subject_id')->toArray();

        return view('admin.students.edit', compact('student', 'subjects', 'tutors', 'enrolledSubjectIds', 'currentTutorMap'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_level' => 'required|string|max:100',
            'parent_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'monthly_fee' => 'required|numeric|min:0',
            'is_active' => 'nullable|boolean',
            'subjects' => 'required|array|min:1',
            'subjects.*' => 'exists:subjects,id',
            'tutor_for_subject' => 'required|array',
        ]);

        $student->update([
            'name' => $validated['name'],
            'class_level' => $validated['class_level'],
            'parent_name' => $validated['parent_name'] ?? null,
            'phone' => $validated['phone'],
            'address' => $validated['address'] ?? null,
            'monthly_fee' => $validated['monthly_fee'],
            'is_active' => $request->boolean('is_active'),
        ]);

        // If the current month's fee has already been generated and is not fully paid,
        // update its amount to match the new monthly_fee (paid amount is left untouched)
        $student->fees()
            ->where('month', date('Y-m'))
            ->where('status', '!=', 'paid')
            ->update(['amount' => $validated['monthly_fee']]);

        // Reset enrollments and re-create (simplest reliable approach)
        $student->enrollments()->delete();
        foreach ($validated['subjects'] as $subjectId) {
            $tutorId = $validated['tutor_for_subject'][$subjectId] ?? null;
            if ($tutorId) {
                $student->enrollments()->create([
                    'subject_id' => $subjectId,
                    'tutor_id' => $tutorId,
                ]);
            }
        }

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student removed successfully.');
    }
}
