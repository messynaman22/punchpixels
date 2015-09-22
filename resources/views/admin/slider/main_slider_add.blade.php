@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <p style="text-align: center">{{$result['name']}}</p>
                <div class="panel panel-default">
                    {!! Form::open(array('url' => url('home/slider/'.$result['form']),'class'=>'form-homepage', 'enctype' => 'multipart/form-data')) !!}

                    <div class="form-group">
                        {!! Form::label('slider_title','Title'); !!}
                        {!! Form::text('slider_title',null,['class'=>'form-control']); !!}
                    </div>
                    @if($result['type'] == 'main')
                        <div class="form-group">
                            {!! Form::label('slider_description','Description'); !!}
                            {!! Form::text('slider_description',null,['class'=>'form-control']); !!}
                        </div>
                    @endif
                    <div class="form-group">
                        {!! Form::label('slider_content','Content'); !!}
                        {!! Form::textarea('slider_content',null,['class'=>'form-control']); !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('first_button','First Button'); !!}
                        {!! Form::text('first_button',null,['class'=>'form-control']); !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('second_button','Second  Button'); !!}
                        {!! Form::text('second_button',null,['class'=>'form-control']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::Submit('Add new Slider Item',['class'=>'form-control btn btn-success'] ) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>

@endsection
