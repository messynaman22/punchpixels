@extends('new_auth.main')


@section('navbar')
    <nav class="navbar">
        <div class="brdrbtm">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <a class="navbar-brand" ><img class="logo" src="{!!asset('/images/logo.png')!!}" title="Credit1Solutions.com" alt="Credit1Solutions.com" /></a>
                    </div>
                    <div class="col-sm-8">
                        <div class="colnowsec flright">
                            <div class="callnow no-mar"><span class="telicon"></span> call now <span class="telno">1-877-782-7839</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="signup">Your Sign Up Page</h1>
                    <div class="tabbed-menu">
                        <ul>
                            <li><a href="#">Step 1 "Getting Started: Personal Information"</a></li>
                            <li><a href="#">Step 2</a></li>
                            <li><a href="#">Step 3</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="flright audio">
                        <span class="audio-right"><img src="{{ asset('/images/icon-audio-right.png') }}"></span> <a id="playAudio" class="audioclick lg" onclick = "toogleAudio()" style="cursor:pointer">Click For Audio</a>
                        <span class="audio-left"><img src="{!!asset('/images/icon-audio-left.png')!!}"></span>
                    </div>
                    <div class="flright text-right">
                        <span class="signuptxt"> "On behalf of Credit1solutions.com we want to congratulate you on taking the first steps towards credit worthiness”.</span>
                    </div>
                </div>
            </div><!-- end row-->
        </div>
    </nav>
@stop

@section('main')
    <section class="formcontainer">
        <div class="container">
            <div class="row">
                <div class="col-md-7">  
                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissable">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times;</button>
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="alert alert-danger alert-dismissable" id="reqAlert">
                          <button type="button" class="close" onclick="hideAlert()"> &times;</button>
                         <span id="errorMsg"></span>
                        </div>
                    
                    {!!Form::open(['method'=>'post', 'url'=>'/step1','id'=>'step1form'])!!}

                        {!! Form::hidden('ip', Request::getClientIp(), ['name' => 'ip']) !!}

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="fname">*First Name</label>                                   
                                    {!!Form::text('fname', old('fname'), ['id'=>'fname', 'class'=>'form-control req alpha'])!!}
                                 
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="mname">Middle Name</label>
                                    {!!Form::text('mname', old('mname'), ['id'=>'mname', 'class'=>'form-control alpha'])!!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="lname">*Last Name</label>
                                    {!!Form::text('lname', old('lname'), ['id'=>'lname', 'class'=>'form-control req alpha'])!!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="paddress">*Physical Address</label>
                            {!!Form::text('paddress', old('paddress'), ['id'=>'paddress', 'class'=>'form-control req'])!!}
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="city">*City</label>
                                    {!!Form::text('city', old('city'), ['id'=>'city', 'class'=>'form-control req'])!!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="state">*State</label>
                                            {!!Form::select('state', $states, old('state'), ['class'=>'form-control dd','id'=>'state'])!!}
                                        </div>
                                </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="zip">*Zip Code</label>
                                    {!!Form::text('zip', old('zip'), ['id'=>'zip', 'class'=>'form-control req zipcode'])!!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group signup2">
                            <input type="checkbox" class="form-control" id="sameadd" name="sameadd"><label for="sameadd"></label>
                            <span class="sameadd">Use the Physical Address as Mailing Address</span>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group">
                            <label for="mpaddress">*Mailing Address</label>
                            {!!Form::text('mpaddress', old('mpaddress'), ['id'=>'mpaddress', 'class'=>'form-control req'])!!}
                        </div>


                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="mcity">*City</label>
                                    {!!Form::text('mcity', old('mcity'), ['id'=>'mcity', 'class'=>'form-control req'])!!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="hau">*State</label>
                                            {!!Form::select('mstate', $states, old('mstate'), ['class'=>'form-control dd','id'=>'mstate'])!!}
                                        </div>
                                </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="mzip">*Zip Code</label>
                                    {!!Form::text('mzip', old('mzip'), ['id'=>'mzip', 'class'=>'form-control req zipcode'])!!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="hno">Home Number</label>
                                    {!!Form::text('hno', old('hno'), ['id'=>'hno', 'class'=>'form-control phone'])!!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mno">*Mobile Number</label>
                                    {!!Form::text('mno', old('mno'), ['id'=>'mno', 'class'=>'form-control req phone'])!!}
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="email">*E-Mail Address</label>
                            {!!Form::email('email', old('email'), ['id'=>'email', 'class'=>'form-control req'])!!}
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="ml">Have you been in the Military?</label>
                                    {!!Form::select('ml', ['No', 'Yes'], old('ml'), ['class'=>'form-control'])!!}

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="hau">How Did You Hear About Us</label>
                                    {!!Form::select('hau', ['Auto Dealer'=>'Auto Dealer', 
                                                                         'Billboard' =>'Billboard',
                                                                         'Friend or Relative' =>'Friend or Relative',
                                                                         'From a Current Client' => 'From a Current Client',
                                                                         'I was a Former Client' => 'I was a Former Client',                                                                
                                                                        'Internet-Google'=>'Internet-Google',
                                                                        'Internet-MSN'=>'Internet-MSN',
                                                                        'Internet-Yahoo'=>'Internet-Yahoo',
                                                                        'Internet-Other'=>'Internet-Other',
                                                                        'Magazine' => 'Magazine',
                                                                        'Mortgage Broker' =>'Mortgage Broker',
                                                                        'Movie Theater Trailer'=>'Movie Theater Trailer',
                                                                        'Newspaper' => 'Newspaper',
                                                                        "Other" => "Other",
                                                                        "Phone Book" => "Phone Book",
                                                                        "Radio" => "Radio",
                                                                        "Realtor" => "Realtor",
                                                                        "Sign on Building" => "Sign on Building"
                                                                        ], old('hau'), ['class'=>'form-control'])!!}
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="in">What are you interested In?</label>
                                    {!!Form::select('in', ['Auto Purchase'=>'Auto Purchase', 'Auto Refinance'=>'Auto Refinance',
                                                                      'Basic Credit Building' => 'Basic Credit Building',
                                                                      'Employment Creditability'=>'Employment Creditability',
                                                                      'Mortgage Purchase' =>'Mortgage Purchase',
                                                                      'Mortgage Refinance' =>'Mortgage Refinance'], old('in'), ['class'=>'form-control'])!!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="btc">Best time to contact you?</label>
                                    {!!Form::select('btc', ['Anytime'=>'Anytime', 'Morning'=>'Morning','Afternoon'=>'Afternoon'], old('btc'), ['class'=>'form-control'])!!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <input type="button" class="gotobutton" onclick="sendFormRequest()" value="GO TO STEP 2">
                            </div>
                            <!-- <div class="col-md-5"><a href="#" class="savebtn">Save &rarr;</a></div> -->
                        </div>
                    {!!Form::close()!!}

                    <p class="signup-info">By clicking "Go TO Step 2" I agree by electronic signature to" (1) be contacted about credit repair or credit repair marketing by a live agent, artificial or prerecorded voice, and SMS text at my residential or cellular number, dialed manually or by autodialer, and by email (consent to be contacted is not a condition to purchase services); and (2) the Privacy Policy and Terms of use.</p>
                </div>

                <div class="col-md-5">
                    <div class="img-signup">
                        <img src="{{ asset('/images/img-signup.jpg') }}">
                    </div>
                    <h1 class="testimonial">Testimonial</h1>
                    <div class="testimonials">
                        <p><em>Your services helped us purchase our new home!</em></p>
                        <div class="client">
                            Thanks M Tran<br>
                            Credit1solutions.com Client
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('new_auth.straphline')
@stop

@section('footer')
    <footer>
        <div class="container">
            <div class="row footer2">
                <div class="col-sm-2 text-center">
                    <img src="{{ asset('/images/fico-signup.jpg') }}" class="img-responsive ficoimg">
                </div>
                <div class="col-sm-8">
                    <p>Credit1Solutions.com ™ abides by all laws/provisions of the CROA: SEC. 402(a) CREDIT REPAIR ORGANIZATIONS ACT.
                        Title IV of the Consumer Credit Protection Act (Public Law 90-321, 82 Stat. 164). Credit1Solutions.com ™does not charge
                        Advanced Fees to its clients. Credit1Solutions.com ™ is federally registered, state licensed and bonded.</p>
                    <div class="clearfix"></div>
                    <hr>
                    <p class="small">2006-2015 Credit1Solutions.com ™, All Right Reserved.<br>
                        Location: 5284 N Dixie Hwy Elizabethtown, KY 42701 Local: 279-982-4747 Toll: 877-782-7839</p>
                    <div class="banner-certified">
                        <div class="bottom_icons col-sm-4 ficoimg">                           
                             <img  class="img-responsive" src="{{ asset('/images/bottom_icon1.png') }}">
                        </div>
                       
                        <div class="bottom_icons col-sm-4 ficoimg">                           
                                <img  class="img-responsive" src="{{ asset('/images/bottom_icon2.png') }}">
                          </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <h2>How it works</h2>
                    <ul>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms Of Use</a></li>
                        <li><a href="#">Email Preferences</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <audio id="step1audio"style="display:none" preload="none"> 
       <source src={!!asset("audio/step1.mp3")!!} type="audio/mpeg">
    </audio>
@stop
