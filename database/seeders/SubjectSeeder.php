<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $subjects = [
            [
                'subject_code'          => "IT111",
                'subject_description'   => "Introduction to Computing",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT112",
                'subject_description'   => "Computer Programming 1",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "PurCom",
                'subject_description'   => "Purposive Communication",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "RPH",
                'subject_description'   => "Readings in Philippine History",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "TCW",
                'subject_description'   => "The Contemporary World",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "MMW",
                'subject_description'   => "Mathematics in the Modern World",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "PATHFit1",
                'subject_description'   => "Movement Competency Training or MCT",
                'unit'                  => 2,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "NSTP101a",
                'subject_description'   => "ROTC 1",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "NSTP101b",
                'subject_description'   => "CWTS 1",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "NSTP101C",
                'subject_description'   => "LTS 1",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT121",
                'subject_description'   => "Computer Programming 2",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT122",
                'subject_description'   => "Data Structures and Algorithms",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT123",
                'subject_description'   => "Discrete Mathematics",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "ArtApp",
                'subject_description'   => "Art Appreciation",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "UTS",
                'subject_description'   => "Understanding the Self",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "STS",
                'subject_description'   => "Science, Technology, and Society",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "PATHFit2",
                'subject_description'   => "Exercised-based Fitness Activities",
                'unit'                  => 2,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "NSTP102a",
                'subject_description'   => "ROTC 2",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "NSTP102b",
                'subject_description'   => "CWTS 2",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "NSTP102C",
                'subject_description'   => "LTS 2",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT211",
                'subject_description'   => "Intro to Human Computer Interaction",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT212",
                'subject_description'   => "Fundamentals of Database System",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT213",
                'subject_description'   => "Platform Technologies",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT214",
                'subject_description'   => "Object Oriented Programming",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT215",
                'subject_description'   => "Accounting Principles",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "EnviSci",
                'subject_description'   => "Environmental Science",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "PATHFit3",
                'subject_description'   => "Physical Activity Towards Health and Fitness 3",
                'unit'                  => 2,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT221",
                'subject_description'   => "Information Management",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT222",
                'subject_description'   => "Networking 1",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT223",
                'subject_description'   => "Web Systems and Technologies",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT224",
                'subject_description'   => "Systems Integration and Architecture 1",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "Ethc",
                'subject_description'   => "Ethics",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "Rizal",
                'subject_description'   => "Life and Works of Rizal",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "PATHFit4",
                'subject_description'   => "Physical Activity Towards Health and Fitness 4",
                'unit'                  => 2,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT311",
                'subject_description'   => "Information Assurance and Security",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT312",
                'subject_description'   => "Networking 2",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT313",
                'subject_description'   => "Mobile Programming",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT314",
                'subject_description'   => "Software Engineering",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT315",
                'subject_description'   => "IT Elective 1",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "ES211a",
                'subject_description'   => "Technopreneurship",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT321",
                'subject_description'   => "CAPSTONE Project and Research 1",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT322",
                'subject_description'   => "Integrative Programming and Technologies",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT323",
                'subject_description'   => "Applications Development and Emerging Technologies",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT324",
                'subject_description'   => "Quantitative Methods",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT325",
                'subject_description'   => "IT Elective 2",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "PICPE",
                'subject_description'   => "Philippine Indigenous Communities and Peace Education",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "FreeElec",
                'subject_description'   => "Foreign Language",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT411",
                'subject_description'   => "CAPSTONE Project and Research 2",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT412",
                'subject_description'   => "System Administration and Maintenance",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT413",
                'subject_description'   => "Social and Professional Issues",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT414",
                'subject_description'   => "IT Elective 3",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT415",
                'subject_description'   => "IT Elective 4",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "GnS",
                'subject_description'   => "Gender and Society",
                'unit'                  => 3,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'subject_code'          => "IT421",
                'subject_description'   => "PRACTICUM (486 hrs)",
                'unit'                  => 6,
                'course_id'             => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
        ];

        \App\Models\Subject::insert($subjects);
    }
}
