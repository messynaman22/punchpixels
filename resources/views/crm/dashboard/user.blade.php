@extends("crm.dashboard")

@section("container")
<div class="container-fluid " style="margin-top:100px;margin-left:10px" ng-app="UserModule" ng-controller="UserController">
<div class="col-lg-8">
	<form class="form-horizontal col-lg-8">			
		<div class="form-group">
			<label class="col-lg-3 control-label" for="username">Username</label>
			<div class="col-lg-9">
				<input type="text" class="form-control recReq" name="username" ng-model="user.username" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label" for="email">Email</label>
			<div class="col-lg-9">
				<input type="email" class="form-control recReq" name="email" ng-model="user.email" />
			</div>
		</div>
		<div class="form-group">
		    <label for="oldPassword" class="col-lg-3 control-label" >New Password</label>
		    <div class="col-lg-9">
		      <input type="password" class="form-control" id="oldPassword" ng-disabled="!isPassword" ng-model="user.password" />
		      <div class="checkbox" >
		        <label>
		          <input type="checkbox" ng-model="isPassword"> Edit password
		        </label>
		      </div>
		    </div>
		</div>
		<div class="form-group">
			<div class="col-lg-9 col-lg-offset-3">
				<button class="btn btn-primary col-lg-3" ng-click="saveUser()">Save</button>
			</div>
		</div>
	</form>
	
		<div class="col-lg-10 col-lg-offset-1">
			<div class="alert alert-dismissible col-lg-offset-2 col-lg-6 text-left" ng-show="request.isActive"
			                        ng-class="request.alert" style="font-size: 15px">        
			                         <button type="button" class="close" ng-hide="request.type == 'request' "ng-click="request = Request.clearRequest();">×</button>
			                           <i class="fa fa-w" ng-class="request.icon"></i>
			                         <strong>((request.message))</strong>
			</div>	
		</div>
	

</div>
<div style="display:none">
	<span id="apiUrl">{!! URL::to("/api") !!}</span>
	<span id="token_app">{!! Session::token() !!}</span>
	<span id="username">{!! $admin["username"] !!}</span>
	<span id="email">{!! $admin["email"] !!}</span>	
	<span id="userId">{!! $admin["id"] !!}</span>
</div>
</div>
@endsection

@section("extrascripts")
{!! HTML::script("js/angular/commonFactory.js") !!}
{!! HTML::script("js/angular/user.js") !!}
@endsection