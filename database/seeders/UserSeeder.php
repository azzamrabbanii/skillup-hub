<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@skillup.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);


        User::create([
            'name' => 'Pak Budi Instruktur',
            'email' => 'budi@skillup.com',
            'password' => Hash::make('password123'),
            'role' => 'instructor',
        ]);

       
        User::create([
            'name' => 'Andi Siswa',
            'email' => 'andi@skillup.com',
            'password' => Hash::make('password123'),
            'role' => 'student',
        ]);
    }
}
