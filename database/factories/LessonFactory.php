<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Lesson>
     */
    protected $model = Lesson::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subjects = ['Mathematics', 'Physics', 'Chemistry', 'Biology', 'English Literature', 'History', 'Geography', 'Physical Education', 'Art', 'Music', 'Computer Science'];
        $gradelevels = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
        $classSections = ['A', 'B', 'C', 'D'];
        $classrooms = ['Room 101', 'Room 102', 'Room 103', 'Lab 1', 'Lab 2', 'Gymnasium', 'Art Studio', 'Music Room', 'Library', 'Computer Lab'];
        
        $subject = fake()->randomElement($subjects);
        $topics = [
            'Mathematics' => ['Algebra Basics', 'Geometry', 'Trigonometry', 'Calculus Introduction', 'Statistics'],
            'Physics' => ['Newton\'s Laws', 'Electricity', 'Magnetism', 'Waves', 'Thermodynamics'],
            'Chemistry' => ['Atomic Structure', 'Chemical Bonding', 'Acids and Bases', 'Organic Chemistry', 'Periodic Table'],
            'Biology' => ['Cell Structure', 'Genetics', 'Ecology', 'Human Body Systems', 'Evolution'],
            'English Literature' => ['Poetry Analysis', 'Shakespeare', 'Novel Study', 'Creative Writing', 'Grammar'],
            'History' => ['Ancient Civilizations', 'World Wars', 'Industrial Revolution', 'Modern History', 'Local History'],
        ];
        
        $lessonTopic = $topics[$subject] ?? ['Introduction to ' . $subject];
        
        $startTime = fake()->time('H:i', '15:00');
        $endTime = fake()->time('H:i', '17:00');
        
        return [
            'subject' => $subject,
            'grade_level' => fake()->randomElement($gradelevels),
            'class_section' => fake()->randomElement($classSections),
            'teacher_id' => Teacher::factory(),
            'lesson_date' => fake()->dateTimeBetween('now', '+3 months'),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'classroom' => fake()->randomElement($classrooms),
            'lesson_topic' => fake()->randomElement($lessonTopic),
            'lesson_objectives' => fake()->optional()->paragraph(),
            'curriculum_standards' => fake()->optional()->sentence(),
            'materials_needed' => fake()->optional()->words(5, true),
            'homework_assigned' => fake()->optional()->sentence(),
            'status' => fake()->randomElement(['scheduled', 'completed', 'cancelled', 'rescheduled']),
            'notes' => fake()->optional()->sentence(),
        ];
    }

    /**
     * Indicate that the lesson is scheduled.
     */
    public function scheduled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'scheduled',
            'lesson_date' => fake()->dateTimeBetween('now', '+1 month'),
        ]);
    }

    /**
     * Indicate that the lesson is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'lesson_date' => fake()->dateTimeBetween('-1 month', 'now'),
        ]);
    }

    /**
     * Indicate that the lesson is for today.
     */
    public function today(): static
    {
        return $this->state(fn (array $attributes) => [
            'lesson_date' => now()->toDateString(),
            'status' => 'scheduled',
        ]);
    }
}