@extends("crm.dashboard")

@section("container")
<div class="container-fluid " style="margin-top:100px;margin-left:10px" ng-app="InviteApp" ng-controller="InviteController">
<div class="col-md-12">
<button class="btn btn-primary" data-toggle="modal" data-target="#sendInvite"><i class="fa fa-plus"></i> Invite users</button>
</div>
<div class="col-md-12" style="margin-top:20px;padding:0px">
<div class="col-md-5" >
	<div class="panel panel-success ">
		  <div class="panel-heading">
		    <h3 class="panel-title">Invite sent</h3>
		  </div>
		<ul class="list-group">
		   <li class="list-group-item" ng-repeat="user in invitedUser">
		   	(( user.email ))
		   	<button class='btn btn-danger btn-sm  pull-right' style="margin-top:-7px" ng-click="removeUser(1,user)"><i class='fa  fa-w fa-close'></i>&nbsp;Cancel Invite</button>
		
		   	<div class="btn-group pull-right" style="margin-top:-7px;margin-right:10px">		   	
		   	  <a href="#" class="btn btn-sm btn-primary" disabled>(( user.role ))</a>
		   	  <a href="#" class="btn btn-sm  btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
		   	  <ul class="dropdown-menu">
		   	    <li><a href="#" ng-click="changeAccess(user,'Admin')">Admin</a></li>
		   	    <li><a href="#" ng-click="changeAccess(user,'Read')">Read</a></li>
		   	    <li><a href="#" ng-click="changeAccess(user,'Write')">Write</a></li>
		   	  </ul>
		   	</div>

		   </li>
		   <li  class="list-group-item" >
		   	(( (invitedUser.length == 0)? "No user invited ! ":"" ))<a  style="cursor:pointer" data-toggle="modal" data-target='#sendInvite'>Add user</a>
		   </li>	 
		 </ul>
	</div>
</div>
<div class="col-md-7">	
	<div class="panel panel-info ">
	  <div class="panel-heading">
	    <h3 class="panel-title">Active users</h3>
	  </div>
	  <table class="table table-bordered" ng-show = "admins.length">
	  	<thead>
	  		<tr>
	  			<th>Username</th>
	  			<th>E-mail</th>
	  			<th>Permission</th>
				<th>Status</th>
	  			<th>Delete User</th>
	  		</tr>
	  	</thead>
	  	<tbody>
	  		<tr ng-repeat="user in admins">
	  			<td>(( user.username ))</td>
	  			<td> (( user.email ))</td>
	  			<td>
	  				<div class="btn-group" >		   	
	  				  <a href="#" class="btn btn-sm btn-primary" disabled>(( user.role  ))</a>
	  				  <a href="#" class="btn btn-sm  btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
	  				  <ul class="dropdown-menu">
	  				    <li><a href="#" ng-click="changeAccess(user,'Admin')">Admin</a></li>
	  				    <li><a href="#" ng-click="changeAccess(user,'Read')">Read</a></li>
	  				    <li><a href="#" ng-click="changeAccess(user,'Write')">Write</a></li>
	  				  </ul>
	  				</div>
	  			</td>
                <td>
                    <div class="btn-group" >
                        <a href="#" class="btn btn-sm btn-primary" ng-show="user.status=='active'" disabled>Active</a>
                        <a href="#" class="btn btn-sm btn-primary btn-unblock" ng-show="user.status=='blocked'" ng-click="unblockUser(user)"><span class="state-idle">Blocked</span><span class="state-hover">Unblock</span></a>
                    </div>
                </td>
	  			<td>
	  				<button class='btn btn-danger btn-sm' ng-click="removeUser(2,user)"><i class='fa  fa-w fa-close'></i></button>
	  			</td>
	  		</tr>
	  	</tbody>	
	  </table>
	  <ul class="list-group">

	  	  <li  class="list-group-item" >
	  		(( (admins.length == 0)? "No admins there ! ":"" ))<a  style="cursor:pointer" data-toggle="modal" data-target='#sendInvite'>Add user</a>
	  	</li>	 
	  </ul>
	</div>	
	
</div>
</div>

<div class="modal fade" id="sendInvite" data-controls-modal="sendInvite" 
   data-backdrop="static" 
   data-keyboard="false">
  <div class="modal-dialog" id="modal_dialog" style="z-index:9000">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" ng-hide="request.type=='request'" ng-click="closeModal()"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="myModalLabel">Add User</h5>
      </div>
      <div class="modal-body">
        {!! Form::open(["class"=>"form-horizontal"]) !!}
            <div class="form-group" ng-class="validation.errorclass">
                {!!Form::label("email","Email :",["class"=>"col-lg-offset-1 col-lg-2 control-label"])!!}
                <div class="col-lg-8">
                    {!! Form::email("email",null,["class"=>"form-control","id"=>"user_form_email","placeholder"=>"((validation.placeholder))" ]) !!}
                </div>
            </div>
            <div class="form-group">
            	{!!Form::label("state","Can : ",["class"=>"col-lg-offset-1 col-lg-2 control-label"])!!}
            	<div class="col-lg-8">
            	    {!! Form::select("state",["Admin"=>"Admin","Read"=>"Read","Write"=>"Write"],null,["class"=>"form-control col-lg-4","id"=>"user_role_select"]) !!}
            	</div>
            </div>  
            <div class="form-group">
                <div class="col-lg-offset-8">
                 <button type="button" class="btn btn-primary col-lg-8" ng-disabled="request.type=='request'" ng-click="sendInvite()">
                    Save
                 </button>
                </div>              
            </div>   
       </div>
       <div class="modal-footer" ng-show="request.isActive">
       	<div class="alert alert-dismissible col-lg-offset-2 col-lg-9 text-left" 
       	     ng-class="request.alert" style="font-size: 15px">        
       	      <button type="button" class="close" ng-hide="request.type=='request'" ng-click="clearRequest()">×</button>
       	        <i class="fa fa-w" ng-class="request.icon"></i>
       	      <strong>((request.message))</strong>
       	</div>
       </div>
      </div>      
</div>
<div style="display:none">
	<span id="apiUrl">{!! URL::to("/api") !!}</span>
	<span id="token_app">{!! Session::token() !!}</span>
</div>
</div>

</div>

@endsection

@section("extrastyles")
{!! HTML::style("css/sweetalert.css") !!}
<style type="text/css">
	.btn-circle {
	  width: 30px;
	  height: 30px;
	  text-align: center;
	  padding: 6px 0;
	  font-size: 12px;
	  line-height: 1.428571429;
	  border-radius: 15px;
	}
	.btn-circle.btn-lg {
	  width: 50px;
	  height: 50px;
	  padding: 10px 16px;
	  font-size: 18px;
	  line-height: 1.33;
	  border-radius: 25px;
	}
	.btn-circle.btn-xl {
	  width: 70px;
	  height: 70px;
	  padding: 10px 16px;
	  font-size: 24px;
	  line-height: 1.33;
	  border-radius: 35px;
	}

    .btn-unblock .state-idle{
        display: block;
    }
    .btn-unblock .state-hover{
        display: none;
    }

    .btn-unblock:hover .state-idle{
        display: none;
    }
    .btn-unblock:hover .state-hover{
        display: block;
    }

</style>
@endsection

@section("extrascripts")
{!! HTML::script("js/angular/commonFactory.js") !!}
{!! HTML::script("js/sweetalert.min.js") !!}
{!! HTML::script("js/angular/invite.js") !!}
@endsection