@extends('../base')

@section('title', 'Subjects')

@section('map_site')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">{{ $course->course_name }}</h1>
    </div><!-- /.col -->

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admission.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Courses</li>
            <li class="breadcrumb-item active">{{ $course->course_code }}</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <button type="button" class="btn btn-default btn-outline-primary" data-toggle="modal" data-target="#modal-newSubject">
            <i class="fa fa-plus"></i> Add subject
        </button>

        @if(session()->has('message'))
            <div class="alert alert-danger mt-2">
                {{ session()->get('message') }}
            </div>
        @endif

        <table class="table table-bordered table-hover text-center" id="tbl_subjects">
            <thead>
                <tr>
                    <th>Course/Subject Code</th>
                    <th>Description</th>
                    <th>Unit</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Add new subject modal -->
    <div class="modal fade" id="modal-newSubject">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add subject</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('superadmin.save_subject') }}" method="POST" id="addSubject_form">
                        <div class="modal-body">
                                @csrf
                                <div class="form-group">
                                    <label for="subject_code">Course/Subject Code</label>
                                    <input type="text" name="subject_code" class="form-control" id="subject_code">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" class="form-control" id="description">
                                </div>

                                <div class="form-group">
                                    <label for="unit">Unit</label>
                                    <input type="number" min=0 step=1 name="unit" class="form-control" id="unit">
                                </div>

                                <div class="form-group">
                                    <label for="approver">Under what program</label>
                                    <select name="approver" id="approver" class="form-control">
                                        <option value="">--- Please select the program this course is under ---</option>
                                        @foreach ($programs as $program)
                                        <option value="{{ $program->id }}">{{ $program->course_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- /.Add new subject modal -->

        <!-- Edit course modal -->
        <div class="modal fade" id="modal-editSubject">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit subject</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form method="POST" id="editSubject_form">
                        <div class="modal-body">
                                @csrf
                                <div class="form-group">
                                    <label for="edit_subject_code">Course/Subject Code</label>
                                    <input type="text" name="edit_subject_code" class="form-control" id="edit_subject_code">
                                </div>

                                <div class="form-group">
                                    <label for="edit_description">Description</label>
                                    <input type="text" name="edit_description" class="form-control" id="edit_description">
                                </div>

                                <div class="form-group">
                                    <label for="edit_unit">Unit</label>
                                    <input type="number" min=0 step=1 name="edit_unit" class="form-control" id="edit_unit">
                                </div>

                                <div class="form-group">
                                    <label for="edit_approver">Under what program</label>
                                    <select name="edit_approver" id="edit_approver" class="form-control">
                                        <option value="">--- Please select the program this course is under ---</option>
                                        @foreach ($programs as $program)
                                        <option value="{{ $program->id }}">{{ $program->course_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" value="{{ $course->id }}" name="course_id" readonly>
                                </div>
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update changes</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- /.Edit course modal -->
</div>
@endsection

@section('page_custom_script')
<script>
$(function() {
    // Initialize datatable
    const subjectTable = $("#tbl_subjects").DataTable({
        ajax: "{{ url('/superadmin/subjects') }}/" + {{ $course->id }},
        columns: [
            { 
                data: 'subject_code',
                width: '15%'
            },
            { data: 'subject_description' },
            { data: 'unit' },
            { 
                data: 'id', 
                render: function(data, type, row, meta) {
                    return `<button type="button" class="btn btn-primary btn-sm editSubjectBtn" title="Edit"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-warning btn-sm deleteSubjectBtn" title="Delete"><i class="fa fa-trash-alt"></i></button>`
                },
                width: '10%'
            },
        ],
        responsive: true, 
        lengthChange: false, 
        autoWidth: false,
    });

    // Delete button function
    subjectTable.on('click', 'td button.deleteSubjectBtn', function() {
        var data = subjectTable.row($(this).parents('tr')).data();
        Swal.fire({
            title: "Delete Confirmation",
            text: "Are you sure you want to delete " + data.subject_description + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, delete!",
            cancelButtonText: "Cancel"
        }).then(function(result) {
            if(result.value) {
                $.ajax({
                    url: "{{ url('/superadmin/subject/') }}/" + data.id,
                    type: "DELETE",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Success Message",
                            text: response.message,
                            icon: "info"
                        });

                        subjectTable.ajax.reload();
                    },
                    error: function(xhr, response, error) {
                        console.log(error);
                    }
                });
            }
        });
    })
    // End delete button

    // Edit button function
    subjectTable.on('click', 'td button.editSubjectBtn', function() {
        var data = subjectTable.row($(this).parents('tr')).data();

        // Retrieve data
        $.ajax({
            url: "{{ url('/superadmin/subject') }}/" + data.id,
            type: "GET",
            dataType: 'json',
            success: function(response) {
                // Show modal
                $('#editSubject_form').attr('action', "{{ url('/superadmin/subject') }}/" + data.id + "/edit");
                $('#modal-editSubject').modal('show');
                $('#edit_subject_code').val(response.subject.subject_code);
                $('#edit_description').val(response.subject.subject_description);
                $('#edit_unit').val(response.subject.unit);
                if (response.subject.approver) {
                    $('#edit_approver option[value="' + response.subject.approver + '"]').prop('selected', true);
                } else {
                    $('#edit_approver option[value=""]').prop('selected', true);
                }
            },
            error: function(xhr, response, error) {
                console.log(error);
            }
        });
    });
    // End edit subject

    // Form validation
    $.validator.setDefaults({
        submitHandler: function (form) {
            form.submit();
        }
    });

    // Add subject modal form validation
    $('#addSubject_form').validate({
        rules: {
            subject_code: {
                required: true,
            },
            
            description: {
                required: true,
            },

            unit: {
                required: true,
                number: true,
            },

            approver: {
                required: true,
            }
        },

        messages: {
            subject_code: {
                required: "Please enter the course/subject code.",
            },

            description: {
                required: "Please enter the subject description.",
            },

            unit: {
                required: "Please select the subject unit(s).",
                number: "Please input a valid numeric value."
            },

            approver: {
                required: "Please select the program this subject is under.",
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

    // Edit subject modal form validation
    $('#editSubject_form').validate({
        rules: {
            edit_subject_code: {
                required: true,
            },
            
            edit_description: {
                required: true,
            },

            edit_unit: {
                required: true,
                number: true,
            },

            edit_chairperson: {
                required: true
            },

            edit_approver: {
                required: true
            },
        },

        messages: {
            edit_subject_code: {
                required: "Please enter the course/subject code.",
            },

            edit_description: {
                required: "Please enter the subject description.",
            },

            edit_unit: {
                required: "Please select the subject unit(s).",
                number: "Please input a valid numeric value."
            },

            edit_chairperson: {
                required: "Please select the Program/Area Chairperson for this subject.",
            },

            edit_approver: {
                required: "Please select the program this subject is under.",
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
    // End of form validation
});
</script>
@endsection