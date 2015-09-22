@extends('app')

@section('content')
    <div class="container" ng-app="TestModule" ng-controller="TestController">
        <div class="row">
            <div class="col-md-10">
                <div>
                    <a class="btn btn-primary" href="{{url('admin/pages/add')}}">Add new Page</a>
                </div><br>
                <div class="panel panel-default">
                        <table ng-table="tableParams" class="table table-striped table-bordered Pages_table">
                            <tbody>
                                <tr ng-repeat="dat in $data">
                                    <td data-title="'Name'"  sortable="'name'">((dat.name))</td>    
                                    <td data-title="'Url'" sortable="'url'">((dat.url))</td>
                                    <td data-title="'Status'" sortable="'status'">((dat.status))</td>
                                    <td data-title="'Position'" sortable="'position'">((dat.position))</td>
                                    <td data-title="'CreatedAt'" sortable="'created_at'">((dat.created_at))</td>
                                    <td data-title="'UpdatedAt'" sortable="'updated_at'">((dat.updated_at))</td>    
                                    <td data-title="'Edit/Delete '"><a href="(( (editUrl +'/'+ dat.id) ))" class="btn btn-info rounded-buttons"><i class="fa fa-pencil"></i></a>
                                    <button class="btn btn-danger rounded-buttons" ng-click="deletePage(dat.id,dat.name)"><i class="fa fa-close"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>

        </div>
        <div>
        <div>
        <div style="display:none"> 
            <span id="token">{{$data}}</span>
            <span id="apiUrl">{{url('api')}}</span>
            <span id="editUrl">{{url('home/pages/edit/')}}</span>
        </div>
        

    </div>
   
@endsection
@section('extrascripts')
    <script src='{{ asset("/js/angular.js") }}'></script>
    <script src="{{ asset('/js/angular/ng-table.min.js') }}"></script>
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/angular/alternate.js') }}"></script>
@endsection

@section("extrastyles")
<link href="{{ asset('/') }}css/sweetalert.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/ngtable.css">
@endsection
