<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Staff>
     */
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();
        $departments = ['Administration', 'Finance', 'Human Resources', 'IT Support', 'Maintenance', 'Security', 'Library', 'Counseling'];
        $positions = ['Administrator', 'Secretary', 'Accountant', 'IT Specialist', 'Librarian', 'Counselor', 'Security Guard', 'Maintenance Worker', 'Receptionist', 'Assistant Principal'];
        
        return [
            'employee_id' => 'STF' . fake()->unique()->numberBetween(10000, 99999),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'date_of_birth' => fake()->dateTimeBetween('-65 years', '-20 years'),
            'hire_date' => fake()->dateTimeBetween('-15 years', 'now'),
            'department' => fake()->randomElement($departments),
            'position' => fake()->randomElement($positions),
            'salary' => fake()->numberBetween(25000, 60000),
            'employment_type' => fake()->randomElement(['full-time', 'part-time', 'contract']),
            'status' => fake()->randomElement(['active', 'inactive', 'on-leave']),
            'notes' => fake()->optional()->sentence(),
        ];
    }

    /**
     * Indicate that the staff member is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }
}