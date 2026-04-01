<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@npunto.local',
            'password' => Hash::make('password'),
            'phone' => '0712345678',
            'department' => 'Management',
            'role' => 'admin',
        ]);

        // Create sample support team members
        User::create([
            'name' => 'John Doe',
            'email' => 'john@npunto.local',
            'password' => Hash::make('password'),
            'phone' => '0712345679',
            'department' => 'Support',
            'role' => 'staff',
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@npunto.local',
            'password' => Hash::make('password'),
            'phone' => '0712345680',
            'department' => 'Support',
            'role' => 'staff',
        ]);

        User::create([
            'name' => 'Mike Johnson',
            'email' => 'mike@npunto.local',
            'password' => Hash::make('password'),
            'phone' => '0712345681',
            'department' => 'Support',
            'role' => 'staff',
        ]);
    }
}
