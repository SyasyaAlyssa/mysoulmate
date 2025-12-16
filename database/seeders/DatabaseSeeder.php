<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => Hash::make('password'),
    'role' => 'admin',
]);

User::create([
    'name' => 'Student User',
    'email' => 'student@example.com',
    'password' => Hash::make('password'),
    'role' => 'student',
]);

User::create([
    'name' => 'Guardian User',
    'email' => 'guardian@example.com',
    'password' => Hash::make('password'),
    'role' => 'guardian',
]);


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);

      
    }
}
