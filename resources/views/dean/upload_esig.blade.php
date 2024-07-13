@extends('../base')

@section('title', 'Dean')

@section('map_site')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Upload Electronic Signature</h1>
    </div><!-- /.col -->

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admission.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">Upload E-sig</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('dean.save_upload_esig', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <div class="form-group">
                <label for="e_signature">Electronic Signature</label>
                <input type="file" class="form-control @error('e_signature') is-invalid @enderror" id="e_signature" name="e_signature" required>
                @error('e_signature')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div>
                    @if ($user->esignature)
                    Current: <a href="{{ url('storage') }}/{{$user->esignature}}" target="_blank">{{ $user->esignature }}</a>
                    @else
                    Current: <span class="font-weight-bold">No electronic signature uploaded yet.</span>
                    @endif
                </div>
            </div>

            <button class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
            <a href="{{ route('dean.dashboard') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Return</a>
        </form>
    </div>
</div>
@endsection

@section('page_custom_script')
<script>
</script>
@endsection