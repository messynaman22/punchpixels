@extends('app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div>
                    <a class="btn btn-primary" href="{{url('home/pages/add')}}">Add new Page</a>
                </div>
                <div class="panel panel-default">
                        <table class="table table-striped table-bordered Pages_table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Url</th>
                                <th>Status</th>
                                <th>Position</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Edit/Delete</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($result['data'] as $val)
                                <tr>
                                    <th >{{$val->id}}</th>
                                    <th >{{$val->name}}</th>
                                    <th >{{$val->url}}</th>
                                    <th >
                                        {{($val->status) ? 'Published' : 'In the draft'}}
                                    </th>
                                    <th >{{$val->position}}</th>
                                    <th >{{$val->created_at}}</th>
                                    <th >{{$val->updated_at}}</th>

                                    <th >
                                        <a class="clients_review" href="{{url('home/pages/edit/'.$val->id)}}">Edit</a>
                                        <span> / </span>
                                        <a class="clients_review" href="{{url('home/pages/delete/'.$val->id)}}">Delete</a>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
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
