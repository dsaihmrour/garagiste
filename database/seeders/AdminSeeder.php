<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            "firstName" => "Admin",
            "lastName" => "Admin",
            "email" => "admin@admin",
            "password" => bcrypt("admin123"),
            "username" => "admin",
            "phoneNumber" => "123456789",
            "address" => "admin",
        ]);

        $role = \App\Models\Role::where('name', 'admin')->first();
        $user->roles()->attach($role);
    }
}
