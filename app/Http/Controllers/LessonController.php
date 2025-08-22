<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Lesson::with('teacher');
        
        if ($request->has('teacher_id') && $request->teacher_id) {
            $query->where('teacher_id', $request->teacher_id);
        }
        
        if ($request->has('subject') && $request->subject) {
            $query->where('subject', 'like', '%' . $request->subject . '%');
        }
        
        if ($request->has('grade_level') && $request->grade_level) {
            $query->where('grade_level', $request->grade_level);
        }
        
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('lesson_date', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('lesson_date', '<=', $request->date_to);
        }
        
        $lessons = $query->latest('lesson_date')->paginate(15);
        $teachers = Teacher::active()->select('id', 'first_name', 'last_name', 'employee_id')->get();
        
        return Inertia::render('lessons/index', [
            'lessons' => $lessons,
            'teachers' => $teachers,
            'filters' => $request->only(['teacher_id', 'subject', 'grade_level', 'date_from', 'date_to'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::active()->select('id', 'first_name', 'last_name', 'employee_id', 'subject_specialization')->get();
        
        return Inertia::render('lessons/create', [
            'teachers' => $teachers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'grade_level' => 'required|string|max:10',
            'class_section' => 'required|string|max:10',
            'teacher_id' => 'required|exists:teachers,id',
            'lesson_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'classroom' => 'required|string|max:50',
            'lesson_topic' => 'required|string|max:255',
            'lesson_objectives' => 'nullable|string',
            'curriculum_standards' => 'nullable|string',
            'materials_needed' => 'nullable|string',
            'homework_assigned' => 'nullable|string',
            'status' => 'required|in:scheduled,completed,cancelled,rescheduled',
            'notes' => 'nullable|string',
        ]);

        $lesson = Lesson::create($validated);

        return redirect()->route('lessons.show', $lesson)
            ->with('success', 'Lesson created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        $lesson->load('teacher');
        
        return Inertia::render('lessons/show', [
            'lesson' => $lesson
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        $lesson->load('teacher');
        $teachers = Teacher::active()->select('id', 'first_name', 'last_name', 'employee_id', 'subject_specialization')->get();
        
        return Inertia::render('lessons/edit', [
            'lesson' => $lesson,
            'teachers' => $teachers
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'grade_level' => 'required|string|max:10',
            'class_section' => 'required|string|max:10',
            'teacher_id' => 'required|exists:teachers,id',
            'lesson_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'classroom' => 'required|string|max:50',
            'lesson_topic' => 'required|string|max:255',
            'lesson_objectives' => 'nullable|string',
            'curriculum_standards' => 'nullable|string',
            'materials_needed' => 'nullable|string',
            'homework_assigned' => 'nullable|string',
            'status' => 'required|in:scheduled,completed,cancelled,rescheduled',
            'notes' => 'nullable|string',
        ]);

        $lesson->update($validated);

        return redirect()->route('lessons.show', $lesson)
            ->with('success', 'Lesson updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->route('lessons.index')
            ->with('success', 'Lesson deleted successfully.');
    }
}