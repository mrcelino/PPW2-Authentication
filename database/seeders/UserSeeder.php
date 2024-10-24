<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat 5 pengguna dengan level admin
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => 'Admin User ' . $i,
                'email' => 'admin' . $i . '@example.com',
                'password' => Hash::make('password'), // Ganti dengan password yang sesuai
                'is_admin' => true, // Set is_admin ke true untuk admin
            ]);
        }

        // Membuat 5 pengguna dengan level user biasa
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => 'Regular User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('password'), // Ganti dengan password yang sesuai
                'is_admin' => false, // Set is_admin ke false untuk user biasa
            ]);
        }
    }
}