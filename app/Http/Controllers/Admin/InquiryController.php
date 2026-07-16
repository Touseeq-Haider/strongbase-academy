<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::orderByDesc('created_at')->paginate(20);
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function updateStatus(Request $request, Inquiry $inquiry)
    {
        $request->validate(['status' => 'required|in:new,contacted,enrolled,not_interested']);
        $inquiry->update(['status' => $request->status]);
        return back()->with('success', 'Inquiry status updated successfully.');
    }
}
