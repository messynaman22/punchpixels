<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Credit1Solutions | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ asset('/') }}bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />    
    <link href="{{ asset('/') }}dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/')}}css/admin.css">
    @yield("extrastyles")
</head>

<body class="skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
     
        <a href="#" class="logo">
   
            <span class="logo-mini"><b>A</b>LT</span>
  
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">        
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">                                                            
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('/') }}dist/img/avatar5.png" class="user-image" alt="User Image"/>
                            <span class="hidden-xs">Alexander Pierce</span>
                        </a>
                        <ul class="dropdown-menu">                           
                            <li class="user-header">
                                <img src="{{ asset('/') }}dist/img/avatar5.png" class="img-circle" alt="User Image" />
                                <p>
                                    Alexander Pierce - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>                                                   
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">		    
                                    <a href="{{ url('/auth/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>                    
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('/') }}dist/img/avatar5.png" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>Alexander Pierce</p>

                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>        
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Home Page</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                  
                        <li class="active"><a href="{{ url('admin/main-data/') }}"><i class="fa fa-circle-o"></i> Main Data</a></li>
                        <li><a href="{{ url('admin/header') }}"><i class="fa fa-circle-o"></i> Header</a></li>
                        <li><a href="{{ url('admin/footer') }}"><i class="fa fa-circle-o"></i> Footer</a></li>                   
                        <li><a href="{{ url('admin/footer/friends-logo') }}"><i class="fa fa-circle-o"></i> Footer- Friends Logo</a></li>
                        <li><a href="{{ url('admin/slider/mainslider') }}"><i class="fa fa-circle-o"></i> Main Slider</a></li>
                        <li><a href="{{ url('admin/slider/clientsreviews') }}"><i class="fa fa-circle-o"></i> Clients Reviews</a></li>
                        <li><a href="{{ url('admin/slider/whyus') }}"><i class="fa fa-circle-o"></i> Why Us</a></li>
                        <li><a href="{{ url('admin/customer-satisfaction') }}"><i class="fa fa-circle-o"></i> Customer Satisfaction</a></li>
                        <li><a href="{{ url('admin/you-trust') }}"><i class="fa fa-circle-o"></i> You Trust</a></li>

                    </ul>
                </li>
                <li><a href="{{ url('admin/pages/') }}"><i class="fa fa-circle-o text-red"></i> <span>Pages</span></a></li>
                
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <section class="content">
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">        
        <strong>Copyright &copy; 2014-2015 <a href="http://credit1solutions.com">Credit1Solutions</a>.</strong> All rights reserved.
    </footer> 
    <div style="display:none">
        <span id="apiUrl">{!! URL::to("/api") !!}</span>
        <span id="token_app">{!! Session::token() !!}</span>
    </div> 
    <div class='control-sidebar-bg'></div>
</div>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<script src="{{ asset('/') }}bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{ asset('/') }}plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src='{{ asset("/") }}plugins/fastclick/fastclick.min.js'></script>
<script src="{{ asset('/') }}dist/js/app.min.js" type="text/javascript"></script>
{!! HTML::script("js/angular.js") !!}
{!! HTML::script("js/angular/commonFactory.js") !!}
@yield("extrascripts")
</body>
</html>