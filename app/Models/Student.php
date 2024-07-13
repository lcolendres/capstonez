<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'email',
        'contact_number',
        'course_id',
        'year_level',
        'major',
        'last_school',
        'previous_course',
        'period_of_attendance'
    ];

    public function course() {
        return $this->hasMany(Course::class, 'id', 'course_id');
    }

    public function credited_subject() {
        return $this->hasMany(SubjectForCredit::class, 'student_id', 'id');
    }
}
