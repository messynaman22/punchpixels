@extends("auth.login_main")

@section("content")
    <div class="login-box-body">
        <h2 class="login-box-msg">Password Reset</h2>
        <p>Enter your email and we'll send you password info</p>
        @if(isset($errormessage))
            <div class="alert alert-danger">{{ $errormessage }}</div>
        @endif
        @if(isset($successmessage))
            <div class="alert alert-success">{{ $successmessage }}</div>
        @endif
        <form method="POST" action="{{ url('/crm/forgotpassword') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="email" value=""/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-6">
                </div><!-- /.col -->
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
                </div><!-- /.col -->
            </div>
        </form>
    </div>
    @if($errors->any())
        <div style="margin-top:20px;" class="login-box-body">
            <ul>
                @foreach($errors->all() as $error)
                    <li style="color:red">{!! $error !!}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection