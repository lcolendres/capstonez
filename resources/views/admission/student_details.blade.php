@extends('../base')

@section('title', 'Student Details')

@section('page_custom_css')
<style>
    .tbl_details tr td:first-child {
        font-weight: bold;
    }
</style>
@endsection

@section('map_site')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Student Details</h1>
    </div><!-- /.col -->

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admission.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Students</li>
            <li class="breadcrumb-item active">{{ $student->last_name }}, {{ $student->first_name }}</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <!-- Student details -->
            <div class="col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered tbl_details">
                            <tbody>
                                <tr>
                                    <td>Student ID</td>
                                    <td>{{ $student->student_id }}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $student->last_name }}, {{ $student->first_name }} @if($student->middle_name){{ strtoupper($student->middle_name[0]) }}. @endif{{ $student->suffix }}</td>
                                </tr>
                                <tr>
                                    <td>Email Address</td>
                                    <td>{{ $student->email }}</td>
                                </tr>
                                <tr>
                                    <td>Contact Number</td>
                                    <td>{{ $student->contact_number }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                    <table class="table table-bordered tbl_details">
                            <tbody>
                                <tr>
                                    <td>Academic Program</td>
                                    <td>{{ $course->course_name }}</td>
                                </tr>
                                <tr>
                                    <td>Year Level</td>
                                    <td>{{ $student->year_level }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.Student details -->
        </div>

        <!-- List of TORs -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Transcript of Record (TOR)</h4>

                        <button type="button" class="btn btn-default btn-outline-primary" data-toggle="modal" data-target="#modal-uploadTOR">
                            <i class="fa fa-plus"></i> Upload TOR
                        </button>

                        <table class="table table-bordered table-hovered text-center" id="tbl_tor">
                            <thead>
                                <tr>
                                    <th>Filename</th>
                                    <th>Date Uploaded</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.List of TORs -->

        <!-- Add new course modal -->
        <div class="modal fade" id="modal-uploadTOR">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New File</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('admission.save_tor') }}" method="POST" id="tor_form" enctype="multipart/form-data">
                        <div class="modal-body">
                                @csrf
                                <div class="form-group">
                                    <label for="tor">Filename</label>
                                    <input type="file" name="tor[]" class="form-control" id="tor" multiple>
                                    <input type="hidden" name="student_id" class="form-control" id="student_id" value="{{ $student->id }}" readonly>
                                </div>
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
        <!-- /.Add new course modal -->

        <!-- Subject for accreditation -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Subject to be Accredited</h4>

                        <table class="table table-bordered table-hovered text-center" id="tbl_accre">
                            <thead>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Data uploaded</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.Subject for accreditation -->
    </div>
</div>
@endsection

@section('page_custom_script')
<script>
    $(function() {
        // TORs Table
        const tableTor = $('#tbl_tor').DataTable({
            ajax: "{{ url('admission/get_tors') }}/{{ $student->id }}",
            columns: [
                { 
                    data: 'file_path',
                    render: function(data, type, row, meta) {
                        return "<a href=\"{{ url('storage')}}/" + data + "\" target=\"_blank\">" + data + "</a>"
                    }
                },
                { 
                    data: 'created_at',
                    render: function(data, type, row, meta) {
                        return moment().format('L');
                    }
                },
                { 
                    data: 'map',
                    render: function(data, type, row, meta) {
                        if(data) {
                            return "Data mapped";
                        } else {
                            return "Pending";
                        }
                    }
                },
                { 
                    data: null,
                    render: function(data, type, row, meta) {
                        if(data.map) {
                            return `<button type="button" class="btn btn-primary btn-sm mapTorBtn" title="Map Data" disabled><i class="fa fa-spinner"></i></button> <button type="button" class="btn btn-warning btn-sm deleteTorBtn" title="Delete"><i class="fa fa-trash-alt"></i></button>`
                        } else {
                            return `<button type="button" class="btn btn-primary btn-sm mapTorBtn" title="Map Data"><i class="fa fa-spinner"></i></button> <button type="button" class="btn btn-warning btn-sm deleteTorBtn" title="Delete"><i class="fa fa-trash-alt"></i></button>`
                        }
                    }
                }
            ],
            responsive: true, 
            lengthChange: false, 
            autoWidth: false,
        });

        // Accreditation Table
        const tableAccre = $('#tbl_accre').DataTable({
            ajax: "{{ url('admission/subjects_for_credit') }}/{{ $student->id }}",
            columns: [
                { 
                    data: 'subject',
                    render: function(data, type, row, meta) {
                        return data.subject_code;
                    }
                },
                {
                    data: 'subject',
                    render: function(data, type, row, meta) {
                        return data.subject_description;
                    }
                },
                { 
                    data: 'status',
                    render: function(data, type, row, meta) {
                        if(data == 1) {
                            return '<span class="badge badge-secondary">Pending</span>';
                        } else if (data == 2) {
                            return '<span class="badge badge-success">Approved</span>';
                        } else if(data == 3) {
                            return '<span class="badge badge-danger">Denied</span>';
                        }
                    }
                },
                {
                    data: 'created_at',
                    render: function(data, type, row, meta) {
                        return moment().format('L');
                    }
                },
            ],
            responsive: true, 
            lengthChange: false, 
            autoWidth: false,
        });

        // Modal form validation
        $.validator.setDefaults({
            submitHandler: function (form) {
                form.submit();
            }
        });

        // Upload TOR modal form validation
        $('#tor_form').validate({
            rules: {
                'tor[]': {
                    required: true,
                    extension: "jpg|jpeg|png"
                },
            },

            messages: {
                'tor[]': {
                    required: "This field is required.",
                    extension: "JPG,JPEG,PNG only are allowed."
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

        // Delete button
        // Delete button function
        tableTor.on('click', 'td button.deleteTorBtn', function() {
            var data = tableTor.row($(this).parents('tr')).data();
            Swal.fire({
                title: "Delete Confirmation",
                text: "Are you sure you want to delete this record?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "Cancel"
            }).then(function(result) {
                if(result.value) {
                    $.ajax({
                        url: "{{ url('/admission/tor') }}/" + data.id,
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

                            tableTor.ajax.reload();
                        },
                        error: function(xhr, response, error) {
                            console.log(error);
                        }
                    });
                }
            });
        })
        // /.Delete button

        // Map TOR data
        tableTor.on('click', 'td button.mapTorBtn', function() {
            var data = tableTor.row($(this).parents('tr')).data();
            Swal.fire({
                title: "Please wait for a while.",
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "{{ url('admission/tor') }}/" + data.id + "/" + data.student_id,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    Swal.fire({
                        title: "",
                        text: response.message,
                        icon: "info"
                    });

                    tableTor.ajax.reload();
                    tableAccre.ajax.reload();
                },
                error: function(xhr, errStatus, error) {
                    console.log(error);
                }
            });
        })
        // /.Map TOR data
    })
</script>
@endsection