<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectLog>
 */
class ProjectLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => $this->faker->randomNumber(),
            'user_id' => $this->faker->randomNumber(),
            'approve' => null,
            'approved_hours' => null,
            'log_date' => $this->faker->date(),
            'billable_hours' => null,
        ];
    }
}
