<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teacher_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('clock_in_time')->nullable();
            $table->time('clock_out_time')->nullable();
            $table->enum('status', ['present', 'absent', 'late', 'half-day', 'on-leave'])->default('present');
            $table->string('leave_type')->nullable()->comment('sick, personal, vacation, etc.');
            $table->text('notes')->nullable();
            $table->decimal('hours_worked', 4, 2)->nullable();
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['teacher_id', 'date']);
            $table->index('date');
            $table->index('status');
            $table->unique(['teacher_id', 'date']); // One record per teacher per day
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_attendances');
    }
};