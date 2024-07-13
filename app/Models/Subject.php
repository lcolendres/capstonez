<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_code',
        'subject_description',
        'unit',
        'course_id',
        'approver'
    ];

    public function course() {
        return $this->hasMany(Course::class, 'id', 'course_id');
    }

    public function subjectForCredit() {
        return $this->hasMany(SubjectForCredit::class, 'subject_id', 'id');
    }

    public function approver_program() {
        return $this->belongsTo(Course::class, 'approver');
    }
}
