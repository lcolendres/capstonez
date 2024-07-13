<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Mail;
use App\Mail\NotifyChairperson;
use App\Mail\NotifyStudent;

use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use App\Models\Student;
use App\Models\Tor;
use App\Models\Code;
use App\Models\SubjectForCredit;

class AdmissionController extends Controller
{

    // Admission Dashboard - return view
    public function dashboard(Request $request) {
        return view('admission/dashboard');
    }

    // Students view
    public function students_view() {
        return view('admission.students');
    }

    // Get student list
    public function get_student() {
        $students = Student::with('course')->get();

        return response()->json(['data' => $students]);
    }

    // Add student view
    public function add_student_view() {
        $courses = Course::all();

        return view('admission.add_student')->with(['courses' => $courses]);
    }

    // Add student
    public function add_student(Request $request) {
        // Validate data
        $data = $request->validate([
            'student_id' => 'required|unique:students,student_id',
            'first_name' => 'required',
            'middle_name' => '',
            'last_name' => 'required',
            'suffix' => '',
            'email' => 'required|unique:students,email',
            'contact_number' => 'required|unique:students,contact_number',
            'course_id' => 'required|exists:courses,id',
            'year_level' => 'required',
            'major' => '',
            'last_school' => 'required',
            'previous_course' => 'required',
            'period_of_attendance' => 'required'
        ]);

        if(Student::create($data)) {
            return redirect()->route('admission.students_view');
        }
    }

    // Delete student
    public function delete_student($id) {
        $student = Student::findOrFail($id);
        if($student->delete()) {
            return response()->json(['message' => "Record has been deleted successfully"], 200);
        } else {
            return response()->json(['message' => "An error has been encountered."], 500);
        }
    }

    // Edit student view
    public function edit_student($id) {
        $student = Student::where('id', $id)->first();
        $courses = Course::all();

        return view('admission.edit_student')->with([
            'student' => $student,
            'courses' => $courses
        ]);
    }

    // Save changes
    public function save_student_changes(Request $request, $id) {
        // Validate data
        $data = $request->validate([
            'student_id' => 'required',
            'first_name' => 'required',
            'middle_name' => '',
            'last_name' => 'required',
            'suffix' => '',
            'email' => 'required',
            'contact_number' => 'required',
            'course_id' => 'required|exists:courses,id',
            'year_level' => 'required',
            'major' => '',
            'last_school' => 'required',
            'previous_course' => 'required',
            'period_of_attendance' => 'required'
        ]);

        $student = Student::findOrFail($id);

        $student->student_id = $data['student_id'];
        $student->first_name = $data['first_name'];
        $student->middle_name = $data['middle_name'];
        $student->last_name = $data['last_name'];
        $student->suffix = $data['suffix'];
        $student->email = $data['email'];
        $student->contact_number = $data['contact_number'];
        $student->course_id = $data['course_id'];
        $student->year_level = $data['year_level'];
        $student->major = $data['major'];
        $student->last_school = $data['last_school'];
        $student->previous_course = $data['previous_course'];
        $student->period_of_attendance = $data['period_of_attendance'];
        $student->save();

        return redirect()->route('admission.students_view');
    }

    // Student detail
    public function student_details($id) {
        $student = Student::findOrFail($id);
        $course = Course::findOrFail($student->course_id);
        $tors = Tor::where('student_id', $id)->get();

        return view('admission.student_details')->with([
            'student' => $student,
            'course' => $course,
            'tors' => $tors
        ]);
    }

    // Save tor to database
    public function save_tor(Request $request) {
        $destinationPath = 'uploads';
        $files = $request->file('tor');
        foreach($files as $file) {
            // Move uploaded file to storage/public folder
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public', $filename);
            
            // Save to database
            Tor::create([
                'student_id' => $request->input('student_id'),
                'file_path' => $filename
            ]);
        }

        return back();
    }

    // Get TORs
    public function get_tors($id) {
        $tors = Tor::where('student_id', $id)->get();

        return response()->json([
            'data' => $tors
        ]);
    }

    // Delete TOR
    public function delete_tor($id) {
        // Find the TOR data
        $tor = Tor::findOrFail($id);

        // Delete from the storage/public directory
        $file = Storage::delete('public/' . $tor->file_path);

        if($file) {
            if($tor->delete()) {
                return response()->json([
                    'message' => "Record succesfully deleted."
                ]);
            }
        }
    }

    // Map TOR data
    public function map_data($tor_id, $student_id) {
        // Retrieve student data
        $student = Student::findOrFail($student_id);

        // Retrieve TOR from the database
        $tor = Tor::findOrFail($tor_id);

        // Conver image to text
        $file_path = storage_path('app/public/' . $tor->file_path); // Image file path
        $script = base_path('app/Http/Controllers/ocr.py'); // path to ocr python script
        $command = "python {$script} --image {$file_path}"; // Set command
        $tor_raw = null; // Set variable for the output and return
        $escapedCmd = escapeshellcmd($command); // Escape command
        exec($escapedCmd, $tor_raw); // Execute command
        
        // Process the raw TOR data
        $course_subjects = Subject::where('course_id', $student->course_id)->get();
        $tor_raw_collection = collect($tor_raw); // Convert array to collection
        $subjects_to_be_credited = $tor_raw_collection->map(function($item) use ($course_subjects) {
            $subjects_to_be_credited_formatted = array();

            $stopwords = array(" the ", " in ", " and ", " to ", " for ", " ng ", " at ", " sa ", " from ", " of ");    //declare stopwords

            $tor_raw_low_case = strtolower($item); // Transform the TOR data to lowercase
            $tor_raw_remove_stopwords = str_replace($stopwords, " ", $tor_raw_low_case); // remove stopwords from extracted student data

            foreach($course_subjects as $subject) {
                $subject_low_case = strtolower($subject->subject_description); //Convert characters to lowercase
                $subject_remove_stopwords = str_replace($stopwords, " ", $subject_low_case); //remove stopwords from extracted student data

                if(str_contains($tor_raw_remove_stopwords, $subject_remove_stopwords)) {
                    $old_subject_code = explode(" ", $tor_raw_low_case, 3);

                    // Clean data
                    $clean_tor_data = strstr($tor_raw_remove_stopwords, $subject_remove_stopwords); // Remove the tor data subject/course code
                    $clean_grade_unit = trim(preg_replace('/[^\d.-]+/', ' ', str_replace($subject_remove_stopwords, "", $clean_tor_data))); // Remove everything except digits, dots, and optionally a single leading or trailing minus sign. Also remove the leading or trailing space
                    $grade_unit = explode(" ", $clean_grade_unit); // Separate the grade and unit

                    // Check if the units is the same
                    if($grade_unit[1] == $subject->unit) {
                        // Check if the grade pass
                        if($grade_unit[0] <= 3) {
                            // If grade is pass, add data to array for subject to be credited
                            $data = array(
                                'subject_id' => $subject->id,
                                'grade' => $grade_unit[0],
                                'subject_title_to_be_credited' => ucwords($subject_low_case),
                                'subject_code_to_be_credited' => $old_subject_code[0] . " " . $old_subject_code[1]
                            );

                            array_push($subjects_to_be_credited_formatted, $data);
                        }
                    }
                }
            }
            return $subjects_to_be_credited_formatted;
        });

        // Remove null values
        $filterSubjects = array_filter($subjects_to_be_credited->toArray(), function ($value) {
            return $value !== [];
        });

        // dd($filterSubjects);

        if(empty($filterSubjects)) {
            // Update TOR to set the map column to TRUE
            $tor->map = 1;
            $tor->save();

            return response()->json([
                'message'   =>  'No subject to be assess for accreditation.'
            ]);
        } else {
            // Generate code to be sent to the student; format: minutes-seconds-6 random digits
            $reference_code = Carbon::now()->format('is') . "" . rand(100000,999999);

            // Save the new generated code
            $new_code = Code::create(['code' => $reference_code]);

            // Prepare the data to be save to credited_subject_table
            $convert_subject_to_collection = collect($filterSubjects);
            $data_for_saving = $convert_subject_to_collection->map(function($item) use ($student_id, $new_code, $tor_id) {
                $item[0]['student_id'] = $student_id;
                $item[0]['code_id'] = $new_code->id;
                $item[0]['tor_id'] = $tor_id;
                return $item;
            });

            // Save subjects for program chair approval
            foreach($data_for_saving as $subject) {
                SubjectForCredit::create($subject[0]);
            }

            // Retrieve chairperson email
            $chairperson = DB::table('subject_for_credits')
                            ->join('subjects', 'subject_for_credits.subject_id', '=', 'subjects.id')
                            ->join('courses', 'subjects.course_id', '=', 'courses.id')
                            ->join('users', 'courses.chairperson_id', '=', 'users.id')
                            ->where('subject_for_credits.student_id', $student_id)
                            ->select('users.*') // Include users.id in the SELECT statement
                            ->first();

            // // Notify Chairperson
            Mail::to($chairperson->email)->send(new NotifyChairperson($chairperson));

            // Notify Student
            Mail::to($student->email)->send(new NotifyStudent($student, $new_code));

            // Update TOR to set the map column to TRUE
            $tor->map = 1;
            $tor->save();

            return response()->json([
                'message'   =>  'Subject mapped successfully.'
            ]);
        }

    }

    // Get all subject for credit
    public function get_subject_for_credit($student_id) {
        $subjects_for_credit = SubjectForCredit::with('subject')->where('student_id', $student_id)->get();

        return response()->json([
            'data' => $subjects_for_credit
        ]);
    }

    // Get all recommended accreditation for the history
    public function get_history() {
        $credited_subjects = SubjectForCredit::with('student')
                                            ->get();

        return response()->json([
            'data'  => $credited_subjects
        ]);
    }
}
