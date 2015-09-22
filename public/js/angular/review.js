var app = angular.module("ClientReviewModule",["FactoryModule"], function($interpolateProvider) {
        $interpolateProvider.startSymbol('((');
        $interpolateProvider.endSymbol('))');
    }).config(['$httpProvider', function($httpProvider) {
      $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
  }]);

var rootScope ;
app.controller("ClientController",["$scope","$http","Request",function($scope,$http,Request){

rootScope = $scope;
$scope.imagePath = $("#imagePath").html();
var token = $("token").html();
var url = apiUrl+"/clientreview?token="+token_app;
$scope.percent = 0;


$scope.fetchData = function(){
	$http.get(url).success(function(data){
		$scope.data = data;			
	}).error(function(data){
		console.log(data);
	})
}
$scope.selectedData = {};	
$scope.selectedData.content="";
$scope.selectedData.image="";
$scope.selectedData.id="";


$scope.edit = function(data){
	
	if(data==null){
		$scope.selectedData.content="";
		$scope.selectedData.image="";
		$scope.selectedData.id="";
		$scope.isCreate = true;
		$scope.title = "Create client review";
		return;
	}
	$scope.selectedData.content =data.content;
	$scope.selectedData.image="";
	$scope.selectedData.id=data.id;
	$scope.isCreate = false;
	$scope.title = "Edit client review";
}

$scope.editReview = function(){	
	$scope.request = Request.setRequest("request","Editing the data!");
	var dat = $scope.selectedData;	
	if($scope.isCreate && (dat.content==""||dat.image=="")){
		$scope.request = Request.setRequest("error","Both fields are required to perform this operation.");
		return;
	}else{
		if(dat.content==""){
			$scope.request = Request.setRequest("error","Content field is required!");
			return;	
		}
	}
	$input = {
		token:$("#token").html(),
		content:dat.content,
		image:dat.image,		
	};
	if($scope.isCreate)
		var postUrl = apiUrl+"/createreview";
	else{
		var postUrl = apiUrl+"/editreview";
		$input.id= dat.id;
	}
	$input.token = token_app;
	console.log($input);
	$http.post(postUrl, $input).
		 success(function(data, status, headers, config) {
		 	success_msg = "Successfuly updated footer image";
		 	if($scope.isCreate){
		 		$scope.data.push(data);
		 		success_msg = "Successfuly inserted footer image";	 				 		
		 	}else{
		 		var length = $scope.data.length;
		 		for(var i=0;i<length;i++){
		 			if($scope.data[i].id==$scope.selectedData.id){
		 			$scope.data[i] = data;
		 			break;
		 			}
		 		}
		 	}		 
		 	$scope.request = Request.setRequest("success",success_msg);
		 	
		 	if(!$scope.isCreate)
				$scope.selectedData = {alt:"",image:"",id:0};

			$scope.percent=0;
		 }).
		 error(function(data, status, headers, config) {			  	
	  	$scope.request = Request.setRequest("error","There was error performing operation!");
	  	$scope.percent=0;
	});


}


$scope.deleteReview = function(id,name){
	console.log("called");
	     var postUrl = apiUrl+"/delreview";
	      var $inputs = {
	         id:id,
	         token:$scope.token,
	      };
	     var func = function(){
	                 $http.post(postUrl, $inputs).
	                   success(function(data, status, headers, config) {        
	                         swal("Deleted!", name+" has been deleted!", "success");     
	                         var dat = $scope.data;
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



$scope.clearRequest = function(){
	$scope.request = Request.clearRequest();
}

$scope.fetchData();
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
	$rootScope.selectedData = {id:0,image:"",content:""};
	$rootScope.percent=0;
});
});