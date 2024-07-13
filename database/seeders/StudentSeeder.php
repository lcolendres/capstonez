<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Student::create([
            'student_id' => '2018102520',
            'first_name' => 'Lorenzo',
            'middle_name' => 'Uy',
            'last_name' => 'Colendres',
            'suffix' => '',
            'email' => 'lorenzocolendres123@gmail.com',
            'contact_number' => '09161519112',
            'course_id' => 1,
            'year_level' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
