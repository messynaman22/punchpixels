@extends('mainContent')

@section('content')


<section  class="banner" id="topSlider" style='background-image: url("{{URL::asset('images/'.$result['main_banner'])}}")'>
    <div class="container">


        <div class="banner-content">
            <ul class="top_slider">
                @foreach($result['main_slider'] as $val)
                <li >
                    <h1>{!!$val->title!!}</h1>
                    <h2>{!!$val->description!!}</h2>
                    <p>{!!$val->content!!}</p>
                    <button class="orangebtn main_slider_{{$val->id}}_button1" >{!!$val->button1!!}</button>
                    <button class="learnmore main_slider_{{$val->id}}_button2">{!!$val->button2!!}</button>
                </li>
                    @endforeach
                </ul>
        </div>

    </ul>
        </div>
</section>
<section class="strapline">
    <div class="container">
        Credit Report Repair Questions? <span>{{$result['credit_report_repair_questions']}}: {{$result['phone_number']}}</span>
    </div>
</section>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="start">Start with the name you trust</h1>
                <div>
                    {!!$result['you_trust_left']!!}
                </div>
                <div class="videowrapp">
                    {!!$result['you_trust_iframe']!!}
                </div>

            </div>

            <div class="col-md-6">

                <div class="better-business"><img src="{{ URL::asset('images/better-business-button.png') }}"></div>
                <div class="content-right">
                    <div>
                        {!!$result['you_trust_right']!!}
                    </div>

                    <ul>
                        @foreach($result['menu']['you_trust_1'] as $val)
                            <li ><a href="{{URL::to('page/'.$val->url)}}">{!!$val->name!!}</a></li>
                        @endforeach
                    </ul>
                    <ul>
                        @foreach($result['menu']['you_trust_2'] as $val)
                            <li ><a href="{{URL::to('page/'.$val->url)}}">{!!$val->name!!}</a></li>
                        @endforeach
                    </ul>
                    <div class="clearfix"></div>
                    <div class="btncontainer">
                        <a href="#" class="cntremoval">Count removal?</a> <a href="#" class="allres">View All Results</a>
                    </div>
                </div>
            </div>



        </div>


    </div> <!-- /container -->

</section>
<div class="clearfix"></div>
<section class="clientreview">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="start">Clients Reviews</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <h2 class="clientstory">Real Clients of {!!$result['site_name']!!} and not paid actors</h2>
            </div>
            <div class="col-sm-4">
                <a href="#" class="allres">Read All Stories</a>
            </div>
        </div>
        <div class="pull-left carouselcontainer text-center">
            <ul class="bxslider">
                @foreach($result['clients_reviews'] as $val)
                    <li data-id="{{$val->id}}"><img src="{{ URL::asset('images/'.$val->image) }}"  width="263" height="293" /></li>
                @endforeach
            </ul>
        </div>


    </div>

</section>


<section class="clientpost">
    <div class="container container2"></div>

    <div class="container">
        <div class="padded">
                @foreach($result['clients_reviews'] as $val)
                    <p class="carousel_content" style="display: none;" data-id="{{$val->id}}">{!!$val->content!!}</p>
                @endforeach

            <h1>current clients may post a review!</h1>
            <h2>How to Post &amp; Validate Reviews about {!!$result['site_name']!!} <sup><small>TM</small></sup></h2>
            <div class="buttoncontainer">
                <button class="orangebtn">Become A Client</button> <button class="learnmore">Learn More</button>
            </div>
        </div>
    </div>


</section>
<section class="about">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h1 class="start">Why {!!$result['site_name']!!}</h1>
            </div>
            <div class="col-md-7">
                <h2 class="tagline">“As leaders in the legal credit repair industry our customers deserve honest expectations to support their goals.”</h2>
            </div>
        </div>
        <div id="myCarousel" class="carousel slide">


            <div class="carousel-inner" role="listbox">
                @foreach($result['why_us'] as $key =>$value)
                    <div class="item {{($key == 0) ? 'active' : ''}}">
                        <div class="row">
                    @foreach($value as $val)
                        <div class="col-sm-4">
                            <div class="about-posts">
                                <h1>{{$val->id}}. {!!$val->title!!}</h1>
                                <p>{!!$val->content!!}</p>
                                <div class="btn-about">
                                    <a href="#" class="audioclick">{!!$val->button1!!}</a>
                                    @if(!empty($val->button2))
                                        <a href="#" class="learnmore orangebg">{!!$val->button2!!}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="fa fa-chevron-circle-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="fa fa-chevron-circle-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>




    </div>

</section>

<section class="customer-setisfaction">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="start">100% Customer Satisfaction</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="csicons">
                    <ul>
                        @foreach($result['customer_satisfaction'] as $key => $val)
                            <li class="{{($key == 0) ? '__active' : ''}}" data-content="{!!$val->content!!}">
                            <a href="#" ><span class="credit_status"></span>{!!$val->display_name!!}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
            <div class="col-md-6">
                <div class="padded-sm">
                    <h1 class="title_content start">Credit Status Portal</h1>
                    <p class="body_content">{!!$result['credit_status_portal_content']!!}</p>
                    <div class="btn-customer">
                        <a href="#" class="audioclick">Read This Article</a> <a href="#" class="learnmore orangebg">Let’s Get Started</a>
                    </div>
                </div>
            </div>
        </div>

    </div>



</section>

<section class="strapline">
    <div class="container">
        Credit Report Repair Questions? <span>{!!$result['credit_report_repair_questions']!!}: {!!$result['phone_number']!!}</span>
    </div>
</section>

@endsection
@section('footer')
    <script type="text/javascript">
        $("#myCarousel").carousel("pause");
    </script>
    <script src="{{ URL::asset('js/scripts.js') }}"></script>

@endsection
