@extends('app')

@section('content')
    <div class="container" ng-app="FooterModule" ng-controller="FooterController">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div>
                    <a class="btn btn-primary" data-toggle="modal" data-target="#editWhy" ng-click="editWhy(null)">Add new Item</a>
                </div><br>
                <div class="panel panel-default">
                        <table  class="table table-striped table-bordered Pages_table">
                            <thead>
                                <td><b>Id</b></td>
                                <td><b>Image</b></td>
                                <td><b>Alt</b></td>
                                <td><b>Edit</b></td>
                                <td><b>Delete</b></td>
                            </thead>
                            <tbody>
                                <tr ng-repeat="dat in newData">
                                    <td>((dat.id))</td>    
                                    <td class="clients_review_admin_item"><img src="((imagePath+'/'+dat.image))" alt="" style="height:100px;width:150px" /></td>
                                    <td>((dat.alt))</td>                                                    
                                    <td><button type="button" class="btn btn-info rounded-buttons" data-toggle="modal" data-target="#editWhy" ng-click="editWhy(dat)" ><i class="fa fa-pencil"></i></button></td>
                                    <td>
                                <button class="btn btn-danger rounded-buttons" type="button"   ng-click="deleteFooter(dat.id,dat.alt)" ><i class="fa fa-close"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
        <div style="display:none">
            <span id="imagePath">{{ URL::asset('images/') }}</span>
            <span id="token">{!! $token !!}</span>
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
                        {!!Form::label("friend_logo_alt","Friend Logo Alt",["class"=>"col-lg-offset-1 col-lg-3 control-label"])!!}
                        <div class="col-lg-8">
                            {!! Form::text("title",null,["class"=>"form-control","placeholder"=>"","ng-model"=>"selectedData.alt","placeholder"=>"((validation.placeholder))"]) !!}
                        </div>
                    </div>    
                      <div class="form-group">
                          <div class="btn btn-default btn-file col-md-10 " style="margin-left:86px" >
                                  <i class="fa fa-picture-o"></i> Footer Image
                                  {!! Form::file('image',null); !!}      
                          </div>
               
                       <div class='col-md-10 text-center' ng-hide="percent=='0'"  style="margin-top:7px;margin-left:86px" >
                           <span style="  font-size: 14px;font-weight: 700;">(( percent ))% uploaded</span>
                       </div>
                      </div>                                  

                    <div class="form-group">
                        <div class="col-lg-offset-7">
                         <button type="button" class="btn btn-primary col-lg-9" ng-click="editFooter()">
                            ((title))
                         </button>
                        </div>
                    </div>   
                {!! Form::close() !!}   
              </div>
              <div class="modal-footer" ng-show="request.isActive">
                    <div class="alert alert-dismissible col-lg-offset-2 col-lg-9 text-left" 
                         ng-class="request.alert" style="font-size: 15px">        
                          <button type="button" class="close" ng-hide="request.type == 'request' "ng-click="clearRequest()">×</button>
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
{!! HTML::script("js/angular/footerFriend.js") !!}
@endsection

@section("extrastyles")
{!! HTML::style("css/sweetalert.css") !!}
@endsection