<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Welcome to {{$result['site_name']}}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="{{ URL::asset('css/bootstrap-theme.min.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/jquery.bxslider.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/carousel.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/signup.css') }}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body role="document">

<!-- Fixed navbar -->
<nav class="navbar">
    <div class="brdrbtm">
        <div class="container">

            <div class="row">
                <div class="col-sm-4">
                    <a class="navbar-brand" href="{{URL::to('/')}}/"><img class="logo" src="{{ URL::asset('images/'.$result['main_logo']) }}" title="{{$result['site_name']}}" alt="{{$result['site_name']}}" /></a>
                </div>
                <div class="col-sm-8">
                    <div class="colnowsec flright">
                        <div class="callnow"><span class="telicon"></span> call now <span class="telno">{{$result['main_phone_number']}}</span></div>
                        <div class="wrap_getstart"><a href="{{URL::to('signup')}}" class="getstarted">{{$result['signup_button']}}</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="flleft">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            @foreach($result['menu']['header'] as $val)
                            <li class="active"><a href="{{URL::to('page/'.$val->url)}}">{{$val->name}}</a></li>
                            @endforeach
                        </ul>

                    </div><!--/.nav-collapse -->
                </div>
            </div>
            <div class="col-sm-6">
                <div class="flright">
                    <div class="client-login">click here for the <span>Client Login</span></div>
                    <div class="search"><div id="input"><input type="search" name="search-terms" id="search-terms" placeholder="Enter search terms..."></div><span class="fa fa-search" id="label"></span></div>

                </div>
            </div>
        </div><!-- end row-->

    </div>
</nav>

@yield('content')

<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h1>who we are</h1>
                <ul>
                    @foreach($result['menu']['footer_1'] as $val)
                        <li ><a href="{{URL::to('page/'.$val->url)}}">{{$val->name}}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-sm-3">
                <h1>How it works</h1>
                <ul>
                    @foreach($result['menu']['footer_2'] as $val)
                        <li ><a href="{{URL::to('page/'.$val->url)}}">{{$val->name}}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-sm-3">
                <h1>Resources</h1>
                <ul>
                    @foreach($result['menu']['footer_3'] as $val)
                        <li ><a href="{{URL::to('page/'.$val->url)}}">{{$val->name}}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-sm-3 col-sm-6">
                <h1>Education</h1>
                <ul>
                    @foreach($result['menu']['footer_4'] as $val)
                        <li ><a href="{{URL::to('page/'.$val->url)}}">{{$val->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="row footer2">
            <div class="col-sm-2 text-center ">
                <div class="fico_wrapper">
                    <img src="{{ URL::asset('images/'.$result['footer_main_image']) }}" class="img-responsive ficoimg fico_img">
                    <img src="{{ URL::asset('images/'.$result['footer_main_logo']) }}" class="img-responsive ficoimg fico_logo">
                </div>
            </div>
            <div class="col-sm-10">
                <div class="col-sm-10">
                    <div class="large">{!!$result['content_top']!!}</div>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="col-sm-8">
                    <div class="small">
                                {!! $result['content_bottom'] !!} 
                    </div>
                   <div class="bottom_icons_container row text-center">
                       @foreach($result['friends_logo'] as $val)
                           <div class="bottom_icons col-sm-4 ficoimg">
                                <img class="img-responsive" src="{{ URL::asset('images/'.$val->image) }}" alt="{{$val->alt}}"/>
                           </div>
                       @endforeach
                   </div>
                </div>
                <div class="col-sm-4">
                    <h2 class="confirming">{{$result['content_bottom_button_lable']}}</h2>
                    <a href="#" class="phone-confirm">{{$result['content_bottom_button_content']}}</a>
                </div>

            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="{{ URL::asset('js/jquery.bxslider.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.maskedinput.min.js') }}"></script>
<script src="{{ URL::asset('js/form-format-helper.js') }}"></script>
<script src="{{ URL::asset('js/signup.js') }}"></script>

@yield('footer')


</body>
</html>
