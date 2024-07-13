@extends('../base')

@section('title', 'System Administrator')

@section('map_site')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
    </div><!-- /.col -->

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h2>List of Users</h2>

        <button type="button" class="btn btn-default btn-outline-primary" data-toggle="modal" data-target="#modal-newUser">
            <i class="fa fa-plus"></i> Add User
        </button>

        <table class="table table-bordered table-hover text-center" id="tbl_users">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Add new user modal -->
    <div class="modal fade" id="modal-newUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add new user</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('superadmin.add_user') }}" method="POST" id="newUser_form">
                    <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="first_name">Firstname</label>
                                <input type="text" name="first_name" class="form-control" id="first_name">
                            </div>

                            <div class="form-group">
                                <label for="middle_name">Middlename</label>
                                <input type="text" name="middle_name" class="form-control" id="middle_name">
                            </div>

                            <div class="form-group">
                                <label for="last_name">Lastname</label>
                                <input type="text" name="last_name" class="form-control" id="last_name">
                            </div>

                            <div class="form-group">
                                <label for="suffix">Suffix</label>
                                <input type="text" name="suffix" class="form-control" id="suffix">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" readonly>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>

                            <div class="form-group">
                                <label for="role">User Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="">--- Please select the user role ---</option>
                                    <option value="0">System Administrator</option>
                                    <option value="1">Admission</option>
                                    <option value="2">Chairperson</option>
                                    <option value="3">Dean</option>
                                </select>
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
    <!-- /.Add new user modal -->

    <!-- Edit user modal -->
    <div class="modal fade" id="modal-editUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit user</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" id="editUser_form">
                    <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="edit_first_name">Firstname</label>
                                <input type="text" name="edit_first_name" class="form-control" id="edit_first_name">
                            </div>

                            <div class="form-group">
                                <label for="edit_middle_name">Middlename</label>
                                <input type="text" name="edit_middle_name" class="form-control" id="edit_middle_name">
                            </div>

                            <div class="form-group">
                                <label for="edit_last_name">Lastname</label>
                                <input type="text" name="edit_last_name" class="form-control" id="edit_last_name">
                            </div>

                            <div class="form-group">
                                <label for="edit_suffix">Suffix</label>
                                <input type="text" name="edit_suffix" class="form-control" id="edit_suffix">
                            </div>

                            <div class="form-group">
                                <label for="edit_email">Email</label>
                                <input type="email" name="edit_email" class="form-control" id="edit_email">
                            </div>

                            <div class="form-group">
                                <label for="edit_username">Username</label>
                                <input type="text" name="edit_username" class="form-control" id="edit_username" readonly>
                            </div>

                            <div class="form-group">
                                <label for="edit_role">User Role</label>
                                <select name="edit_role" id="edit_role" class="form-control">
                                    <option value="">--- Please select the user role ---</option>
                                    <option value="0">System Administrator</option>
                                    <option value="1">Admission</option>
                                    <option value="2">Chairperson</option>
                                    <option value="3">Dean</option>
                                </select>
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
    <!-- /.Edit user modal -->
</div>
@endsection

@section('page_custom_script')
<script>
    $(function() {
        // Modal form validation
        // New course modal form validation
        $('#newUser_form').validate({
            submitHandler: function (form) {
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    success: function(response) {
                        // Handle success
                        usersTable.ajax.reload();
                        Swal.fire({
                            text: "User successfully added.",
                            icon: "success"
                        });
                        $('#first_name').val('');
                        $('#middle_name').val('');
                        $('#last_name').val('');
                        $('#suffix').val('');
                        $('#email').val('');
                        $('#username').val('');
                        $('#password').val('');
                        $('#role').val('');
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        var jsonResponse = xhr.responseJSON;
                        if (jsonResponse) {
                            $.each(jsonResponse.errors, function(key, value) {
                                // Display the error message below the corresponding input field
                                $('[name="' + key + '"]').after('<span style="font-size: 80%; color: #dc3545;" class="error_msg" >' + value + '</span>');
                            });
                        }
                    }
                });
            },

            rules: {
                first_name: {
                    required: true,
                },

                last_name: {
                    required: true,
                },

                email: {
                    required: true,
                    email: true
                },

                password: {
                    required: true,
                    minlength: 6,
                },

                role: {
                    required: true,
                }
            },

            messages: {
                first_name: {
                    required: "This field is required.",
                },

                last_name: {
                    required: "This field is required.",
                },

                email: {
                    required: "This field is required.",
                    email: "Invalid email address."
                },

                password: {
                    required: "This field is required.",
                    minlength: "Password must be at least 6 characters long."
                },

                role: {
                    required: "This field is required.",
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
        // /.New user validation

        // Edit user validation
        $('#editUser_form').validate({
            submitHandler: function (form) {
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    success: function(response) {
                        // Handle success
                        Swal.fire({
                            text: "User successfully added.",
                            icon: "success"
                        }).then((result) => {
                            window.location.reload();
                        });
                        
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.log(xhr);
                        var jsonResponse = xhr.responseJSON;
                        if (jsonResponse) {
                            $.each(jsonResponse.errors, function(key, value) {
                                // Display the error message below the corresponding input field
                                $('[name="' + key + '"]').after('<span style="font-size: 80%; color: #dc3545;" class="error_msg" >' + value + '</span>');
                            });
                        }
                    }
                });
            },

            rules: {
                edit_first_name: {
                    required: true,
                },

                edit_last_name: {
                    required: true,
                },

                edit_email: {
                    required: true,
                    email: true
                },

                edit_role: {
                    required: true,
                }
            },

            messages: {
                edit_first_name: {
                    required: "This field is required.",
                },

                edit_last_name: {
                    required: "This field is required.",
                },

                edit_email: {
                    required: "This field is required.",
                    email: "Invalid email address."
                },

                edit_role: {
                    required: "This field is required.",
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
        // /.Edit user validation

        // Initialize User table
        var usersTable = $('#tbl_users').DataTable({
            ajax: "{{ route('superadmin.get_users') }}",
            columns: [
                { 
                    data: null,
                    render: function(data, type, row, meta) {
                        return data.first_name + " " + (data.middle_name == null ? "" : data.middle_name[0] + ".") + " " + data.last_name + " " + (data.suffix == null ? "" : data.suffix)
                    }
                },
                {
                    data: null, 
                    render: function(data, type, row, meta) {
                        if(data.role == 1) {
                            return "Admission"
                        } else if(data.role == 2) {
                            return "Program Chairperson"
                        } else if(data.role == 3) {
                            return "Dean"
                        } else if(data.role == 0) {
                            return "Superuser"
                        }
                    }
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        if(data.role != 0) {
                            return '<button type="button" class="btn btn-primary btn-sm editUserBtn" title="Edit"><i class="fa fa-edit"></i></button> <button type="button" class="btn btn-warning btn-sm deleteUserBtn" title="Delete"><i class="fa fa-trash-alt"></i></button>'
                        } else {
                            return '-'
                        }
                    }
                },
            ],
            responsive: true, 
            lengthChange: false, 
            autoWidth: false,
        });

        // Delete button function
        usersTable.on('click', 'td button.deleteUserBtn', function() {
            var data = usersTable.row($(this).parents('tr')).data();
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
                        url: "{{ url('/superadmin/user') }}/" + data.id,
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

                            usersTable.ajax.reload();
                        },
                        error: function(xhr, response, error) {
                            console.log(error);
                        }
                    });
                }
            });
        })

        // Edit button
        usersTable.on('click', 'td button.editUserBtn', function() {
            var data = usersTable.row($(this).parents('tr')).data();

            // Retrieve user data
            $.ajax({
                url: "{{ url('/superadmin/user') }}/" + data.id,
                type: "GET",
                dataType: 'json',
                success: function(response) {
                    // Show modal
                    $('#editUser_form').attr('action', "{{ url('/superadmin/user') }}/" + data.id + "/edit");
                    $('#modal-editUser').modal('show');
                    $('#edit_first_name').val(response.user.first_name);
                    $('#edit_middle_name').val(response.user.middle_name);
                    $('#edit_last_name').val(response.user.last_name);
                    $('#edit_suffix').val(response.user.suffix);
                    $('#edit_email').val(response.user.email);
                    $('#edit_username').val(response.user.username);
                    $('#edit_role option[value="' + response.user.role + '"]').prop('selected', true);
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                }
            });
        });

        // Username
        $('#first_name').on('keyup', function() {
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();

            $('#username').val(first_name.replace(/\s/g, '').toLowerCase() + "." + last_name.replace(/\s/g, '').toLowerCase());
        });

        $('#last_name').on('keyup', function() {
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();

            $('#username').val(first_name.replace(/\s/g, '').toLowerCase() + "." + last_name.replace(/\s/g, '').toLowerCase());
        });

        // Email remove error message
        $('#email').on('keyup', function() {
            $('.error_msg').css('display', 'none');
        });

        // Edit Username
        $('#edit_first_name').on('keyup', function() {
            var first_name = $('#edit_first_name').val();
            var last_name = $('#edit_last_name').val();

            $('#edit_username').val(first_name.replace(/\s/g, '').toLowerCase() + "." + last_name.replace(/\s/g, '').toLowerCase());
        });

        $('#edit_last_name').on('keyup', function() {
            var first_name = $('#edit_first_name').val();
            var last_name = $('#edit_last_name').val();

            $('#edit_username').val(first_name.replace(/\s/g, '').toLowerCase() + "." + last_name.replace(/\s/g, '').toLowerCase());
        });

        // Email remove error message
        $('#edit_email').on('keyup', function() {
            $('.error_msg').css('display', 'none');
        });
    })
</script>
@endsection