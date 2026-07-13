<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Subject;
use App\Models\Tutor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('level')->orderBy('name')->get()->groupBy('level');
        $tutors = Tutor::with(['user', 'subjects'])
            ->whereHas('user', fn ($q) => $q->where('is_active', true))
            ->get();

        return view('public.home', compact('subjects', 'tutors'));
    }

    public function storeInquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'class_level' => 'required|string|max:100',
            'message' => 'nullable|string|max:1000',
        ]);

        Inquiry::create($validated);

        return back()->with('success', 'Shukriya! Aapki inquiry mil gayi hai, hum jald hi rabta karenge.');
    }
}
