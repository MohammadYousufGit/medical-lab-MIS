@extends('layouts.app',['title'=>'Permission List'])

@section('content')

    <a href="{{ route('permission.create') }}" class="btn btn-primary">Create New permission</a>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">permissions Data</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>permission Name</th>
                    <th>permission for</th>

                    <th>Manipulate</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                <tr>
                    <td>{{ $loop->index + 1}}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->for }}</td>



                    <td>
                        <form action="{{route('permission.destroy', $permission->id) }}" method="post">
                            {{csrf_field()}}
                            {{method_field('delete')}}
                            <div class="btn-group btn-group-xs" role="group">
                                <a class="btn btn-primary" href="{{ route('permission.edit' ,$permission->id) }}"><span class="glyphicon glyphicon-edit"></span> edit</a>
                                <input type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger delete-btn" value=" delete" />
                            </div>
                        </form>
                    </td>
                </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <!-- /.box-body -->
    </div>
    @stop
