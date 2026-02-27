<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamNames = [
            'Agile Avengers',
            'Sprint Spartans',
            'Kanban Commandos',
            'Scrum Stormers',
            'Velocity Vanguards',
            'Backlog Bandits',
            'Epic Executors',
            'User Story Squad',
            'Daily Standup Stars',
            'Retrospective Rockstars',
        ];

        foreach ($teamNames as $name) {
            Team::create(['name' => $name]);
        }
    }
}
