<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AcademySeeder extends Seeder
{
    public function run(): void
    {
        // Pehla admin account
        User::firstOrCreate(
            ['email' => 'admin@strongbase.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'), // be sure to change this after first login
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        // Default subjects — apni zarurat ke hisaab se badha/ghata sakte hain
        $subjects = [
            ['name' => 'Mathematics', 'level' => 'Primary'],
            ['name' => 'English', 'level' => 'Primary'],
            ['name' => 'Science', 'level' => 'Middle'],
            ['name' => 'Mathematics', 'level' => 'Matric'],
            ['name' => 'Physics', 'level' => 'Matric'],
            ['name' => 'Chemistry', 'level' => 'Matric'],
            ['name' => 'Biology', 'level' => 'FSc'],
            ['name' => 'Physics', 'level' => 'FSc'],
            ['name' => 'Chemistry', 'level' => 'FSc'],
            ['name' => 'Mathematics', 'level' => 'O-Level'],
            ['name' => 'Physics', 'level' => 'A-Level'],
        ];

        foreach ($subjects as $subject) {
            Subject::firstOrCreate($subject);
        }
    }
}
