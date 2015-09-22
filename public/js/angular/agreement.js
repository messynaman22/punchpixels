var app = angular.module("AgreementApp",["FactoryModule"], function($interpolateProvider) {
    $interpolateProvider.startSymbol('((');
    $interpolateProvider.endSymbol('))');
}).config(['$httpProvider', function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
}]);
var rootScope = null;

app.controller("AgreementController",["$scope","$http","Request", function($scope,$http,Request){
    rootScope = $scope, $scope.agreementSections = [],$scope.admins = [];

    $scope.token_app = token_app;
    $scope.modal = angular.element('#addAgreementSection');
    $scope.new_section = {};
    $scope.empty_section = {};
    $scope.editor = angular.element($('#editor'));

    $scope.variables = [
        {'key': '{!! $step1_fname !!}', 'value': 'First name'},
        {'key': '{!! $step1_mname !!}', 'value': 'Middle name'},
        {'key': '{!! $step1_lname !!}', 'value': 'Last name'},
        {'key': '{!! $step1_serialno !!}', 'value': 'Serial Number'},
        {'key': '{!! $credit_report_date !!}', 'value': 'Credit Report Date'},
        {'key': '{!! $today !!}', 'value': 'Today Date'},
        {'key': '{!! $three_today !!}', 'value': 'Three days from today Date'},
        {'key': '{!! $agreement_date !!}', 'value': 'Agreement Date'},
        {'key': '{!! $step1_paddress !!}', 'value': 'Physical address'},
        {'key': '{!! $step1_city !!}', 'value': 'Physical city'},
        {'key': '{!! $step1_state !!}', 'value': 'Physical state'},
        {'key': '{!! $step1_zip !!}', 'value': 'Physical zip'},
        {'key': '{!! $step1_mpaddress !!}', 'value': 'Mailing address'},
        {'key': '{!! $step1_mcity !!}', 'value': 'Mailing city'},
        {'key': '{!! $step1_mstate !!}', 'value': 'Mailing state'},
        {'key': '{!! $step1_mzip !!}', 'value': 'Mailing zip'},
        {'key': '{!! $ssn !!}', 'value': 'Social Security state'},
        {'key': '{!! $month !!}', 'value': 'Birth month'},
        {'key': '{!! $day !!}', 'value': 'Birth day'},
        {'key': '{!! $year !!}', 'value': 'Birth year'},
        {'key': '{!! $step1_email !!}', 'value': 'Email'},
        {'key': '{!! $step1_mno !!}', 'value': 'Mobile phone number'},
        {'key': '{!! $step1_hno !!}', 'value': 'Home phone number'},
        {'key': '{!! $step2_full_name !!}', 'value': 'Credit Card full name'},
        {'key': '{!! $step2_card_type !!}', 'value': 'Credit Card type'},
        {'key': '{!! $step2_card_number !!}', 'value': 'Credit Card number'},
        {'key': '{!! $step2_month !!}', 'value': 'Credit Card month'},
        {'key': '{!! $step2_year !!}', 'value': 'Credit Card year'},
        {'key': '{!! $step2_cvv !!}', 'value': 'Credit Card cvv'},
        {'key': '{!! $step2_routing_number !!}', 'value': 'Bank Routing number'},
        {'key': '{!! $step2_bank_name !!}', 'value': 'Bank Name'},
        {'key': '{!! $step2_account_type !!}', 'value': 'Acount type'},
        {'key': '{!! $step2_account_number !!}', 'value': 'Account number'},
        {'key': '{!! $dls !!}', 'value': 'Driver License State'},
        {'key': '{!! $dln !!}', 'value': 'Driver License number'},
        {'key': '{!! $step2_package !!}', 'value': 'Selected Services'},
        {'key': '{!! $crd_pdf !!}', 'value': 'The one-time credit report fee date'},
        {'key': '{!! $fpd_pdf !!}', 'value': 'First payment schedule fee date'},
        {'key': '{!! $ssd_pdf !!}', 'value': 'Month to month fee schedule'},
        {'key': '{!! $package_image !!}', 'value': 'Selected Service image'},
        {'key': '{!! $signature !!}', 'value': 'Signature code'}
    ];

    $scope.fetchAgreementSections = function(){

        var getUrl = apiUrl+"/agreementsections?token="+token_app;

        $http.get(getUrl).success(function(data,status){
            $scope.agreementSections = data.agreementSections;
            console.log(data);
        }).error(function(data,status){
            console.log(data);
        });

    };

    $scope.addAgreementSection = function(new_section){
        var request_data = angular.copy(new_section);
        request_data['token'] = $scope.token_app;

        $scope.request = Request.setRequest("request","Creating new contract agreement section.");

        $http.post(apiUrl+"/createagreementsection", request_data).success(function(data,status){
            $scope.request = Request.setRequest("success", "Section created successfully!");
            $scope.new_section = angular.copy($scope.empty_section);
            $scope.agreementSections.push(data);
        }).error(function(data,status){
            $scope.request = Request.setRequest("error", "There was an error creating the new section or " +
                "section with the same name already exist!");
        });
    }

    $scope.editingAgreementSection = function(index, section){
        $scope.isEditing = true;
        $scope.editingElement = section;
        $scope.editor.html(section.content);
        setTimeout(function(){
            $('html, body').animate({
                scrollTop: $scope.editor.offset().top - 100
            }, 500);
        });
    }

    $scope.saveCurrentEditing = function(){

        if ($scope.editor.hasClass('editing-error')){
            sweetAlert("Oops!!", "This content is too long, and won't fit on a single page.", "error");
            return;
        }
        var request_data = angular.copy($scope.editingElement);
        request_data.content = $scope.editor.cleanHtml();
        request_data['token'] = $scope.token_app;
        $scope.request = Request.setRequest("request","Editing contract agreement section.");

        $http.post(apiUrl+"/editagreementsection", request_data).success(function(data,status){
            $scope.request = Request.setRequest("success", "Section created successfully!");
            $scope.editingElement.content = data.content;
            $scope.editingElement = null;
            $scope.isEditing = false;
            swal("Good job!", "Section edited succesfully", "success");

        }).error(function(data,status){
            $scope.request = Request.setRequest("error", "There was an error editing the existing section or " +
                "section with the same name already exist!");
        });
    }

    $scope.removeAgreementSection = function(index, section){
        var requestData = {
                id : section.id,
                token: $scope.token_app,
        };
        $http.post(apiUrl+"/removeagreementsection",requestData).success(function(data,status){
            console.log(data, status);
            $scope.agreementSections.splice(index, 1);
        }).error(function(data,status){
            sweetAlert("Oops!!", "There was an error deleting this section", "error");
        });
    }

    $scope.watchContentChange = function(){
        if($scope.editor.height() > 880){
            $scope.editor.addClass('editing-error');
        }else{
            $scope.editor.removeClass('editing-error');
        }
    }
    $scope.clearRequest = function(){
        $scope.request = Request.clearRequest();
    }
    $scope.closeModal = function(){
        $scope.new_section = angular.copy($scope.empty_section);
        $scope.modal.modal('hide');
    }
    $scope.clearRequest();
    $scope.fetchAgreementSections();
    $scope.editor.wysiwyg();
}]);
