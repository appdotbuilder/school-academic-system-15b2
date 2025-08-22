<?php

namespace Database\Factories;

use App\Models\Teacher;
use App\Models\TeacherAttendance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeacherAttendance>
 */
class TeacherAttendanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\TeacherAttendance>
     */
    protected $model = TeacherAttendance::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['present', 'absent', 'late', 'half-day', 'on-leave']);
        $clockInTime = null;
        $clockOutTime = null;
        $hoursWorked = null;
        $leaveType = null;
        
        if ($status === 'present') {
            $clockInTime = fake()->time('H:i', '09:30');
            $clockOutTime = fake()->time('H:i', '17:00');
            $clockIn = \Carbon\Carbon::createFromTimeString($clockInTime);
            $clockOut = \Carbon\Carbon::createFromTimeString($clockOutTime);
            $hoursWorked = $clockOut->diffInMinutes($clockIn) / 60;
        } elseif ($status === 'late') {
            $clockInTime = fake()->time('H:i', '10:30');
            $clockOutTime = fake()->time('H:i', '17:00');
            $clockIn = \Carbon\Carbon::createFromTimeString($clockInTime);
            $clockOut = \Carbon\Carbon::createFromTimeString($clockOutTime);
            $hoursWorked = $clockOut->diffInMinutes($clockIn) / 60;
        } elseif ($status === 'half-day') {
            $clockInTime = fake()->time('H:i', '09:30');
            $clockOutTime = fake()->time('H:i', '13:00');
            $clockIn = \Carbon\Carbon::createFromTimeString($clockInTime);
            $clockOut = \Carbon\Carbon::createFromTimeString($clockOutTime);
            $hoursWorked = $clockOut->diffInMinutes($clockIn) / 60;
        } elseif ($status === 'on-leave') {
            $leaveType = fake()->randomElement(['sick', 'personal', 'vacation', 'emergency', 'maternity']);
        }
        
        return [
            'teacher_id' => Teacher::factory(),
            'date' => fake()->dateTimeBetween('-3 months', 'now'),
            'clock_in_time' => $clockInTime,
            'clock_out_time' => $clockOutTime,
            'status' => $status,
            'leave_type' => $leaveType,
            'notes' => fake()->optional()->sentence(),
            'hours_worked' => $hoursWorked,
        ];
    }

    /**
     * Indicate that the teacher was present.
     */
    public function present(): static
    {
        return $this->state(function (array $attributes) {
            $clockInTime = fake()->time('H:i', '09:30');
            $clockOutTime = fake()->time('H:i', '17:00');
            $clockIn = \Carbon\Carbon::createFromTimeString($clockInTime);
            $clockOut = \Carbon\Carbon::createFromTimeString($clockOutTime);
            
            return [
                'status' => 'present',
                'clock_in_time' => $clockInTime,
                'clock_out_time' => $clockOutTime,
                'hours_worked' => $clockOut->diffInMinutes($clockIn) / 60,
                'leave_type' => null,
            ];
        });
    }

    /**
     * Indicate that the teacher was absent.
     */
    public function absent(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'absent',
            'clock_in_time' => null,
            'clock_out_time' => null,
            'hours_worked' => null,
            'leave_type' => null,
        ]);
    }

    /**
     * Indicate that the teacher was on leave.
     */
    public function onLeave(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'on-leave',
            'clock_in_time' => null,
            'clock_out_time' => null,
            'hours_worked' => null,
            'leave_type' => fake()->randomElement(['sick', 'personal', 'vacation', 'emergency', 'maternity']),
        ]);
    }
}