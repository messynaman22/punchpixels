var app = angular.module("TrustModule",["FactoryModule"], function($interpolateProvider) {
        $interpolateProvider.startSymbol('((');
        $interpolateProvider.endSymbol('))');
    }).config(['$httpProvider', function($httpProvider) {
      $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
  }]);

var rootScope ;
app.controller("TrustController",["$scope","$http","Request",function($scope,$http,Request){
	rootScope = $scope;	
	$scope.$input = {};

	$scope.sendRequest = function(){
		input = $scope.$input;
		input.you_trust_left = retByName("you_trust_left").val();
		input.you_trust_right = retByName("you_trust_right").val();
		input.you_trust_iframe = retByName("you_trust_iframe").val();
		disableSubmit(true);
		input.token = token_app;
		$scope.request = Request.setRequest("request","Changing the main data!");
		$http.post(apiUrl+"/trust",input).success(function(data){
			$scope.request = Request.setRequest("success","Successfuly updated main data");
			disableSubmit(false);
		}).error(function(data){
			console.log(data);
			$scope.request = Request.setRequest("error","There was an error updating main data.");
			disableSubmit(false);
		});
	}

	$scope.clearRequest = function(){
		$scope.request = Request.clearRequest();
	}

	$scope.clearRequest();
}]);

$(".ta").wysihtml5();