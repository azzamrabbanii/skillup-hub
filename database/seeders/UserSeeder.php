<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@skillup.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Buat Akun Instructor Contoh
        User::create([
            'name' => 'Pak Budi Instruktur',
            'email' => 'budi@skillup.com',
            'password' => Hash::make('password123'),
            'role' => 'instructor',
        ]);

        // 3. Buat Akun Student Contoh
        User::create([
            'name' => 'Andi Siswa',
            'email' => 'andi@skillup.com',
            'password' => Hash::make('password123'),
            'role' => 'student',
        ]);
    }
}
