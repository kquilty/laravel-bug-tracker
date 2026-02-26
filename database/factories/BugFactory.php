<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bug>
 */
class BugFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Assign only SOME bugs to a random worker
        $worker_id = (rand(0, 1) == 1) ? \App\Models\Worker::inRandomOrder()->first()?->id : null;

        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['open', 'in progress', 'closed']),
            'days_old' => fake()->numberBetween(0, 60),
            'worker_id' => $worker_id,
        ];
    }
}
