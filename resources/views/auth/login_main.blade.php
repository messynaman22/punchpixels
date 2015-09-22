<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Credit1solutions | Log in</title>
    
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
   
     <link href="{{ asset('/') }}bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
 
    <link href="{{ asset('/') }}plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />


  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="{!! URL::to('/') !!}"><b>Credit1Solutions.com</b> 
        @if(isset($extra))
          {!! $extra !!}
        @else
        CMS
        @endif
        </a>
      </div><!-- /.login-logo -->
      @yield('content')
     <!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="../../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
