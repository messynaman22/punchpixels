var app = angular.module("WhyModule",["ngTable"], function($interpolateProvider) {
        $interpolateProvider.startSymbol('((');
        $interpolateProvider.endSymbol('))');
    }).config(['$httpProvider', function($httpProvider) {
      $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
  }]);
var rootScope;
app.controller("WhyController",["$scope","$http","$filter","NgTableParams",function($scope,$http,$filter,NgTableParams){
	rootScope = $scope;
	$scope.title="";
	$scope.apiUrl = $("#apiUrl").html(),
	$scope.testData = null,
	$scope.token = $("#token").html(),
	$scope.selectedData = null,$scope.editUrl = $("#editUrl").html(),
	$scope.modal = document.getElementById("modal_dialog");
	$scope.type=$("#type").html();
	$scope.request = {
		isPresent:false,
		alert:"",
		icon:"",
		strong:"",
		message:"",
	};

	$scope.fetchPages = function(){
	    var getUrl = $scope.apiUrl+"/whyus?token="+$scope.token+"&type="+$scope.type;
	    $http.get(getUrl).success(function(data){
	       $scope.testData = data.data;	       
	       $scope.fillTable();  	       
	    }).error(function(data){
	            console.log(data);
	    });
	};

	$scope.fillTable = function(){
	    $scope.tableParams = new NgTableParams({
	        page: 1, 
	        count: 10,
	        sorting: {
	                    title: 'asc'   
	                }           
	      }, {
	        total: $scope.testData.length, 

	        getData: function($defer, params) {
	           var orderedData = params.sorting() ?
	                              $filter('orderBy')($scope.testData, params.orderBy()) :
	                              $scope.testData;

	          $defer.resolve(orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count()));
	        }
	    });
	}

	$scope.editWhy = function(data){
		if(data==null){
			$scope.selectedData = {
				title:"",
				content:"",
				button1:"",
				button2:"",
			};
			if($scope.type=="main"){
				$scope.selectedData.description ="";
			}
			$scope.isCreate = true;
			$scope.title = "Create page";
			return;
		}
		$scope.selectedData =data;
		$scope.isCreate = false;
		$scope.title = "Edit page";
	}

	$scope.editPage = function(){
		if($scope.selectedData.title==""){
			$scope.setRequest("response_error","Title can't be empty");
			return;
		}
		if($scope.selectedData.content==""){
			$scope.setRequest("response_error","Content can't be empty");
			return;
		}
		if($scope.type=="main" && $scope.selectedData.description==""){
			$scope.setRequest("response_error","Description can't be empty");
			return;
		}
		if($scope.selectedData.button1==""){
			$scope.setRequest("response_error","First button can't be empty");
			return;
		}
		if($scope.selectedData.button2==""){
			$scope.setRequest("response_error","Second button can't be empty");
			return;
		}


		$scope.setRequest("request","Editing the data!");
		var dat = $scope.selectedData;
		$input = {
			token:$scope.token,
			slider_title:dat.title,
			slider_content:dat.content,
			first_button:dat.button1,
			second_button:dat.button2,
			type:$scope.type,
		};

		if($scope.type=="main"){
			$input.description=$scope.selectedData.description;
		}

		if($scope.isCreate)
			var postUrl = $scope.apiUrl+"/createwhyus";
		else{
			var postUrl = $scope.apiUrl+"/whyus";
			$input.id= dat.id;
		}
		$input.token = token_app;
		$http.post(postUrl, $input).
			 success(function(data, status, headers, config) {
			 	$scope.setRequest("response_success","Successfully done");	
			 	if($scope.isCreate){
			 		$scope.testData.push(data);
			 		$scope.tableParams.reload();
			 	}	
			 }).
			 error(function(data, status, headers, config) {				  	
		  	$scope.setRequest("response_error","There was error performing operation!");
		  });
	}

	$scope.deletePage = function(id,name){
	    var postUrl = $scope.apiUrl+"/delwhyus";
	     var $inputs = {
	        id:id,
	        token:$scope.token,
	        type:$scope.type,
	     };
	    var func = function(){
	                $http.post(postUrl, $inputs).
	                  success(function(data, status, headers, config) {        
	                        swal("Deleted!", name+" has been deleted!", "success");     
	                        var dat = $scope.testData;
	                        for(var i=0,len= dat.length;i<len;i++){
	                            if(dat[i].id==id){
	                                dat.splice(i,1);
	                                break;
	                            }
	                        }             
	                        $scope.tableParams.reload();                           
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


	$scope.setRequest = function(type,msg){
		var req = $scope.request;
		req.isPresent = true;
		req.message = msg;
		switch(type){
		     case "request" :  req.alert="alert-info",req.icon="fa-spinner fa-spin",req.strong="Please wait!";break;
		     case "response_error" : req.alert="alert-danger",req.icon="fa-ban",req.strong="Oops!";break;
		     case "response_success" : req.alert="alert-success",req.icon="fa-check",req.strong="Done!";break;			
		}
	}

	$scope.clearRequest = function(){
		$scope.request = {
			isPresent:false,
			alert:"",
			icon:"",
			strong:"",
			message:"",
		};
	}

	$scope.fetchPages();
}]);

function closeModal(){
	$("#editWhy").modal("hide");
}

$("#editWhy").on("hide",function(){
	rootScope.$apply(function(){
		rootScope.selectedData = {
			title:"",
			content:"",
			button1:"",
			button2:"",
		};	
		if(rootScope.type=="main"){
			rootScope.selectedData.description="";
		}
	});
	
});