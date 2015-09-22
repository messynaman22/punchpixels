var app = angular.module("TestModule",["ngTable"], function($interpolateProvider) {
        $interpolateProvider.startSymbol('((');
        $interpolateProvider.endSymbol('))');
    }).config(['$httpProvider', function($httpProvider) {
      $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
  }]);

app.controller("TestController",["$scope","$http","$filter","NgTableParams",function($scope,$http,$filter,NgTableParams){
        $scope.apiUrl = $("#apiUrl").html(),
        $scope.testData = null,
        $scope.token = $("#token").html(),
        $scope.selectedData = null,$scope.editUrl = $("#editUrl").html();
        $scope.fetchPages = function(){
            var getUrl = $scope.apiUrl+"/pages?token="+$scope.token;
            $http.get(getUrl).success(function(data){
               $scope.testData = data;
               $scope.fillTable();     
            }).error(function(data){
                    console.log(data);
            });
        };

        $scope.deletePage = function(id,name){
            var postUrl = $scope.apiUrl+"/delpage";
             var $inputs = {
                id:id,
                token:$scope.token,
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
        

        $scope.fillTable = function(){
            $scope.tableParams = new NgTableParams({
                page: 1, 
                count: 10,
                sorting: {
                            name: 'asc'   
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
        
        
        $scope.fetchPages();
}]);

function closeModal(){
  $("#editData").close();
}