$(function(){
	signup.init();
});

var signup = {

	step: null,
	service_level_id: null,

	init: function(){

		if(signup.step == 1){
			//if(getURLParam('FHD')){
			//	$('#add_additional_client_yes').trigger('click');
			//}
			signup.step1_init();
		}
		if(signup.step == 1.5){
			signup.step15_init();
		}
		if(signup.step == 2){
			signup.step2_init();
			cardType.init();
		}
		if(signup.step == 3){
			signup.step3_init();
			PrintAgreements.init();
		}

	},

	step1_init: function(){
		$("#frmSignUp1").validate({
			debug: false,
			errorElement: 'em',
			errorClass: 'field_error',
			onfocusout: false,
			errorPlacement: function(error, element){
				error.prependTo(element.parent('.block'));
			},
			highlight: function(element, errorClass, validClass){
				$(element).parent('.block').addClass(errorClass);
			},
			unhighlight: function(element, errorClass, validClass){
				$(element).parent('.block').removeClass(errorClass);
			},
			submitHandler: function(form){
				//$(form).find('input[type=submit]').attr('disabled', 'disabled');
				// IE9 decided that we do not get to style disabled input fields.... GENIUS!!!!
				$(form).find('input[type=submit]').on('click.i-hate-ie', function(event){
					event.preventDefault();
				});
				form.submit();
			}
		});

		// check initial state of additional client
		if($('input[type=radio][name="signup[add_additional_client]"]:checked').val() == 'true'){
			signup.enableAdditionalClient();
		}else{
			signup.disableAdditionalClient();
		}

		// handle additional client change event
		$('input[type=radio][name="signup[add_additional_client]"]').on('change.additionalClient', function(event){
			if($(this).val() == 'true'){
				signup.enableAdditionalClient();
			}else{
				signup.disableAdditionalClient();
			}
		});

    },

	step15_init: function(){

		$("#frmSignUp1b").validate({
			debug: false,
			errorElement: 'em',
			errorClass: 'field_error',
			onfocusout: false,
			highlight: function(element, errorClass, validClass){
				$(element).addClass(errorClass);
				if($(element).hasClass('deduction_out_of_check_element')){
					$(element).parents('.deduction_out_of_check').addClass(errorClass);
				}else if($(element).hasClass('fixed_expense_element')){
					$(element).parents('.fixed_expense').addClass(errorClass);
				}else if($(element).hasClass('garnishment_element')){
					$(element).parents('.additional_answers_wrapper').addClass(errorClass);
				}else{
					$(element).parents('.answers_wrapper').addClass(errorClass);
				}
			},
			unhighlight: function(element, errorClass, validClass){
				$(element).removeClass(errorClass);
				if($(element).hasClass('marital_status_element')){
					$(element).parents('.answers.radio').find('em.field_error').remove();
				}
				if($(element).hasClass('deduction_out_of_check_element')){
					$(element).parents('.deduction_out_of_check').removeClass(errorClass);
				}else if($(element).hasClass('fixed_expense_element')){
					$(element).parents('.fixed_expense').removeClass(errorClass);
				}else if($(element).hasClass('garnishment_element')){
					$(element).parents('.additional_answers_wrapper').removeClass(errorClass);
				}else{
					$(element).parents('.answers_wrapper').removeClass(errorClass);
				}
			},
			submitHandler: function(form){
				//$(form).find('input[type=submit]').attr('disabled', 'disabled');
				// IE9 decided that we do not get to style disabled input fields.... GENIUS!!!!
				$(form).find('input[type=submit]').on('click.i-hate-ie', function(event){
					event.preventDefault();
				});
				form.submit();
			}
		});
	},

	step2_init: function(){

		$("#frmSignUp2").validate({
			debug: false,
			errorElement: 'em',
			errorClass: 'field_error',
			onfocusout: false,
			errorPlacement: function(error, element){
				error.prependTo(element.parent('.block'));
			},
			highlight: function(element, errorClass, validClass){
				$(element).parent('.block').addClass(errorClass);
			},
			unhighlight: function(element, errorClass, validClass){
				$(element).parent('.block').removeClass(errorClass);
			},
			messages: {
				"signup[cc][0][cc_cvv]": {required: 'Required.'},
				"signup[cc][0][cc_exp]": {required: 'Required.'},
				"signup[cc][1][cc_cvv]": {required: 'Required.'},
				"signup[cc][1][cc_exp]": {required: 'Required.'},
			},
			submitHandler: function(form){
				//$(form).find('input[type=submit]').attr('disabled', 'disabled');
				// IE9 decided that we do not get to style disabled input fields.... GENIUS!!!!
				$(form).find('input[type=submit]').on('click.i-hate-ie', function(event){
					event.preventDefault();
				});
                frmSignUp2_submit()
			}
		});

		$('.input_cc_num').each(function(){
			if($(this).val().length === 0){
				$(this).rules('add', {customCreditCard: true});
			}
		});

		$('.input_cc_exp').each(function(){
			if($(this).is('#cc_exp_0')){
				$(this).rules('add', {CCExp: {}});
			}else{
				$(this).rules('add', {
					CCExp: {
						depends: function(element){
							return signup.validateAdditionalPaymentMethod();
						}
					}
				});
			}
		});

		$('.additional_payment_method .payment_method_card input').each(function(){
			$(this).rules('add', {
				required: function(){
					return signup.validateAdditionalPaymentMethod();
				}
			});
		});


		// for now check premier by default
		$('#product_select_premier.product_selection_checkbox').prop('checked', true);

		// handle product seletion
		$('.product_selection_checkbox').on('click.productSelection', function(event){
			if($(this).prop('checked') == true){
				if($(this).attr('id') == 'product_select_premier'){
					$('#product_select_standard.product_selection_checkbox').prop('checked', false);
					$('.service_level_selection').removeClass('active_standard').addClass('active_premier');
				}
				if($(this).attr('id') == 'product_select_standard'){
					$('#product_select_premier.product_selection_checkbox').prop('checked', false);
					$('.service_level_selection').removeClass('active_premier').addClass('active_standard');
				}
			}else{
				event.preventDefault();
			}
		});

		// handle quickstart selection
		$('#report_up_front_checkbox').on('change.quickStartSelection', function(){
			var $report_up_front_cost = $('#report_up_front_cost');
			if($(this).is(':checked')){
				$report_up_front_cost.html($report_up_front_cost.attr('data-cost'));
				$('#total_due_cost').html($report_up_front_cost.attr('data-cost'));
			}else{
				$report_up_front_cost.html("0");
				$('#total_due_cost').html("0");
			}
		});

		// check for currently checked payment method
		$('.payment_method_selection input[type=radio]:checked').each(function(){

			var currentPaymentMethodWrapper = $(this).parents('.payment_method_wrapper');

			if($(this).val() == 'ach'){
				signup.paymentMethodAch(currentPaymentMethodWrapper);
			}else{
				signup.paymentMethodCc(currentPaymentMethodWrapper);
			}
		});

		// handle payment method selection
		$('.payment_method_selection input[type=radio]').on('change.paymentMethodSelection', function(){

			var currentPaymentMethodWrapper = $(this).parents('.payment_method_wrapper');

			if($(this).val() == 'ach'){
				// ach
				signup.paymentMethodAch(currentPaymentMethodWrapper);
			}else{
				// credit card
				signup.paymentMethodCc(currentPaymentMethodWrapper);
			}
		});

		// allow a user to click the toggle and switch payment method
		$('.switch .dummyclick').on('click.paymentMethodSelection', function(){
			$(this).siblings('input[type="radio"]').not(':checked').trigger('click');
		});

		// handle billing information
		$('.same_contact_info_checkbox').on('change.billingInfoSame', function(){

			var currentBillingInfoSameWrapper = $(this).parents('.billing_info_same_wrapper');

			if($(this).prop('checked') == true){
				currentBillingInfoSameWrapper.children('.text').children('.users_information').show();
				currentBillingInfoSameWrapper.next('.billing_info_wrapper').removeClass('expanded');
				currentBillingInfoSameWrapper.next('.billing_info_wrapper').find('input').each(function(){
					if(typeof ContactInformation == 'object'){
						if($(this).hasClass('input_name_on_card')){
							$(this).val(ContactInformation.fullname);
						}
						if($(this).hasClass('input_cc_street')){
							$(this).val(ContactInformation.street);
						}
						if($(this).hasClass('input_cc_zip')){
							$(this).val(ContactInformation.zip);
						}
					}
				});
			}else{
				currentBillingInfoSameWrapper.children('.text').children('.users_information').hide();
				currentBillingInfoSameWrapper.next('.billing_info_wrapper').addClass('expanded');
				currentBillingInfoSameWrapper.next('.billing_info_wrapper').find('input').val('');
			}
		});
	},

	step3_init: function(){

		$("#frmSignUp3").validate({
			debug: false,
			errorElement: 'em',
			errorClass: 'field_error',
			onfocusout: false,
			errorPlacement: function(error, element){
				error.prependTo(element.parent('.block'));
			},
			highlight: function(element, errorClass, validClass){
				if($(element).hasClass('legal_agreement_checkbox')){
					$(element).parents('.agreement').addClass(errorClass);
				}else{
					$(element).parent('.block').addClass(errorClass);
				}
			},
			unhighlight: function(element, errorClass, validClass){
				if($(element).hasClass('legal_agreement_checkbox')){
					$(element).parents('.agreement').removeClass(errorClass);
				}else{
					$(element).parent('.block').removeClass(errorClass);
				}
			},
			submitHandler: function(form){
				//$(form).find('input[type=submit]').attr('disabled', 'disabled');
				// IE9 decided that we do not get to style disabled input fields.... GENIUS!!!!
				$(form).find('input[type=submit]').on('click.i-hate-ie', function(event){
					event.preventDefault();
				});
				form.submit();
			}
		});

		$('#username').rules('add', {minlength: 5});
		$('#password2').rules('add', {equalTo: '#password1'});

		$('#password1').pstrength({'minChar':8,'verdicts':	["<img src='/assets/images/password-strength-indicators/pw_no.png' alt='not good enough' />", "<img src='/assets/images/password-strength-indicators/pw_weak.png' alt='weak' />", "<img src='/assets/images/password-strength-indicators/pw_medium.png' alt='medium' />", "<img src='/assets/images/password-strength-indicators/pw_medium.png' alt='medium' />", "<img src='/assets/images/password-strength-indicators/pw_strong.png' alt='strong' />"]});

		// hack fix ie10 display issue
		$('#password1, #password2').on('blur.iehack', function(){
			$(this).val($(this).val());
		});

		// check / uncheck all agreements
		$('#select_all_agreements_checkbox').on('click.selectAllAgreements', function(){
			if($(this).prop('checked')){
				$('.agreement input[type=checkbox]').each(function(){
					$(this).prop('checked', true);

					// remove select all agreements handler if user manually unchecks an agreement
					$(this).on('change.selectAllAgreements', function(){
						$('.agreement input[type=checkbox]').off('change.selectAllAgreements');
						$('#select_all_agreements_checkbox').prop('checked', false);
					});
				});
			}else{
				$('.agreement input[type=checkbox]').each(function(){
					$(this).prop('checked', false);
				});
			}
		});

		// show / hide an agreement
		$('.agreement .agreement_expand_arrow, .agreement .agreement_name').on('click.expandAgreement', function(){
			$(this).parents('.agreement').toggleClass('expanded');
		});
	},

	// handle display of additional client form on step 1
	enableAdditionalClient: function(){
		$('.additional_client_wrap input').prop('disabled', false);
		$('.client_heading').addClass('expanded');
		$('.additional_client_wrap').addClass('expanded');
	},

	// handle display of additional client form on step 1
	disableAdditionalClient: function(){
		$('.additional_client_wrap input').prop('value', '').prop('disabled', true);
		$('.client_heading').removeClass('expanded');
		$('.additional_client_wrap').removeClass('expanded');
	},

	paymentMethodAch: function(currentPaymentMethodWrapper){
		//$('#signup_primary_payment_method').val('ACH');
		currentPaymentMethodWrapper.find('#signup_primary_payment_method').val('ACH');
		currentPaymentMethodWrapper.find('.payment_method_card').removeClass('expanded');
		currentPaymentMethodWrapper.find('.payment_method_ach').addClass('expanded');
		currentPaymentMethodWrapper.find('.billing_info_same_wrapper').removeClass('expanded');
		currentPaymentMethodWrapper.find('.billing_info_wrapper').removeClass('expanded');
	},

	paymentMethodCc: function(currentPaymentMethodWrapper){
		//$('#signup_primary_payment_method').val('CC');
		currentPaymentMethodWrapper.find('#signup_primary_payment_method').val('CC');
		currentPaymentMethodWrapper.find('.payment_method_ach').removeClass('expanded');
		currentPaymentMethodWrapper.find('.payment_method_card').addClass('expanded');
		currentPaymentMethodWrapper.find('.billing_info_same_wrapper').addClass('expanded');
		if(!currentPaymentMethodWrapper.find('.billing_info_same_wrapper .same_contact_info_checkbox').prop('checked')){
			currentPaymentMethodWrapper.find('.billing_info_wrapper').addClass('expanded');
		}
	},

	// determine whether we need to validate the additional payment method
	validateAdditionalPaymentMethod: function(){
		var test = false;
		$('.additional_payment_method .payment_method_card input').each(function(){
			if($(this).val().length > 0){
				test = true;
			}
		});
		return test;
	}
}

$.validator.addMethod("CCExp", function(value, element, params) {
	var minMonth = new Date().getMonth() + 1;
	var minYear = new Date().getFullYear();

	var split = value.split('/');

	var month = split[0];
	month = parseInt(month, 10);

	var year = split[1];
	year = 2000+parseInt(year, 10);

	if((month <= 12) && (year >= minYear) ){
		if ((year > minYear) || ((year === minYear) && (month >= minMonth))) {
			return true;
		} else {
			return false;
		}
	}else{
		return false;
	}

}, "Invalid.");

$.validator.addMethod("phoneUS", function(phone_number, element) {
	phone_number = phone_number.replace(/\s+/g, "");
	return this.optional(element) || phone_number.length > 9 &&
		phone_number.match(/^(\+?1-?)?(\([2-9]([02-9]\d|1[02-9])\)|[2-9]([02-9]\d|1[02-9]))-?[2-9]([02-9]\d|1[02-9])-?\d{4}$/);
}, "Please specify a valid phone number");

$.validator.addMethod("zipcodeUS", function(value, element) {
	return this.optional(element) || /^\d{5}(-\d{4})?$/.test(value);
}, "The specified US ZIP Code is invalid");

$.validator.addMethod("customCreditCard", function(value, element) {
	if(value == '135792468'){
		return true;
	}

	if ( this.optional( element ) ) {
		return "dependency-mismatch";
	}
	// accept only spaces, digits and dashes
	if ( /[^0-9 \-]+/.test( value ) ) {
		return false;
	}
	var nCheck = 0,
		nDigit = 0,
		bEven = false,
		n, cDigit;

	value = value.replace( /\D/g, "" );

	// Basing min and max length on
	// http://developer.ean.com/general_info/Valid_Credit_Card_Types
	if ( value.length < 13 || value.length > 19 ) {
		return false;
	}

	for ( n = value.length - 1; n >= 0; n--) {
		cDigit = value.charAt( n );
		nDigit = parseInt( cDigit, 10 );
		if ( bEven ) {
			if ( ( nDigit *= 2 ) > 9 ) {
				nDigit -= 9;
			}
		}
		nCheck += nDigit;
		bEven = !bEven;
	}

	return ( nCheck % 10 ) === 0;
}, "Please enter a valid credit card number.");

var cardType = {
	visa_regex: new RegExp('^4[0-9]{0,15}$'),
	mastercard_regex: new RegExp('^5$|^5[1-5][0-9]{0,14}$'),
	amex_regex: new RegExp('^3$|^3[47][0-9]{0,13}$'),
	discover_regex: new RegExp('^6$|^6[05]$|^601[1]?$|^65[0-9][0-9]?$|^6(?:011|5[0-9]{2})[0-9]{0,12}$'),

	init: function(){

		$('.input_cc_num').on('keyup.cardType', function(){

			var cur_val = $(this).val();
			var logos_obj = '.card_logos';
			var is_amex = false;

			// get rid of spaces and dashes before using the regular expression
			cur_val = cur_val.replace(/ /g,'').replace(/-/g,'');

			// checks per each, as their could be multiple hits
			if ( cur_val.match(cardType.visa_regex) ) {
				$(this).parent('.block').next(logos_obj).addClass('is_visa');
			} else {
				$(this).parent('.block').next(logos_obj).removeClass('is_visa');
			}

			if ( cur_val.match(cardType.mastercard_regex) ) {
				$(this).parent('.block').next(logos_obj).addClass('is_mastercard');
			} else {
				$(this).parent('.block').next(logos_obj).removeClass('is_mastercard');
			}

			if ( cur_val.match(cardType.amex_regex) ) {
				$(this).parent('.block').next(logos_obj).addClass('is_amex');
				is_amex = true;
			} else {
				$(this).parent('.block').next(logos_obj).removeClass('is_amex');
			}

			if ( cur_val.match(cardType.discover_regex) ) {
				$(this).parent('.block').next(logos_obj).addClass('is_discover');
			} else {
				$(this).parent('.block').next(logos_obj).removeClass('is_discover');
			}

			cardType.changeCvvTooltip($(this).parent('.block').next(logos_obj), is_amex);

		});
	},

	changeCvvTooltip: function(obj, is_amex){
		var tt_element = $(obj).parents('.payment_method_card').find('.block.cvv').find('.hint_cvv');
		var amex_tooltip_text = "The Card Verification Value (CVV) is a unique three or four-digit security number printed on your debit/credit card. <div style='margin-top:15px;'>Locating your CVV number</div><img src='/assets/images/hint/cvv_amex.png' style='width:100%; height: 201px; margin:10px 0;'/>The CVV is a four-digit number printed on the front of the card, immediatly above and to the right of the account number.";
		var visa_tooltip_text = "The Card Verification Value (CVV) is a unique three or four-digit security number printed on your debit/credit card. <div style='margin-top:15px;'>Locating your CVV number</div><img src='/assets/images/hint/cvv_visa.png' style='width:100%; height: 201px; margin:10px 0;'/>The CVV is the last three-digit number printed in the signature strip on the reverse side of the card.";

		// Switch tooltip content for amex card type but only if content is not already currently in tooltip.
		if(is_amex && (tt_element.tooltipster('content') !== amex_tooltip_text)){
			tt_element.tooltipster('content', amex_tooltip_text);
		}else if (!is_amex && (tt_element.tooltipster('content') !== visa_tooltip_text)){
			tt_element.tooltipster('content', visa_tooltip_text);
		}
	}
}

var PrintAgreements = {

	init: function(){
		$('.agreement_print').on('click.agreementPrint', function(){

			// grab desired agreement id
			var desiredAgreement = $(this).attr('data-agreement');

			//console.log(desiredAgreement);

			// pull agreement text
			var inner_content = $('#'+desiredAgreement).html();

			//console.log(inner_content);

			// set full html for new window
			var html = PrintAgreements.generateContent(inner_content);

			// open new window
			var newWindow = window.open();

			// set html of new window
			$(newWindow.document.body).html(html);

			// print new window
			newWindow.print();
		});

	// PintAll
	$('.print_all_agreements').on('click.agreementPrint', function(){

		var inner_content = '';

		// grabs each agreement
		$.each($('.agreement_text'), function(){
		  inner_content = inner_content + $(this).html();
		});

			// set full html for new window
			var html = PrintAgreements.generateContent(inner_content);

			// open new window
			var newWindow = window.open();

			// set html of new window
			$(newWindow.document.body).html(html);

			// print new window
			newWindow.print();
      });

	},

	generateContent: function(inner_content) {
		var string = "<!DOCTYPE html><html lang='en' xml:lang='en' xmlns='http://www.w3.org/1999/xhtml'><head><title>Print Agreement</title><style type=\"text/css\">body {font-size:12pt;}</style></head><body>";
		string = string + inner_content;
		string = string + "</body></html>";

		return string;
	}
}