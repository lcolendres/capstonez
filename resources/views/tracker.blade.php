<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'USTP')</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
        <style>
            body {
                background-color: #ececec;
                padding: 50px;
            }
        </style>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('img/ustp-logo.png') }}" alt="USTP Logo" style="border-radius: 5%;">
        </div>

        <!-- Main content -->
        <section class="content mt-5">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 text-center">
                        <img src="{{ asset('img/site-logo.png') }}" alt="USTP Accreditation System Logo" class="img-fluid">

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" autocomplete="off" placeholder="Enter tracking code" id="tracking_code">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="searchBtn"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card" id="student_data" style="display: none;">
                            <div class="card-body">
                                <div class="">
                                    <h4>Student Details</h4>
                                    <span id="student"></span>
                                </div>

                                <a target="_blank" id="printBtn" class="btn btn-primary float-right mb-2">
                                    <i class="fa fa-print"></i> Print
                                </a>

                                <div class="table-responsive">
                                    <table class="table table-bordered text-center" id="student_data_tbl">
                                        <thead>
                                            <tr>
                                                <th colspan="3">Subjects to be Accredited</th>
                                                <th rowspan="2" class="align-middle">Accredited to (Subject Code & Descriptive Title)</th>
                                                <th rowspan="2" class="align-middle">Remarks</th>
                                            </tr>
                                            <tr>
                                                <th>Subject Code</th>
                                                <th>Descriptive Title</th>
                                                <th>Units</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <cite style="color:red;"><span style="font-weight: bold;">Notice:</span> The print button will only be available once your corresponding program chairperson validates your subject accreditation request.</cite>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('dist/js/adminlte.js') }}"></script>
        <!-- jquery-validation -->
        <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

        <script>
            $(function() {
                // Search Button
                $('#searchBtn').on('click', function() {
                    if ($('#tracking_code').val() == "") {
                        alert('Enter tracking code');
                    } else {
                        $.ajax({
                            url: "{{ url('/get_status') }}/" + $('#tracking_code').val(),
                            type: "GET",
                            dataType: "json",
                            success: function(response) {
                                var html = "";

                                $('#student_data').css('display', 'block');
                                for (var i = 0; i <= response.data.length - 1; i++) {
                                    if (response.data[i].recom_app == 0) {
                                        // Disable print button
                                        $('#printBtn').addClass("disabled");
                                    }
                                }

                                for (var i = 0; i <= response.data.length - 1; i++) {

                                    html += 
                                        `<tr>
                                            <td>${ response.data[i].subject_code_to_be_credited }</td>
                                            <td>${ response.data[i].subject_title_to_be_credited }</td>
                                            <td>${ response.data[i].subject.unit }</td>
                                            <td>${ response.data[i].subject.subject_code } - ${ response.data[i].subject.subject_description }</td>`;

                                    if (response.data[i].status == 1) {
                                        html +=
                                        `
                                            <td><span class="badge badge-secondary">Pending</span></td>
                                        </tr>
                                        `
                                    } else if (response.data[i].status == 2) {
                                        html +=
                                        `
                                        <td><span class="badge badge-primary">Approved</span></td>
                                        </tr>
                                        `
                                    } else if (response.data[i].status == 3) {
                                        html +=
                                        `
                                        <td><span class="badge badge-danger">Denied</span></td>
                                        </tr>
                                        `
                                    }
                                }

                                $('#student_data_tbl tbody').html(html);

                                var student_details = `<h5><span style="font-weight: bold;">Student ID:</span> ${ response.student.student_id }</h5>`
                                if (response.student.suffix != null) {
                                student_details += `<h5><span style="font-weight: bold;">Name:</span> ${ response.student.last_name }, ${ response.student.first_name } ${ response.student.suffix } ${ response.student.middle_name }</h5>`
                                } else {
                                student_details += `<h5><span style="font-weight: bold;">Name:</span> ${ response.student.last_name }, ${ response.student.first_name } ${ response.student.middle_name }</h5>`
                                }
                                student_details += `<h5><span style="font-weight: bold;">Course:</span> ${ response.student.course[0].course_name }</h5>`
                                $('#student').html(student_details)

                                // Print Button
                                $('#printBtn').attr('href', `{{ url('/generate_pdf') }}/${$('#tracking_code').val()}`);
                            },
                            error: function(xhr, errorStatus, error) {
                                $('#student_data').css('display', 'none');
                                alert("No data found pertaining the tracking code: " + $('#tracking_code').val());
                            }
                        });
                    }
                });
            })
        </script>
    </body>
</html>