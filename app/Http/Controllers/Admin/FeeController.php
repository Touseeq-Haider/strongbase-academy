<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\Student;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', date('Y-m'));
        $status = $request->input('status');

        $query = Fee::with('student')->where('month', $month);

        if ($status) {
            $query->where('status', $status);
        }

        $fees = $query->orderBy('status')->orderBy('due_date')->paginate(20)->withQueryString();

        $summary = [
            'total' => Fee::where('month', $month)->sum('amount'),
            'collected' => Fee::where('month', $month)->sum('paid_amount'),
            'pending' => Fee::where('month', $month)->where('status', '!=', 'paid')->count(),
        ];

        return view('admin.fees.index', compact('fees', 'month', 'status', 'summary'));
    }

    // Ek click me sab active students ke liye is month ki fee entry bana deta hai
    public function generate(Request $request)
    {
        $validated = $request->validate([
            'month' => 'required|date_format:Y-m',
            'due_day' => 'required|integer|min:1|max:28',
        ]);

        $month = $validated['month'];
        $dueDate = $month . '-' . str_pad($validated['due_day'], 2, '0', STR_PAD_LEFT);

        $students = Student::where('is_active', true)->get();
        $created = 0;

        foreach ($students as $student) {
            $fee = Fee::firstOrCreate(
                ['student_id' => $student->id, 'month' => $month],
                [
                    'amount' => $student->monthly_fee,
                    'status' => 'unpaid',
                    'paid_amount' => 0,
                    'due_date' => $dueDate,
                ]
            );
            if ($fee->wasRecentlyCreated) {
                $created++;
            }
        }

        return redirect()->route('admin.fees.index', ['month' => $month])
            ->with('success', "{$created} naye fee records generate hue is month ke liye.");
    }

    // Fee ka amount aur paid_amount dono update karna (paid/partial/unpaid khud decide hota hai)
    public function updateStatus(Request $request, Fee $fee)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
        ]);

        $amount = $validated['amount'];
        $paidAmount = $validated['paid_amount'];

        $status = 'unpaid';
        if ($paidAmount >= $amount && $amount > 0) {
            $status = 'paid';
        } elseif ($paidAmount > 0) {
            $status = 'partial';
        }

        $fee->update([
            'amount' => $amount,
            'paid_amount' => $paidAmount,
            'status' => $status,
            'paid_date' => $status !== 'unpaid' ? now() : null,
        ]);

        return back()->with('success', "Fee update ho gayi: {$fee->student->name} — " . ucfirst($status));
    }

    // Printable receipt for a fee payment
    public function receipt(Fee $fee)
    {
        $fee->load('student');
        return view('admin.fees.receipt', compact('fee'));
    }
}
