@extends('template.template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="signup">Your Sign Up Page</h1>
                <?php
                    if(Session::has("step_error")){
                       $error = Session::pull("step_error");
                         $mess_error = $error["messages"];
                        // dd($error);
                    }
                    // dd($result);
                    echo ((isset($error["cvv"]))?$error["cvv"]:'');
                    // if(isset($result["errors"])){
                    //     $mess_error=$result["errors"]['messages'];
                    //     // dd(isset($mess_error['month'][0]));
                    //     // echo  ((isset($mess_error['cvv'][0]))?$mess_error['cvv'][0]:'');
                    // }
               /*     echo '<pre>';
                    print_r($data[0]['messages']['card-number']);die;*/

                ?>


                <div class="tabbed-menu">
                    <ul>
                        <li><a href="{{URL::to('signup')}}">Step 1</a></li>
                        <li><a href="{{URL::to('signup/step2')}}">Step 2 "Getting Started: Payment Information"</a></li>
                        <li><a href="{{URL::to('signup/thank-you')}}">Step 3</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="flright audio">
                    <span class="audio-right">
                       {!! HTML::image('images/icon-audio-right.png') !!}
                    </span> <a class="audioclick lg" id="playAudio" style="cursor:pointer" onclick="toogleAudio()">Click For Audio</a> <span class="audio-left">{!! HTML::image('images/icon-audio-left.png') !!}</span>

                </div>
                <div class="flright text-right" style="width:100%">
                    <span class="signuptxt">"Now you're one step closer to credit worthiness”</span>

                </div>
            </div>
        </div><!-- end row-->



    </div>
    </nav>
    <section class="formcontainer">
        <div class="container">
            {!! Form::open(array('url' => '/poststeptwo','name' => 'frmSIGNUP2','id'=>'frmSignUp2','novalidate' => 'novalidate','class'=>'signup2','id'=>"step2form")) !!}
                <div class="row">

                    <table class="table table-bordered service_charges">
                        <colgroup>
                            <col span="2">
                            <col class="darkcol">
                        </colgroup>
                        <tr>
                            <th><h2>Service Charges Summary</h2></th>

                            <th><input name="choose_service" type="radio" id="cs"  checked ><label for="cs"></label> <span>Comprehensive Service</span></th>
                            <th><input name="choose_service" type="radio" id="fss" ><label for="fss"></label> <span>Fresh Start Service</span></th>
                        </tr>

                        <tr>
                            <td>Unlimited Credit Bureau Disputes <span class="fa fa-question-circle"></span>
                                <div class="tooltip-show col-lg-6 col-md-6 col-sm-3 col-xs-1">
                                    <p><a class="printlink">Print&nbsp;<i class="fa fa-print"></i></a></p>
                                    <p>Unlimited Credit Bureau Disputes can be the best way to maximize your results. Each round documents will be prepared for the credit bureaus concerning the questionable negative items appearing on you consumer credit report. We will prepare documentation for these questionable negative items on each credit report (Equifax, Experian and/or TransUnion).  Note- Unlimited Credit Bureau Disputes does not include Personal Summary and Inquiries.</p></div></td>
                            <td class="cs"><span class="fa fa-check-circle"></span></td>
                            <td class="fss"><span class="fa fa-check-circle dark"></span></td>
                        </tr>

                        <tr>
                            <td>Unlimited Personal Summary Information Disputes <span class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Tooltip on right"></span>
                                <div class="tooltip-show col-lg-6 col-md-6 col-sm-3 col-xs-1">
                                    <p><a class="printlink">Print&nbsp;<i class="fa fa-print"></i></a></p>
                                    <p>The Personal Summary Section of your credit report often includes inaccurate and error filled information pertaining to addresses, employment history, names, social security numbers, spouses and more.  The Unlimited Personal Summary Information challenges these inaccuracies to make sure that your identity is precise.  Also removing invalid addresses, employment and identity information can increase your appearance of stability if you ever have to pass a security clearance or background check.<p>
                                </div>

                            </td>
                            <td class="cs"><span class="fa fa-check-circle"></span></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Unlimited Inquiry Investigation (TM)</td>
                            <td class="cs"><span class="fa fa-check-circle"></span></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Designated Credit Advisor to help you towards better credit worthiness</td>
                            <td class="cs"><span class="fa fa-check-circle"></span></td>
                            <td class="fss"><span class="fa fa-check-circle dark"></span></td>
                        </tr>

                        <tr>
                            <td>Access to a 24/7 Online Portal <span class="fa fa-question-circle"></span>
                                <div class="tooltip-show col-lg-6 col-md-6 col-sm-3 col-xs-1">
                                    <p><a class="printlink">Print&nbsp;<i class="fa fa-print"></i></a></p>
                                    <p>A. 24/7 Online Access<br>B. Track Results<br>   C. Check Status of Accounts<br>   D. Communicate and Ask Questions with Credit1Solutions.com credit advisors.<br> E. Upload, Scan and Download documents with ease in our attachment section</p></div>
                                </td>
                            <td class="cs"><span class="fa fa-check-circle "></span></td>
                            <td class="fss"><span class="fa fa-check-circle dark"></span></td>
                        </tr>

                        <tr>
                            <td>In-depth Budget Expenditure Spreadsheet</td>
                            <td class="cs"><span class="fa fa-check-circle "></span></td>
                            <td class="fss"><span class="fa fa-check-circle dark"></span></td>
                        </tr>

                        <tr>
                            <td>Online Educational Library <span class="fa fa-question-circle"></span>
                                <div class="tooltip-show col-lg-6 col-md-6 col-sm-3 col-xs-1">
                                    <p><a class="printlink">Print&nbsp;<i class="fa fa-print"></i></a></p>
                                    <p>A. 24/7 Online Access<br>B. Information ranging from but not limited to:                                    
                                    <br>&nbsp;a. Information about Credit Reports and Credit Scores</li>
                                    <br>&nbsp;b. General Credit Reporting Information.
                                    <br>&nbsp;c. Federal and State Laws.
		    <br>&nbsp;d. Federal and State Rights.
		    <br>&nbsp;e. and much, much more.
		    </p>
		</div>
	            </td>
                            <td class="cs"><span class="fa fa-check-circle"></span></td>
                            <td class="fss"><span class="fa fa-check-circle dark"></span></td>
                        </tr>
                        <tr>
                            <td>Monthly Fee Begins on <span class="packageService"></span>  for work already performed.</td>
                            <td class="cs-check-price">$89.95</td>
                            <td class="cs-check-invert">$--.--</td>
                            <td class="fss-check-price">$79.95</td>
                            <td class="fss-check-invert">$--.--</td>
                            
                        </tr>
                    </table>

                </div>

                <div class="row">
                    <div class="col-md-7">
                        <div class="alert alert-danger alert-dismissable" id="reqAlert">
                          <button type="button" class="close" onclick="hideAlert()" style="color:black"> &times;</button>
                            <span style="color:black" id="reqMessage"></span>
                        </div>
                        <h2>Scheduled Payment Dates</h2>
                        <div class="row sch_pay">
                            <div class="col-sm-9">
                                <strong>One-time credit report charge <span class="fa fa-question-circle"></span>
                                    <div class="tooltip-show col-lg-6 col-md-6 col-sm-3 col-xs-1">
                                        <p><a class="printlink">Print&nbsp;<i class="fa fa-print"></i></a></p>
                                        <p>One-Time Credit Report Charge. Charge Applies Today</p></div></strong><br>
                                         Charge will apply today. {!! $result["dates"]["now"] !!}
                            </div>
                            <div class="col-sm-3 text-right">
                                $12.99
                            </div>
                        </div>

                        <div class="row sch_pay">                   
                            <div class="col-sm-9">             
                                <strong>Your First Payment <span class="fa fa-question-circle"></span>                            
                                <div class="tooltip-show col-lg-6 col-md-6 col-sm-3 col-xs-1">
                                    <p>
                                        <a class="printlink">Print&nbsp;<i class="fa fa-print"></i></a>
                                    </p>
                                     <p>
                                         This Payment is not for credit repair, as Credit1Solutions.com abides by the C.R.O.A. and does not charge upfront or advanced fees for credit repair. Your first payment is for the one or more of the following mentioned items: <br>A. Provide Each client with his/her own 24/7 online customer status portal with self-help educational library explain credit reports, credit scores and establish a good pay history.<br>B. Analysis of Credit Reports (Equifax, Experian and TransUnion)<br>C. Explain and provide copy of federal laws per sec.  2451.  Regulations of credit repair organization and guidelines of FCRA laws.<br>D. Credit1solutuons.com agrees to upload components deemed to be inaccurate, untimely or unverifiable by said of credit1solutions.com to clients online portal for approval.<br>E. Client agrees that service rendered will not cause any financial harm nor replace any other owed financial obligations. Financial budget will be provided on online portal for customers use.<br>F. Welcome Package will be sent to client, including username/password access to online portal.
                                     </p>
                                </div>             <br>                   
                                
                                <div class="row col-sm-12 nopadding">
                                            <div class="col-sm-5 nopadding">
                                                    <div >One time fee charged on</div>  
                                            </div>
                                            <div class="col-sm-4 nopadding">
                                            {!!Form::select('packagedate', $result["packageDate"],null, ['class'=>'form-control p-l col-sm-3','style'=>'padding: 0px;height: 28px;width: 125px;margin-top: -5px; '])!!}</span>
                                            </div>
                                  </div>
                            </div>
                            <div class="col-sm-3 text-right">
                                $99.95
                            </div>
                        </div>

                        <div class="row sch_pay">
                            <div class="col-sm-9">
                                <strong ><span id="price_label">Comprehensive Service</span> <span class="fa fa-question-circle"></span>
                                    <div class="tooltip-show col-lg-6 col-md-6 col-sm-3 col-xs-1" id="package_tooltip"></div></strong><br>
                                Charge will apply on  <span class="packageService"></span> for work
                                already performed.
                            </div>
                            <div class="col-sm-3 text-right" id="fss_price">
                                $89.95
                            </div>
                        </div>

                        <div class="row sch_pay">
                            <div class="col-sm-9">
                                <strong>Total Due Today</strong>
                            </div>
                            <div class="col-sm-3 text-right">
                                <strong>$12.99</strong>
                            </div>
                        </div>
                        <h2 id="primary_pay">*Primary Payment</h2>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group field_error">
                                    <input name="card_number" type="text" class="form-control req" placeholder="Card Number" value="<?php echo ((isset($error["card_number"]))?$error["card_number"]:''); ?>">
                                   
                                </div>
                            </div>
                            <div class="col-sm-7 carddetails">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <select name="month" class="form-control p-l">
                                                <option value="<?php echo ((isset($error->month))?$error->month:'EXP Month'); ?>"><?php echo ((isset($error->month))?$error->month:'EXP Month'); ?></option>
                                                <option value="01">01</option>
                                                <option value="02">02</option>
                                                <option value="03">03</option>
                                                <option value="04">04</option>
                                                <option value="05">05</option>
                                                <option value="06">06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                                <option value="09">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>

                                            </select>
                                            <em class="field_error"><?php echo ((isset($mess_error['month'][0]))?$mess_error['month'][0]:''); ?></em>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                        {!!Form::select('year', $result['years'],null, ['class'=>'form-control p-l'])!!}                                                                                     
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input name="cvv" type="text" class="form-control req" placeholder="CVV" value="<?php echo ((isset($error["cvv"]))?$error["cvv"]:''); ?>">                                            
                                        </div>
                                    </div>                                                                   
                                </div>

                            </div>
                            <div class="col-sm-12 text-left">
                                CVV
                                <span class="fa fa-question-circle"></span>
                                        <div class="tooltip-show col-lg-6 col-md-6 col-sm-3 col-xs-1">
                                        <p><a class='printlink'>Print&nbsp;<i class='fa fa-print'></a></i></p>
                                        <p>
                                        The CVV Number (Card Verification Value) on your credit card or debit card is a 3 digit number on the back of the card by the signature.</p>
                                        </div>
                            </div>
                        </div><br>
                        <div class="form-group">
                            {!! HTML::image('images/icon-mastercard.jpg') !!}
                        </div>
                        <h2 id="primary_bill">*Billing Information</h2>
                        <input name="saci" type="checkbox" id="saci" checked="checked"><label for="saci" ></label><span class="bothsame">Same as contact information</span>
                        <div class="form-group">
                        <input name="full_name" type="text" class="form-control req alpha" placeholder="John Deo" value="<?php echo ((isset($error["full_name"]))?$error["full_name"]:''); ?>">
                            <em class="field_error"></em>
                        </div>
                        <div class="form-group">
                            Type the name as it appears on the account
                        </div>
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input name="street_address" type="text" class="form-control req" placeholder="Street Address" value="<?php echo ((isset($error["street_address"]))?$error["street_address"]:''); ?>">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input name="primary_zip_code" type="text" class="form-control req zipcode" placeholder="40065" value="<?php echo ((isset($error["primary_zip_code"]))?$error["primary_zip_code"]:''); ?>">                        
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-12 nopadding">
                            <strong style="font-size:18px;font-weight:100" >
                                <span  id="sec_pay">*Secondary Payment</span> <span class="fa fa-question-circle"></span>
                                <div class="tooltip-show col-lg-6 col-md-6 col-sm-3 col-xs-1" id="package_tooltip">
                                  <p><a class="printlink">Print&nbsp;<i class="fa fa-print"></i></a></p>
                                  <p>
                                  <strong>Why do we request a Secondary Payment?</strong><br>
                                   In case you’re primary card is update by its provider and you have failed to contact our billing department prior to the scheduled payment date, our billing department will then adjust your account to ensure case work is not stalled.</p>
                                </div><br>
                          
                        </div><br>          
                        <div class="row no-pad">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select class="form-control p-l" name="account_type">
                                        <option value="Checking Account">Checking Account</option>
                                        <option value="Savings Account">Savings Account</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input name="bank_name" type="text" class="form-control req alpha" placeholder="Bank Name" value="<?php echo ((isset($error["bank_name"]))?$error["bank_name"]:''); ?>">                                   
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input name="routing_number" type="text" class="form-control req" placeholder="Routing Number" value="<?php echo ((isset($error["routing_number"]))?$error["routing_number"]:''); ?>">                                  
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input name="account_number" type="text" class="form-control req" placeholder="Account Number" value="<?php echo ((isset($error['account_number']))?$error['account_number']:''); ?>">                                    
                                </div>
                            </div>
                        </div><br><br>
                        <button class="btn btn-primary">ACH</button>
                        <h2 id="sec_bill">*Billing Information</h2>
                        <input name="same_contact_information" type="checkbox" id="sacib" checked="checked"><label for="sacib"></label><span class="bothsame">Same as contact information</span>
                        <div class="form-group">
                            <input name="contact_information" type="text" class="form-control req alpha" placeholder="Name on Checking Account or Savings Account" value="<?php echo ((isset($errorerror['contact_information']))?$error->error['contact_information']:''); ?>">                            
                        </div>
                        <div class="form-group">
                            Type the name as it appears on the account
                        </div>
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input name="billing_address" type="text" class="form-control req" placeholder="Billing Address" value="<?php echo ((isset($error['billing_address']))?$error['billing_address']:''); ?>">                                    
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input name="secondary_zip_code" type="text" class="form-control req zipcode" placeholder="Zip Code" value="<?php echo ((isset($error['secondary_zip_code']))?$error['secondary_zip_code']:''); ?>">                                    
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <input type="button"  onclick= "sendFormRequest()"  class="gotobutton" value="GO TO STEP 3">
                            </div>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <!-- <div class="col-md-5"><a href="#" class="savebtn">Save &rarr;</a></div> -->
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="img-signup">
                            {!! HTML::image('images/img-signup.jpg') !!}
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

                {!! Form::hidden("package", "Comprehensive") !!}
                {!! Form::hidden("card_type", "Visa") !!}
            {!! Form::close() !!}
        </div>
        <audio id="step2audio"style="display:none" preload="none"> 
           <source src={!!asset("audio/step2.mp3")!!} type="audio/mpeg">
        </audio>
    </section>
@endsection




