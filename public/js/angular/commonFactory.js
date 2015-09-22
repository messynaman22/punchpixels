angular.module("FactoryModule",[]).factory('Request', function() {
     
    var factory = {}; 
 
    factory.clearRequest = function() {        
     	return {isActive:false,message:"",icon:"",alert:"",type:""};
     }
 
    factory.setRequest = function(req_type,message) {
   	var request = {isActive:true,message:"",icon:"",alert:"",type:req_type};
   	switch(req_type){
   		case "request" :     request.icon = "fa-spin fa-circle-o-notch";
   				                     request.alert = "alert-info";
   				                     request.message = "Please wait ! "+message;
                                                     break;
   		case "success" : request.icon = "fa-check";
   				                         request.alert = "alert-success";
   				                         request.message = "Done ! "+message;
                                                         break; 
		case "error" :       request.icon = "fa-info-error";
				                          request.alert = "alert-danger";
				                          request.message = "Oops ! "+message;
                                                          break;    				  
   	}	
   	return request;
    }

 
    return factory;
}).factory("Validation",function(){
      var factory = {}; 
   
      factory.clearValidation = function() {        
        return {errorclass:"",placeholder:""};
       }
   
      factory.setRequest = function(message) {
      return {errorclass:"has-error",placeholder:message};
      }

   
      return factory;
});

function retByName(name){
   return $($("[name="+name+"]").get(0));
}

function disableSubmit(val){
  $("#submit").attr("disabled",val);
}

var apiUrl = $("#apiUrl").html();
var token_app = $("#token_app").html();