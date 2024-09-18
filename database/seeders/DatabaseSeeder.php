<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Role::factory()->create([
        //     'name' => 'Manager',
        // ]);

        // Role::factory()->create([
        //     'name' => 'Developer',
        // ]);

        User::factory()->create([
            'name' => 'Fauzan',
            'username' => 'fauzan',
            'role_id' => 1,
            'email' => 'fauzan@gmail.com',
            'password' => Hash::make('fauzan'),
        ]);
    }
}
