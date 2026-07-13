<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // login belongs here
            $table->string('qualification')->nullable();
            $table->text('bio')->nullable();
            $table->decimal('commission_percent', 5, 2)->default(0); // for commission-based payout, optional
            $table->timestamps();
        });

        // Pivot: which tutor teaches which subjects
        Schema::create('subject_tutor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tutor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subject_tutor');
        Schema::dropIfExists('tutors');
    }
};
