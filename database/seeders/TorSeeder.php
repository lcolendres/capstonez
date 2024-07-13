<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tors = [
            [
                'student_id' => 1,
                'file_path' => "65a6200e1c56f_sample1.jpg",
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'student_id' => 1,
                'file_path' => "65a6200e2073f_sample2.jpg",
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ];

        \App\Models\Tor::insert($tors);
    }
}
