@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {{--<div class="panel panel-default">--}}
                    {!! Form::open(array('url' => url('home/pages/add'),'class'=>'form-homepage', 'enctype' => 'multipart/form-data')) !!}

                    <div class="form-group col-lg-4">
                        {!! Form::label('name','name'); !!}
                        {!! Form::text('name',null,['class'=>'form-control']); !!}
                    </div>
                    <div class="form-group col-lg-4">
                        {!! Form::label('url','Url'); !!}
                        {!! Form::text('url',null,['class'=>'form-control']); !!}
                    </div>

                    <div class="form-group col-lg-2">
                        {!! Form::label('position','Position'); !!}
                        {!! Form::select('position',$result,null,['class'=>'form-control']); !!}
                    </div>
                    <div class="form-group  col-lg-2">
                        {!! Form::label('status','Status'); !!}
                        {!! Form::select('status',array('1' => 'Publish','0' => 'In the draft'),'0',['class'=>'form-control']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('page_content','Page Content'); !!}
                        {!! Form::textarea('page_content',null,['class'=>'form-control']); !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            {{--</div>--}}

        </div>
    </div>

@endsection
@section('footer')

    <script src="{{URL::asset('js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{URL::asset('js/ckeditor/adapters/jquery.js')}}"></script>
    <script>
        $( document ).ready( function() {
            $( 'textarea#page_content' ).ckeditor();
        } );
    </script>
@endsection
