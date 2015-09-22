@extends('app')

@section('content')
    <div class="container" ng-app="HeaderModule" ng-controller="HeaderController">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    {!! Form::open(array('class'=>'form-homepage')) !!}                
                    <div class="form-group">
                    {!! Form::label('signup_button',' Signup Button'); !!}
                    {!! Form::text('signup_button',$data['signup_button'],['class'=>'form-control']); !!}
                    </div>
                      <div class="form-group">

                          <div class="btn btn-default btn-file col-md-3">
                                  <i class="fa fa-picture-o"></i> Main Logo
                                  {!! Form::file('main_logo',null); !!}      
                          </div>
                     <div class="progress col-md-5 col-md-offset-1" ng-hide="(percent==100||percent==0)" style="margin-top:7px">
                      <div class="progress-bar progress-bar-aqua" role="progressbar" style="width: (( percent ))%;margin-left:-15px">
                        <span class="sr-only">(( percent ))% Complete</span>
                      </div>
                    </div>
                       <div class='col-md-3 ' ng-hide="percent==0" style="margin-top:7px" >
                           <span style="  font-size: 14px;font-weight: 700;">(( percent ))% uploaded</span>
                       </div>
                      </div>
                    <div class="form-group">
                    {!! Form::Submit('Submit Header',['class'=>'form-control btn btn-success','style'=>'margin-top:10px','id'=>'submit','ng-click'=>'sendRequest()'] ) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
        <div ng-show="request.isActive" class="col-md-10  col-md-offset-1 alert alert-dismissable" ng-class="request.alert">
           <button type="button" class="close" ng-click="clearRequest()" ng-hide="request.type=='request'">&times;</button>
           <h4><i class="icon fa" ng-class="request.icon"></i>(( request.message ))</h4>
        </div>
    </div>

@endsection

@section("extrascripts")
{!! HTML::script("js/angular/header.js") !!}
@endsection