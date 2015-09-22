@extends("auth.login_main")

@section("content")
<div class="login-box-body">
  <p class="login-box-msg">Sign up for CRM</p>
 <form method="POST" action="{{ url('/crm/signup') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" value="{{ $admin['id'] }}">

    <div class="form-group has-feedback">
      <input type="email" class="form-control" placeholder="" name="email" value="{!! $admin['email']  !!}" disabled="disabled" />
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="text" class="form-control" placeholder="Username" name="username" value="{!! $username !!}" required  />
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="password" name="password" class="form-control" placeholder="Password" required/>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="password" name="conf_password" class="form-control" placeholder="Re enter Password" required/>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">      
      <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign up</button>
      </div><!-- /.col -->
    </div>
  </form>
  </div>

  @if($err !="default")
    <div style="margin-top:20px;" class="login-box-body">
      <ul>        
          <li style="color:red">{!! $err !!}</li>
      </ul>
    </div>
  @endif

@endsection