var app = angular.module("HeaderModule",["FactoryModule"], function($interpolateProvider) {
        $interpolateProvider.startSymbol('((');
        $interpolateProvider.endSymbol('))');
    }).config(['$httpProvider', function($httpProvider) {
      $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
  }]);

var rootScope;
app.controller("HeaderController",["$scope","$http","Request",function($scope,$http,Request){
	rootScope = $scope;	
	$scope.percent =0;
	$scope.$input = {main_logo:""};

	$scope.sendRequest = function(){
		input = $scope.$input;
		input.signup_button = retByName("signup_button").val();		
		disableSubmit(true);
		input.token = token_app;
		$scope.request = Request.setRequest("request","Changing the header data!");
		$http.post(apiUrl+"/header",input).success(function(data){
			$scope.request = Request.setRequest("success","Successfuly updated header data");
			disableSubmit(false);
		}).error(function(data){
			console.log(data);
			$scope.request = Request.setRequest("error","There was an error updating header data.");
			disableSubmit(false);
		});
	}

	$scope.clearRequest = function(){
		$scope.request = Request.clearRequest();
	}

	$scope.clearRequest();
}]);


retByName("main_logo").change(function(){
	sendFile(document.getElementsByName('main_logo')[0].files[0]);
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
    	rootScope.$input.main_logo = dat;
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