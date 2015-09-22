@extends('app')

@section('content')
    <div class="container" ng-app="TrustModule" ng-controller="TrustController">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div topSlider class="panel panel-default">
                    {!! Form::open(array('url' => 'home/you-trust','class'=>'form-homepage', 'enctype' => 'multipart/form-data')) !!}

                    <div class="form-group">
                        {!! Form::label('you_trust_left','Content Left Top'); !!}
                        {!! Form::textarea('you_trust_left',$result['you_trust_left'],['class'=>'form-control ta']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('you_trust_right','Content Right Top'); !!}
                        {!! Form::textarea('you_trust_right',$result['you_trust_right'],['class'=>'form-control ta']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('you_trust_iframe','Iframe For Video'); !!}
                        {!! Form::textarea('you_trust_iframe',$result['you_trust_iframe'],['class'=>'form-control']); !!}
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

@section("extrascripts")
<script src="{{ asset('/') }}plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
{!! HTML::script("js/angular/trust.js") !!}
@endsection

@section("extrastyles")
{!! HTML::style("plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") !!}
@endsection