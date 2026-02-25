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
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['open', 'in progress', 'closed']),
            'days_old' => $this->faker->numberBetween(0, 60),
            'worker_id' => $worker_id,
        ];
    }
}
