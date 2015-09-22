<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset("favicon.ico") }}" rel="icon"/>
    <title>{{$result['site_name']}}|Signup2</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap theme -->
    <link href="{{ asset("css/bootstrap-theme.min.css") }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset("css/font-awesome.css") }}" rel="stylesheet" type="text/css"/>
    <!-- Custom styles for this template -->
    <link href="{{ asset("css/style_new.css") }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("css/carousel.css") }}" rel="stylesheet" type="text/css"/>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
</head>

<body role="document">

<!-- Fixed navbar -->
<nav class="navbar">
    <div class="brdrbtm">
        <div class="container">

            <div class="row">
                <div class="col-sm-4">
                    <a class="navbar-brand" href="/">
                        <img class="logo" src="{{ URL::asset('images/'.$result['main_logo']) }}" title="{{$result['site_name']}}" alt="{{$result['site_name']}}" />

                    </a>
                </div>
                <div class="col-sm-8">
                    <div class="colnowsec flright">
                        <div class="callnow no-mar"><span class="telicon"></span> call now <span class="telno">{{$result['main_phone_number']}}</span></div>

                    </div>
                </div>
            </div>
        </div>
    </div>