@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    {{--{!! Form::open(array('url' => 'home/edit/home_page','class'=>'form-homepage')) !!}--}}

                    {{--<div class="form-group">--}}
                        {{--{!! Form::label('phone_number','Phone Number'); !!}--}}
                        {{--{!! Form::text('phone_number',$result['phone_number'],['class'=>'form-control']); !!}--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--{!! Form::label('site_name','Site Name'); !!}--}}
                        {{--{!! Form::text('site_name',$result['site_name'],['class'=>'form-control']); !!}--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--{!! Form::label('site_desc','Site description'); !!}--}}
                        {{--{!! Form::text('site_desc',$result['site_desc'],['class'=>'form-control']); !!}--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--{!! Form::label('banner_content','Top Banner Content'); !!}--}}
                        {{--{!! Form::textarea('banner_content',$result['banner_content'],['class'=>'form-control']); !!}--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--{!! Form::label('credit_status_portal_content','Credit Status Portal Content'); !!}--}}
                        {{--{!! Form::textarea('credit_status_portal_content',$result['credit_status_portal_content'],['class'=>'form-control']); !!}--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--{!! Form::Submit('Edit HomePage',['class'=>'form-control btn btn-success'] ) !!}--}}
                    {{--</div>--}}
                    {{--{!! Form::close() !!}--}}
                </div>
            </div>

        </div>
    </div>

@endsection
