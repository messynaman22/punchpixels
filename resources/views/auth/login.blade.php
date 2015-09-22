@extends("auth.login_main")

@section("content")
<div class="login-box-body">
  <p class="login-box-msg">Sign in to start your session</p>
 <form method="POST" action="{{ url('/auth/login') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group has-feedback">
      <input type="email" class="form-control" placeholder="Email" name="email" value="{!! old('email')  !!}"/>
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="password" name="password" class="form-control" placeholder="Password"/>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
      <div class="col-xs-8">    
        <div class="checkbox icheck">
          <label>
            <input name="remember" type="checkbox"> Remember Me
          </label>
        </div>                        
      </div><!-- /.col -->
      <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
      </div><!-- /.col -->
    </div>
  </form>

  <div class="social-auth-links text-center">
    <p>- OR -</p>
  </div><!-- /.social-auth-links -->

  <a  href="{{ url('/password/email') }}">I forgot my password</a><br>
 <!--  <a href="register.html" class="text-center">Register a new membership</a> -->

</div>
@stop