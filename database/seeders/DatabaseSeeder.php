<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $data = [
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'utpas2024@gmail.com',
                'username' => 'system.admin',
                'role' => 0,
                'password' => bcrypt('@dmin123'),
            ]
        ];

        \App\Models\User::insert($data);

        $this->call([
            // CourseSeeder::class,
            // SubjectSeeder::class,
            // StudentSeeder::class,
            // TorSeeder::class
        ]);
    }
}
