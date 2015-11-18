<!DOCTYPE html>
<html>
<head>
	<title>Credit1solutions | CRM</title>

	<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
	{!! HTML::style("css/bootstrap.css") !!}
      {!! HTML::style("css/flatly.css") !!}
      {!! HTML::style("css/font-awesome.css") !!}
	<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> -->
	{!! HTML::style("css/sweetalert.css") !!}	
	{!! HTML::style("css/crm/crm.css") !!}
	@yield("extrastyles")
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a href={!! URL::to("/") !!} class="navbar-brand"><img src= {!! URL::asset("images/logo.png") !!} style="width: 200px;height: 35px;margin-top: -5px;"></a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-main">
                  <ul class="nav navbar-nav">
                    @if($admin["role"]=='Admin')
                    <li @if(isset($optclass))class="active" @endif>
                      <a href={!! URL::to("crm/options") !!} >Options</a>
                    </li>
                    @endif
                    <li  @if(isset($resclass)) class="active" @endif>
                      <a href={!! URL::to("crm/response") !!}>View Responses</a>
                    </li>        
                    @if($admin["role"]=='Admin')
                    <li  @if(isset($invclass)) class="active" @endif>
                      <a href={!! URL::to("crm/invite") !!}>Manage CRM users</a>
                    </li>                   
                    @endif
                    @if($admin["role"]=='Admin')
                    <li  @if(isset($agreclass)) class="active" @endif>
                      <a href={!! URL::to("crm/agreement") !!}>Manage Agreement</a>
                    </li>
                    @endif
                  </ul>

                  <ul class="nav navbar-nav navbar-right">                 
                     <li class="dropdown">
                             <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="loginmenu">Welcome , {!! $admin["username"] !!} <span class="caret"></span></a>
                            <ul class="dropdown-menu" aria-labelledby="loginmenu">
                                      <li><a href={!! URL::to("crm/user") !!}>Settings</a></li>                                               
                                       <li><a href={!! URL::to("crm/logout") !!}>Logout</a></li>
                            </ul>
                     </li>
                  </ul>
        </div>

      </div>
      <div style="display:none">
        <div id="apiUrl">{!! URL::to("api") !!}</div>
        <div id="token">{!! Session::token() !!}</div>
      </div>
</div>
	
	@yield("container")
      

	{!! HTML::script("js/jquery-1.9.1.min.js") !!}
	{!! HTML::script("js/bootstrap.js") !!}
	{!! HTML::script("js/angular.js") !!}
	{!! HTML::script("js/sweetalert.min.js") !!}
	@yield("extrascripts")
</body>

</html>