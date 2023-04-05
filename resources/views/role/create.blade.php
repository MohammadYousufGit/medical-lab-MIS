@extends('layouts.app',['title'=>'Create Role'])

@section('content')
    <form role="form" action="{{ route('role.store') }}" method="post" >
        {{ csrf_field() }}
        <div class="col-lg-offset-2 col-lg-7">
            <div class="box-body">

                <div class="form-group">
                    <label for="name">Role Title</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter title">
                </div>
                <div class="row">

                <div class="col-lg-3">
                    <label for="name">Doctor Permission</label>
                    @foreach($permissions as $permission)
                        @if($permission->for == 'doctor')
                            <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>

                        @endif
                        @endforeach
                </div>
                <div class="col-lg-3">
                    <label for="name">Stock Permission</label>
                    @foreach($permissions as $permission)
                        @if($permission->for == 'stock')
                            <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>

                        @endif
                        @endforeach
                </div>
                <div class="col-lg-3">
                    <label for="name">Branch Permission</label>
                    @foreach($permissions as $permission)
                        @if($permission->for == 'branch')
                            <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>

                        @endif
                        @endforeach
                </div>
                <div class="col-lg-3">
                    <label for="name">Test Permission</label>
                    @foreach($permissions as $permission)
                        @if($permission->for == 'test')
                            <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>

                        @endif
                        @endforeach
                </div>
                <div class="col-lg-3">
                    <label for="name">Patient Permission</label>
                    @foreach($permissions as $permission)
                        @if($permission->for == 'patient')
                            <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>

                        @endif
                        @endforeach
                </div>
                <div class="col-lg-3">
                    <label for="name">Other Permission</label>
                    @foreach($permissions as $permission)
                        @if($permission->for == 'other')
                            <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>

                        @endif
                        @endforeach
                </div>
                </div>
                <div class="box-body">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('role.index') }}" class="btn btn-success">Go to Tags</a>
                </div>

            </div>

        </div>
    </form>
@stop