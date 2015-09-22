@extends('app')

@section('content')
    <div class="container" ng-app="SatisfactionModule" ng-controller="SatisfactionController">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                <table  class="table table-striped table-bordered Pages_table ">
                    <thead>
                        <td><b>Id</b></td>
                        <td><b>Name</b></td>
                        <td><b>Content</b></td>
                        <td><b>Edit</b></td>                        
                    </thead>
                    <tbody>
                        <tr ng-repeat="dat in data">
                            <td>((dat.id))</td>    
                            <td >(( dat.display_name ))</td>
                            <td>((dat.content))</td>                                                    
                            <td><button type="button" class="btn btn-info rounded-buttons" data-toggle="modal" data-target="#editWhy" ng-click="edit(dat)" ><i class="fa fa-pencil"></i></button></td>                            
                        </tr>
                    </tbody>
                </table>            
                </div>
            </div>

        </div>
        <div class="modal fade" id="editWhy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" id="modal_dialog" style="z-index:9000">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" onclick="closeModal()"><span aria-hidden="true" style="font-size: 40px">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">Edit Content</h3>
              </div>
              <div class="modal-body">
                {!! Form::open(["class"=>"form-horizontal"]) !!}
                    <div class="form-group">
                        {!!Form::label("name","Name",["class"=>"col-lg-3 control-label"])!!}
                        <div class="col-lg-8">
                            {!! Form::text("name",null,["class"=>"form-control","placeholder"=>"","ng-model"=>"selectedData.display_name"]) !!}
                        </div>
                    </div>    
                    <div class="form-group">
                        {!!Form::label("content","Content",["class"=>"col-lg-offset-1 col-lg-2 control-label"])!!}
                        <div class="col-lg-8">
                            {!! Form::textarea("content",null,["class"=>"form-control","rows"=>"5","style"=>"resize:none",
                            "placeholder"=>"Content","ng-model"=>"selectedData.content"]) !!}
                        </div>
                    </div>
                                   
                    <div class="form-group">
                        <div class="col-lg-offset-8">
                         <button type="button" class="btn btn-primary col-lg-9" ng-click="editContent()">
                            Edit content
                         </button>
                        </div>
                    </div>   
                {!! Form::close() !!}   
              </div>
              <div class="modal-footer" ng-show="request.isActive">
                    <div class="alert alert-dismissible col-lg-offset-2 col-lg-9 text-left" 
                         ng-class="request.alert" style="font-size: 15px">        
                          <button type="button" class="close" ng-click="clearRequest()">×</button>
                            <i class="fa fa-w" ng-class="request.icon"></i>
                          <strong>((request.message))</strong>
                    </div>
              </div>
            </div>
          </div>
        </div>
       
    </div>

@endsection

@section("extrascripts")
{!! HTML::script("js/sweetalert.min.js") !!}
{!! HTML::script("js/angular/satisfaction.js") !!}
@endsection

@section("extrastyles")
{!! HTML::style("css/sweetalert.css") !!}
@endsection