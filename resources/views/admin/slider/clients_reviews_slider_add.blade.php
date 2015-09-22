@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    {!! Form::open(array('url' => url('home/slider/clientsreviews_add'),'class'=>'form-homepage', 'enctype' => 'multipart/form-data')) !!}

                    <div class="form-group">
                        {!! Form::label('slider_image','Image'); !!}
                        {!! Form::file('slider_image',null,['class'=>'form-control']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('slider_content','Content'); !!}
                        {!! Form::textarea('slider_content',null,['class'=>'form-control']); !!}
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
