<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = [
            'Software Engineer', 'DevOps', 'Database Analyst', 'Cyber Security Consultant', 'Project Manager',
            'System Architect', 'QA Engineer', 'Product Owner', 'UI/UX Designer', 'Scrum Master'
        ];
        shuffle($roles);

        foreach ($roles as $role) {
            User::create([
                'name' => fake()->name(),
                'role' => $role,
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);
        }
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
