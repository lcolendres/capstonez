<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectForCredit extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'code_id',
        'grade',
        'status',
        'subject_code_to_be_credited',
        'subject_title_to_be_credited',
        'recom_app',
        'approved',
        'tor_id'
    ];

    public function subject() {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function tor() {
        return $this->belongsTo(Tor::class, 'tor_id');
    }
}
