<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_code')->unique(); // auto-generated e.g. SBA-0001
            $table->string('name');
            $table->string('class_level'); // e.g. "Class 9", "FSc Part 1"
            $table->string('parent_name')->nullable();
            $table->string('phone');
            $table->string('address')->nullable();
            $table->date('admission_date');
            $table->decimal('monthly_fee', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Which subjects a student takes, and which tutor teaches them that subject
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tutor_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
        Schema::dropIfExists('students');
    }
};
