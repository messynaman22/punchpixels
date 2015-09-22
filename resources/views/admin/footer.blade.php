@extends('app')

@section('content')
    <div class="container" ng-app="FooterModule" ng-controller="FooterController">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    {!! Form::open(array('class'=>'form-homepage')) !!}


                      <div class="form-group">

                          <div class="btn btn-default btn-file col-md-3">
                                  <i class="fa fa-picture-o"></i> Footer Main Image
                                  {!! Form::file('footer_main_image',null); !!}      
                          </div>
                     <div class="progress col-md-5 col-md-offset-1" ng-hide="(percent_image==100||percent_image==0)" style="margin-top:7px">
                      <div class="progress-bar progress-bar-aqua" role="progressbar" style="width: (( percent_image ))%;margin-left:-15px">
                        <span class="sr-only">(( percent_image ))% Complete</span>
                      </div>
                    </div>
                       <div class='col-md-3 ' ng-hide="percent_image==0" style="margin-top:7px" >
                           <span style="  font-size: 14px;font-weight: 700;">(( percent_image ))% uploaded</span>
                       </div>
                      </div>              
                        <br><br>
                        <div class="form-group">

                            <div class="btn btn-default btn-file col-md-3">
                                    <i class="fa fa-picture-o"></i> Footer Main Logo
                                    {!! Form::file('footer_main_logo',null); !!}      
                            </div>
                       <div class="progress col-md-5 col-md-offset-1" ng-hide="(percent_logo==100||percent_logo==0)" style="margin-top:7px">
                        <div class="progress-bar progress-bar-aqua" role="progressbar" style="width: (( percent_logo ))%;margin-left:-15px">
                          <span class="sr-only">(( percent_logo ))% Complete</span>
                        </div>
                      </div>
                         <div class='col-md-3 ' ng-hide="percent_logo==0" style="margin-top:7px" >
                             <span style="  font-size: 14px;font-weight: 700;">(( percent_logo ))% uploaded</span>
                         </div>
                        </div>
                        <br><br>
                    <div class="form-group">
                        {!! Form::label('content_top','Content Top'); !!}
                        {!! Form::textarea('content_top',$data['content_top'],['class'=>'form-control ta']); !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('content_bottom','Content Bottom'); !!}
                        {!! Form::textarea('content_bottom',$data['content_bottom'],['class'=>'form-control ta']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('content_bottom_button_lable','Bottom\'s button label'); !!}
                        {!! Form::text('content_bottom_button_lable',$data['content_bottom_button_lable'],['class'=>'form-control']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('content_bottom_button_content','Bottom\'s button content'); !!}
                        {!! Form::text('content_bottom_button_content',$data['content_bottom_button_content'],['class'=>'form-control']); !!}
                    </div>
                  
                  <div class="form-group">
                      {!! Form::button('Submit',['class'=>'form-control btn btn-success','style'=>'margin-top:10px','id'=>'submit','ng-click'=>'sendRequest()'] ) !!}
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
    </div>

@endsection


@section("extrastyles")
<link href="{{ asset('/') }}plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .textarea{
         width: 100%; 
         height: 125px;
         font-size: 14px;
         line-height: 18px;
         border: 1px solid #dddddd;
         padding: 10px;
    }
</style>
@stop

@section("extrascripts")
<script src="{{ asset('/') }}plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
{!! HTML::script("js/angular/footer.js") !!}
@stop