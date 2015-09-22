@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $val)
                             <tr>
                                 <th >{{$val->id}}</th>
                                 <th ><a href="{{url('home/slider/'.$val->id)}}">{{$val->name}}</a></th>
                            </tr>
                       @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

@endsection
