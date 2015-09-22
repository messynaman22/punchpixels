@extends('mainContent')

@section('content')
    <section class="main_content signup_wrapper content">
        <div class="container">
        <div class="row step_navigation active_step1 clearfix">
            <div class="column grid_12">
                <ul>
                    <li class="step1 highlighted"><a href="/signup" class="disabled_link">1. Enter Your Contact Information</a></li>
                    <li class="step2"><a href="/signup/step2" class="disabled_link">2. Service Selection</a></li>
                    <li class="step3"><a href="/signup/step3" class="disabled_link">3. Legal Agreements</a></li>
                </ul>
            </div>
        </div>
        <div class="row signup signup_step1">
            <div class="column form_wrapper">

                <noscript>
                    &lt;div id="noJavascript" class="non_fatal_errors clearfix"&gt;
                    &lt;div class="error_img"&gt;&lt;/div&gt;
                    &lt;div class="error_heading"&gt;
                    Javascript and Cookies must be enabled to signup online.
                    &lt;/div&gt;
                    &lt;/div&gt;
                </noscript>
                <div id="cookiesDisabled" class="non_fatal_errors clearfix" style="display:none;">
                    <div class="error_img"></div>
                    <div class="error_heading">
                        Cookies must be enabled to signup online.
                    </div>
                </div>

                    {!! Form::open(array('url' => 'signup/step1','name' => 'frmSIGNUP1','id'=>'frmSignUp1','novalidate' => 'novalidate')) !!}

                    <div class="heading_2 client_heading">Your Contact Information</div>


                    <!-- COMPONENT - CONTACT INFO -->
                    <div class="component_wrap">
                        <fieldset class="contact_info">
                            <legend>Personal Information</legend>
                            <div class="block first_name floating_label ">
                                <label for="first_name">First Name</label>
                                <input type="text" required="" id="first_name" class=" form-control input_first_name" name="signup[first_name]" maxlength="25"  placeholder="First Name" aria-required="true">
                            </div>
                            <div class="block last_name floating_label ">
                                <input type="text" required="" id="last_name" class=" form-control input_last_name" name="signup[last_name]" maxlength="25"placeholder="Last Name" aria-required="true">
                                <label for="last_name">Last Name</label>
                            </div>
                            <div class="block middle_name floating_label ">
                                <input type="text" required="" id="middle_name" class=" form-control input_last_name" name="signup[middle_name]" maxlength="25"placeholder="Middle Name" aria-required="true">
                                <label for="middle_name">Middle Name</label>
                            </div>
                            <div class="block email floating_label ">
                                <input type="email" required="" id="email" class=" form-control input_email" name="signup[email]" data-rule-email="true" maxlength="50" placeholder="Email" aria-required="true">
                                <label for="email">Email</label>
                            </div>
                            <div class="block phone1 floating_label ">
                                <input type="tel" required="" id="phone1" class=" form-control input_phone1" name="signup[phone1]" data-rule-phoneus="true" data-form-format-helper="formatPhoneNumber" placeholder="Phone" aria-required="true">
                                <label for="phone1">Phone</label>
                            </div>
                            <div class="block street floating_label ">
                                <input type="text" required="" id="street" class=" form-control input_street" name="signup[street]" maxlength="60"placeholder="Address" aria-required="true">
                                <label for="street">Address</label>
                            </div>
                            <div class="block zip floating_label ">
                                <input type="tel" required="" id="zip" class=" form-control input_zip" name="signup[zip]" data-form-format-helper="forceNumeric" data-rule-zipcodeus="true" maxlength="5"placeholder="Zip Code" aria-required="true">
                                <label for="zip">Zip Code</label>
                            </div>
                        </fieldset>
                    </div>
                    <!-- END COMPONENT - CONTACT INFO -->
                    <div class="additional_client_question_wrap clearfix">
                        <p>Would you like to sign up with a family or household member today and each save $<span id="fnhd_discount">50.00</span>?</p>
                        <label id="add_additional_client_yes_label" for="add_additional_client_yes">
                            <input id="add_additional_client_yes" name="signup[add_additional_client]" type="radio" value="true"> Yes
                        </label>
                        <label id="add_additional_client_no_label" for="add_additional_client_no">
                            <input checked id="add_additional_client_no" name="signup[add_additional_client]" type="radio" value="0"> No
                        </label>
                    </div>
                <div class="additional_client_wrap">
                    <div class="heading_2 client_heading" style="margin-top:35px;">Friend or Family Member's Contact Information</div>

                    <!-- COMPONENT - CONTACT INFO -->
                    <div class="component_wrap">
                        <fieldset class="contact_info">
                            <legend>Personal Information</legend>
                            <div class="block first_name floating_label ">
                                <input type="text" required="" id="first_name_ac0" class="form-control input_first_name" name="signup[additional_clients][0][first_name]" maxlength="25" value="" placeholder="First Name" aria-required="true">
                                <label for="first_name_ac0">First Name</label>
                            </div>
                            <div class="block last_name floating_label ">
                                <input type="text" required="" id="last_name_ac0" class="form-control input_last_name" name="signup[additional_clients][0][last_name]" maxlength="25" value="" placeholder="Last Name" aria-required="true">
                                <label for="last_name_ac0">Last Name</label>
                            </div>
                            <div class="block email floating_label ">
                                <input type="email" required="" id="email_ac0" class="form-control input_email" name="signup[additional_clients][0][email]" data-rule-email="true" maxlength="50" value="" placeholder="Email" aria-required="true">
                                <label for="email_ac0">Email</label>
                            </div>
                            <div class="block phone1 floating_label ">
                                <input type="tel" required="" id="phone1_ac0" class="form-control input_phone1" name="signup[additional_clients][0][phone1]" value="" data-rule-phoneus="true" data-form-format-helper="formatPhoneNumber" placeholder="Phone" aria-required="true">
                                <label for="phone1_ac0">Phone</label>
                            </div>
                            <div class="block street floating_label ">
                                <input type="text" required="" id="street_ac0" class="form-control input_street" name="signup[additional_clients][0][street]" maxlength="60" value="" placeholder="Address" aria-required="true">
                                <label for="street_ac0">Address</label>
                            </div>
                            <div class="block zip floating_label ">
                                <input type="tel" required="" id="zip_ac0" class="form-control input_zip" name="signup[additional_clients][0][zip]" data-form-format-helper="forceNumeric" data-rule-zipcodeus="true" maxlength="5" value="" placeholder="Zip Code" aria-required="true">
                                <label for="zip_ac0">Zip Code</label>
                            </div>
                        </fieldset>
                    </div>
                    <!-- END COMPONENT - CONTACT INFO -->			</div>
                    <div class="submit_button_wrap clearfix">
                        <input type="submit" value="Go To Step 2" class="button_orange submit_button" autocomplete="off">
                        <div class="cert_wrapper">
                            <table width="135" border="0" cellpadding="2" cellspacing="0" title="Click to Verify - This site chose Symantec SSL for secure e-commerce and confidential communications.">
                                <tbody><tr>
                                    <td width="135" align="center" valign="top"><script type="text/javascript" src="https://seal.websecurity.norton.com/getseal?host_name=www.lexingtonlaw.com&amp;size=S&amp;use_flash=YES&amp;use_transparent=YES&amp;lang=en"></script><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" id="s_s" width="100" height="72" align=""> <param name="movie" value="https://seal.websecurity.norton.com/getseal?at=1&amp;sealid=2&amp;dn=www.lexingtonlaw.com&amp;lang=en"> <param name="loop" value="false"> <param name="menu" value="false"> <param name="quality" value="best"> <param name="wmode" value="transparent"> <param name="allowScriptAccess" value="always"> <embed src="https://seal.websecurity.norton.com/getseal?at=1&amp;sealid=2&amp;dn=www.lexingtonlaw.com&amp;lang=en" loop="false" menu="false" quality="best" wmode="transparent" swliveconnect="FALSE" width="100" height="72" name="s_s" align="" type="application/x-shockwave-flash" pluginspage="https://www.macromedia.com/go/getflashplayer" allowscriptaccess="always">  </object><br>
                                        <a href="http://www.symantec.com/ssl-certificates" target="_blank" style="color:#000000; text-decoration:none; font:bold 7px verdana,sans-serif; letter-spacing:.5px; text-align:center; margin:0px; padding:0px;">ABOUT SSL CERTIFICATES</a></td>
                                </tr>
                                </tbody></table>
                        </div>
                    </div>
                    <div class="disclaimer_wrap">
                        <p>By clicking "Go To Step 2" I agree by electronic signature to: (1) be contacted about credit repair or credit repair marketing by a live agent, artificial or prerecorded voice, and SMS text at my residential or cellular number, dialed manually or by autodialer, and by email (consent to be contacted is not a condition to purchase services); and (2) the <a href="https://www2.lexingtonlaw.com/info/privacy-policy.html" target="_blank">Privacy Policy</a> and <a href="https://www2.lexingtonlaw.com/info/terms.html" target="_blank">Terms of Use</a>.</p>
                    </div>
                </form>
            </div>
            <div class="column testimonial_wrapper">
                <img src="images/handshake.jpg">
                <p>"Last week I received updated CR's from TU and Equifax. So far there are 3 deletions on TU and 2 deletions on Equifax. I have to admit that I was shocked and amazed!! I had decided that I was going to give your service 3 months before I made a decision as to continue my credit repair with your company. It took only 2 months before I had greatly appreciated positive results!! This is truly a wonderful service that anyone with financial difficulties should be using to get themselves back on track. I am recommending you to EVERYONE! Keep up the fantastic work that you do!!"</p>
                <p class="testimonial_name">Monica, Lexington Client<br><br></p>
                <p><a href="/info/testimonials">What you need to know about testimonials</a></p>
            </div>
        </div>

        </div>

    </section>
@endsection
@section('footer')
    <script type="text/javascript">signup.step = 1;</script>
@endsection

