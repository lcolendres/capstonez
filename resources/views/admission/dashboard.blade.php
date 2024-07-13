@extends('../base')

@section('title', 'Admission')

@section('map_site')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
    </div><!-- /.col -->

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admission.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h3>History</h3>

        <table class="table table-bordered table-hover text-center" id="tbl_history">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Date Validated</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('page_custom_script')
<script>
    $(function() {
        var historyTable = $('#tbl_history').DataTable({
            ajax: "{{ route('admission.get_history') }}",
            columns: [
                { 
                    data: null,
                    render: function(data, type, row, meta) {
                        return `${data.student.student_id}`
                    }
                },
                {
                    data: null, 
                    render: function(data, type, row, meta) {
                        return data.student.first_name + " " + (data.student.middle_name == null ? "" : data.student.middle_name[0] + ".") + " " + data.student.last_name + " " + (data.student.suffix == null ? "" : data.student.suffix)
                    }
                },
                { 
                    data: null,
                    render: function(data, type, row, meta) {
                        if(data.recom_app) {
                            return `<span class="badge bg-primary">Complete</span>`
                        } else {
                            return `<span class="badge bg-warning">Incomplete</span>`
                        }
                    }
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        if(data.recom_app) {
                            const date = new Date(data.updated_at)
                            const month = date.getMonth() + 1 // Months are zero-based in JavaScript
                            const day = date.getDate()
                            const year = date.getFullYear()

                            // Pad single-digit months and days with a leading zero
                            const formattedMonth = month < 10? '0' + month : month
                            const formattedDay = day < 10? '0' + day : day

                            // Format the date in M-D-YYYY format
                            const formattedDate = `${formattedMonth}-${formattedDay}-${year}`
                            return formattedDate
                        } else {
                            return `-`
                        }
                    }
                }
            ],
            responsive: true, 
            lengthChange: false, 
            autoWidth: false,
        });
    })
</script>
@endsection