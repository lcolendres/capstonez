<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use App\Models\SubjectForCredit;

class DeanController extends Controller
{
    //
    public function dashboard() {
        return view('dean/students_list');
    }

    // Upload e-sig
    public function upload_esig($user_id) {
        $user = User::findOrFail($user_id);

        return view('dean.upload_esig')->with([
            'user' => $user
        ]);
    }

    // Save e-sig
    public function save_upload_esig(Request $request, $user_id) {
        // Validate
        $messages = [
            'e_signature.required' => 'Please select a file.',
            'e_signature.mimes' => 'Only JGP, JPEG, PNG files are allowed.',
            'e_signature.max' => 'The file size may not exceed 2048 kilobytes.',
        ];
    

        $uploadedFile = $request->validate([
            'e_signature' => 'required|mimes:jpg,png,jpeg|max:2048'
        ], $messages);


        $file = $request->file('e_signature');
        $filename = uniqid() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public', $filename);

        // Save to database
        $user = User::findOrFail($user_id);
        $user->esignature = $filename;
        $user->save();

        return back()->with('success','You have successfully upload file.')
                    ->with('e_signature', $filename);
    }

    // Get all students for approval
    public function for_approval_list() {
        $courses = array();
        $courses_list = Course::where('dean_id', auth()->user()->id)->get();

        foreach($courses_list as $course) {
            array_push($courses, $course->id);
        }

        $students = Student::with('credited_subject')
                            ->with('course')
                            ->whereIn('course_id', $courses)
                            ->whereHas('credited_subject', function ($query) {
                                $query->whereNotNull('id')
                                        ->where('recom_app', 1)
                                        ->where('approved', 0);
                            })
                            ->get();

        return response()->json([
            'data'  => $students
        ]);
    }

    // PDF View
    public function generate_pdf($code_id) {
        $creditedSubjects = SubjectForCredit::with('subject')
                                            ->with('subject.approver_program.chairperson')
                                            ->where('code_id', $code_id)
                                            ->get();
                                            
        $student_course = Student::where('id', $creditedSubjects[0]->student_id)->first();
        
        $course = Course::with('chairperson')
                        ->with('dean')
                        ->where('id', $student_course->course_id)
                        ->first();

        $student = Student::with('course')->where('id', $creditedSubjects[0]->student_id)->first();

        $data = [
            'student'           => $student,
            'creditedSubjects'  => $creditedSubjects,
            'course'            => $course
        ];

        $pdf = Pdf::loadView('pdf.pdf_template', $data);
        return $pdf->stream('sample.pdf');
    }

    // Approved
    public function approved($student_id, $code_id) {
        $credited_subjects = SubjectForCredit::where('student_id', $student_id)
                                                ->where('code_id', $code_id)
                                                ->get();

        foreach($credited_subjects as $subject) {
            $subject->approved = 1;
            $subject->save();
        }

        return response()->json([
            'subjects' => $credited_subjects
        ]);
    }
}
