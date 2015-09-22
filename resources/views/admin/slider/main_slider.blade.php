@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                    @if($result['type'] == 'main')
                    <div>
                        <a href="{{url('home/slider/mainslider_add')}}">Add new Item</a>
                    </div>
                    <div class="panel panel-default">
                    <table class="table table-striped table-bordered Pages_table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Content</th>
                            <th>First Button</th>
                            <th>Secund Button</th>
                            <th>Edit/Delete</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($result['data'] as $val)
                            <tr>
                                <th >{{$val->id}}</th>
                                <th >{{$val->title}}</th>
                                <th >{{$val->description}}</th>
                                <th >
                                    <p>{{$val->content}}</p>
                                </th>
                                <th >{{$val->button1}}</th>
                                <th >{{$val->button2}}</th>

                                <th >
                                    <a class="clients_review" href="{{url('home/slider/mainslider/'.$val->id)}}">Edit</a>
                                    <a class="clients_review" href="{{url('home/slider/mainslider_delete/'.$val->id)}}">Delete</a>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    @elseif($result['type'] == 'why_us')
                        <div>
                            <a href="{{url('home/slider/whyus_add')}}">Add new Item</a>
                        </div>
                            <div class="panel panel-default">

                            <table class="table table-striped table-bordered Pages_table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>First Button</th>
                                <th>Secund Button</th>
                                <th>Edit/Delete</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($result['data'] as $val)
                                <tr>
                                    <th >{{$val->id}}</th>
                                    <th >{{$val->title}}</th>
                                    <th >
                                        <p>{{$val->content}}</p>
                                    </th>
                                    <th >{{$val->button1}}</th>
                                    <th >{{$val->button2}}</th>

                                    <th >
                                        <a class="clients_review" href="{{url('home/slider/whyus/'.$val->id)}}">Edit</a>
                                        <span> / </span>
                                        <a class="clients_review" href="{{url('home/slider/whyus_delete/'.$val->id)}}">Delete</a>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                @endif
            </div>

        </div>
    </div>

@endsection

@section('footer')
    <script>
        $( document ).ready( function() {

            $('.Pages_table').dataTable();
        })
    </script>
@endsection
