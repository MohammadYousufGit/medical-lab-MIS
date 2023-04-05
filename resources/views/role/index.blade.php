@extends('layouts.app',['title'=>'Role List'])

@section('content')

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <a href="{{ route('role.create') }}" class="btn btn-xs btn-default">Create New Role</a> | Role List
                <div class="pull-right">
                    Total: <div class="badge">{{count($data)}}</div>
                </div>
            </div>

            <div class="table-responsive">

                <table class="table table-condensed table-hover table-striped">
                    <thead>
                    <tr>
                        {{-- <th>Branch ID</th>--}}
                        <th>Role Name</th>
                        <th>Manipulation</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- List of all Branches-->
                    @foreach($data as $row)
                        <tr>
                            <td>{{$row->name}}</td>
                            <td>
                                <form action="{{ route('role.destroy',$row->id) }}" method="post">
                                    {{csrf_field()}}
                                    {{method_field('delete')}}
                                    <div class="btn-group btn-group-xs" role="group">
                                        <a class="btn btn-primary " href="{{ route('role.edit',$row->id) }}"><span class="glyphicon glyphicon-trash"></span>edit</a>
                                        <input type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger delete-btn" value="delete" />
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach()
                    </tbody>
                </table>
            </div>
            {{--<div class="panel-footer">--}}
                {{--{!!$data->links();!!}--}}
            {{--</div>--}}
        </div>
    </div>
@stop