<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'student_code',
        'name',
        'class_level',
        'parent_name',
        'phone',
        'address',
        'admission_date',
        'monthly_fee',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'admission_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    // Pakistani number ko WhatsApp (wa.me) format me convert karta hai: 03xx... -> 923xx...
    public function whatsappPhone(): string
    {
        $digits = preg_replace('/[^0-9]/', '', $this->phone);
        if (str_starts_with($digits, '0')) {
            $digits = '92' . substr($digits, 1);
        }
        return $digits;
    }

    public function fees(): HasMany
    {
        return $this->hasMany(Fee::class);
    }

    // Auto-generate next student code like SBA-0001, SBA-0002 ...
    public static function generateStudentCode(): string
    {
        $last = static::orderByDesc('id')->first();
        $nextNumber = $last ? ((int) substr($last->student_code, 4)) + 1 : 1;
        return 'SBA-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }
}
