var app = angular.module("FooterModule",["FactoryModule"], function($interpolateProvider) {
        $interpolateProvider.startSymbol('((');
        $interpolateProvider.endSymbol('))');
    }).config(['$httpProvider', function($httpProvider) {
      $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
  }]);



var rootScope ;
app.controller("FooterController",["$scope","$http","Request",function($scope,$http,Request){
	rootScope = $scope,
	$scope.percent_image =0;
	$scope.percent_logo =0;
	$scope.$input = {image:"",logo:""};

	$scope.sendRequest = function(){
		input = $scope.$input;
		input.content = {
		         content_top : retByName("content_top").val(),
		         content_bottom : retByName("content_bottom").val(),
		         content_bottom_button_lable : retByName("content_bottom_button_lable").val(),
		         content_bottom_button_content : retByName("content_bottom_button_content").val()
		}		
              input.token = token_app;
		disableSubmit(true);		
		$scope.request = Request.setRequest("request","Changing the footer!");
		$http.post(apiUrl+"/footer",input).success(function(data){
			$scope.request = Request.setRequest("success","Successfuly updated footer data");
			disableSubmit(false);
		}).error(function(data){
			console.log(data);
			$scope.request = Request.setRequest("error","There was an error updating footer data.");
			disableSubmit(false);
		});
	}

	$scope.clearRequest = function(){
		$scope.request = Request.clearRequest();
	}

	$scope.clearRequest();
}]);



retByName("footer_main_logo").change(function(){
	sendFile(document.getElementsByName('footer_main_logo')[0].files[0],"logo");
	disableSubmit(true);
});
retByName("footer_main_image").change(function(){
	sendFile(document.getElementsByName('footer_main_image')[0].files[0],"image");
	disableSubmit(true);
});

function sendFile(file,index) {
  
  var postUrl =apiUrl+"/mainfiles",
   fd = new FormData();
  fd.append("file", file);
  fd.append("token",document.getElementsByName('_token')[0].value);

  $.ajax({
    type: 'post',
    url: postUrl,
    data: fd,
    success : function (dat) {
    rootScope.$apply(function(){
    	if(index=="logo")
    		rootScope.$input.logo = dat;
    	else
    		rootScope.$input.logo = dat;
    });
    disableSubmit(false);
    },
    xhrFields: {     
      onprogress: function (progress) { 
      	rootScope.$apply(function(){
      		console.log(progress);
      		var percent = (progress.total==0&&progress.totalSize==0)?100:Math.floor((progress.total / progress.totalSize) * 100);                               	
      		if(index=="logo")
      			rootScope.percent_logo = percent;
      		else
      			rootScope.percent_image = percent; 
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


$(".ta").wysihtml5();

