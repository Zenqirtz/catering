<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Cek apakah admin sudah ada
        $adminExists = User::where('email', 'admin@foryoucatering.com')->exists();

        if (!$adminExists) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@foryoucatering.com',
                'password' => Hash::make('admin123'), // Password default
                'is_admin' => true,
                'email_verified_at' => now(),
            ]);

            $this->command->info('Admin user created successfully!');
            $this->command->info('Email: admin@foryoucatering.com');
            $this->command->info('Password: admin123');
        } else {
            $this->command->info('Admin user already exists!');
        }

        // Buat beberapa user dummy untuk testing
        User::factory()->count(5)->create([
            'is_admin' => false
        ]);
    }
}