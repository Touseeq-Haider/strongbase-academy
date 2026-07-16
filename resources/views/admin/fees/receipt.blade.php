<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Receipt - {{ $fee->student->name }}</title>
<style>
    body{ font-family: 'Segoe UI', Arial, sans-serif; background:#eee; margin:0; padding:30px; }
    .receipt{ max-width:600px; margin:auto; background:#fff; padding:40px; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,.1); }
    @media (max-width:600px){
        body{ padding:12px; }
        .receipt{ padding:22px; }
        td{ font-size:.85rem; }
    }
    .header{ text-align:center; border-bottom:2px solid #182642; padding-bottom:16px; margin-bottom:24px; }
    .header h1{ margin:0; font-size:1.4rem; color:#182642; }
    .header p{ margin:4px 0 0; color:#666; font-size:.85rem; }
    .status{ display:inline-block; padding:4px 14px; border-radius:20px; font-size:.8rem; font-weight:600; text-transform:uppercase; }
    .status.paid{ background:#d1e7dd; color:#0f5132; }
    .status.partial{ background:#fff3cd; color:#664d03; }
    .status.unpaid{ background:#f8d7da; color:#842029; }
    table{ width:100%; border-collapse:collapse; margin-top:20px; }
    td{ padding:10px 0; border-bottom:1px solid #eee; font-size:.95rem; }
    td.label{ color:#666; width:45%; }
    td.value{ font-weight:600; text-align:right; }
    .total-row td{ border-bottom:none; border-top:2px solid #182642; padding-top:16px; font-size:1.1rem; }
    .footer{ text-align:center; margin-top:30px; color:#999; font-size:.8rem; }
    .print-btn{ display:block; margin:24px auto 0; background:#182642; color:#fff; border:none; padding:10px 24px; border-radius:6px; cursor:pointer; font-size:.95rem; }
    @media print{ body{ background:#fff; padding:0; } .receipt{ box-shadow:none; } .print-btn{ display:none; } }
</style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h1>🎓 Strong Base Academy</h1>
            <p>Fee Payment Receipt</p>
        </div>

        <table>
            <tr>
                <td class="label">Receipt For</td>
                <td class="value">{{ \Carbon\Carbon::createFromFormat('Y-m', $fee->month)->format('F Y') }}</td>
            </tr>
            <tr>
                <td class="label">Student Name</td>
                <td class="value">{{ $fee->student->name }}</td>
            </tr>
            <tr>
                <td class="label">Student Code</td>
                <td class="value">{{ $fee->student->student_code }}</td>
            </tr>
            <tr>
                <td class="label">Class / Level</td>
                <td class="value">{{ $fee->student->class_level }}</td>
            </tr>
            <tr>
                <td class="label">Due Date</td>
                <td class="value">{{ $fee->due_date->format('d M, Y') }}</td>
            </tr>
            <tr>
                <td class="label">Payment Date</td>
                <td class="value">{{ $fee->paid_date ? $fee->paid_date->format('d M, Y') : '—' }}</td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td class="value"><span class="status {{ $fee->status }}">{{ $fee->status }}</span></td>
            </tr>
            <tr>
                <td class="label">Total Fee Amount</td>
                <td class="value">Rs. {{ number_format($fee->amount, 0) }}</td>
            </tr>
            <tr class="total-row">
                <td class="label">Amount Paid</td>
                <td class="value">Rs. {{ number_format($fee->paid_amount, 0) }}</td>
            </tr>
            @if($fee->status == 'partial')
            <tr>
                <td class="label" style="color:#842029;">Balance Remaining</td>
                <td class="value" style="color:#842029;">Rs. {{ number_format($fee->amount - $fee->paid_amount, 0) }}</td>
            </tr>
            @endif
        </table>

        <div class="footer">
            Generated on {{ now()->format('d M, Y h:i A') }} — Strong Base Academy
        </div>

        <button class="print-btn" onclick="window.print()"><i class="fa-solid fa-print"></i> Print / Save as PDF</button>
    </div>
</body>
</html>
