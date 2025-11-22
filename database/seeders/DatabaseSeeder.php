<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Database\Factories\TaskFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        if (User::count() === 0) {
            User::factory(30)->create();
        }

        if( Project::count() === 0){
            Project::factory(2)->create();
        }

        if(Task::count() === 0){
            Task::factory(50)->create();
        }


        $this->call(RoleNPermissionSeeder::class);
        $this->call(UserSeeder::class);
    }
}
