<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Teacher>
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();
        $departments = ['Mathematics', 'Science', 'English', 'History', 'Physical Education', 'Art', 'Music', 'Computer Science'];
        $subjects = ['Mathematics', 'Physics', 'Chemistry', 'Biology', 'English Literature', 'History', 'Geography', 'Physical Education', 'Art', 'Music', 'Computer Programming'];
        $qualifications = ['B.Ed.', 'M.Ed.', 'Ph.D.', 'B.A.', 'M.A.', 'B.Sc.', 'M.Sc.'];
        
        return [
            'employee_id' => 'EMP' . fake()->unique()->numberBetween(10000, 99999),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'date_of_birth' => fake()->dateTimeBetween('-65 years', '-25 years'),
            'hire_date' => fake()->dateTimeBetween('-10 years', 'now'),
            'department' => fake()->randomElement($departments),
            'subject_specialization' => fake()->randomElement($subjects),
            'qualification' => fake()->randomElement($qualifications),
            'salary' => fake()->numberBetween(30000, 80000),
            'employment_type' => fake()->randomElement(['full-time', 'part-time', 'contract']),
            'status' => fake()->randomElement(['active', 'inactive', 'on-leave']),
            'notes' => fake()->optional()->sentence(),
        ];
    }

    /**
     * Indicate that the teacher is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the teacher is full-time.
     */
    public function fullTime(): static
    {
        return $this->state(fn (array $attributes) => [
            'employment_type' => 'full-time',
        ]);
    }
}