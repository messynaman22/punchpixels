var FormFormatHelper = {

	initialize: function(){
		FormFormatHelper.update($(document));
	},

	update: function(part) {

		// check for form helpers
		part.find('input').each(function(){

			if(typeof $(this).attr('data-form-format-helper') != 'undefined')
			{

				// store our input object
				var inputObject = this;

				// determine validators for the element
				var options = Array();
				if(typeof $(this).attr('data-form-format-helper') == 'string'){
					options = $(this).attr('data-form-format-helper').split(',');
				}

				// loop through our elements that need validation
				if(options.length > 0){

					$.each(options, function(index, option){

						// check for additional parameters
						option = option.split('|');


						switch(option[0]){
							case 'autotab':
								FormFormatHelper.autoTab(inputObject, option[1]);
								break;
							case 'forceNumeric':
								FormFormatHelper.forceNumeric(inputObject);
								break;
							case 'formatPhoneNumber':
								FormFormatHelper.formatPhoneNumber(inputObject);
								break;
							case 'formatDateOfBirth':
								FormFormatHelper.formatDateOfBirth(inputObject);
								break;
							case 'formatSocialSecurityNumber':
								FormFormatHelper.formatSocialSecurityNumber(inputObject);
								break;
							case 'formatCardExpirationDate':
								FormFormatHelper.formatCardExpirationDate(inputObject);
						}
					});
				}
			}
		});
	},

	// autotab based on fields maxlength
	autoTab: function(object, nextObjectId){
		$(object).keyup(function(){
			if($(object).attr('maxlength') == $(object).val().length){
				$('#' + nextObjectId).focus();
			}
		});
	},

	// forces only numbers
	forceNumeric: function(object){
		$(object).keyup(function(){
			$(this).val($(this).val().replace(/[\D]/g, ''));
		});
	},

	// phone number auto format
	formatPhoneNumber: function(object){
		// uses masked input jquery plugin.
		$(object).mask("(999) 999-9999",{placeholder:" "});
	},

	// card expiration auto format
	formatCardExpirationDate: function(object){
		// uses masked input jquery plugin.
		$(object).mask("99/99",{placeholder:" "});
	},

	// date of birth auto format
	formatDateOfBirth: function(object){
		// uses masked input jquery plugin.
		$(object).mask("99/99/99?99",{placeholder:" "});
	},

	// social security number auto format
	formatSocialSecurityNumber: function(object){
		// uses masked input jquery plugin.
		$(object).mask("999-99-9999",{placeholder:" "});
	}
}

$(function(){
	FormFormatHelper.initialize();
});
