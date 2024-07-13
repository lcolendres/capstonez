@extends('../base')

@section('title', 'Chairperson')

@section('map_site')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Subject/s for accreditation</h1>
    </div><!-- /.col -->

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admission.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">{{ $student->last_name }}, {{ $student->first_name }}</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover text-center" id="tbl_forAccre">
            <thead>
                <tr>
                    <th colspan=3>Subjects to be Accredited</th>
                    <th rowspan=2 class="align-middle">Accredited to (Subject Code & Descriptive Title)</th>
                    <th rowspan=2 class="align-middle">Grade</th>
                    <th rowspan=2 class="align-middle">Actions</th>
                </tr>
                <tr>
                    <th>Subject Code</th>
                    <th>Descriptive Title</th>
                    <th>Units</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('page_custom_script')
<script>
    $(function() {
        var tableForAccre = $('#tbl_forAccre').DataTable({
            ajax: "{{ url('/chairperson/student') }}/" + {{ $student->id }} + "/subjects/",
            columns: [
                { data: 'subject_code_to_be_credited' },
                { data: 'subject_title_to_be_credited' },
                { data: 'subject.unit' },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return data.subject.subject_code + ' - ' + data.subject.subject_description
                    }
                },
                { data: 'grade' },
                { 
                    data: null,
                    render: function(data, type, row, meta) {
                        if(data.subject.approver_program.chairperson.id == {{ auth()->user()-> id}}) {
                            if(data.status == 1) {
                                return `
                                    <a href="{{ url('storage') }}/${data.tor.file_path}" target="_blank" class="btn btn-sm btn-secondary">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-primary approve">
                                        <i class="fa fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger denied">
                                        <i class="fa fa-times"></i>
                                    </button>`
                            } else if(data.status == 2) {
                                return `<span class="badge badge-primary">Approved</span></td>`
                            } else {
                                return `<span class="badge badge-danger">Denied</span></td>`
                            }
                        } else {
                            if(data.status == 1) {
                                return `
                                    <a href="{{ url('storage') }}/${data.tor.file_path}" target="_blank" class="btn btn-sm btn-secondary disabled">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-primary approve" disabled>
                                        <i class="fa fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger denied" disabled>
                                        <i class="fa fa-times"></i>
                                    </button>`
                            } else if(data.status == 2) {
                                return `<span class="badge badge-primary">Approved</span></td>`
                            } else {
                                return `<span class="badge badge-danger">Denied</span></td>`
                            }
                        }
                    }
                }
            ],
            responsive: true, 
            lengthChange: false, 
            autoWidth: false,
        });

        tableForAccre.on('click', 'button.approve', function() {
            Swal.fire({
                title: "Confirmation",
                text: "Approved this accreditation?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: "Approve",
                denyButtonText: 'Cancel'
                }).then( async (result) => {
                if (result.isConfirmed) {
                    try {
                        Swal.showLoading()
                        var data = tableForAccre.row($(this).parents('tr')).data();
                        
                        return new Promise((resolve, reject) => {
                            $.ajax({
                                url: "{{ url('/chairperson/accredit') }}/" + data.id + "/approved",
                                type: "PUT",
                                dataType: "json",
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    tableForAccre.ajax.reload();
                                    resolve(response)
                                },
                                error: function(xhr, errorStatus, error) {
                                    console.log(error)
                                    reject(error)
                                }
                            });
                        })
                    } catch (err) {
                        console.log(err)
                    }
                }
            });
        });

        tableForAccre.on('click', 'button.denied', function() {
            Swal.fire({
                title: "Confirmation",
                icon: 'question',
                html: '<h5>Deny this accreditation?</h5><textarea name="remarks" id="remarks" placeholder="Please provide a reason for denying" class="form-control" required></textarea>',
                showCancelButton: true,
                confirmButtonText: "Deny",
                denyButtonText: 'Cancel',
                preConfirm: async () => {
                    try {
                        Swal.showLoading();
                        
                        // Check if the required field is filled
                        if ($('#remarks').val() == "") {
                            Swal.showValidationMessage('Please provide a reason for denying.');
                            return false; // Prevents the promise from resolving
                        }

                        // Proceed
                        var data = tableForAccre.row($(this).parents('tr')).data();

                        return new Promise((resolve, reject) => {
                            $.ajax({
                                url: "{{ url('/chairperson/accredit') }}/" + data.id + "/denied",
                                type: "PUT",
                                dataType: "json",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    "remarks": $('#remarks').val()
                                },
                                success: function(response) {
                                    tableForAccre.ajax.reload();
                                    resolve(response)
                                },
                                error: function(xhr, errorStatus, error) {
                                    console.log(error)
                                    reject(error)
                                }
                            });
                        })
                    } catch (err) {
                        console.log(err)
                    }
                }
            })
        });
    })
</script>
@endsection