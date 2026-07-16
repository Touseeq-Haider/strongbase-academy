<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TutorController extends Controller
{
    public function index()
    {
        $tutors = Tutor::with(['user', 'subjects'])->orderByDesc('id')->paginate(15);
        return view('admin.tutors.index', compact('tutors'));
    }

    public function create()
    {
        $subjects = Subject::orderBy('name')->get();
        return view('admin.tutors.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|min:6',
            'qualification' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'subjects' => 'required|array|min:1',
            'subjects.*' => 'exists:subjects,id',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'tutor',
        ]);

        $tutor = Tutor::create([
            'user_id' => $user->id,
            'qualification' => $validated['qualification'] ?? null,
            'bio' => $validated['bio'] ?? null,
        ]);

        $tutor->subjects()->sync($validated['subjects']);

        return redirect()->route('admin.tutors.index')
            ->with('success', "Tutor '{$user->name}' has been added successfully. Login email: {$user->email}");
    }

    public function edit(Tutor $tutor)
    {
        $tutor->load('user', 'subjects');
        $subjects = Subject::orderBy('name')->get();
        return view('admin.tutors.edit', compact('tutor', 'subjects'));
    }

    public function update(Request $request, Tutor $tutor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $tutor->user_id,
            'phone' => 'nullable|string|max:20',
            'qualification' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'subjects' => 'required|array|min:1',
            'subjects.*' => 'exists:subjects,id',
        ]);

        $tutor->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        $tutor->update([
            'qualification' => $validated['qualification'] ?? null,
            'bio' => $validated['bio'] ?? null,
        ]);

        $tutor->subjects()->sync($validated['subjects']);

        return redirect()->route('admin.tutors.index')->with('success', 'Tutor updated successfully.');
    }

    public function destroy(Tutor $tutor)
    {
        $tutor->user()->delete(); // cascades to tutor row via FK
        return redirect()->route('admin.tutors.index')->with('success', 'Tutor removed successfully.');
    }
}
