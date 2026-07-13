<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->string('month'); // e.g. "2026-07"
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['paid', 'unpaid', 'partial'])->default('unpaid');
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->date('due_date');
            $table->date('paid_date')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'month']); // ek student ki ek month me ek hi fee entry
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
