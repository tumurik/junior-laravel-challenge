<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $todos = [
            [
                'title' => 'Buy groceries',
                'description' => 'Get milk, bread, eggs, and some fruits from the supermarket.',
                'completed' => false,
                'due_date' => Carbon::now()->addDays(3), // Due within 30 days
            ],
            [
                'title' => 'Walk the dog',
                'completed' => true,
                'due_date' => Carbon::now()->subDays(1), // Already completed
            ],
            [
                'title' => 'Fix the car',
                'description' => 'Take the car to the mechanic to fix the strange noise from the engine.',
                'completed' => false,
                'due_date' => Carbon::now()->addDays(15), // Due within 30 days
            ],
            [
                'title' => 'Buy concert tickets',
                'description' => 'Purchase tickets for the jazz concert next month before they sell out.',
                'completed' => false,
                'due_date' => Carbon::now()->addDays(45), // Due later (beyond 30 days)
            ],
        ];

        foreach ($todos as $todo) {
            Todo::create($todo);
        }
    }
}
