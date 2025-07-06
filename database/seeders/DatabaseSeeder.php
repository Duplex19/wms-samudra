<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Ahmad Suhendra',
                'email' => 'ahmad@example.com',
                'phone' => '081234567890',
                'gender' => 'male',
                'status' => 'active',
                'city' => 'Jakarta',
                'birth_date' => '1990-05-15',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@example.com',
                'phone' => '081234567891',
                'gender' => 'female',
                'status' => 'active',
                'city' => 'Surabaya',
                'birth_date' => '1992-08-20',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'phone' => '081234567892',
                'gender' => 'male',
                'status' => 'inactive',
                'city' => 'Bandung',
                'birth_date' => '1988-12-10',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Dewi Sartika',
                'email' => 'dewi@example.com',
                'phone' => '081234567893',
                'gender' => 'female',
                'status' => 'active',
                'city' => 'Medan',
                'birth_date' => '1995-03-25',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Rizki Pratama',
                'email' => 'rizki@example.com',
                'phone' => '081234567894',
                'gender' => 'male',
                'status' => 'active',
                'city' => 'Semarang',
                'birth_date' => '1993-07-18',
                'password' => Hash::make('password123'),
            ],
        ];

        // Insert manual users
        foreach ($users as $user) {
            User::create($user);
        }

        // Generate additional random users
        User::factory(45)->create();
    }
}
