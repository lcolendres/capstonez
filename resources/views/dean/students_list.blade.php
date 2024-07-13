@extends('../base')

@section('title', 'Courses')

@section('map_site')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Student List</h1>
    </div><!-- /.col -->

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Student List</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover text-center" id="tbl_for_approval">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Year/Course</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('page_custom_script')
<script>
  $(function () {
    var tableForApproval = $('#tbl_for_approval').DataTable({
        ajax: "{{ route('dean.for_approval_list') }}",
        columns: [
            { 
                data: 'student_id',
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
                    return `${data.course[0].course_name} - ${data.year_level}`
                }
            },
            { 
                data: null,
                render: function(data, type, row, meta) {
                    return `<a href="{{ url('/dean/generate_pdf') }}/` + data.credited_subject[0].code_id + `" target="_blank" class="btn btn-primary btn-sm mr-2" title="View"><i class="fa fa-eye"></i></a><button type="button" class="btn btn-success btn-sm approvedBtn" title="Recommend" value="${data.id}" data-code="${data.credited_subject[0].code_id}"><i class="fa fa-check"></i></button>`
                }
            }
        ],
        responsive: true, 
        lengthChange: false, 
        autoWidth: false,
    });

    tableForApproval.on('click', 'td button.approvedBtn', function() {
        $.ajax({
            url: "{{ url('dean/approved') }}/" + $(this).val() + "/" + $(this).attr('data-code'),
            type: "POST",
            dataType: "json",
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(response) {
                Swal.fire({
                    title: "Student Approved",
                    text: "Subject for credits has been approved",
                    icon: "info"
                });

                tableForApproval.ajax.reload();
            },
            error: function(xhr, errStatus, error) {
                console.log(error);
            }
        });
    })
  });
</script>
@endsection