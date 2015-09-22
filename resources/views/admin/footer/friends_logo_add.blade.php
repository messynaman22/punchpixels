@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    {!! Form::open(array('url' => url('home/footer/friends-logo/add'),'class'=>'form-homepage', 'enctype' => 'multipart/form-data')) !!}

                    <div class="form-group" style="width: 50%;float: left;">
                        {!! Form::label('friend_logo','Image'); !!}
                        {!! Form::file('friend_logo',null,['class'=>'form-control']); !!}
                    </div>
                    <div class="form-group" style="width: 50%;float: right;">
                        {!! Form::label('friend_logo_alt','Image Alt'); !!}
                        {!! Form::text('friend_logo_alt',null,['class'=>'form-control']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::Submit('Add',['class'=>'form-control btn btn-success'] ) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>

@endsection
