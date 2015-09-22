var app = angular.module("OptionsModule",["FactoryModule"], function($interpolateProvider) {
        $interpolateProvider.startSymbol('((');
        $interpolateProvider.endSymbol('))');
    }).config(['$httpProvider', function($httpProvider) {
      $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
  }]);
    var rootScope = null;
    app.controller("OptionsController",["$scope","$http","Request",function($scope,$http,Request){
    	rootScope = $scope;
    	$scope.type = "receipt";
    	$scope.recActive = "active";
    	$scope.notActive = "";
    	$scope.$watch("type",function(newValue,oldValue){
    		if(!newValue)return;
    		$scope.toggleActive(newValue);
    	});
    	
    	$scope.fetchData = function(){
                            var getUrl = apiUrl + "/emaildetails?token="+token_app;
                            console.log(getUrl);
                            $http.get(getUrl).success(function(data,status){
                                    $scope.receipt = (data.receipt!="absent") ? data.receipt :{};
                                    $scope.notification = (data.notification!="absent") ? data.notification :{};
                                    $scope.emails = data.emails;
                                    console.log(data);
                            }).error(function(data,status){
                                    console.log(data);
                            });
    	};

            $scope.saveReceipt = function(){
                if(!$scope.checkVal("recReq"))
                    return;
               $scope.receipt.type="receipt";
               
               if(!$scope.receipt.hasOwnProperty('include_data')){
                $scope.receipt.include_data = 0;
               }
               $input = {
                data:$scope.receipt,
                token:token_app,
               };
               
               $scope.saveDetails($input);
             
            }


            $scope.saveNotifs = function(){
                if(!$scope.checkVal("notifReq"))
                    return;
               $scope.notification.type="notification";
               $scope.notification.to_from ="";
               if(!$scope.notification.hasOwnProperty('include_data')){
                $scope.notification.include_data = 0;
               }
               $input = {
                data:$scope.notification,
                token:token_app,
               };
               
               $scope.saveDetails($input);             
            }

            $scope.saveDetails = function(input){
                $scope.request = Request.setRequest("request","Saving data.");
                $http.post(apiUrl+"/createemaildetails",input).success(function(data){
                             $scope.request = Request.setRequest("success","Saved data");
                             console.log(data);
                }).error(function(data){
                             $scope.request = Request.setRequest("error","There was error saving data.Try again.");
                });
            }

            $scope.addEmails = function(){
                if(!$scope.checkVal("emReq"))
                    return;
                $input = {
                    email : $("#email_address").val(),
                    token:token_app,
                }
                $http.post(apiUrl+"/addemails",$input).success(function(data){
                    $scope.emails.push(data);    
                                    
                }).error(function(data){
                    console.log(data);
                }).finally(function(){
                    $("#addEmail").modal("hide");
                });
            }
        $scope.updateEmail = function(email){
            var postUrl = apiUrl+"/changeemailaccess";
            var $input = {
                id:email.id,
                token:token_app,
            }
            $http.post(postUrl,$input).success(function(data){
                console.log("success");
            }).error(function(data){
                email.included = (email.included=="0")?"1":"0";
            });
        }
         $scope.delEmail = function(email){
                          
                var postUrl = apiUrl+"/delemails";
                var name = email.email;
            
                 var $inputs = {
                    id:email.id,
                    token:token_app,
                 };              
                var func = function(){                
                            $http.post(postUrl, $inputs).
                              success(function(data, status, headers, config) {        
                                    swal("Deleted!", name+" has been deleted!", "success");     
                                   for(var i=0,j=$scope.emails.length;i<j;i++){
                                        if(email.id == $scope.emails[i].id){
                                            $scope.emails.splice(i,1);
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
            
            $scope.checkVal = function(className){
                var noerror = true;
                $("."+className).each(function(){
                    if($(this).val()==""){
                        noerror = false;
                        return false;
                    }
                });
                return noerror;
            }


    	$scope.toggleActive = function(newValue){
    		if(newValue=='receipt'){
    			$scope.recActive = 'active';
    			$scope.notActive = '';
    		}else{
    			$scope.recActive = '';
    			$scope.notActive = 'active'
    		}
                    $scope.request = Request.clearRequest();
    	}
        $scope.fetchData();
    }]);
