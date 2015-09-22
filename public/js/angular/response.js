var app = angular.module("ResponseModule",["xeditable","ui.bootstrap","FactoryModule"], function($interpolateProvider) {
        $interpolateProvider.startSymbol('((');
        $interpolateProvider.endSymbol('))');
    }).config(['$httpProvider', function($httpProvider) {            
      $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
  }]).run(function(editableOptions,editableThemes) {
  editableThemes.bs3.inputClass = 'input-xs';
  editableThemes.bs3.buttonsClass = 'btn-xs';
  editableOptions.theme = 'bs3';
}).filter("Search",function(){
  return function(listOfValues,option,value,date){
        var list = [];
        var check = ""; 
        var isDate = option.value=='order.package_start' || option.value=='user.today'  || option.value=='order.service_start'  || option.value=='last.birthdate'; 
          if(isDate){
            if(date==""||date==undefined){
                return listOfValues;  
            }else{
                check = date;              
            }
          }else{
              if(value==""||value==undefined)
                return listOfValues;                
                  if(option.value=="profile.ml" ){                  
                        check = ("yes".indexOf(value)>-1) ?"1":"0";
                  }else if(option.value == "order.year"){
                      if(value.length>2 && value.indexOf("20") == 0 ){
                        check = value.substring(2,value.length+1);
                      }else{
                        check = value;
                      }
                  }else{
                    check = value;
                  }              
              }
          for(var i=0,len = listOfValues.length;i<len;i++){            
            if(isDate){              
              if(eval("listOfValues[i]."+option.value).toLocaleDateString() == check.toLocaleDateString() ){
                list.push(listOfValues[i]);
              }              
            }else{
              if((eval("listOfValues[i]."+option.value)+"").toLowerCase().indexOf((check+"").toLowerCase())>-1){
                list.push(listOfValues[i])              
              }  
            }
            
          }
          return list;

      }
});

   var rootScope = null; 
  app.controller("ResponseController",["$scope","$http","Request",function($scope,$http,Request){
  	rootScope = $scope;
  	var token = $("#token").html();
  	var tokenUrl = "?token="+token;
  	var apiUrl = $("#apiUrl").html();
  	var currentYear = moment().year()+"";
       
      $scope.selectPackage = [{value: "FreshStart" , text:"FreshStart"},{value: "Comprehensive" , text:"Comprehensive"}]
      $scope.accountType = [{value: "Checking Account" , text:"Checking Account"},{value: "Savings Account" , text:"Savings Account"}];
      $scope.years = new Array(),$scope.months = new Array(),$scope.states = new Array(),$scope.selectedData = new Array(),$scope.file=null,$scope.error="bg-primary",
      $scope.errorMsg = "Please select a row by clicking on sno.",$scope.responseData = new Array(),$scope.image = null,$scope.windowHeight=$(window).height(),
      $scope.yesNo =  [{value: "0" , text:"No"},{value: "1" , text:"Yes"}],
      $scope.BTC = [{value: "Morning" , text:"Morning"},{value: "Afternoon" , text:"Afternoon"},{value: "Anytime" , text:"Anytime"}],
      $scope.HAU = new Array(),$scope.IN = new Array,$scope.searchText = "name",$scope.package_date_scope = [];
    
     
      currentYear = parseInt(currentYear.substring(2,4));
      $scope.dateList = {
        days:[],
        month:[],
        year:[],
      };
    
      for(i=1;i<=31;i++){
          $scope.dateList.days.push({value:i,text:i});
      } 
      for(i=1;i<=12;i++){
        $scope.dateList.month.push({value:i,text:i});  
      }
      for(i=1930;i<=2015;i++){
        $scope.dateList.year.push({value:i,text:i});  
      }

  

    for(i=currentYear;i<=currentYear+7;i++){
      $scope.years.push({value:i,text:i});
    }
    
    for(i=1;i<=12;i++){
      var num = ( i<10) ? "0"+i : i+"";
      $scope.months.push({value:num,text:num});
    }

    for(i=3;i<10;i++){
        var tempDate = moment().add(i,"days");
        $scope.package_date_scope.push({value:tempDate.format("YYYY-M-D"),text:tempDate.format("Do MMM YYYY")})          
    }
 


  	$scope.fetchData = function(date){
                $inputs = {
                    date:date,
                    token:token
                };
  		$http.post(apiUrl+"/response",$inputs).success(function(data){  			
  			data.data.forEach(function(dat){
  				dat.last.birthdate = $scope.returnDate(dat.last.birthdate);
  				dat.order.package_start = $scope.returnDate(dat.order.package_start);
                              dat.user.today = $scope.returnDate(dat.user.today);
                              dat.order.service_start = $scope.returnDate(moment(dat.order.package_start).add(30,"days").format("YYYY-M-D")) ;
                              dat.order.service_min_date = dat.user.today;
                              dat.order.service_max_date = $scope.returnDate(moment(dat.user.today).add(10,"days").format("YYYY-M-D"));
                              dat.class="";
  			});
  			$scope.responseData = data.data;  			
  			var result = data.states;
  			$.each(result, function(k, v) {  			  
  			 	$scope.states.push({value:k,text:v});
  			});
                      result = data.hauList;
                      $.each(result, function(k, v) {         
                        $scope.HAU.push({value:k,text:v});
                      });
                      
                      result = data.interestedList;
                      $.each(result, function(k, v) {         
                        $scope.IN.push({value:k,text:v});
                      });

                      
                      
                      $scope.initNewUser();
                      console.log($scope.responseData);
  		}).error(function(data){
  			console.log(data);
  		});
  	}


  	$scope.returnDate = function(date){
  		var arr = date.split("-");
  		return new Date(parseInt(arr[0]),parseInt(arr[1])-1,parseInt(arr[2]));
  	}

      $scope.historyDate = null;

      $scope.$watch("historyDate",function(newValue,oldValue){
          if(!newValue) return;
          $scope.fetchData($scope.returnFormatedDate(newValue));
          $scope.closeAnyModal('historyModal');    
      });

      $scope.fromBeginning = function(){
        $scope.fetchData(null);
        $scope.historyDate = null;
        $scope.closeAnyModal('historyModal');        
      }

      $scope.closeAnyModal = function(modalName){        
        $("#"+modalName).modal("hide");
      }

      $scope.updateResponse = function(tableName,fieldName,fieldValue,id){
              if(fieldName=="package_start"||fieldName=="birthdate"){      
                  fieldValue =  $scope.returnFormatedDate(fieldValue);
                  if(fieldName=="package_start"){
                    var rdata = $scope.responseData;
                    for(var i=0,j = rdata.length; i<j;i++){
                              if(rdata[i].order.id==id){
                                rdata[i].order.service_start =   moment(fieldValue).add(30,"days").format("MMM DD YYYY") ;
                                break;
                            }
                    }        
                 }
              }



            var $inputs = {
                tableName:tableName,
                fieldName:fieldName,
                fieldValue:fieldValue,
                token:token,
                id:id,
            };
           
            if(fieldName=="zip"){
               $http.defaults.useXDomain = true;
               delete $http.defaults.headers.common['X-Requested-With'];
              return $http.get("http://api.zippopotam.us/us/"+fieldValue).then(function(response){                    
                    $http.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
                    var cityState = response.data.places[0];                             
                    $inputs.city = cityState["place name"];
                    $inputs.state = cityState["state abbreviation"];      
                    $scope.changeCity($inputs.city,$inputs.state,$inputs.id);              
                    $http.post(apiUrl+"/updateresponse",$inputs);
              }).finally(function(){
                              $http.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
               });
            }else{
                return   $http.post(apiUrl+"/updateresponse",$inputs);    
            }
       }
        
          $scope.changeCity = function(city,state,id){
                   var data = $scope.responseData,length = $scope.responseData.length;
                  for(i=0;i<length;i++){
                          if(data[i].profile.id == id){
                            data[i].profile.city = city;
                            data[i].profile.state = state;
                            break;
                          }  
                  }
          }
          
          $scope.genFile = function(type){                        
              if($scope.selectedData.length==0){
                $scope.error = "alert-danger";      
                $scope.errorMsg = "Please select a row by clicking on sno.";    
                $("#newfileModal").modal("show");      
                return;
              }
              if($scope.selectedData.length>1 && type=="pdf"){
               $scope.error = "alert-danger";      
               $scope.errorMsg = "Please select a single  row for pdf";    
               $("#newfileModal").modal("show");      
               return; 
              } 
              $inputs = {
                data: (type=="pdf")? $scope.selectedData[0]:$scope.selectedData,
                token:token,
                type:type,
              }

              
              
              if(type=="pdf"){
                  $inputs.extra = {
                  package_start : $scope.returnFormatedDate($scope.selectedData[0].order.package_start),
                  day : $scope.selectedData[0].last.birthdate.getDate(),
                  month :  $scope.selectedData[0].last.birthdate.getMonth()+1,
                  year : $scope.selectedData[0].last.birthdate.getFullYear(),
                  card_type: ($scope.selectedData[0].order.card_number.substring(0,1)=="4") ? "Visa" : "Master Card",
                  today: $scope.returnFormatedDate($scope.selectedData[0].user.today),
                  };
                  $scope.image = $("#imagePath").html()+"/pdf_file.png";
              }else{
                $scope.image = $("#imagePath").html()+"/excel.png";
              }

              $("#newfileModal").modal("show");
              $http.post(apiUrl+"/genfile",$inputs).success(function(file){
                $scope.file = file;                
                $scope.error = "bg-primary";
              }).error(function(response){
                 $scope.error = "alert-danger";
                 $scope.errorMsg = "There was error generating file.. please try again.";
                 $scope.clearClass();
              });
              return;
          }

          $scope.toogleClass = function(sno){
            $scope.responseData.forEach(function(data){
              if(data.user.sno==sno){
                  if(data.class==""){
                      data.class="bg-custom";
                      $scope.selectedData.push(data);
                  }else{
                      data.class="";
                      $scope.removeData(sno);
                  }
              }
            });
          }

          $scope.$watch("newUser.profile.zip",function(newValue,oldValue){
              if(!newValue || newValue.length<5)return;
              $http.defaults.useXDomain = true;
              delete $http.defaults.headers.common['X-Requested-With'];
              $http.get("http://api.zippopotam.us/us/"+newValue).then(function(response){                    
                                  $http.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
                                  var cityState = response.data.places[0];                             
                                  $scope.newUser.profile.city = cityState["place name"];
                                  $scope.newUser.profile.state = cityState["state abbreviation"];                                        
                            }).catch(function(){
                              $scope.newUser.profile.zip = "";
                            }).finally(function(){
                              $http.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
                            });
          });

          $scope.$watch("newUser.order.pzip",function(newValue,oldValue){
              if(!newValue || newValue.length<5)return;
              $http.defaults.useXDomain = true;
              delete $http.defaults.headers.common['X-Requested-With'];
              $http.get("http://api.zippopotam.us/us/"+newValue).then(function(response){                    
                            console.log("success")                                                                                                  
                            }).catch(function(){
                              $scope.newUser.order.pzip = "";
                            }).finally(function(){
                              $http.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
                            });
          });

          $scope.$watch("newUser.order.szip",function(newValue,oldValue){
              if(!newValue || newValue.length<5)return;
              $http.defaults.useXDomain = true;
              delete $http.defaults.headers.common['X-Requested-With'];
              $http.get("http://api.zippopotam.us/us/"+newValue).then(function(response){                    
                            console.log("success")                                                                                                  
                            }).catch(function(){
                              $scope.newUser.order.szip = "";
                            }).finally(function(){
                              $http.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
                            });
          });

          $scope.saveNewUser = function(){       
            if(!$scope.validateMaskedValues()){
              return;
            }
              if(isNaN($scope.newUser.order.account_number)){
                  $scope.saverequest  = Request.setRequest("error","Account number should be a number");
                  return;                
              }
            console.log($scope.newUser);  
            $scope.saverequest  = Request.setRequest("request","Creating new user");
            $inputs = {
              data : $scope.newUser,
              token:token,
            };

            $http.post(apiUrl+"/newuser",$inputs).success(function(data,status){
                      $scope.saverequest = Request.setRequest("success","Created new user.");
                      data.last.birthdate = $scope.returnDate(data.last.birthdate);
                      data.order.package_start = $scope.returnDate(data.order.package_start);
                      data.user.today = $scope.returnDate(data.user.today);
                      data.order.service_start = $scope.returnDate(moment(data.order.package_start).add(30,"days").format("YYYY-M-D")) ;
                      data.order.service_min_date = data.user.today;
                      data.order.service_max_date = $scope.returnDate(moment(data.user.today).add(10,"days").format("YYYY-M-D"));
                      data.class="";
                      $scope.responseData.push(data);
                      $scope.initNewUser();
                      $scope.closeAnyModal("addUser");
            }).error(function(data){
                  $scope.saverequest = Request.setRequest("error","Something went wrong..Please check input fields.");
            });
            
          }


          $scope.deleteUsers = function(){
                           
                 var postUrl = apiUrl+"/removeuser",list = [],selectedRows = $scope.selectedData;
                 
                 for(var i=0,j=selectedRows.length;i<j;i++){
                    list.push(selectedRows[i].user.id);
                 }
                 
                  var $inputs = {
                     idList:list,
                     token:token,
                  };
                  console.log($inputs);
                 var func = function(){                
                             $http.post(postUrl, $inputs).
                               success(function(data, status, headers, config) {        
                                     swal("Deleted!", "Seleted rows has been deleted!", "success");     
                                     $scope.selectedData.length = 0;
                                     for(var i=0,j=list.length; i<j;i++){
                                        for(var k=0,m=$scope.responseData.length;k<m;k++){
                                              if(list[i]==$scope.responseData[k].user.id){
                                                $scope.responseData.splice(k,1);
                                                break;
                                              }
                                        }
                                     }
                              }).
                               error(function(data, status, headers, config) {        
                                 sweetAlert("Oops!!", "Please try again!!", "error");
                               });
                 }

               $scope.deletePopUp(func,"selected rows");                       
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


          $scope.removeData = function(sno){
            var sel = $scope.selectedData,length = $scope.selectedData.length;
            if(length>0){
              for(i=0;i<length;i++){
                if(sel[i].user.sno == sno){
                  sel.splice(i,1);
                  break;
                }
              }
            }
          }
          
          $scope.selectAll = function(){
            $scope.selectedData.length = 0;
            $scope.responseData.forEach(function(data){
              data.class="bg-custom";
              $scope.selectedData.push(data);
            });
          }
          
          $scope.viewResponse = function(){
            if($scope.selectedData.length==0){
                          $scope.error = "alert-danger";      
                          $scope.errorMsg = "Please select a row by clicking on sno.";    
                          $("#newfileModal").modal("show");      
                          return;
              }
              $("#editRow").modal("show");
          }
          
          $scope.closeResponse = function(){
            $("#editRow").modal("hide");
          }

          $scope.clearClass = function(){
            $scope.responseData.forEach(function(data){                
                data.class="";              
            });
            $scope.selectedData.length = 0;
          }

          $scope.closeModal = function(){
            $("#newfileModal").modal("hide");
            $scope.error = "bg-primary";
            $scope.errorMsg = "Please select a row by clicking on sno.";
            $scope.file = null;
            $scope.selectedData.length = 0;
            $scope.image = null;
          }

          $scope.returnFormatedDate = function(fieldValue){
            return fieldValue.getFullYear() +"-"+ (fieldValue.getMonth()+1) + "-"+fieldValue.getDate();
          }

      

          $scope.filterValues = [ 
                                        {value:"user.sno",text:"Serial No."},
                                        {value:"user.today",text:"Time submitted"},
                                        {value:"profile.fname",text:"First Name"},
                                        {value:"profile.lname",text:"Last Name"},
                                        {value:"profile.mname",text:"Middle Name"},
                                        {value:"user.email",text:"E-mail"},
                                        {value:"profile.mno",text:"Best phone to contact"},
                                        {value:"profile.paddress",text:"Street Address"},
                                        {value:"profile.zip",text:"Zip"},
                                        {value:"profile.city",text:"City"},
                                        {value:"profile.state",text:"State"},
                                        {value:"profile.btc",text:"Best time to contact"},
                                        {value:"profile.ml",text:"Ex-military"},
                                        {value:"profile.in",text:"Interested in"},
                                        {value:"profile.hau",text:"Hear from"},
                                        {value:"order.package_start",text:"First Payment Fee Start Date"},
                                        {value:"user.today",text:"Credit-report Date"},
                                        {value:"order.service_start",text:"Service start Date"},
                                        {value:"order.package",text:"Package type"},
                                        {value:"order.contact_information",text:"Name As Shown on Card"},
                                        {value:"order.card_number",text:"Card Number"},
                                        {value:"order.month",text:"Expiration Date MM"},
                                        {value:"order.year",text:"YY"},
                                        {value:"order.cvv",text:"CVV"},
                                        {value:"order.bank_name",text:"Bank Name"},
                                        {value:"order.account_type",text:"Account type"},
                                        {value:"order.routing_number",text:"ABA/ Routing Number"},
                                        {value:"order.account_number",text:"Account Number"},
                                        {value:"order.fullname",text:"Name on Account"},
                                        {value:"last.birthdate",text:"Date of Birth"},
                                        {value:"last.social_security_number",text:"Social security Number"},
                                        {value:"last.driving_license_number",text:"Driving License Number"},
                                        {value:"last.driving_license_state",text:"Driving License State"}];
                                        $scope.searchOption = $scope.filterValues[0];
       
       $scope.$watch('searchOption',function(newValue,oldValue){
                if(!newValue)return;
                $scope.isDate = newValue.value=='order.package_start' || newValue.value=='user.today'  || newValue.value=='order.service_start'  || newValue.value=='last.birthdate';
        });


      $scope.dateOptions= {
       formatYear: 'yy',
       startingDay: 1
      }                    

      $scope.clearSaverequest = function(){
        $scope.saverequest = Request.clearRequest();
      }

      $scope.initNewUser = function(){
                $scope.newUser = {
                  order:{},
                  last:{},
                  user:{},
                  profile:{},
                };
                $scope.newUser.profile.btc = $scope.BTC[0];
                $scope.newUser.profile.ml = $scope.yesNo[0];
                $scope.newUser.order.package = $scope.selectPackage[1];
                $scope.newUser.order.account_type = $scope.accountType[0];
                $scope.newUser.last.day = $scope.dateList.days[0];
                $scope.newUser.last.year = $scope.dateList.year[0];
                $scope.newUser.last.month = $scope.dateList.month[0]; 
                $scope.newUser.profile.hau = $scope.HAU[0];
                $scope.newUser.profile.in = $scope.IN[0];
                $scope.newUser.last.dls = $scope.states[0];
                $scope.newUser.order.package_start = $scope.package_date_scope[0];
                $scope.newUser.order.year = $scope.years[0];
                $scope.newUser.order.month = $scope.months[0];
      };

      $scope.applyMaskedInput = function(){
        $.mask.definitions['h'] = "[A-Za-z0-9]";
        $("#maskedMob").mask("999-999-9999");
        $("#maskedZip").mask("99999");
        $("#maskedPZip").mask("99999");
        $("#maskedSZip").mask("99999");
        $("#maskedCard").mask("9999-9999-9999-9999");
        $("#maskedCvv").mask("999");        
        $("#maskedRouting").mask("999999999");
        $("#maskedSsn").mask("999-99-9999");
        $("#maskedDln").mask("hhh-hhh-hhh");
      }

      $scope.validateMaskedValues = function(){
          var errorlog = {
            name : "",
            isset : false,
          };
          $(".required_input").each(function(){
            $this = $(this);
            if($this.val()==""){
              errorlog.isset = true;
              errorlog.name=$this.parent().prev().html();
              return false;
            }
          });
          if(errorlog.isset){
            $scope.saverequest = Request.setRequest("error",errorlog.name+" can't be empty");
            return false;
          }

          $scope.saverequest = Request.clearRequest();
          return true;
      };

      $scope.clearSaverequest();
      $scope.applyMaskedInput();                
      $scope.fetchData(null);
  }]);

$(document).click(function(e){
  if(e.target.nodeName !="TD" && !$(e.target).hasClass("persist")){
    rootScope.$apply(function(){
      if(rootScope.selectedData.length!=0)
          rootScope.clearClass();
    });  
  }
});

$(window).resize(function(event) {
  rootScope.$apply(function(){
    rootScope.windowHeight = $(window).height();
  });
});

