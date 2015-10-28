@extends("crm.dashboard")

@section("container")
<div class="container-fluid " style="margin-top:100px;margin-left:10px" ng-app="ResponseModule" ng-controller="ResponseController">

<div class="bs-component">
              <nav class="navbar navbar-default">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>                 
                  </div>

                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav">
                      <li><a href="#" class="persist" ng-click="selectAll()"> <i class="fa fa-check-square persist"></i>&nbsp;Select All</a></li>
                      <li><a href="#" class="persist" ng-click="clearClass()" ng-disabled="selectedData.length == 0"> <i class="fa fa-square-o persist"></i>&nbsp;Unselect All</a></li>
                      <li><a href="#" class="persist" ng-click="genFile('pdf')" ng-disabled="selectedData.length == 0"><i class="fa fa-file-pdf-o persist"></i>&nbsp;Save PDF</a></li>
                      <li><a href="#" class="persist" ng-click="genFile('xls')" ng-disabled="selectedData.length == 0"> <i class="fa fa-file-excel-o persist"></i>&nbsp;Save Excel</a></li>              
                    </ul>
                    <form class="navbar-form navbar-left" role="search" id="searchForm">
                                           
                        <input type="text" class="form-control"  ng-hide = "isDate" placeholder="Search" ng-model="searchValue" >
                        
                        <input type="text" ng-show= "isDate" class="form-control" datepicker-popup="dd-MM-yyyy"ng-model="dateFilterData"  datepicker-options="dateOptions"  ng-required="true" close-text="Close" placeholder="Select Date" />                          
                        <select ng-model="searchOption" ng-options="filter.text for filter in filterValues"  class="form-control" style="color:#666666" ></select>                                               
                       &nbsp;&nbsp; 
                        <label for="history" style="color:white">Show data from :</label>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#historyModal">(( (historyDate)? ( historyDate | date:'MMM dd yyyy' ):   "Beginning"))</button>
                        @if($admin["role"] == 'Admin' || $admin["role"] == 'Write')
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUser"><i class="fa fa-plus"></i> &nbsp;&nbsp;Add User</button>    
                        <button type="button" class="btn btn-danger" ng-click="deleteUsers()" ng-disabled="selectedData.length == 0"><i class="fa fa-close"></i> &nbsp;&nbsp;Delete User</button>
                        @endif
                    </form>              
                  </div>
                </div>
              </nav>
            </div>


<div class="container-fluid over">
<table class="table table-bordered "  style=" word-wrap: break-word;table-layout:fixed">
  <thead>
    <tr >
     <th class="twidth" ng-repeat="filter in filterValues">(( filter.text ))</th>         
    </tr>
  </thead>
  @if($admin["role"] == 'Admin' || $admin["role"] == 'Write')
  <tbody>
     <tr ng-repeat="data in responseData | Search:searchOption:searchValue:dateFilterData" ng-class="data.class"  >     
      <td class="twidth" ng-click="toogleClass(data.user.sno)">(( data.user.sno ))</td>
      <td  class="twidth" ng-click="toogleClass(data.user.sno)">(( data.user.time_submitted ))</td>
      <td  class="twidth" ><div class="edit" onbeforesave="updateResponse('profiles','fname',$data,data.profile.id)" editable-text="data.profile.fname" buttons="no" e-required>(( data.profile.fname ))</div></td>
      <td  class="twidth"><div class="edit" onbeforesave="updateResponse('profiles','lname',$data,data.profile.id)" editable-text="data.profile.lname"  buttons="no"  e-required>(( data.profile.lname ))</div></td>
      <td  class="twidth"><div class="edit" onbeforesave="updateResponse('profiles','mname',$data,data.profile.id)" editable-text="data.profile.mname"  buttons="no">(( data.profile.mname ))</div></td>
      <td  class="twidth"><div class="edit" editable-email="data.user.email" onbeforesave="updateResponse('users','email',$data,data.user.id)" buttons="no" e-required>(( data.user.email ))</div></td>
      <td  class="twidth"><div class="edit" onbeforesave="updateResponse('profiles','mno',$data,data.profile.id)"  editable-tel="data.profile.mno" buttons="no" e-pattern="\d{3}\-\d{3}\-\d{4}" e-title="xxx-xxx-xxxx" e-required>(( data.profile.mno ))</div></td>
      <td  class="twidth "><div class="edit" onbeforesave="updateResponse('profiles','paddress',$data,data.profile.id)" editable-text="data.profile.paddress" buttons="no" e-required>(( data.profile.paddress ))</div></td>
      <td  class="twidth "><div class="edit" onbeforesave="updateResponse('profiles','zip',$data,data.profile.id)" editable-text="data.profile.zip" buttons="no" e-pattern="\d{5}" e-title="xxxxx" e-required>(( data.profile.zip ))</div></td>
      <td  class="twidth ">(( data.profile.city ))</td>
      <td  class="twidth ">(( data.profile.state ))</td>
      <td  class="twidth "><div class="edit"buttons="no" onbeforesave="updateResponse('profiles','btc',$data,data.profile.id)" editable-select="data.profile.btc" e-ng-options="s.value as s.text for s in BTC"  e-required>(( data.profile.btc ))</div></td>
      <td  class="twidth "><div class="edit"buttons="no" onbeforesave="updateResponse('profiles','ml',$data,data.profile.id)" editable-select="data.profile.ml" e-ng-options="s.value as s.text for s in yesNo"  e-required>(( (data.profile.ml == 0)? "No" : "Yes"   ))</div></td>      
      <td  class="twidth "><div class="edit"buttons="no" onbeforesave="updateResponse('profiles','in',$data,data.profile.id)" editable-select="data.profile.in" e-ng-options="s.value as s.text for s in IN"  e-required>(( data.profile.in   ))</div></td>
      <td  class="twidth "><div class="edit"buttons="no" onbeforesave="updateResponse('profiles','hau',$data,data.profile.id)" editable-select="data.profile.hau" e-ng-options="s.value as s.text for s in HAU"  e-required>(( data.profile.hau   ))</div></td>
      <td  class="twidth ">
            <div class="edit"  e-min-date="data.order.service_min_date" e-max-date="data.order.service_max_date" editable-bsdate="data.order.package_start" onbeforesave="updateResponse('orders','package_start',$data,data.order.id)"  e-datepicker-popup="dd/MM/yyyy" >
                (( data.order.package_start | date:'MMM dd yyyy'))
              </div>
       </td>
       <td  class="twidth" ng-click="toogleClass(data.user.sno)">(( data.user.date ))</td>
       <td  class="twidth" ng-click="toogleClass(data.user.sno)" >(( data.order.service_start | date:'MMM dd yyyy'  ))</td>
      <td  class="twidth "><div class="edit" buttons="no" onbeforesave="updateResponse('orders','package',$data,data.order.id)" editable-select="data.order.package"  e-ng-options="s.value as s.text for s in selectPackage"  e-required>(( data.order.package ))</div></td>

      <td  class="twidth "><div class="edit" buttons="no" onbeforesave="updateResponse('orders','contact_information',$data,data.order.id)" editable-text="data.order.contact_information" e-required>(( data.order.contact_information ))</div></td>

      <td  class="twidth "><div class="edit" buttons="no" onbeforesave="updateResponse('orders','card_number',$data,data.order.id)" editable-text="data.order.card_number" e-pattern="[4|5][0-9]{3}-[0-9]{4}-[0-9]{4}-[0-9]{4}" e-required>(( data.order.card_number ))</div></td>

      <td  class="twidth "><div class="edit" buttons="no" onbeforesave="updateResponse('orders','month',$data,data.order.id)" editable-select="data.order.month" e-ng-options="s.value as s.text for s in months"  e-required>(( data.order.month ))</div></td>

      <td  class="twidth ">20<span class="edit" buttons="no" onbeforesave="updateResponse('orders','year',$data,data.order.id)" editable-select="data.order.year"  e-ng-options="s.value as s.text for s in years"  e-required>((data.order.year ))</span></td>

      <td  class="twidth "><div class="edit"buttons="no" onbeforesave="updateResponse('orders','cvv',$data,data.order.id)" editable-text="data.order.cvv" e-pattern="\d{3}" e-title="xxx" e-required>(( data.order.cvv ))</div></td>

      <td  class="twidth "><div class="edit"buttons="no" onbeforesave="updateResponse('orders','bank_name',$data,data.order.id)" editable-text="data.order.bank_name" e-required>(( data.order.bank_name ))</div></td>

      <td  class="twidth "><div class="edit"buttons="no" onbeforesave="updateResponse('orders','account_type',$data,data.order.id)" editable-select="data.order.account_type" e-ng-options="s.value as s.text for s in accountType"  e-required>(( data.order.account_type ))</div></td>

      <td  class="twidth"><div class="edit"buttons="no" onbeforesave="updateResponse('orders','routing_number',$data,data.order.id)" editable-text="data.order.routing_number" e-pattern="\d{9}" e-title="xxxxxxxxx" e-required>(( data.order.routing_number ))</div></td>

      <td  class="twidth"><div class="edit" buttons="no" onbeforesave="updateResponse('orders','account_number',$data,data.order.id)" editable-text="data.order.account_number" e-required>(( data.order.account_number ))</div></td>

      <td  class="twidth">(( data.order.full_name ))</td>
      <td class="twidth"> <div class="edit"  onbeforesave="updateResponse('last_step','birthdate',$data,data.last.user_id)"  editable-bsdate="data.last.birthdate" e-datepicker-popup="dd/MMM/yyyy" >(( data.last.birthdate  | date:'MMM dd yyyy'))</div></td>
      <td  class="twidth"><div class="edit" onbeforesave="updateResponse('last_step','social_security_number',$data,data.last.user_id)"  buttons="no" editable-text="data.last.social_security_number" e-pattern=" [0-9]{3}-[0-9]{2}-[0-9]{4}"  e-title="xxx-xx-xxxx" e-required>(( data.last.social_security_number ))</div></td>
      <td  class="twidth"><div class="edit" onbeforesave="updateResponse('last_step','driving_license_number',$data,data.last.user_id)" buttons="no"  editable-text="data.last.driving_license_number" e-pattern=" [A-Za-z0-9]{3}-[A-Za-z0-9]{3}-[A-Za-z0-9]{3}"  e-title="aaa-aaa-aaa"  e-required>(( data.last.driving_license_number ))</div></td>
      <td  class="twidth"><div class="edit" onbeforesave="updateResponse('last_step','driving_license_state',$data,data.last.user_id)" buttons="no"  editable-select="data.last.driving_license_state"  e-ng-options="s.value as s.text for s in states" >(( data.last.driving_license_state ))</div></td>
      
    </tr>  
   <tr ng-hide="responseData.length">
     <td>No rows.</td>
   </tr>
  </tbody>
  @else

  <tbody>
     <tr ng-repeat="data in responseData | Search:searchOption:searchValue:dateFilterData" ng-class="data.class"  >     
      <td class="twidth" ng-click="toogleClass(data.user.sno)">(( data.user.sno ))</td>
      <td  class="twidth" ng-click="toogleClass(data.user.sno)">(( data.user.time_submitted ))</td>
      <td  class="twidth" ng-click="toogleClass(data.user.sno)" >(( data.profile.fname ))</td>
      <td  class="twidth" ng-click="toogleClass(data.user.sno)">(( data.profile.lname ))</td>
      <td  class="twidth" ng-click="toogleClass(data.user.sno)">(( data.profile.mname ))</td>
      <td  class="twidth" ng-click="toogleClass(data.user.sno)">(( data.user.email ))</td>
      <td  class="twidth" ng-click="toogleClass(data.user.sno)">(( data.profile.mno ))</td>
      <td  class="twidth " ng-click="toogleClass(data.user.sno)">(( data.profile.paddress ))</td>
      <td  class="twidth " ng-click="toogleClass(data.user.sno)">(( data.profile.zip ))</td>
      <td  class="twidth " ng-click="toogleClass(data.user.sno)">(( data.profile.city ))</td>
      <td  class="twidth " ng-click="toogleClass(data.user.sno)">(( data.profile.state ))</td>
      <td  class="twidth " ng-click="toogleClass(data.user.sno)">(( data.profile.btc ))</td>
      <td  class="twidth "ng-click="toogleClass(data.user.sno)">(( (data.profile.ml == 0)? "No" : "Yes"   ))</td>      
      <td  class="twidth "ng-click="toogleClass(data.user.sno)">(( data.profile.in   ))</td>
      <td  class="twidth "ng-click="toogleClass(data.user.sno)">(( data.profile.hau   ))</td>
      <td  class="twidth "ng-click="toogleClass(data.user.sno)"> (( data.order.package_start | date:'MMM dd yyyy'))</td>
       <td  class="twidth" ng-click="toogleClass(data.user.sno)">(( data.user.date ))</td>
       <td  class="twidth" ng-click="toogleClass(data.user.sno)">(( data.order.service_start | date:'MMM dd yyyy'  ))</td>
      <td  class="twidth " ng-click="toogleClass(data.user.sno)">(( data.order.package ))</td>
      <td  class="twidth " ng-click="toogleClass(data.user.sno)">(( data.order.contact_information )</td>
      <td  class="twidth " ng-click="toogleClass(data.user.sno)">(( data.order.card_number ))</td>
      <td  class="twidth " ng-click="toogleClass(data.user.sno)">(( data.order.month ))</td>
      <td  class="twidth " ng-click="toogleClass(data.user.sno)">20((data.order.year ))</td>
      <td  class="twidth " ng-click="toogleClass(data.user.sno)">(( data.order.cvv ))</td>
      <td  class="twidth " ng-click="toogleClass(data.user.sno)">(( data.order.bank_name ))</td>
      <td  class="twidth " ng-click="toogleClass(data.user.sno)">(( data.order.account_type ))</td>
      <td  class="twidth" ng-click="toogleClass(data.user.sno)">(( data.order.routing_number ))</td>
      <td  class="twidth" ng-click="toogleClass(data.user.sno)">(( data.order.account_number ))</td>
      <td  class="twidth" ng-click="toogleClass(data.user.sno)">(( data.order.full_name ))</td>
      <td class="twidth" ng-click="toogleClass(data.user.sno)"> (( data.last.birthdate  | date:'MMM dd yyyy'))</td>
      <td  class="twidth" ng-click="toogleClass(data.user.sno)">(( data.last.social_security_number ))</td>
      <td  class="twidth" ng-click="toogleClass(data.user.sno)">(( data.last.driving_license_number ))</td>
      <td  class="twidth" ng-click="toogleClass(data.user.sno)">(( data.last.driving_license_state ))</td>      
    </tr>  
    <tr ng-hide="responseData.length">
      <td>No rows.</td>
    </tr>
  </tbody>

@endif

</table>
</div> 	


<div class="modal fade" id="newfileModal" data-controls-modal="newfileModal" 
   data-backdrop="static" 
   data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" z-index="999999">
  <div class="modal-dialog" role="document"  style="z-index:9000" >
    <div class="modal-content modalbody" >      
      <div class="modal-body" style="height:170px">
          <span class="pull-right clickable"  ng-show=" file || error == 'alert-danger'" ng-click="closeModal()"><i class="fa fa-close"></i></span>
          <div class="col-xs-12  nopadding">      
          <div class="col-sm-4" ng-hide="error=='alert-danger'">
              <img  src=((image)) width="100" height="100" />
          </div>
          <div class="col-sm-8">
              <span ng-show="file">The (( file.filename )) is ready to be downloaded<br>
              <a ng-show="file"  href="(( file.url))" class="btn btn-default" download>Download the file..</a></span>        
              <div style="margin-top: 25px !important;" ng-hide="file || error == 'alert-danger' "><i class="fa fa-spin fa-circle-o-notch"></i>&nbsp; Preparing requested file, please wait ...</div>
          </div>
              <div style="margin-top: 25px !important;color:#E51C23;font-weight:bold" ng-show="error=='alert-danger'" class="col-xs-12"><i class="fa fa-frown-o" ></i>&nbsp;((errorMsg))</div>
          </div>
      </div>    
    </div>
  </div>
</div>


    <div class="modal fade" id="historyModal" data-controls-modal="historyModal" 
       data-backdrop="static" 
       data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" z-index="999999">
        <div class="modal-dialog" role="document"  style="z-index:9000" >
            <div class="modal-content" >
                <div class="modal-header">
                  <button type="button" class="close" ng-click="closeAnyModal('historyModal')"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title" id="myModalLabel">Choose date</h3>
                </div>                    
                <div class="modal-body" >  
                      <div style="display:inline-block; min-height:290px;margin-left:80px">
                            <datepicker ng-model="historyDate" datepicker-popup="dd-MM-yyyy"  datepicker-options="dateOptions"  show-weeks="true" class="well well-sm">                              
                            </datepicker>
                      </div>          
                      <br>
                      <button class="btn btn-primary" style="margin-left:80px" ng-click="fromBeginning()">From beginning</button>               
                </div>
              </div>    
          </div>
      </div>

          <div class="modal fade" id="addUser" data-controls-modal="addUser" 
          data-backdrop="static" 
          data-keyboard="false" 
          tabindex="-1" role="dialog" aria-labelledby="myModalLabel" z-index="999999">
              <div class="modal-dialog" role="document"  style="z-index:9000" >
                  <div class="modal-content" >      
                      <div class="modal-header">
                            <button type="button" class="close" ng-hide="saverequest.type=='request'" ng-click="closeAnyModal('addUser')"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title" id="myModalLabel">Add new user</h3>
                      </div>
                      <div class="modal-body" style="height: ((windowHeight-320))px;overflow-y:auto;">         
                          {!! Form::open(["class"=>"form-horizontal","name"=>"addUserForm","novalidate"=>""]) !!}
                             <div class="form-group">
                                 {!!Form::label("fname","First Name",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                     {!! Form::text("fname",null,["class"=>"form-control required_input","ng-model"=>"newUser.profile.fname"]) !!}
                                 </div>
                             </div>    
                             <div class="form-group">
                                 {!!Form::label("mname","Middle Name",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                     {!! Form::text("mname",null,["class"=>"form-control ","ng-model"=>"newUser.profile.mname"]) !!}
                                 </div>
                             </div>   
                             <div class="form-group">
                                 {!!Form::label("lname","Last Name",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                     {!! Form::text("lname",null,["class"=>"form-control required_input","ng-model"=>"newUser.profile.lname"]) !!}
                                 </div>
                             </div>   
                             <div class="form-group">
                                 {!!Form::label("email","Email",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                     {!! Form::email("email",null,["class"=>"form-control required_input","ng-model"=>"newUser.user.email"]) !!}
                                 </div>
                             </div>   
                             <div class="form-group">
                                 {!!Form::label("mno","Mobile no.",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                     {!! Form::text("mno",null,["class"=>"form-control required_input","ng-model"=>"newUser.profile.mno","id"=>"maskedMob"]) !!}
                                 </div>
                             </div>   
                             <div class="form-group">
                                 {!!Form::label("paddress","Physical Address",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                     {!! Form::text("paddress",null,["class"=>"form-control required_input","ng-model"=>"newUser.profile.paddress"]) !!}
                                 </div>
                             </div>   
                             <div class="form-group">
                                 {!!Form::label("zip","Zip",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                     {!! Form::text("zip",null,["class"=>"form-control required_input","ng-model"=>"newUser.profile.zip","id"=>"maskedZip"]) !!}
                                 </div>
                             </div>   
                             <div class="form-group">
                                 {!!Form::label("city","City",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                     {!! Form::text("city",null,["class"=>"form-control ","ng-model"=>"newUser.profile.city","disabled"=>"disabled"]) !!}
                                 </div>
                             </div> 
                             <div class="form-group">
                                 {!!Form::label("state","State",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                     {!! Form::text("state",null,["class"=>"form-control","ng-model"=>"newUser.profile.state","disabled"=>"disabled"]) !!}
                                 </div>
                             </div> 
                             <div class="form-group">
                                 {!!Form::label("btc","Best time to contact",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                    <select  name="btc" class="form-control" ng-model="newUser.profile.btc" ng-options="s.text  for s in BTC"></select>
                                 </div>
                             </div>   
                             <div class="form-group">
                                 {!!Form::label("ml","Ex-military",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                    <select  name="ml" class="form-control" ng-model="newUser.profile.ml" ng-options="s.text  for s in yesNo"></select>
                                 </div>
                             </div>
                             <div class="form-group">
                                 {!!Form::label("in","Interested in",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                    <select  name="in" class="form-control" ng-model="newUser.profile.in" ng-options="s.text  for s in IN"></select>
                                 </div>
                             </div>   
                             <div class="form-group">
                                 {!!Form::label("hau","Refered from",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                    <select  name="hau" class="form-control" ng-model="newUser.profile.hau" ng-options="s.text  for s in HAU"></select>
                                 </div>
                             </div>   
                             <div class="form-group">
                                 {!!Form::label("package_start","Package starts from",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                    <select  name="hau" class="form-control" ng-model="newUser.order.package_start" ng-options="s.text  for s in package_date_scope"></select>
                                 </div>
                             </div>   
                             <div class="form-group">
                                 {!!Form::label("package","Package type",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                    <select  name="hau" class="form-control" ng-model="newUser.order.package" ng-options="s.text  for s in selectPackage"></select>
                                 </div>
                             </div>   
                             <div class="form-group">
                                 {!!Form::label("contact_information","Name on Card",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                     {!! Form::text("contact_information",null,["class"=>"form-control required_input","ng-model"=>"newUser.order.contact_information"]) !!}
                                 </div>
                             </div>                          
                               <div class="form-group">
                                 {!!Form::label("street_address","Primary Billing Address",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                     {!! Form::text("street_address",null,["class"=>"form-control required_input","ng-model"=>"newUser.order.street_address"]) !!}
                                 </div>
                             </div>
                             <div class="form-group">
                                 {!!Form::label("pzip","Primary Zip",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                     {!! Form::text("pzip",null,["class"=>"form-control required_input","ng-model"=>"newUser.order.pzip","id"=>"maskedPZip"]) !!}
                                 </div>
                             </div>
                             <div class="form-group">
                                 {!!Form::label("billing_address","Secondary Billing Address",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                     {!! Form::text("billing_address",null,["class"=>"form-control required_input","ng-model"=>"newUser.order.billing_address"]) !!}
                                 </div>
                             </div>
                             <div class="form-group">
                                 {!!Form::label("szip","Secondary Zip",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-8">
                                     {!! Form::text("szip",null,["class"=>"form-control required_input","ng-model"=>"newUser.order.szip","id"=>"maskedSZip"]) !!}
                                 </div>
                             </div>  

                             <div class="form-group">
                                 {!!Form::label("card_number","Card Number",["class"=>"col-lg-3 control-label"])!!}
                                 <div class="col-lg-5">
                                     {!! Form::text("card_number ",null,["class"=>"form-control required_input","ng-model"=>"newUser.order.card_number","id"=>"maskedCard"]) !!}
                                 </div>
                                 {!!Form::label("cvv","CVV",["class"=>"col-lg-2 control-label"])!!}
                                 <div class="col-lg-2">
                                     {!! Form::text("cvv",null,["class"=>"form-control required_input","ng-model"=>"newUser.order.cvv","id"=>"maskedCvv"]) !!}
                                 </div>
                             </div>
                             
                      
                            <div class="form-group">
                                {!!Form::label("month","Card Expiry Month",["class"=>"col-lg-3 control-label"])!!}
                                <div class="col-lg-3">
                                     <select  name="months" class="form-control" ng-model="newUser.order.month" ng-options="s.text  for s in months"></select>
                                </div>
                                {!!Form::label("year"," Card Expiry Year",["class"=>"col-lg-3 control-label"])!!}
                                <div class="col-lg-3">
                                 <select  name="year" class="form-control" ng-model="newUser.order.year" ng-options="s.text  for s in years"></select>
                                </div>
                                
                            </div> 
                            <div class="form-group">
                                  {!!Form::label("bank_name","Bank name",["class"=>"col-lg-3 control-label"])!!}
                                  <div class="col-lg-8">
                                      {!! Form::text("bank_name",null,["class"=>"form-control required_input","ng-model"=>"newUser.order.bank_name"]) !!}
                                  </div>
                            </div>
                            <div class="form-group">
                                  {!!Form::label("account_number","Account number",["class"=>"col-lg-3 control-label"])!!}
                                  <div class="col-lg-8">
                                      {!! Form::text("account_number",null,["class"=>"form-control required_input","ng-model"=>"newUser.order.account_number","id"=>"maskedAcount"]) !!}
                                  </div>
                            </div>
                            <div class="form-group">
                                  {!!Form::label("routing_number","Routing number",["class"=>"col-lg-3 control-label"])!!}
                                  <div class="col-lg-8">
                                      {!! Form::text("routing_number",null,["class"=>"form-control required_input","ng-model"=>"newUser.order.routing_number","id"=>"maskedRouting"]) !!}
                                  </div>
                            </div>
                            <div class="form-group">
                                {!!Form::label("account_type","Account type",["class"=>"col-lg-3 control-label"])!!}
                                <div class="col-lg-8">
                                   <select  name="account_type" class="form-control" ng-model="newUser.order.account_type" ng-options="s.text  for s in accountType"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                  {!!Form::label("full_name","Name on bank account",["class"=>"col-lg-3 control-label"])!!}
                                  <div class="col-lg-8">
                                      {!! Form::text("full_name",null,["class"=>"form-control required_input","ng-model"=>"newUser.order.full_name"]) !!}
                                  </div>
                            </div>
                            <div class="form-group">
                                  {!!Form::label("birth_date","BIrth date",["class"=>"col-lg-1 control-label"])!!}
                                  <div class="col-lg-3">
                                  <select  name="day" class="form-control" ng-model="newUser.last.day" ng-options="s.text  for s in dateList.days"></select>                                      
                                  </div>
                                  {!!Form::label("birth_month","BIrth month",["class"=>"col-lg-1 control-label"])!!}
                                  <div class="col-lg-3">                                      
                                  <select  name="month" class="form-control" ng-model="newUser.last.month" ng-options="s.text  for s in dateList.month"></select>                                      
                                  </div>
                                  {!!Form::label("birth_year","BIrth year",["class"=>"col-lg-1 control-label"])!!}
                                  <div class="col-lg-3">                                      
                                  <select  name="year" class="form-control" ng-model="newUser.last.year" ng-options="s.text  for s in dateList.year"></select>                                      
                                  </div>
                            </div>
                            <div class="form-group">
                                  {!!Form::label("ssn","Social security number",["class"=>"col-lg-3 control-label"])!!}
                                  <div class="col-lg-8">
                                      {!! Form::text("ssn",null,["class"=>"form-control required_input","ng-model"=>"newUser.last.ssn","id"=>"maskedSsn"]) !!}
                                  </div>
                            </div>
                            <div class="form-group">
                                  {!!Form::label("dln","Driving license number",["class"=>"col-lg-3 control-label"])!!}
                                  <div class="col-lg-8">
                                      {!! Form::text("dln",null,["class"=>"form-control required_input","ng-model"=>"newUser.last.dln","id"=>"maskedDln"]) !!}
                                  </div>
                            </div>
                            <div class="form-group">
                                {!!Form::label("dls","Driving license state",["class"=>"col-lg-3 control-label"])!!}
                                <div class="col-lg-8">
                                   <select  name="dls" class="form-control" ng-model="newUser.last.dls" ng-options="s.text  for s in states"></select>
                                </div>
                            </div>                                                    
                           
                        {!! Form::close() !!}   
                      </div>

                      <div class="modal-footer" >
                      <div class="form-group">
                        <button class="btn btn-primary col-lg-offset-9" type="button" ng-disabled="saverequest.type=='request'" ng-click="saveNewUser()">Add user</button>
                      </div>
                          <div class="alert alert-dismissible col-lg-offset-2 col-lg-9 text-left" ng-show="saverequest.isActive"
                                                  ng-class="saverequest.alert" style="font-size: 15px">        
                                                   <button type="button" class="close" ng-hide="saverequest.type == 'request' "ng-click="clearSaverequest()">×</button>
                                                     <i class="fa fa-w" ng-class="saverequest.icon"></i>
                                                   <strong>((saverequest.message))</strong>
                          </div>
                      </div>
                      
                    </div>    
                </div>
            </div>
          





<div style="display:none">
    <span id="imagePath">{!! URL::asset("/images/") !!}</span>
    <span id="token_app">{!! Session::token() !!}</span>

</div>

</div>
@endsection

@section("extrastyles")
{!! HTML::style("css/xeditable.css") !!}
{!! HTML::style("css/sweetalert.css") !!}
<style type="text/css">
#searchForm input[type="text"]{
  /*background-color:#2196F3;*/
  /*border-bottom: none;*/
  /*color:white;*/
 
}

.bg-custom{
  background:#CCFF82;
}

#searchForm input, #searchForm select{
  border:none;
}

.white{
  color:white;
  font-size: 20px;
}
.modalbody{
      width: 350px;
    margin-left: 24%;
}
.twidth{
	width: 300px !important	; 
}
.edit{
  border-bottom: none !important;
}
.over{
  width: 100%;
  /*height: 100%;*/
  overflow-x  : auto;
  overflow-y:visible;
}
.nopadding{
  padding:0px !important;
}
.clickable{
  cursor: pointer;
}
</style>
@endsection

@section("extrascripts")
{!! HTML::script("js/xeditable.js") !!}
{!! HTML::script("js/angularui.js") !!}
{!! HTML::script("js/moment.js") !!}
{!! HTML::script("js/jquery.maskedinput.min.js") !!}
{!! HTML::script("js/angular/commonFactory.js") !!}
{!! HTML::script("js/sweetalert.min.js") !!}
{!! HTML::script("js/angular/response.js") !!}
@endsection