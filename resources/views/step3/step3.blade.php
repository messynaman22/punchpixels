<!DOCTYPE html>
<html>
<head>
	@include('new_auth.head')
</head>
<body>
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
	                        <li><a href="#">Step 1 </a></li>
	                        <li><a href="#">Step 2</a></li>
	                        <li><a href="#">Step 3 "Getting Started: Legal Agreements"</a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="col-sm-6">
	                <div class="flright audio">
	                    <span class="audio-right"><img src="{{ asset('/images/icon-audio-right.png') }}"></span> <a id="playAudio" class="audioclick lg" onclick = "toogleAudio()" style="cursor:pointer">Click For Audio</a>
	                    <span class="audio-left"><img src="{!!asset('/images/icon-audio-left.png')!!}"></span>
	                </div>
	                <div class="flright text-right">
	                    <span class="signuptxt"> “Your almost done, all we need you to do is to review the terms and conditions, the consumer rights, and federal disclosure statements”.</span>
	                </div>
	            </div>
	        </div><!-- end row-->
	    </div>
	</nav>


	<section class="formcontainer">
	<div class="container">
		<div class="col-md-7">

		
		<div class="col-md-12 nopadding">
			<div class="contract-title" >Legal Compliance Information</div>
		    	<div class="contract-content">
		    			<p>1. Electronic Signatures Have the Same Legal Effect as Pen-And-Ink, As Long As They’re Executed through a Process. Our Comprehensive E-Signing Process is fully Compliant with all Relevant Legislation and guidelines including The FEDERAL E SIGN ACT, State Laws Modeled after UETA, FFIEC Guidelines for Financial Institutions, and Gramm-Leach-Bliley.</p> 
			<p>2. All Documents are encrypted at all times so that only designated individuals can read and sign them. We offer several levels of signer authentication, including third-party idverification, and each signer creates a unique electronic signature. Every event in the life of a document is logged, dated, and time stamped, and we attach a court-admissible audit trail to every signed digital envelope.</p>
					<hr>
			<p>At credit1solutions.com we understand that everyone's credit report and financial situations are unique. This is why we offer comprehensive, personalized and proven credit repair programs. When you become a credit1solutions.com client, we will then customize your credit repair program to your exact credit situation and goals. We will ensure you will receive not only affordable, but premier credit report repair and superior customer service. Our programs are based upon extensive research of consumer credit laws, experience with credit bureau and creditor tactics, and persistence for our clients. Our programs are 100% legal and have helped thousands of clients correct and update their credit profiles resulting in both higher credit scores and overall better credit reports.</p>
			<p><strong>Explanation of Credit Report Charge</strong> <br>Our One-time credit report charge today : <br>Date: {{ $today  }}                                      Fee Amount: $ 12.99</p><hr>
			<p><strong>Explanation of your First Payment</strong><br><br>Each credit1solutions.com client will be charged $99.95 first payment fee 3-10 days after agreed work has been performed per C.R.O.A. A first payment fee is not the same as the month to month casework dispute fees. The casework fee is separate and paid monthly..Clients who retain our services will be charged monthly thereafter and exactly 30 days from the agreed first payment date for work previously performed. You may cancel anytime.<br><br><strong>Your First Payment</strong> <br><br>is not limited to any specific item mentioned prior to the actual C.R.O.A. however we do recommend each client to read the following items to understand our quality of services are provided to enhance your overall experience and agree this is not Advance Fee. <br>A) Analysis of credit reports (Equifax, Experian and Transunion). <br>B) Explain and provide copy of federal laws per sec 2451. Regulation of credit repair organizations and guidelines of FCRA laws.<br>C) Client agrees that services rendered will not cause any financial harm nor replace any other owed financial obligations. <br>D) Client agrees to the delivery and retrieval of electronic signed documents. Signed Copy will be posted to your Client Portal Online. You will be provided Username/Password Access in separate Welcome Kit.<br>E) Credit1solutions.com agrees to upload components deemed to be inaccurate, untimely or unverifiable by said client of credit1solutions.com to client’s online portal for approval.<br>F) To provide each client with his/her own 24/7 online customer status portal with self-help educational library explaining credit reports, credit scores and establishing a good pay history.<br><hr><strong>Why do we request a Secondary Payment **</strong><br><br>In case you’re primary card is updated by its provider and you have failed to contact our billing department prior to scheduled payment date our billing department will then adjust your account to ensure case work is not compromised.</p>
			</div>
		</div>
		<div class="col-md-12 nopadding">
			<div class="contract-title"  style="margin-top:10px">Legal Terms and Conditions</div>
			<div class="contract-content">
				<p>1. I (We) agree to forward all original correspondence from the credit bureaus including consumer credit reports to Credit1Solutions.comA. I (We) agree to inform Credit1Solutions.com if I have a change in my address or other contact information within five days.<br><br>B. I understand that Credit1Solutions.com is limited in its ability to provide services without current contact information.<br><br>C. I (We) certify that I am not an employee of any credit reporting agency nor am I retaining Credit1Solutions.com, LLC under any such false pretense.<br><br>D. I (We) understand that the success of Credit1Solutions.com program depends on my fulfillment of these commitments.<br><br>2. DISCLAIMERS. I (We) understand that since the success of Credit1Solutions.com program depends on the completion of the above commitments and the willingness of the individual credit reporting agencies to comply with the Fair Credit Reporting Act (FRCA), Credit1Solutions.com cannot guarantee any specific results.<br><br>3. Credit Repair. I understand and agree that any documentation or correspondence sent to Credit1Solutions.com shall become the property of Credit1Solutions.com. Correspondence between the credit reporting agencies and Credit1Solutions.com is confidential and is the property of Credit1Solutions.com, LLC. I hereby waive any right to view or receive any copies of said correspondence.<br><br>4. CANCELLATION POLICY. This contract may be cancelled without penalty or obligation at any time before midnight on the third business day after this contract was signed.<br><br>Credit1solutions.com will not accept back dated request.<br><br>This contract may be canceled with a 30 day cancellation notice in writing with the understanding as long as all arrears monthly casework has been accepted no additional payments will be owed Credit1Solutions.com.  REMINDER: All monthly payments for either service selected are paid in the arrears and never collected upfront as described in the service disclaimers online, audio disclaimers, contractual agreement. Those services start 30 days from the First Payment scheduled date and each 30 days unless written notice and approved by Credit1solutions.com management.<br><br>All Credit1solutions.com customers agree to pay all outstanding charges based on signed contract. All customers agree that no voice mail messages or contacting a credit1solutions.com representative by phone is considered a valid cancellation request.<br><br>All customers agree to the following options as written acknowledgement of cancellation:<br><br>(a) E-mail: cancellation@credit1solutions.com<br><br>(b) Client Portal Note section that was presented in both a video explanation, phone conference, audio, text or face to face. <br><br>(c) Mailed to Credit1Solutions.com: 5284 N Dixie Hwy Elizabetthown, KY 42701 If the cancellation notice provided by each client does not match the same mailed out dates of envelopes received those request will be saved for 3 years and matched to its envelope that is postmarked by postage carrier to validate request was backdated.<br><br>All customers by signing this contract agree to be billed by his/her provided account information for next month's payment since advance fees are not legal. <br><br>I understand and agree that if I cancel between the 1st -31st of any month and have not been billed for services rendered, then I  {!! $formData["step1"]["fname"] ." ".$formData["step1"]["lname"] !!}  agree to pay remaining month to month payment for the following month since I am not billed up front for any casework completed. <br><br> Additional Reminders: Your First Payment fee is a separate charge from your month to month case work fee. Client agrees to pay court cost, attorney fees, and reasonable fees to collect wage garnishments for uncollected payable funds.  <br><br>5. FEES. I (We) understand that the above membership fees paid to Credit1Solutions.com, LLC are for document preparation and consulting and not credit repair. <br><br>6. Returned or Dishonored Payment. If a payment is returned or dishonored by your bank or credit card Company, we will redraft the payment and add a $25.00 late fee.  <br><br>7. Collections of Unpaid balance owed for services. I agree to pay for all court cost, legal fees and collection agency fees.8. Questionable ITEMS TO BE APPEALED. I direct Credit1Solutions.com to dispute all negative credit items on my credit report. I (We) believe them to be inaccurate, untimely or unverifiable. I (We) will attach a separate sheet listing any negative or adverse items on my credit report that I know to be accurate and verifiable. These items will not be challenged or deleted from my credit reports. <br><br>9. POWER OF ATTORNEY. I (We) hereby give Credit1Solutions.com, LLC full power and authority to represent me in the following activities: Communication with the national credit agencies. The acceptance and review of my credit reports from these agencies.The disputation of any information published by creditors or credit reporting agencies on the basis of inaccuracy.The creation and signature on my behalf of all correspondence with any organization or individual relating to my credit report. <br><br>10. Change Payment Schedule Should you wish to change a scheduled payment we require that you notify us within 3 business days prior to a payment. Changing your payment requires a $9.95 fee. The change of payment cannot extend 10 days from the original scheduled payment date.  <br><br>11. As a client of Credit1solutions.com you understand that all collected fees paid to Credit1Solutioins.com are for documentation preparation and consulting and not credit repair.<br><br>12. You understand that Credfit1Solutions.com, LLC complies with all relevant provisions of all of the following as amended from time to time.  <ul class="terms-ul">
				<li>Section 5 of the Federal Trade Commission Act, 15 U.S.C. §5;'the Electronic Funds Transfer Act, 15 U.S.C. § 1693, et seq. ("EFTA") and all regulations implementing the EFTA including without limitation Regulation E, 12 C.F.R. §1005.1, et seq.;2</li>
				<li>The Fair Credit Reporting Act, 15 U.S.C. § 1681 , et seq. ("FCRA") and all regulations implementing the FCRA including without limitation Regulation V, 12 C.F.R. §1 022.1, et seq.; </li>
				<li>The Credit Repair Organizations Act, 15 U.S.C. §1679, et seq.;</li>
				<li>The Telemarketing and Consumer Fraud and Abuse Prevention Act, 15 U.S.C. </li>
				<li>§6101, et seq. ("TCFAPA"),and all regulations implementing the TCFAPA including without limitation the Telemarketing Sales Rule("TSR"), 16 C.F.R. Part 310; </li>
				<li> The Consumer Financial Protection Act of 201 0, 12 U.S.C. §5531 , et seq.; </li>
				<li> The Truth In Lending Act, 15 U.S.C. § 1601 , et seq. ("TILA") and all regulations implementing the   TILA including without limitation Regulation Z, 12 C.F.R. §1 026.1, et seq.; </li>
				<li> The Telephone Consumer Protection Act, 47 U.S.C. §227, et seq. ("TCPA") and all regulations implementing the TCPA including without limitation 47 C.F.R. §64.1200, et seq.; </li>
				<li>The Electronic Signatures in Global and National Commerce Act, 15 U.S.C. §7001 , et seq.; and all other applicable federal, state, and local laws, rules and regulations including, without limitation, those referring, relating or pertaining to the foregoing, consumer privacy and protection, credit, lending, finance, usury, and banking, and with the Rules (as defined in the Agreement). .</li>
				</ul> </p>
			</div>
		</div>
			<div  class="col-md-12 nopadding">
				<div class="contract-title"  style="margin-top:10px">Read Your Consumer Rights</div>
				<div class="contract-content">
					<p><strong>CONSUMER CREDIT FILE RIGHTS UNDER STATE AND FEDERAL LAW</strong><br><br>You have a right to dispute inaccurate information in your credit report by contacting the credit bureau directly. However, neither you nor a credit repair company or credit repair organization has the right to have accurate, current and verifiable information removed from your credit report. The credit bureau must remove accurate, negative information from your report only if it is over 7 years old. Bankruptcy information can be reported up to 10 years.<br><br>You have a right to obtain a copy of your credit report from a credit bureau. You may be charged a reasonable fee. There is no fee, however, if you have been turned down for credit, employment, insurance, or a rental dwelling because of information in your credit report within the preceding 60 days. The credit bureau must provide someone to help you interpret the information in your credit file. You are entitled to receive a free copy of your credit report if you are unemployed and intend to apply for employment in the next 60 days, if you are a recipient of public welfare assistance, or if you have reason to believe that there is inaccurate information in your credit report due to fraud.<br><br>You have a right to sue a credit repair organization that violated the Credit Repair Organization Act. This law prohibits deceptive practices by credit repair organizations.<br><br>You have the right to cancel your contract with any credit repair organization for any reasonwithin 3 business days from the date you signed it. Credit bureaus are required to follow reasonable procedures to ensure that the information they report is accurate. However, mistakes may occur. You may, on your own, notify a credit bureau in writing that you dispute that accuracy of information in your credit file. The credit bureau must then reinvestigate and modify or remove inaccurate or incomplete information. The credit bureau may not charge any fee for this service. Any pertinent information and copies of all documents you have concerning an error should be given to the credit bureau.<br><br>If the credit bureau's reinvestigation does not resolve the dispute to your satisfaction, you may send a brief statement to the credit bureau to be kept in your file, explaining why you think the record is inaccurate. The credit bureau must include a summary of your statement about disputed information with any report it issues about you. The Federal Trade Commission regulates credit bureaus and credit repair organizations. For more information contact: The Public Reference Branch Federal Trade Commission Washington, D.C.</p>
				</div>
			</div>

			<div class="col-md-12 nopadding m-t">				
				<div class="alert alert-danger alert-dismissable m-t" id="reqAlert">
				  <button type="button" class="close" onclick="hideAlert()"> &times;</button>
				  <span id="errorMsg">  </span>
				</div>
			</div>
			  {!!Form::open(['method'=>'post', 'url'=>'/step3','id'=>'step3form'])!!}
			<div class="row m-t">
			    <div class="col-sm-4 m-t">
			        <div class="form-group">
			            <label for="fname">First Name</label>                                   
			            {!!Form::text('sthfname', old('sthfname'), ['id'=>'fname', 'class'=>'form-control',"disabled"])!!}
			         
			        </div>
			    </div>
			    <div class="col-sm-4 m-t">
			        <div class="form-group">
			            <label for="mname">Middle Name</label>
			            {!!Form::text('sthmname', old('sthmname'), ['id'=>'mname', 'class'=>'form-control',"disabled"])!!}
			        </div>
			    </div>
			    <div class="col-sm-4 m-t">
			        <div class="form-group">
			            <label for="lname">Last Name</label>
			            {!!Form::text('sthlname', old('sthlname'), ['id'=>'lname', 'class'=>'form-control',"disabled"])!!}
			        </div>
			    </div>
			</div>
			<div  class="row m-t">
				<div class="col-sm-4 m-t">
				    <div class="form-group">
				        <label for="dln">*Driver License Number</label>                                   
				        {!!Form::text('dln', old('dln'), ['id'=>'dln', 'class'=>'form-control req'])!!}
				     
				    </div>
				</div>
				<div class="col-sm-4 m-t">
				            <div class="form-group">
				                <label for="dls">*Driver License State</label>
				                {!!Form::select('dls', $states, old('state'), ['class'=>'form-control req','id'=>'dls'])!!}
				            </div>
				 </div>			
				<div class="col-sm-4 m-t">
				    <div class="form-group">
				        <label for="ssn">*Social Security Number</label>                                   
				        {!!Form::text('ssn', old('dls'), ['id'=>'ssn', 'class'=>'form-control req'])!!}				     
				    </div>
				</div>
			</div>
			<div class="row m-t">
				<div class="col-sm-12 contract-title" >Date of Birth</div>
				<div class="col-sm-4 m-t">
				    <div class="form-group">
				        <label for="hau">Month</label>
				        {!!Form::select('month', $dates['month'], old('month'), ['class'=>'form-control'])!!}
				    </div>
				</div>
				<div class="col-sm-4">
				    <div class="form-group m-t">
				        <label for="hau">Date</label>
				        {!!Form::select('day', $dates['days'], old('day'), ['class'=>'form-control'])!!}
				    </div>
				</div>				
				<div class="col-sm-4 m-t">
				    <div class="form-group">
				        <label for="hau">Year</label>
				        {!!Form::select('year', $dates['year'], old('year'), ['class'=>'form-control'])!!}
				    </div>
				</div>
				@foreach($formData["step1"] as $name=>$value)
					{!! Form::hidden("step1_".$name, $value) !!}
				@endforeach
				@foreach($formData["step2"] as $name=>$value)
					{!! Form::hidden("step2_".$name, $value) !!}
				@endforeach
			</div>
			<div class="col-md-12 nopadding">
					<div class="form-group agreebox  nopadding">
				            	<input name="agree" type="checkbox" id="agree"><label for="sacib" ></label><span class="bothsame agree_span">By clicking I Agree, that I have Read and acknowledge all Fees, Disclosures, Terms and Conditions provided by Credit1Solutions.com ™</span><br><br>
				              <em id="accepted">Your electronic acceptance of this Agreement signifies that you have read, understand, acknowledge and agree to be bound by this Agreement.
You will receive a copy of this form and all Disclosures, Terms and Conditions.</em>
				              </div>
			</div>
			                    <div class="row">
				                    <div class="col-md-3 ">
				                        <input type="button" id="submitStep3" class="gotobutton"  value="SIGNUP">
				                    </div>
			                    </div>
			{!!Form::close()!!}
		</div>
		<div class="col-md-5">
			<div class="img-signup">
			    <img src="{{ asset('/images/img-signup.jpg') }}">
			</div>
			<h1 class="testimonial" style="margin-top:20px">Testimonial</h1>
			<div class="testimonials">
			    <p><em>Your services helped us purchase our new home!</em></p>
			    <div class="client">
			        Thanks M Tran<br>
			        Credit1solutions.com Client
			    </div>
			</div>
		</div>
	</div>
	</section>

	@include('new_auth.straphline')
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
	<audio id="step3audio"style="display:none" preload="none"> 
	   <source src={!!asset("audio/step3.mp3")!!} type="audio/mpeg">
	</audio>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	<script type="text/javascript">
		var show_close_alert = true;
		var formData = {!! json_encode($formData) !!};
		console.dir(formData);
		$('#submitStep3').attr('disabled',true);
		classFunc(true,"disbutton",$('#submitStep3'));
		function classFunc(isAdd,className,object){
		   if(isAdd){
		       if(!object.hasClass(className))
		               object.addClass(className);
		       }else{
		           if(object.hasClass(className))
		               object.removeClass(className);
		       }
		}
		function startAudio(){
		                play = true;
		                audio.trigger('play');
		                $("#playAudio").html("Audio playing...");
		    }
		     
		    function pauseAudio(){
		                play = false;
		                audio.trigger('pause');
		                $("#playAudio").html("Click for audio");
		        }
		    function toogleAudio(){
		        if(!play){
		            startAudio();
		        }else{
		            pauseAudio();
		        }
		    }
		    hideAlert();
		     $(document).ready(function(){
		        audio = $("#step3audio");
		        play = false;
		        setTimeout(function(){
		            if(!play)
		                startAudio();
		        },3000);
		     });
		     $("#accepted").hide();
		     $("#agree").click(function(){
		     	if(this.checked){
		     		$("#accepted").show();
		     		classFunc(false,"disbutton",$('#submitStep3'));
		     		$('#submitStep3').attr('disabled',false);
		     	}else{
		     		$("#accepted").hide();
		     		classFunc(true,"disbutton",$('#submitStep3'));
		     		$('#submitStep3').attr('disabled',true);
		     	}
		     });
		     $("#submitStep3").click(function(){
		     	errorMsg = "";
		     	if($("#submitStep3").attr('disabled'))
		     		return;
		     	var valid = true;
		     	$(".req").each(function(){
		     	    $this = $(this);
		     	    if($this.val()==""){
		     	        valid = false;
		     	        classFunc(true,"input-error",$this);
		     	        classFunc(true,"field_error",$this.prev());
		     	    }else{
		     	          classFunc(false,"input-error",$this);
		     	         
		     	          classFunc(false,"field_error",$this.prev());
		     	    }

		     	});
		     	if(!valid)
		     	       errorMsg = "There * marked fields are required<br>";
		     	
		     	if(retByName("month").val()=="default"){
		     		errorMsg += "Month is required.<br>";
		     		classFunc(true,"input-error",retByName("month"));
		     	}else{
		     		classFunc(false,"input-error",retByName("month"));
		     	}

		     	if(retByName("day").val()=="default"){
		     		errorMsg += "Date is required.<br>";
		     		classFunc(true,"input-error",retByName("day"));
		     	}else{
		     		classFunc(false,"input-error",retByName("day"));
		     	}

		     	if(retByName("year").val()=="default"){
		     		errorMsg += "Year is required.<br>";
		     		classFunc(true,"input-error",retByName("year"));
		     	}else{
		     		classFunc(false,"input-error",retByName("year"));
		     	}

		     	if(!checkSSN(retByName("ssn").val())){
		     		errorMsg += "SSN should be 9 digit number.";
		     		classFunc(true,"input-error",retByName("ssn"));
		     		classFunc(true,"field_error",retByName("ssn").prev());
		     	}else{
		     		if(!retByName("ssn").hasClass("input-error")){
		     			classFunc(false,"input-error",retByName("ssn"));
		     			classFunc(false,"field_error",retByName("ssn").prev());
		     		}
		     	}


		     	if(valid){		
		     		show_close_alert = false;     	  
		     		document.getElementById('step3form').submit();
		     	}else{		 
		     	    $("#reqAlert").show();
		     	    $("#errorMsg").html(errorMsg);
		     	}
		     });

		     function hideAlert(){
		     	$("#reqAlert").hide();
		     }
		     function retByName(name){
		        return $($("[name="+name+"]").get(0));
		     }

		     function checkSSN(value){
		                var regex = /^[0-9]{3}-[0-9]{2}-[0-9]{4}$/;
		     	return (regex.test(value)||value=="");
		     }


		   
	function splitString(at,currentValue){
		var num1 = currentValue.substring(0,at);
		var num2 = currentValue.substring(at,currentValue.length);
		return num1+"-"+num2;
	 }

 	retByName("dln").bind("change paste keyup",function(){
		var $this = $(this);
		var length = $this.val().length;
		var ch = $this.val().charAt(length-1);
		var currentValue =$this.val();


		if(isNaN(ch)||length>12){
			$this.val(currentValue.substring(0,length-1));
			return;
		}

		if(length>3  &&  currentValue.charAt(3)!="-"){
			var num1 = currentValue.substring(0,3);
			var num2 = currentValue.substring(3,length);
			$this.val(num1+"-"+num2);
			length++;
		}

		if(length>7 &&  currentValue.charAt(7)!="-"){
			var num1 = currentValue.substring(0,7);
			var num2 = currentValue.substring(7,length);
			$this.val(num1+"-"+num2);
			return;
		}
	});

	retByName("ssn").bind("change paste keyup",function(){
		        var $this = $(this);
		        var length = $this.val().length;
		        var ch = $this.val().charAt(length-1);
		        var currentValue = $this.val();

		            if(isNaN(ch)||length>11){
		              $this.val(currentValue.substring(0,length-1));
		              return;
		            }

		            if(length>3  &&  currentValue.charAt(3)!="-"){             
		             $this.val(splitString(3,currentValue));
		             length++;
		            }
		            if(length>6  &&  currentValue.charAt(6)!="-"){             
		             $this.val(splitString(6,currentValue));
		             length++;		             
		            }		            
		            
	        	});

		     retByName("sthfname").val(formData.step1.fname);
		     retByName("sthmname").val(formData.step1.mname);
		     retByName("sthlname").val(formData.step1.lname);
		     

		     $("a").bind("mouseup", function() {
		         show_close_alert = false;
		     });
		   

		     $(window).bind("beforeunload", function() {
		         if (show_close_alert) {
		             return "You are about to leave this page.";
		         }
		     });


	</script>
</body>
</html>