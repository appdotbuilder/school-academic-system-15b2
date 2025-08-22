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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('grade_level');
            $table->string('class_section');
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->date('lesson_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('classroom');
            $table->string('lesson_topic');
            $table->text('lesson_objectives')->nullable();
            $table->text('curriculum_standards')->nullable();
            $table->text('materials_needed')->nullable();
            $table->text('homework_assigned')->nullable();
            $table->enum('status', ['scheduled', 'completed', 'cancelled', 'rescheduled'])->default('scheduled');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['teacher_id', 'lesson_date']);
            $table->index(['grade_level', 'class_section']);
            $table->index('subject');
            $table->index('lesson_date');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};