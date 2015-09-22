@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('home/main-data/') }}">Main Data</a></li>
                        <li><a href="{{ url('home/header') }}">Header</a></li>
                        <li><a href="{{ url('home/footer') }}">Footer</a></li>
                        <li><a href="{{ url('home/slider/mainslider') }}">Main Slider</a></li>
                        <li><a href="{{ url('home/slider/clientsreviews') }}">Clients Reviews</a></li>
                        <li><a href="{{ url('home/slider/whyus') }}">Why Us</a></li>
                        <li><a href="{{ url('home/customer-satisfaction') }}">Customer Satisfaction</a></li>
                        <li><a href="{{ url('home/you-trust') }}">You Trust</a></li>

                    </ul>
                </div>
            </div>

        </div>
    </div>

@endsection
