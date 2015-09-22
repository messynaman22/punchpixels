@extends('app')

@section('content')
    <div class="container" ng-app="WhyModule" ng-controller="WhyController">
        <div class="row">
            <div class="col-md-10">
                <div>
                    <a class="btn btn-primary" data-toggle="modal" data-target="#editWhy" ng-click="editWhy(null)">Add new Page</a>
                </div><br>
                <div class="panel panel-default">
                        <table ng-table="tableParams" class="table table-striped table-bordered Pages_table">
                            <tbody>
                                <tr ng-repeat="dat in $data">
                                    <td data-title="'Title'"  sortable="'title'">((dat.title))</td>    
                                    <td data-title="'Content'" sortable="'content'">((dat.content))</td>
                                    @if($type=="main")
                                        <td data-title="'Description'" sortable="'content'">((dat.description))</td>
                                    @endif                     
                                    <td data-title="'First Button'" sortable="'button1'">((dat.button1))</td>
                                    <td data-title="'Second Button'" sortable="'button2'">((dat.button2))</td>   
                                    <td data-title="'Edit'">            
                                        <button class="btn btn-info rounded-buttons" data-toggle="modal" data-target="#editWhy" ng-click="editWhy(dat)" ><i class="fa fa-pencil"></i></button>                                                          
                                    <td data-title="'Delete '">                                     
                                    <button class="btn btn-danger rounded-buttons" ng-click="deletePage(dat.id,dat.title)"  ><i class="fa fa-close"></i></button></td>
                                    </td>

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
                <h3 class="modal-title" id="myModalLabel">((title))</h3>
              </div>
              <div class="modal-body">
                {!! Form::open(["class"=>"form-horizontal"]) !!}
                    <div class="form-group" ng-class="validation.errorclass">
                        {!!Form::label("title","Title",["class"=>"col-lg-offset-1 col-lg-2 control-label"])!!}
                        <div class="col-lg-8">
                            {!! Form::text("title",null,["class"=>"form-control","placeholder"=>"","ng-model"=>"selectedData.title","placeholder"=>"((validation.placeholder))"]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label("content","Content",["class"=>"col-lg-offset-1 col-lg-2 control-label"])!!}
                        <div class="col-lg-8">
                            {!! Form::textarea("content",null,["class"=>"form-control","rows"=>"3","style"=>"resize:none",
                            "placeholder"=>"Content","ng-model"=>"selectedData.content"]) !!}
                        </div>
                    </div>
                    @if($type=="main")
                    <div class="form-group">
                        {!!Form::label("description","Description",["class"=>"col-lg-offset-1 col-lg-2 control-label"])!!}
                        <div class="col-lg-8">
                            {!! Form::textarea("description",null,["class"=>"form-control","rows"=>"3","style"=>"resize:none",
                            "placeholder"=>"Description","ng-model"=>"selectedData.description"]) !!}
                        </div>
                    </div>
                    @endif
                    <div class="form-group" ng-class="validation.errorclass">
                        {!!Form::label("button1","First Button",["class"=>"col-lg-offset-1 col-lg-2 control-label"])!!}
                        <div class="col-lg-8">
                            {!! Form::text("button1",null,["class"=>"form-control","placeholder"=>"","ng-model"=>"selectedData.button1"]) !!}
                        </div>
                    </div>
                    <div class="form-group" >
                        {!!Form::label("button2","Second Button",["class"=>"col-lg-offset-1 col-lg-2 control-label"])!!}
                        <div class="col-lg-8">
                            {!! Form::text("button2",null,["class"=>"form-control","placeholder"=>"","ng-model"=>"selectedData.button2"]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-8">
                         <button type="button" class="btn btn-primary col-lg-8" ng-click="editPage()">
                            ((title))
                         </button>
                        </div>
                    </div>   
                {!! Form::close() !!}   
              </div>
              <div class="modal-footer" ng-show="request.isPresent">
                    <div class="alert alert-dismissible col-lg-offset-2 col-lg-9 text-left" 
                         ng-class="request.alert" style="font-size: 15px">        
                          <button type="button" class="close" ng-click="clearRequest()">×</button>
                            <i class="fa fa-w" ng-class="request.icon"></i>
                          <strong>((request.strong))</strong> ((request.message)) 
                    </div>
              </div>
        
            </div>
          </div>
        </div>

        <div style="display:none"> 
            <span id="token">{{$token}}</span>
            <span id="apiUrl">{{url('api')}}</span>
            <span id="editUrl">{{url('home/pages/edit/')}}</span>
            <span id="type">{!! $type !!}</span>
        </div>
        

    </div>
   
@endsection
@section('extrascripts')
    <script type="text/javascript" src="{{asset('/js/angular.js')}}"></script>
    <script src="{{ asset('/js/angular/ng-table.min.js') }}"></script>
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('/js/angular/whyus.js')}}"></script>

@endsection

@section("extrastyles")
{!! HTML::style("css/ngtable.css") !!}
{!! HTML::style("css/sweetalert.css") !!}
<style type="text/css">
    .ng-table-counts {
      margin-top: 5px;
      margin-right: 15px !important;
    }
</style>
@endsection