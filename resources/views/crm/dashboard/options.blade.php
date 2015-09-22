@extends("crm.dashboard")

@section("container")
<div class="container-fluid " style="margin-top:100px;margin-left:10px" ng-app="OptionsModule" ng-controller="OptionsController">
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
	                      <li ng-class="recActive" ng-click="type='receipt' "><a href="#"  > Email-Receipts</a></li>
	                     <li ng-class="notActive" ng-click="type='notification' "><a href="#"  > Email-notification</a></li>
	                    </ul>	                    
	                  </div>
	                </div>
	              </nav>
	</div>
	<div class="container" style="margin-top:50px">
		<form class="form-horizontal col-lg-8" ng-show=" type=='receipt' ">			
			<div class="form-group">
				<label class="col-lg-3 control-label" for="receipt_from">From</label>
				<div class="col-lg-9">
					<input type="email" class="form-control recReq" name="receipt_from" ng-model="receipt.to_from" required/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-3 control-label" for="receipt_subject">Subject</label>
				<div class="col-lg-9">
					<input type="text" class="form-control recReq" name="receipt_subject" ng-model="receipt.subject" required/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-3 control-label" for="receipt_message">Message</label>
				<div class="col-lg-9">
					<textarea  class="form-control recReq" name="receipt_message" ng-model="receipt.message" style="resize:none;scroll-y:auto;height:200px" required></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="checkbox col-lg-offset-3">
				      <label><input type="checkbox" ng-model="receipt.include_data" ng-true-value="'1'" ng-false-value="'0'"> Include submitted data</label>
				</div>
				<button class="btn btn-primary col-lg-offset-9 col-lg-3" ng-click="saveReceipt()">Save</button>
			</div>
		</form>
		<form class="form-horizontal col-lg-8" ng-show=" type=='notification' ">						
			<div class="form-group">
				<div class="col-lg-9 col-lg-offset-3">
					<div class="panel panel-default">
					  
					  <div class="panel-heading">Notification subscribers email list 
					  <a class="pull-right" style="cursor:pointer" data-toggle="modal" data-target="#addEmail">Add email</a>
					  </div>

					  
					  <table class="table"ng-show="emails.length">
					    	<thead>
					    		<th>Email</th>
					    		<th>Include</th>
					    		<th>Delete</th>
					    	</thead>
					    	<tbody>
					    		<tr ng-repeat="email in emails">
					    		<td>(( email.email ))</td>
					    		<td><input type="checkbox"  ng-model="email.included"  ng-true-value="'1'" ng-false-value="'0'" ng-click="updateEmail(email)"></td>
					    		<td><button class="btn btn-danger btn-round" ng-click="delEmail(email)"><i class="fa fa-close"></i></button></td>
					    		</tr>
					    	</tbody>
					  </table>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-3 control-label" for="notification_subject">Subject</label>
				<div class="col-lg-9">
					<input type="text" class="form-control notifReq" ng-model="notification.subject" name="notification_subject" required/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-3 control-label" for="notification_message">Message</label>
				<div class="col-lg-9">
					<textarea  class="form-control notifReq" ng-model="notification.message" name="notification_message" style="resize:none;scroll-y:auto;height:200px" required></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="checkbox col-lg-offset-3">
				      <label><input type="checkbox" ng-model="notification.include_data" ng-true-value="'1'" ng-false-value="'0'"> Include submitted data</label>
				</div>
				<button class="btn btn-primary col-lg-offset-9 col-lg-3" ng-click="saveNotifs()" >Save</button>
			</div>
		</form>

		<div>
			<div class="alert alert-dismissible col-lg-offset-2 col-lg-6 text-left" ng-show="request.isActive"
			                        ng-class="request.alert" style="font-size: 15px">        
			                         <button type="button" class="close" ng-hide="request.type == 'request' "ng-click="request = Request.clearRequest();">×</button>
			                           <i class="fa fa-w" ng-class="request.icon"></i>
			                         <strong>((request.message))</strong>
			</div>
		</div>
	</div>
	<div class="modal fade" id="addEmail" data-controls-modal="addEmail" 
	   data-backdrop="static" 
	   data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" z-index="999999">	   	
		  <div class="modal-dialog" role="document"  style="z-index:9000" >
			    <div class="modal-content modalbody" >      
			    <div class="modal-header">
			    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    	<h4 class="modal-title" id="myModalLabel">Add email</h4>
			    </div>
				      <div class="modal-body">		          		         
				     	<form class="form-horizontal">
				     		<div class="form-group">
				     			<label for="email" class="control-label col-lg-2">Email</label>
				     			<div class="col-lg-6">
				     				<input type="email" class="form-control emReq" name="email_address" id="email_address" required/>
				     			</div>
				     			<button class="col-lg-3 btn btn-primary" ng-click="addEmails()"> Save </button>
				     		</div>
				     	</form>
				      </div>
			      </div>    
		    </div>
	  </div>
			

<div style="display:none">
	<span id="apiUrl"> {!! URL::to("/api") !!}</span>
	<span id="token_app">{!! Session::token() !!}</span>
</div>
</div>
@endsection

@section("extrascripts")
{!! HTML::script("js/angular/commonFactory.js") !!}
{!! HTML::script("js/sweetalert.min.js") !!}
{!! HTML::script("js/angular/options.js") !!}
@endsection

@section("extrastyles")
{!! HTML::style("css/sweetalert.css") !!}

<style type="text/css">
	

.btn-round{
	padding:0px;
	height:25px;
	width:25px;
	border-radius:25px;
}
</style>
@endsection