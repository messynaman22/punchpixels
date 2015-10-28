var app = angular.module("InviteApp",["FactoryModule"], function($interpolateProvider) {
        $interpolateProvider.startSymbol('((');
        $interpolateProvider.endSymbol('))');
    }).config(['$httpProvider', function($httpProvider) {
      $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
  }]);
var rootScope = null;

app.controller("InviteController",["$scope","$http","Request","Validation",function($scope,$http,Request,Validation){
rootScope = $scope,$scope.validation = Validation.clearValidation(),$scope.invitedUser = [],$scope.admins = [];

$scope.fetchAdmins = function(){
	var getUrl = apiUrl+"/crmadmins?token="+token_app;

	$http.get(getUrl).success(function(data,status){
		$scope.invitedUser = data.invitations;
		$scope.admins = data.admins;
	}).error(function(data,status){
		console.log(data);
	});

};


$scope.sendInvite = function(){	
	var email = $("#user_form_email").val(), access = $("#user_role_select").val();
	if(email=="" || !$scope.isvalidEmail(email) ){
		$scope.validation=Validation.setRequest("Enter valid email address!");
		return;
	}
	$scope.validation = Validation.clearValidation();

	$inputs = {
		email : email,
		role:access,
		token : token_app,
	};
	$scope.request = Request.setRequest("request","Sending invite to user.");
	
	$http.post(apiUrl+"/createcrmadmin",$inputs).success(function(data,status){		
		$scope.request = Request.setRequest("success","Invite sent successfully!");
		$("#user_form_email").val("");		
		$scope.invitedUser.push(data);
	}).error(function(data,status){		
		$scope.request = Request.setRequest("error","There was error sending invitation or User already exist!");
	});

}

$scope.changeAccess = function(user,access){
	$inputs = {
		id : user.id,
		role:access,
		token:token_app,
	};
	$http.post(apiUrl+"/changeaccess",$inputs).success(function(data,status){
		user.role=access;
	}).error(function(data,status){
		sweetAlert("Oops!!", "Something is fishy", "error");
		console.log(data);
	});
}

$scope.removeUser = function(type,user){
	$inputs = {
		id : user.id,		
		token:token_app,
	};
	$http.post(apiUrl+"/deletecrmadmin",$inputs).success(function(data,status){
		console.log(success);
	}).error(function(data,status){
		sweetAlert("Oops!!", "User doesn't exist", "error");
		console.log(data);
	}).finally(function(){
		var userArr = [];
		if(type==1){
			userArr = $scope.invitedUser;
		}else{
			userArr = $scope.admins
		}
		for(var i=0,j=userArr.length;i<j;i++){
			if(user.id == userArr[i].id){
				userArr.splice(i,1);
				break;
			}
		}
	});
}

$scope.isvalidEmail = function(email){
	var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	return re.test(email);
}

$scope.clearRequest = function(){
	$scope.request = Request.clearRequest();
}
$scope.closeModal = function(){
	$("#sendInvite").modal("hide");
	$scope.clearRequest();
	$scope.validation = Validation.clearValidation();
	$("#user_form_email").val("");
	$("#user_role_select").val("");
}
$scope.clearRequest();
$scope.fetchAdmins();
}]);
