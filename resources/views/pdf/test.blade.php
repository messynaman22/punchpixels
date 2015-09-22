<!DOCTYPE html>
<html>
<head>
	<title>PDF</title>
	
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css" >
	.page-break {
	    page-break-after: always;
	}
	body{
		padding:10px;
	}
	.logo{
		width:250px;
		height:50px;
	}
	.m-t{
		margin-top: 10px;
	}
	.m-t-l{
		margin-top: 30px;
	}
	.m-t-m{
		margin-top: 20px;
	}
	.title{
		font-weight: bold;
		font-size:16px;
	}
	.content{
		font-size:16px;
	}
	.form-wrapper{
		border:1px solid black;
		padding:20px;
	}
	.blue{
		color:blue;
	}
	hr{
		border-color: black;
	}
	.box-title{
		font-weight: bold;
		font-size: 20px;
	}
	.n-l-p{
		padding-left:0px !important;
	}
	.m-b{
		margin-bottom: 5px;
	}	
	</style>
</head>
<body>
	<div class="container">
		<div class="col-md-12 row m-t">		
			<div class="col-md-9">
				<img class="logo" src="{!! asset('images/logo.png') !!}" title="Credit1Solutions.com" alt="Credit1Solutions.com">
			</div>
			<div class="col-md-3">
				<h4>Credit1Solutions.com <small>TM</small><br>
				5284 N Dixie Hwy<br>
				Elizabethtown, KY 42701<br>
				cs@credit1solutions.com<br>
				Toll Free: 1-877-782-7839<br>
				www.credit1solutions.com</h4>
			</div>
		</div>
		<div class="form-wrapper col-md-12">
			<div class="col-md-12 text-center box-title blue"> User Data</div>
			<div class="col-md-12 row m-t-l">
				<div class="col-md-4">
					<span class="title">First Name :</span>
					<span class="content">{!!  $step1_fname !!}</span>
				</div>
				<div class="col-md-4">
					<span class="title">Middle Name :</span>
					<span class="content">{!! $step1_mname !!}</span>
				</div>
				<div class="col-md-4">
					<span class="title">Last Name :</span>
					<span class="content">{!! $step1_lname !!}</span>
				</div>
			</div>
			<div  class="col-md-12 row m-t-m">
				<div class="col-md-4">
					<span class="title">Email :</span>
					<span class="content">{!! $step1_email !!}</span>
				</div>
				<div class="col-md-4">
					<span class="title">Best phone to contact :</span>
					<span class="content">{!! $step1_mno !!}</span>
				</div>
				<div class="col-md-4 ">
					<span class="title">Street address :</span>
					<span class="content">{!! $step1_paddress !!}</span>
				</div>
			</div>
			<div  class="col-md-12 row m-t-m">
				<div class="col-md-4">
					<span class="title">Zip :</span>
					<span class="content">{!! $step1_zip !!}</span>
				</div>
				<div class="col-md-4">
					<span class="title">City :</span>
					<span class="content">{!! $step1_city !!}</span>
				</div>
				<div class="col-md-4 ">
					<span class="title">State :</span>
					<span class="content">{!! $step1_state !!}</span>
				</div>
			</div>
			
		</div>
		<div class="col-md-12 m-t-l">
			<h3 class="col-md-12 blue">Your Payment Information</h3>
			<hr>
			<div class="col-md-12 content">
				At Credit1Solutions.com we understand that everyone's credit report and financial situations are
				unique. This is why we offer comprehensive, personalized and proven credit repair programs. When
				you become a Credit1Solutions.com client, we will then customize your credit repair program to
				your exact credit situation and goals. We will ensure you will receive not only affordable, but premier
				credit report repair and superior customer service. Our programs are based upon extensive
				research of consumer credit laws, experience with credit bureau and creditor tactics, and
				persistence for our clients. Our programs are 100% legal and have helped thousands of clients
				correct and update their credit profiles resulting in both higher credit scores and overall better credit
				reports.
			</div>
			<h3 class="col-md-12 blue">Explanation of your first work fee?</h3>
			<hr>
			<div class="col-md-12 content">
				* Each Credit1Solutions.com Client will be charged $99.00 First Work Fee 1 to 6 Days after the
				agreed work has been performed per C.R.O.A. Laws<br><br>
				Your First Work Fee is not limited to any specific item mentioned prior to the actual C.R.O.A. laws
				however we do recommend each client to read the following items to understand our quality of
				services provided to enhance your overall experience:<br><br>
				A) ANALYSIS OF CREDIT REPORTS (EQUIFAX OR CSC CREDIT SERVICES, EXPERIAN AND
				TRANSUNION).<br><br>
				B) EXPLAIN AND PROVIDE COPY OF FEDERAL LAWS PER SEC 2451. REGULATION OF
				CREDIT REPAIR ORGANIZATIONS AND GUIDELINES OF FCRA LAWS.<br><br>				
				C) CLIENT AGREES THAT SERVICES RENDERED WILL NOT CAUSE ANY FINANCIAL HARM
				NOR REPLACE ANY OTHER OWED FINANCIAL OBLIGATIONS.<br><br>
				D) CLIENT AGREES TO THE DELIVERY/RETRIEVE SIGNED DOCUMENTS BY WAY OF E-
				GREEN. (ELECTRONICALLY)<br><br>
				E) Credit1Solutions.com AGREES TO UPLOAD TO SECTION F ALL CREDIT REPORT
				COMPONENTS DEEMED TO BE INACCURATE, UNTIMELY OR UNVERIFIABLE BY SAID
				CLIENT OF Credit1Solutions.com, LLC.<br><br>
				F) TO PROVIDE EACH CLIENT WITH HIS/HER OWN 24/7 ONLINE CUSTOMER STATUS
				PORTAL WITH SELF HELP EDUCATIONAL LIBRARY EXPLAINING CREDIT REPORTS, CREDIT
				SCORES AND ESTABLISHING A GOOD PAY HISTORY.<br><br>
			</div>
		</div>
		<!-- <div class="col-md-12 m-t-l">
			<h3 class="col-md-12 blue">Package Information</h3>
			<div class="title col-md-5">Fresh Start Program</div>
			<div class="content col-md-7">
				<div class="col-md-12">
				<h4 class="blue">$79.95 - Fresh Start Program -</h4>
				<div class="col-md-6 n-l-p">includes everything that you need for most
				standard credit report repair issues with all 3
				reporting bureaus, and allows your case
				worker to dispute each item on your credit
				reports that you feel is inaccurate, misleading,
				or unverifiable in any way.</div>
				</div>
				<div class="col-md-12">
				<h4 class="blue">Other Benefits Include:</h4>
				<div class="col-md-6 n-l-p">•"How To Budget My Money"<br>
							       •Valuable Credit Report Improvement Analysis<br>
							       •Client Support for your monthly case work<br>
							       •Unlimited Credit Inquiry Repair<br>
							       •24/7 Client Status Portal<br>
							       •Online Library<br>
							       •Online Financial Wellness Learning Center<br>
							       •Unlimited Disputes with Equifax (CSC),
							       Experian and TransUnion
				</div>
				</div>
			</div>
		</div> --><hr>
		<div class="page-break"></div>
		<div class="form-wrapper col-md-12 m-t-l">
			<div class="col-md-12 text-center box-title blue"> Primary Payment </div>
			<div class="col-md-12 row m-t-l">
				<div class="col-md-4">
					<span class="title">Name as shown on the card</span>
					<span class="content">{!! $step2_full_name !!}</span>
				</div>
				<div class="col-md-4">
					<span class="title">Credit / Debit Card</span>
					<span class="content">Visa/MC</span>
				</div>
				<div class="col-md-4">
					<span class="title">Card Number</span>
					<span class="content">{!! $step2_card_number !!}</span>
				</div>
			</div>
			<div class="col-md-12 row m-t-l">
				<div class="col-md-4">
					<span class="title">Expiration Date MM</span>
					<span class="content">{!! $step2_month !!}</span>
				</div>
				<div class="col-md-4">
					<span class="title">YY</span>
					<span class="content">{!! $step2_year !!}</span>
				</div>
				<div class="col-md-4">
					<span class="title">CVV</span>
					<span class="content">{!! $step2_cvv !!}</span>
				</div>
			</div>
		</div>
		<hr>
		<div class="col-md-12 m-t-l">
			<h3 class="col-md-12 blue">Why do we request a Secondary Payment **</h3>
			<div class="col-md-12 content">** In case your primary card is updated by its provider and you have failed to contact our billing
department prior to scheduled payment date our billing department will then adjust your account to
ensure case work is not compromised.</div>
			<div class="col-md-12 content">** You can control which is listed as Primary and Secondary Payment method, after you have fully
registered. If you have any questions, contact our staff 1-877-782-7839</div>
		</div>
		<div class="form-wrapper col-md-12 m-t-l">
			<div class="col-md-12 text-center box-title blue"> Secondary Payment </div>
			<div class="col-md-12 row m-t-l">
				<div class="col-md-4">
					<span class="title">Checking Account - Bank Name</span>
					<span class="content">{!! $step2_bank_name !!}</span>
				</div>
				<div class="col-md-4">
					<span class="title">ABA/ Routing Number</span>
					<span class="content">{!! $step2_routing_number !!}</span>
				</div>
				<div class="col-md-4">
					<span class="title">Checking Account Number</span>
					<span class="content">{!! $step2_account_number !!}</span>
				</div>
			</div>
			<div class="col-md-12 row m-t-l">
				<div class="col-md-4">
					<span class="title">Name on Account</span>
					<span class="content">{!! $step2_contact_information !!}</span>
				</div>
				<div class="col-md-4">
					<span class="title">Type of Account</span>
					<span class="content">{!! $step2_account_type !!}</span>
				</div>				
			</div>
		</div><hr>
		<div class="col-md-12 content m-t-m n-p-l">Credit1solutions.com provides a 100% money back refund if the agreed first work fee has not been
completed per C.R.O.A. laws. </div>
		<div class="page-break"></div>
		<div class="col-md-12 m-t-l">
			<h3 class="col-md-12 blue title text-center">Terms &Conditions **</h3>
			<div class="col-md-12 content">
				<div class="col-md-12 m-b">1. I (We) agree to forward all original correspondence from the credit bureaus including consumer
				credit reports to Credit1Solutions.com</div>
				<div class="col-md-12 m-b">A. I (We) agree to inform Credit1Solutions.comif I have a change in my address or other contact
				information within five days.</div>
				<div class="col-md-12 m-b">B. I understand that Credit1Solutions.com is limited in its ability to provide services without current
				contact information.</div>
				<div class="col-md-12 m-b">C. I (We) certify that I am not an employee of any credit reporting agency nor am I retainingCredit1Solutions.com, LLC under any such false pretense.</div>
				<div class="col-md-12 m-b">D. I (We) understand that the success of Credit1Solutions.com program depends on my fulfillment
				of these commitments.</div>
				<div class="col-md-12 m-b"><span class="title">2. DISCLAIMERS.</span> I (We) understand that since the success of Credit1Solutions.com program
				depends on the completion of the above commitments and the willingness of the individual credit
				reporting agencies to comply with the Fair Credit Reporting Act (FRCA), Credit1Solutions.com
				cannot guarantee any specific results.</div>
				<div class="col-md-12 m-b">3. I understand and agree that any documentation or correspondence sent to Credit1Solutions.com
				shall become the property of Credit1Solutions.com. Correspondence between the credit reporting
				agencies and Credit1Solutions.com is confidential and is the property of Credit1Solutions.com, LLC.
				I hereby waive any right to view or receive any copies of said correspondence.</div>
				<div class="col-md-12 m-b"><span class="title">4. CANCELLATION POLICY.</span> This contract may be cancelled without penalty or obligation at any
				time before midnight on the third business day after this contract was signed. After the 3rd business
				day of signed contract with Credit1Solutions.com may be cancelled at any time in writing with a 30
				days advance notice. Any customer further agrees to pay all outstanding charges based on signed
				contract. All customers agree that no Voice Mail Messages or contacting a credit1solutions.com
				representative by phone is considered a valid cancellation request.</div>
				<div class="col-md-12 m-b">All customers agree that all cancellation requests should include members name(s) and address(s)
				and can be delivered any of these mentioned options: (1) e-mailed to CS@credit1solutions.com (2)
				Uploaded to each customers online client note section that was presented in both a video
				explanation, phone conference or in person (3) Mailed to Credit1Solutions.com, LLC, 5284 N Dixie
				Hwy, Elizabethtown, KY 42701.</div>
				<div class="col-md-12 m-b">Please Note: Our office will also back date any/all Cancellation request received by U.S. postal
				services if the cancellation notice provided by each client does not match the same mailed out
				dates of envelopes delivered by US Postal Service. <span class="blue"><span class="title">Sample:</span> (Your cancellation dated 2-5-2010
				and the U.S. Postal service is dated 2-27-2010 on the envelope. Then the notice will be dated
				02-27-2010)</span></div>
				<div class="col-md-12 m-b">All customers by signing this contract agree to be billed by his/her provided account information for
				next month's payment since advance fees are not legal.</div>
				<div class="col-md-12 m-b">I understand and agree that if I cancel between the 1st -31st and have already been billed for last
				month, I still owe a remaining month to month payment the following month since I am not billed up
				front casework charges.</div>
				<div class="col-md-12 m-b">Please Note: Your preliminary fee is a separate charge from your month to month case work fee.
				Client agrees to pay court cost, attorney fees, and reasonable fees to collect wage garnishments for
				uncollected payable funds.</div>
				<div class="col-md-12 m-b"><span class="title">5. FEES. </span>I (We) understand that the above membership fees paid to Credit1Solutions.com, LLC are
				for document preparation and consulting and not credit repair.</div>
				<div class="col-md-12 m-b"><span class="title">6. Returned or Dishonored Payment.</span> If a payment is returned or dishonored by your bank orcredit card Company, we will redraft the payment and add a $25.00 late fee.</div>
				<div class="col-md-12 m-b"><span class="title">7. Collections of Unpaid balance owed for services.</span> I agree to pay for all court cost, legal fees
				and collection agency fees.</div>
				<div class="col-md-12 m-b"><span class="title">8. Questionable ITEMS TO BE APPEALED. </span> I direct Credit1Solutions.com to dispute all negative
				credit items on my credit report. I (We) believe them to be inaccurate, untimely or unverifiable. I
				(We) will attach a separate sheet listing any negative or adverse items on my credit report that I
				know to be accurate and verifiable. These items will not be challenged or deleted from my credit
				reports.</div>
				<div class="col-md-12 m-b"><span class="title">9. POWER OF ATTORNEY. </span> I (We) hereby give Credit1Solutions.com, LLC full power and authority
				to represent me in the following activities:</div>
				<div class="col-md-12 m-b">A. Communication with the national credit agencies.</div>
				<div class="col-md-12 m-b">B. The acceptance and review of my credit reports from these agencies.</div>
				<div class="col-md-12 m-b">C. The disputation of any information published by creditors or credit reporting agencies on the
				basis of inaccuracy.</div>
				<div class="col-md-12 m-b">D. The creation and signature on my behalf of all correspondence with any organization or
				individual relating to my credit report.</div>
				<div class="col-md-12 m-b"><span class="title">10. Change Payment Schedule</span>
				Should you wish to change a scheduled payment we require that you notify us within 3 business
				days prior to a payment. Changing your payment requires a $9.95 fee. The change of payment
				cannot extend 10 days from the original scheduled payment date.</div>
				<div class="col-md-12 m-b">11. As a client of Credit1solutions.com you understand that all collected fees paid to
				Credit1Solutioins.com are for documentation preparation and consulting and not credit repair. You
				understand that Credfit1Solutions.com, LLC complies with all relevant provisions of all of the
				following as amended from time to time.</div>
				<div class="col-md-12 m-b">• Section 5 of the Federal Trade Commission Act, 15 U.S.C. §5;'the Electronic Funds Transfer Act,
				15 U.S.C. § 1693, et seq. ("EFTA") and all regulations implementing the
				EFTA including without limitation Regulation E, 12 C.F.R. §1005.1, et seq.;2</div>
				<div class="col-md-12 m-b">• The Fair Credit Reporting Act, 15 U.S.C. § 1681 , et seq. ("FCRA") and all regulations
				implementing the FCRA including without limitation Regulation V, 12 C.F.R. §1 022.1, et seq.;</div>
				<div class="col-md-12 m-b">• The Credit Repair Organizations Act, 15 U.S.C. §1679, et seq.;</div>
				<div class="col-md-12 m-b">• The Telemarketing and Consumer Fraud and Abuse Prevention Act, 15 U.S.C. §6101, et seq.
				("TCFAPA"),and all regulations implementing the TCFAPA including without limitation the
				Telemarketing Sales Rule("TSR"), 16 C.F.R. Part 310;</div>
				<div class="col-md-12 m-b">• The Consumer Financial Protection Act of 201 0, 12 U.S.C. §5531 , et seq.;</div>
				<div class="col-md-12 m-b">• The Truth In Lending Act, 15 U.S.C. § 1601 , et seq. ("TILA") and all regulations implementing the
				TILA including without limitation Regulation Z, 12 C.F.R. §1 026.1, et seq.;• The Telephone Consumer Protection Act, 47 U.S.C. §227, et seq. ("TCPA") and all regulations
				implementing the TCPA including without limitation 47 C.F.R. §64.1200, et seq.;</div>
				<div class="col-md-12 m-b">• The Electronic Signatures in Global and National Commerce Act, 15 U.S.C. §7001 , et seq.; and
				all other applicable federal, state, and local laws, rules and regulations including, without limitation,
				those referring, relating or pertaining to the foregoing, consumer privacy and protection, credit,
				lending, finance, usury, and banking, and with the Rules (as defined in the Agreement).</div>
			</div>
		</div>
		<div class="form-wrapper col-md-12 m-t-m title">I agree that I have read and understand the (11) terms and
conditions by electronic signature.</div>
		<div class="col-md-12 m-t-l">
			<h3 class="col-md-12 blue title text-center">Read Your Consumer Rights</h3>
			<h3 class="col-md-12 title text-center">CONSUMER CREDIT FILE RIGHTS UNDER STATE AND FEDERAL LAW</h3>
			<div class="col-md-12 m-t content">You have a right to dispute inaccurate information in your credit report by contacting the credit
			            bureau directly. However, neither you nor a credit repair company or credit repair organization has
			            the right to have accurate, current and verifiable information removed from your credit report. The
			            credit bureau must remove accurate, negative information from your report only if it is over 7 years
			            old. Bankruptcy information can be reported up to 10 years.</div>
			 <div class="col-md-12 m-t content">You have a right to obtain a copy of your credit report from a credit bureau. You may be charged a
			 reasonable fee. There is no fee, however, if you have been turned down for credit, employment,
			 insurance, or a rental dwelling because of information in your credit report within the preceding 60
			 days. The credit bureau must provide someone to help you interpret the information in your credit
			 file. You are entitled to receive a free copy of your credit report if you are unemployed and intend to
			 apply for employment in the next 60 days, if you are a recipient of public welfare assistance, or if
			 you have reason to believe that there is inaccurate information in your credit report due to fraud.</div>
			<div class="col-md-12 m-t content"> You have a right to sue a credit repair organization that violated the Credit Repair Organization Act.
			 This law prohibits deceptive practices by credit repair organizations.</div>
			<div class="col-md-12 m-t content"> You have the right to cancel your contract with any credit repair organization for any reason within 3
			 business days from the date you signed it. Credit bureaus are required to follow reasonable
			 procedures to ensure that the information they report is accurate. However, mistakes may occur.
			 You may, on your own, notify a credit bureau in writing that you dispute that accuracy of information
			 in your credit file. The credit bureau must then reinvestigate and modify or remove inaccurate or
			 incomplete information. The credit bureau may not charge any fee for this service. Any pertinent
			 information and copies of all documents you have concerning an error should be given to the credit
			 bureau.</div>
			<div class="col-md-12 m-t content"> If the credit bureau's reinvestigation does not resolve the dispute to your satisfaction, you may send
			 a brief statement to the credit bureau to be kept in your file, explaining why you think the record is
			 inaccurate. The credit bureau must include a summary of your statement about disputed information
			 with any report it issues about you. The Federal Trade Commission regulates credit bureaus and
			 credit repair organizations. For more information contact: The Public Reference Branch Federal
			 Trade Commission Washington, D.C.</div>
		</div>
		<div class="col-md-12 m-t-l">
			<h3 class="col-md-12 blue title text-center">You Agree to Electronic Signature</h3>
			<div class="col-md-12 m-t title">LEGAL COMPLIANCE</div>
			<div class="col-md-12 m-t content">1. ELECTRONIC SIGNATURES HAVE THE SAME LEGAL EFFECT AS PEN-AND-INK, AS LONG
			AS THEY’RE EXECUTED THROUGH A PROCESS. OUR COMPREHENSIVE E-SIGNING
			PROCESS IS FULLY COMPLIANT WITH ALL RELEVANT LEGISLATION AND GUIDELINES
			INCLUDING THE FEDERAL ESIGN ACT, STATE LAWS MODELED AFTER UETA, FFIEC
			GUIDELINES FOR FINANCIAL INSTITUTIONS, AND GRAMM-LEACH-BLILEY. OUR COMPANY
			ADDRESS’S SECURITY AT</div>
			<div class="col-md-12 m-t content">EVERY LEVEL TO ENSURE A COMPLETELY TAMPERPROOF SIGNING PROCESS. OUR
			ENTIRE SITE IS MAINTAINED IN ONE OF THE WORLDS MOST SECURE FACILITIES, A SAS 70
			TYPE II DATA CENTER.</div>
			<div class="col-md-12 m-t content">2. ALL DOCUMENTS ARE ENCRYPTED AT ALL TIMES SO THAT ONLY DESIGNATED
			INDIVIDUALS CAN READ AND SIGN THEM. WE OFFER SEVERAL LEVELS OF SIGNER
			AUTHENTICATION, INCLUDING THIRD-PARTY ID VERIFICATION, AND EACH SIGNER
			CREATES A UNIQUE ELECTRONIC SIGNATURE. EVERY EVENT IN THE LIFE OF A
			DOCUMENT IS LOGGED, DATED, AND TIME STAMPED, AND WE ATTACH A COURT-
			ADMISSIBLE AUDIT TRAIL TO EVERY SIGNED DIGITAL ENVELOPE.</div>
			<div class="col-md-12 m-t content">3. SIGNING GREEN BY USING THE E- DOCUMENTS ELECTRONICALLY, CUSTOMERS AVOID
			THE ECOLOGICAL IMPACT OF PRINTING, FAXING, MAILING, AND USING COURIER
			SERVICES. EVERY PAPERLESS SIGNATURE HAS AN ENVIRONMENTAL RIPPLE EFFECT
			THAT SAVES TREES, REDUCES GREENHOUSE GASES, AND PREVENTS POLLUTION</div>
		</div>
		<div class="form-wrapper col-md-12 m-t-l">
			<div class="col-md-12 text-center box-title blue"> Other Information</div>
			<div class="col-md-12 row m-t-l">
				<div class="col-md-6">
					<span class="title">Date or Birth</span>
					<span class="content">{!!  $month  ."/ ". $day ."/ ".$year!!}</span>
				</div>
				<div class="col-md-6">
					<span class="title">Social Security Number</span>
					<span class="content">{!! $ssn !!}</span>
				</div>
			</div>

		</div>
		<div class="form-wrapper col-md-12 m-t-m">
			<div class="col-md-12 content">By clicking this "Submit" button, you are providing your electronic signature and completing the sign
			up process. You will receive a copy of this form and all all Disclosures, Terms and Conditions.</div>
			<div class="col-md-12 content m-t">By clicking I Agree, You have Read and Acknowledge all Fees, Disclosures, Terms and
			Conditions provided by Credit1Solutions.com, LLC</div>
		</div>
		<hr>
		<div class="col-md-12 m-t-m">
			<div class="col-md-6 text-center">
				<span class="title">Date :</span>
				<span class="content">{!! $date !!}</span>
			</div>
			<div class="col-md-6 text-center">
				<span class="title">Serial No :</span>
				<span class="content">{!! $step1_serialno !!}</span>
			</div>
		</div>
	</div>
</body>
</html>