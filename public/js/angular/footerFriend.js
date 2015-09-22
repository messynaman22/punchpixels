var app = angular.module("FooterModule",["FactoryModule"], function($interpolateProvider) {
        $interpolateProvider.startSymbol('((');
        $interpolateProvider.endSymbol('))');
}).config(['$httpProvider', function($httpProvider) {
      $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
  }]);

var rootScope;
app.controller("FooterController",["$scope","$http","Request","Validation",function($scope,$http,Request,Validation){

rootScope = $scope;
$scope.percent = 0;
$scope.imagePath = $("#imagePath").html();
$scope.clearRequest = function(){
	$scope.request = Request.clearRequest();
};


$scope.newData = new Array();

$scope.getData = function(){
	var getUrl = apiUrl+"/friendfooter?token="+token_app; 	
	$http.get(getUrl).success(function(data){
		$scope.newData = data;		
	}).error(function(data){
		console.log(data);
	});
}

$scope.selectedData = {
		alt:"",image:"",id:0
		};
$scope.editWhy = function(data){
	
	if(data==null){
		$scope.selectedData.alt="";
		$scope.selectedData.image="";
		$scope.selectedData.id="";
		$scope.isCreate = true;
		$scope.title = "Create Footer Image";
		return;
	}
	$scope.selectedData.alt =data.alt;
	$scope.selectedData.image="";
	$scope.selectedData.id=data.id;
	$scope.isCreate = false;
	$scope.title = "Edit Footer Image";
}

$scope.editFooter = function(){	
	$scope.request = Request.setRequest("request","Editing the data!");
	var dat = $scope.selectedData;
	console.log(dat);
	if($scope.isCreate && (dat.alt==""||dat.image=="")){
		$scope.request = Request.setRequest("error","Both fields are required to perform this operation.");
		return;
	}else{
		if(dat.alt==""){
			$scope.request = Request.setRequest("error","Alt field is required!");
			return;	
		}
	}
	$input = {
		token:$("#token").html(),
		alt:dat.alt,
		image:dat.image
	};
	if($scope.isCreate)
		var postUrl = apiUrl+"/createfooterfriend";
	else{
		var postUrl = apiUrl+"/editfooterfriend";
		$input.id= dat.id;
	}
	$input.token = token_app;
	console.log($input);
	$http.post(postUrl, $input).
		 success(function(data, status, headers, config) {
		 	success_msg = "Successfuly updated footer image";
		 	if($scope.isCreate){
		 		$scope.newData.push(data);
		 		success_msg = "Successfuly inserted footer image";	 				 		
		 	}else{
		 		var length = $scope.newData.length;
		 		for(var i=0;i<length;i++){
		 			if($scope.newData[i].id==$scope.selectedData.id){
		 			$scope.newData[i] = data;
		 			break;
		 			}
		 		}
		 	}
		 	$scope.request = Request.setRequest("success",success_msg);
		 	if(!$scope.isCreate)
				$scope.selectedData = {alt:"",image:"",id:0};
		 }).
		 error(function(data, status, headers, config) {			  	
	  	$scope.request = Request.setRequest("error","There was error performing operation!");
	});


}

$scope.deleteFooter = function(id,name){
	console.log("called");
	     var postUrl = apiUrl+"/delfriendfooter";
	      var $inputs = {
	         id:id,
	         token:$scope.token,
	      };
	     var func = function(){
	     
	                 $http.post(postUrl, $inputs).
	                   success(function(data, status, headers, config) {        
	                         swal("Deleted!", name+" has been deleted!", "success");     
	                         var dat = $scope.newData;
	                         for(var i=0,len= dat.length;i<len;i++){
	                             if(dat[i].id==id){
	                                 dat.splice(i,1);
	                                 break;
	                             }
	                         }             		                                                
	                   }).
	                   error(function(data, status, headers, config) {        
	                     sweetAlert("Oops!!", "Please try again!!", "error");
	                   });
	     }

     $scope.deletePopUp(func,name);                       
};


 $scope.deletePopUp = function(functionName,name){
        swal({ title: "Are you sure?",   
               text: "You are about to delete "+name,   
               type: "warning",   
               showCancelButton: true,   
               confirmButtonColor: "#DD6B55",   
               confirmButtonText: "Yes, delete "+name+"!",
               closeOnConfirm: false
             }, functionName);
    };

$scope.validation = Validation.clearValidation();
$scope.getData();
$scope.clearRequest();
}]);

 retByName("image").change(function(){
 	sendFile(document.getElementsByName('image')[0].files[0]);
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
    	rootScope.selectedData.image = dat;
    });
    disableSubmit(false);
    },
    xhrFields: {     
      onprogress: function (progress) { 
      	rootScope.$apply(function(){      		
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

function closeModal(){
	$("#editWhy").modal("hide");	
}

$("#editWhy").on("hide",function(){
	rootScope.$apply(function(){
		rootScope.selectedData.alt="";
		rootScope.selectedData.image="";
		rootScope.selectedData.id=0;
	});
	
});

