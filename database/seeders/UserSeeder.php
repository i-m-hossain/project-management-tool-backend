<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'imran.kuet14@gmail.com'],
            [
                'name' => 'Md Imran Hossain',
                'password' => 'secret123',
            ]
        );

        $user->assignRole(['admin', 'developer']);
    }
}
