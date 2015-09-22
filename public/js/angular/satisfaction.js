var app = angular.module("SatisfactionModule",["FactoryModule"], function($interpolateProvider) {
        $interpolateProvider.startSymbol('((');
        $interpolateProvider.endSymbol('))');
    }).config(['$httpProvider', function($httpProvider) {
      $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
  }]);

var rootScope ;
app.controller("SatisfactionController",["$scope","$http","Request",function($scope,$http,Request){
rootScope = $scope;

$scope.url = apiUrl+"/customersatisfaction?token="+token_app;
$scope.fetchData = function(){
	$http.get($scope.url).success(function(data){
		$scope.data = data;			
	}).error(function(data){
		console.log(data);
	})
}

$scope.edit = function(data){
	$scope.selectedData = data;
}

$scope.editContent = function(){
	var data = $scope.selectedData;
	
	if(data.content==""){
		$scope.request  = Request.setRequest('error',"Content can't be empty!");
		return;
	}
	if(data.display_name==""){
		$scope.request = Request.setRequest("error","Name can't be empty!");
		return;
	}
	$scope.request = Request.setRequest("request","Editing content!");
	$input={
		display_name:data.display_name,
		content:data.content,
		id:data.id,
		token:token_app,
	}
	$http.post(url,$input).success(function(data){
		$scope.request = Request.setRequest("success","Successfully edited data!");
		console.log(data);
	}).error(function(data){
		$scope.request = Request.setRequest("error","There was error updating data!");
		console.log(data)
	});	
}

$scope.clearRequest = function(){
	$scope.request = Request.clearRequest();
}

$scope.fetchData();
$scope.clearRequest();
}]);

function closeModal(){
	$("#editWhy").modal("hide");
}

$("#editWhy").on("hide",function(){
rootScope.$apply(function(){
	$rootScope.selectedData = {};
});
});
