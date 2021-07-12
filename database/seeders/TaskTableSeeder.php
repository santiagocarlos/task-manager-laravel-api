<?php

namespace Database\Seeders;


use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTableSeeder extends Seeder
{
    protected function truncateTables()
    {
        DB::table('tasks')->truncate();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [
            [
                'title'     =>  "Go to the gym",
                'completed'    =>  0,
            ],
            [
                'title'     =>  "Do the homework to ReactJS",
                'completed'    =>  0,
            ],
            [
                'title'     =>  "Wash the car",
                'completed'    =>  0,
            ],
            [
                'title'     =>  "Send mail to Infocasas",
                'completed'    =>  0,
            ],
            [
                'title'     =>  "Go to shopping shoes to mom",
                'completed'    =>  0,
            ],
        ];

        foreach ($tasks as $i => $task)
        {
            Task::create([
                'title'     =>  $task['title'],
                'completed'    =>  $task['completed'],
            ]);
        }
    }
}
