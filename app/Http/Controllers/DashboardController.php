<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherAttendance;
use App\Models\Lesson;
use App\Models\Staff;
use Inertia\Inertia;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $today = Carbon::today();
        
        // Get statistics
        $stats = [
            'total_students' => Student::active()->count(),
            'total_teachers' => Teacher::active()->count(),
            'total_staff' => Staff::active()->count(),
            'present_teachers_today' => TeacherAttendance::whereDate('date', $today)
                ->where('status', 'present')
                ->count(),
            'absent_teachers_today' => TeacherAttendance::whereDate('date', $today)
                ->where('status', 'absent')
                ->count(),
            'scheduled_lessons_today' => Lesson::whereDate('lesson_date', $today)
                ->where('status', 'scheduled')
                ->count(),
            'completed_lessons_today' => Lesson::whereDate('lesson_date', $today)
                ->where('status', 'completed')
                ->count(),
        ];
        
        // Get recent attendance records
        $recentAttendances = TeacherAttendance::with('teacher')
            ->latest('date')
            ->limit(10)
            ->get();
        
        // Get upcoming lessons
        $upcomingLessons = Lesson::with('teacher')
            ->where('lesson_date', '>=', $today)
            ->where('status', 'scheduled')
            ->orderBy('lesson_date')
            ->orderBy('start_time')
            ->limit(10)
            ->get();
        
        // Get today's lessons
        $todaysLessons = Lesson::with('teacher')
            ->whereDate('lesson_date', $today)
            ->orderBy('start_time')
            ->get();
        
        return Inertia::render('dashboard', [
            'stats' => $stats,
            'recentAttendances' => $recentAttendances,
            'upcomingLessons' => $upcomingLessons,
            'todaysLessons' => $todaysLessons,
        ]);
    }
}