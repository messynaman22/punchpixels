var app = angular.module("UserModule",["FactoryModule"], function($interpolateProvider) {
        $interpolateProvider.startSymbol('((');
        $interpolateProvider.endSymbol('))');
    }).config(['$httpProvider', function($httpProvider) {
      $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
  }]);
var rootScope = null;
 app.controller("UserController",["$scope","$http","Request",function($scope,$http,Request){
 	rootScope = $scope;
 	$scope.user = {};
 	$scope.user.id = $("#userId").html();
 	$scope.user.username= $("#username").html(),
 	$scope.user.email = $("#email").html();
 	$scope.user.password = "";
 	$scope.user.isPassword = false;
 	$scope.request = Request.clearRequest();
 	$scope.saveUser = function(){
 		if(!$scope.validateUser()){
 			return;
 		}
 		if($scope.isPassword && $scope.user.password == ""){
 			$scope.request = Request.setRequest("error","Password shouldn't be empty!");
 			return;
 		}	

 		$input = {
 			data:    $scope.user,
 			token: token_app, 			
 		};
 		$scope.setRequest = Request.setRequest("request","Editing the profile!!");
 		console.log($input);
 		$http.post(apiUrl+"/edituser",$input).success(function(data){
 			window.location.reload();
 		}).error(function(data){
 			$scope.request = Request.setRequest("error","There was some error editing user.");
 		});
 	};
 	
 	$scope.validateUser= function(){
 		var noerror =true;
 		$(".recReq").each(function(){
 			if($(this).val() == ""){
 				noerror = false;
 				$scope.request = Request.setRequest("error",$(this).parent().prev().html()+" shouldn't be empty.");
 				return false;
 			}
 		});
 		return noerror;
 	};
 }]);
