@extends('../base')

@section('title', 'Courses')

@section('map_site')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Validation</h1>
    </div><!-- /.col -->

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Validate Student</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover text-center" id="tbl_validate">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Year Level</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('page_custom_script')
<script>
    $(function() {
        // DataTable setup
        const validateTable = $("#tbl_validate").DataTable({
            ajax: "{{ route('chairperson.recommend') }}",
            columns: [
                {
                    data: null, 
                    render: function(data, type, row, meta) {
                        return data.student_id
                    }
                },
                {
                    data: null, 
                    render: function(data, type, row, meta) {
                        return data.first_name + " " + (data.middle_name == null ? "" : data.middle_name[0] + ".") + " " + data.last_name + " " + (data.suffix == null ? "" : data.suffix)
                    }
                },
                {
                    data: null, 
                    render: function(data, type, row, meta) {
                        return data.year_level
                    }
                },
                {
                    data: null, 
                    render: function(data, type, row, meta) {
                        let disabled = false;
                        for(let i = 0; i <= data.credited_subject.length - 1; i++) {
                            // console.log(data.credited_subject[i])
                            if(data.credited_subject[i].status == 1) {
                                disabled = true
                                break
                            }
                        }
                        
                        if(disabled) {
                            return `<a href="{{ url('/chairperson/generate_pdf') }}/` + data.credited_subject[0].code_id + `" target="_blank" class="btn btn-primary btn-sm" title="View"><i class="fa fa-eye"></i></a>
                            <button type="button" class="btn btn-success btn-sm evaluateBtn" title="Recommend" value="${data.id}" data-code="${data.credited_subject[0].code_id}" disabled><i class="fa fa-check"></i></button>`
                        } else {
                            return `<a href="{{ url('/chairperson/generate_pdf') }}/` + data.credited_subject[0].code_id + `" target="_blank" class="btn btn-primary btn-sm" title="View"><i class="fa fa-eye"></i></a>
                            <button type="button" class="btn btn-success btn-sm evaluateBtn" title="Recommend" value="${data.id}" data-code="${data.credited_subject[0].code_id}"><i class="fa fa-check"></i></button>`
                        }

                        
                    }
                }
            ],
            responsive: true, 
            lengthChange: false, 
            autoWidth: false,
        });

        validateTable.on('click', 'td button.evaluateBtn', function() {
            Swal.fire({
                title: "Confirmation",
                text: "Are you sure you want to validate this accreditation?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: "Validate",
                denyButtonText: 'Cancel',
                allowOutsideClick: false, // Prevents the modal from closing when clicking outside of it
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        html: "<h5 style='color: #0c5460'>Wait...</h5>",
                        width: 400,
                        padding: '1em',
                        timer: 1000,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    }).then(async() => {
                        try {
                            const response = await $.ajax({
                                url: "{{ url('chairperson/update_recommend_approval') }}/" + $(this).val() + "/" + $(this).attr('data-code'),
                                type: "POST",
                                dataType: "json",
                                data: {
                                    '_token': "{{ csrf_token() }}"
                                },
                                async: false, // Make the request synchronous so that we can wait for its completion
                            });

                            Swal.close(); // Close the loading indicator

                            Swal.fire({
                                title: "Student Approved",
                                text: "Student successfully recommended",
                                icon: "info"
                            });

                            validateTable.ajax.reload();
                        } catch (error) {
                            console.log(error);
                            Swal.close(); // Ensure the loading indicator is closed even if an error occurs
                        }
                    });
                }
            });
        })
    })
</script>
@endsection