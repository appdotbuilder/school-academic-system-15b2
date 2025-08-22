<?php

use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\TeacherAttendance;
use App\Models\Lesson;

test('dashboard displays school statistics correctly', function () {
    $user = User::factory()->create();
    
    // Create test data
    $teachers = Teacher::factory()->count(5)->active()->create();
    $students = Student::factory()->count(10)->active()->create();
    
    // Create today's attendance
    TeacherAttendance::factory()->create([
        'teacher_id' => $teachers->first()->id,
        'date' => today(),
        'status' => 'present'
    ]);
    
    // Create today's lessons
    Lesson::factory()->create([
        'teacher_id' => $teachers->first()->id,
        'lesson_date' => today(),
        'status' => 'scheduled'
    ]);
    
    $response = $this->actingAs($user)->get('/dashboard');
    
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => $page
        ->component('dashboard')
        ->has('stats')
        ->where('stats.total_teachers', 5)
        ->where('stats.total_students', 10)
    );
});

test('teachers index page displays teachers list', function () {
    $user = User::factory()->create();
    Teacher::factory()->count(3)->active()->create();
    
    $response = $this->actingAs($user)->get('/teachers');
    
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => $page
        ->component('teachers/index')
        ->has('teachers.data', 3)
    );
});

test('students index page displays students list', function () {
    $user = User::factory()->create();
    Student::factory()->count(5)->active()->create();
    
    $response = $this->actingAs($user)->get('/students');
    
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => $page
        ->component('students/index')
        ->has('students.data', 5)
    );
});

test('teacher attendance can be created', function () {
    $user = User::factory()->create();
    $teacher = Teacher::factory()->active()->create();
    
    $response = $this->actingAs($user)->post('/attendances', [
        'teacher_id' => $teacher->id,
        'date' => today()->toDateString(),
        'clock_in_time' => '08:00',
        'clock_out_time' => '16:00',
        'status' => 'present',
        'hours_worked' => 8.0,
    ]);
    
    $response->assertRedirect();
    
    $this->assertDatabaseCount('teacher_attendances', 1);
    
    $attendance = TeacherAttendance::first();
    expect($attendance->teacher_id)->toBe($teacher->id);
    expect($attendance->date->toDateString())->toBe(today()->toDateString());
    expect($attendance->status)->toBe('present');
});

test('lesson can be created', function () {
    $user = User::factory()->create();
    $teacher = Teacher::factory()->active()->create();
    
    $response = $this->actingAs($user)->post('/lessons', [
        'subject' => 'Mathematics',
        'grade_level' => '10',
        'class_section' => 'A',
        'teacher_id' => $teacher->id,
        'lesson_date' => today()->addDays(1)->toDateString(),
        'start_time' => '10:00',
        'end_time' => '11:00',
        'classroom' => 'Room 101',
        'lesson_topic' => 'Algebra Basics',
        'status' => 'scheduled',
    ]);
    
    $response->assertRedirect();
    
    $this->assertDatabaseHas('lessons', [
        'subject' => 'Mathematics',
        'teacher_id' => $teacher->id,
        'status' => 'scheduled',
    ]);
});

test('welcome page displays school information', function () {
    $response = $this->get('/');
    
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => $page
        ->component('welcome')
    );
});

test('unauthenticated users cannot access dashboard', function () {
    $response = $this->get('/dashboard');
    
    $response->assertRedirect('/login');
});

test('unauthenticated users cannot manage teachers', function () {
    $response = $this->get('/teachers');
    
    $response->assertRedirect('/login');
});

test('unauthenticated users cannot manage students', function () {
    $response = $this->get('/students');
    
    $response->assertRedirect('/login');
});