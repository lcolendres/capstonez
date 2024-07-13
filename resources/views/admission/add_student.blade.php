@extends('../base')

@section('title', 'Add student')

@section('map_site')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Add Student</h1>
    </div><!-- /.col -->

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admission.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Students</li>
            <li class="breadcrumb-item active">Add Student</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-md-12 p-2 rounded" style="background-color: #dee2e6;">
            <form action="{{ route('admission.add_student') }}" method="POST" id="add_student_form">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="student_id">Student ID</label>
                            <input type="text" name="student_id" id="student_id" class="form-control" value="{{ old('student_id') }}">
                        </div>

                        <div class="form-group">
                            <label for="first_name">Firstname</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}">
                        </div>

                        <div class="form-group">
                            <label for="middle_name">Middlename</label>
                            <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ old('middle_name') }}" placeholder="If none, leave blank">
                        </div>

                        <div class="form-group">
                            <label for="last_name">Lastname</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}">
                        </div>

                        <div class="form-group">
                            <label for="suffix">Suffix</label>
                            <input type="text" name="suffix" id="suffix" class="form-control" value="{{ old('suffix') }}" placeholder="If none, leave blank">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="e.g 09123456789" value="{{ old('contact_number') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="course_id">Course</label>
                            <select name="course_id" id="course_id" class="form-control">
                                <option value="">--- Please select course ---</option>
                                @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="year_level">Year Level</label>
                            <input type="number" min=0 max=5 step=1 name="year_level" id="year_level" class="form-control" value="{{ old('year_level') }}">
                        </div>

                        <div class="form-group">
                            <label for="major">Major (if any)</label>
                            <input type="text" class="form-control" id="major" name="major" value="{{ old('major') }}" placeholder="If none, leave blank">
                        </div>

                        <div class="form-group">
                            <label for="last_school">Name of School Last Attended</label>
                            <input type="text" class="form-control" id="last_school" name="last_school" value="{{ old('last_school') }}">
                        </div>

                        <div class="form-group">
                            <label for="previous_course">Previous Course</label>
                            <input type="text" class="form-control" id="previous_course" name="previous_course" value="{{ old('previous_course') }}">
                        </div>

                        <div class="form-group">
                            <label for="period_of_attendance">Period of Attendance</label>
                            <input type="text" class="form-control" id="period_of_attendance" name="period_of_attendance" value="{{ old('period_of_attendance') }}">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Save student</button>
                <button type="reset" class="btn btn-warning"><i class="fa fa-times"></i> Reset</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('page_custom_script')
<script>
    $(function() {
        // Form validation
        $.validator.setDefaults({
            submitHandler: function (form) {
                form.submit();
            }
        });

        // Add subject modal form validation
        $('#add_student_form').validate({
            rules: {
                student_id: {
                    required: true,
                    digits: true,
                    maxlength: 10,
                },

                first_name: {
                    required: true
                },

                last_name: {
                    required: true
                },

                email: {
                    required: true,
                    email: true
                },

                contact_number: {
                    required: true,
                    validNumber: true,

                },

                course_id: {
                    required: true
                },

                year_level: {
                    required: true,
                    digits: true, 
                },

                last_school: {
                    required: true
                },

                previous_course: {
                    required: true
                },

                period_of_attendance: {
                    required: true
                }
            },

            messages: {
                student_id: {
                    required: "This field is required.",
                    digits: "Only numbers are allowed.",
                    maxlength: "Maximum 10 digits only."
                },

                first_name: {
                    required: "This field is required."
                },

                last_name: {
                    required: "This field is required."
                },

                email: {
                    required: "This field is required.",
                    email: "Please provide a valid email address."
                },

                contact_number: {
                    required: "This field is required.",
                    validNumber: "Please enter a valid phone number."
                },

                course_id: {
                    required: "This field is required."
                },

                year_level: {
                    required: "This field is required.",
                    digits: "Only numbers are allowed.",
                },

                last_school: {
                    required: "This field is required."
                },

                previous_course: {
                    required: "This field is required."
                },

                period_of_attendance: {
                    required: "This field is required."
                }
            },

            errorElement: 'span',

            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },

            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },

            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $.validator.addMethod("validNumber", function(value, element) {
            var filter = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,5}$/;
            if(filter.test(value)) {
                return true;
            } else {
                return false;
            }
        });
    })
</script>
@endsection