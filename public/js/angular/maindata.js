var app = angular.module("MainDataModule",["FactoryModule"], function($interpolateProvider) {
        $interpolateProvider.startSymbol('((');
        $interpolateProvider.endSymbol('))');
    }).config(['$httpProvider', function($httpProvider) {
      $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
  }]);

var rootScope ;
app.controller("MainDataController",["$scope","$http","Request",function($scope,$http,Request){
	rootScope = $scope;
	
	$scope.percent =0;
	$scope.$input = {main_banner:""};

	$scope.sendRequest = function(){
		input = $scope.$input;
		input.main_phone_number = retByName("main_phone_number").val();
		input.site_name = retByName("site_name").val();
		input.credit_report_repair_questions = retByName("credit_report_repair_questions").val();
		disableSubmit(true);
		input.token = token_app;
		$scope.request = Request.setRequest("request","Changing the main data!");
		$http.post(apiUrl+"/maindata",input).success(function(data){
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



retByName("main_banner").change(function(){
	sendFile(document.getElementsByName('main_banner')[0].files[0]);
	disableSubmit(true);
});

function sendFile(file) {
  
  var postUrl =apiUrl+"/mainfiles";
  var fd = new FormData();
  fd.append("file", file);
  fd.append("token",document.getElementsByName('_token')[0].value);

  $.ajax({
    type: 'post',
    url: postUrl,
    data: fd,
    success : function (dat) {
    rootScope.$apply(function(){
    	rootScope.$input.main_banner = dat;
    });
    disableSubmit(false);
    },
    xhrFields: {     
      onprogress: function (progress) { 
      	rootScope.$apply(function(){
      		console.log(progress);
      		rootScope.percent = (progress.total==0&&progress.totalSize==0)?100:Math.floor((progress.total / progress.totalSize) * 100);                               	
      	});      	
      }
    },
    error:function(data){
     console.log(data);
    },
    processData: false,
    contentType: false
  });
}