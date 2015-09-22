@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    {!! Form::open(array('url' => 'home/homepage','class'=>'form-homepage','enctype' => 'multipart/form-data')) !!}

                    <div class="form-group">
                        {!! Form::label('main_phone_number','Phone Number'); !!}
                        {!! Form::text('main_phone_number',$result['main_phone_number'],['class'=>'form-control']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('site_name','Site Name'); !!}
                        {!! Form::text('site_name',$result['site_name'],['class'=>'form-control']); !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('credit_report_repair_questions','Credit Report Repair Questions'); !!}
                        {!! Form::text('credit_report_repair_questions',$result['credit_report_repair_questions'],['class'=>'form-control']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('main_banner','Main Banner'); !!}
                        {!! Form::file('main_banner',null,['class'=>'form-control']); !!}
                    </div>

                    <div class="form-group">
                        {!! Form::Submit('Submit',['class'=>'form-control btn btn-success'] ) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>

@endsection
