@extends('../base')

@section('title', 'Change Password')

@section('map_site')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Change Password</h1>
    </div><!-- /.col -->

    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('login.view') }}">Home</a></li>
            <li class="breadcrumb-item active">Change Password</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if(session('successMessage'))
        <div class="alert alert-success">
            {{ session('successMessage') }}
        </div>
        @endif
        <form action="{{ route('auth.save_change_password') }}" method="POST" id="changePassword">
            <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="old_password">Current Password</label>
                        <input type="password" name="old_password" class="form-control" id="old_password">
                        @if ($errors->has('old_password'))
                        <cite class="text-danger">{{$errors->first('old_password')}}</cite>
                        @endif
                        @if(session('errMessage'))
                        <cite class="text-danger"> {{ session('errMessage') }}</cite>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" class="form-control" id="new_password">
                        @if ($errors->has('new_password'))
                        <cite class="text-danger">{{$errors->first('new_password')}}</cite>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                        @if ($errors->has('confirm_password'))
                        <cite class="text-danger">{{$errors->first('confirm_password')}}</cite>
                        @endif
                    </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('page_custom_script')
<script>
$(function() {
    // Form validation
    $.validator.setDefaults({
            submitHandler: function (form) {
                form.submit();
            }
        });
    });

    // New course modal form validation
    $('#changePassword').validate({
        rules: {
            old_password: {
                required: true,
            },
            
            new_password: {
                minlength: 6,
                required: true,
            },

            confirm_password: {
                required: true,
                minlength: 6,
                equalTo: "#new_password"
            }
        },

        messages: {
            old_password: {
                required: "Please provide the current password.",
            },

            new_password: {
                required: "Please provide the new password.",
                minlength: "Password must be at least 6 characters long.",
            },

            confirm_password: {
                required: "Please confirm password",
                minlength: "Password must be at least 6 characters long.",
                equalTo: "Password do not match."
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
</script>
@endsection