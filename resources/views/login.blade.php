<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>USTP Accreditation System | Login Page</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Toastr -->
        <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
        <style>
            body {
                background-color: #E9E4D4;
            }
        </style>
    </head>

    <body>
        <div class="wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- left column -->
                    <div class="col-md-4 offset-md-4" style="top: 30vh">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">USTP | Accreditation System</h3>
                            </div>
                            <!-- /.card-header -->

                            <!-- form start -->
                            <form id="quickForm" action="{{ route('login.authenticate') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" value="{{old('username')}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary text-bold"><i class="fa fa-sign-in-alt"></i> Login</button>
                                    <button type="reset" class="btn btn-warning text-bold"><i class="fa fa-times"></i> Reset</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- jquery-validation -->
        <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
        <!-- Toastr -->
        <script src="../../plugins/toastr/toastr.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

        <!-- Page specific script -->
        <script>
            $(function () {

                @if($errors->any())
                    toastr.error("{{ implode('', $errors->all(':message')) }}")
                @endif

                $.validator.setDefaults({
                    submitHandler: function (form) {
                        form.submit();
                    }
                });

                $('#quickForm').validate({
                    rules: {
                        username: {
                            required: true,
                        },
                        password: {
                            required: true
                        },
                    },

                    messages: {
                        email: {
                            required: "Please enter a email address",
                            email: "Please enter a valid email address"
                        },
                        password: {
                            required: "Please provide a password"
                        },
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
            });
        </script>
    </body>
</html>
