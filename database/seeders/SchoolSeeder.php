<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Staff;
use App\Models\TeacherAttendance;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create teachers first
        $teachers = Teacher::factory()
            ->count(15)
            ->active()
            ->create();

        // Create students
        Student::factory()
            ->count(100)
            ->active()
            ->create();

        // Create some graduated students
        Student::factory()
            ->count(20)
            ->graduated()
            ->create();

        // Create staff members
        Staff::factory()
            ->count(10)
            ->active()
            ->create();

        // Create attendance records for the past month
        $startDate = Carbon::now()->subMonth();
        $endDate = Carbon::now();
        
        foreach ($teachers as $teacher) {
            $currentDate = $startDate->copy();
            
            while ($currentDate <= $endDate) {
                // Skip weekends for attendance
                if ($currentDate->isWeekday()) {
                    // 90% chance of being present
                    $status = fake()->randomElement([
                        'present', 'present', 'present', 'present', 'present',
                        'present', 'present', 'present', 'present', 
                        'absent', 'late', 'on-leave'
                    ]);
                    
                    TeacherAttendance::factory()->create([
                        'teacher_id' => $teacher->id,
                        'date' => $currentDate->toDateString(),
                        'status' => $status,
                    ]);
                }
                
                $currentDate->addDay();
            }
        }

        // Create lessons for the next 3 months
        foreach ($teachers as $teacher) {
            // Each teacher has 3-5 lessons per week
            $lessonsPerWeek = random_int(3, 5);
            $weeksToSchedule = 12; // 3 months
            
            for ($week = 0; $week < $weeksToSchedule; $week++) {
                for ($lessonInWeek = 0; $lessonInWeek < $lessonsPerWeek; $lessonInWeek++) {
                    // Schedule lessons on weekdays only
                    $dayOfWeek = random_int(1, 5); // Monday to Friday
                    $lessonDate = Carbon::now()->addWeeks($week)->startOfWeek()->addDays($dayOfWeek - 1);
                    
                    // Skip if date is in the past
                    if ($lessonDate->isPast()) {
                        continue;
                    }
                    
                    // Different time slots throughout the day
                    $timeSlots = [
                        ['08:00', '09:00'],
                        ['09:00', '10:00'],
                        ['10:30', '11:30'],
                        ['11:30', '12:30'],
                        ['13:30', '14:30'],
                        ['14:30', '15:30'],
                    ];
                    
                    $selectedTimeSlot = fake()->randomElement($timeSlots);
                    
                    Lesson::factory()->create([
                        'teacher_id' => $teacher->id,
                        'lesson_date' => $lessonDate->toDateString(),
                        'start_time' => $selectedTimeSlot[0],
                        'end_time' => $selectedTimeSlot[1],
                        'subject' => $teacher->subject_specialization,
                        'status' => 'scheduled',
                    ]);
                }
            }
        }

        // Create some lessons for today
        $todayTeachers = $teachers->random(5);
        foreach ($todayTeachers as $teacher) {
            Lesson::factory()
                ->count(random_int(1, 2))
                ->today()
                ->create([
                    'teacher_id' => $teacher->id,
                    'subject' => $teacher->subject_specialization,
                ]);
        }
    }
}