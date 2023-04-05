@extends('layouts.app',['title'=>'Permission Create'])
@section('content')
    <form role="form" action="{{ route('permission.store') }}" method="post" >
        {{ csrf_field() }}
        <div class="col-lg-offset-2 col-lg-7">
            <div class="box-body">

                <div class="form-group">
                    <label for="name">permission name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <label for="name">permission for</label>
                    <select class="form-control" id="name" name="for" >
                        <option selected disabled >Select permission for</option>
                        <option value="patient">Patient</option>
                        <option value="parameter">Parameter</option>
                        <option value="doctor">Doctor</option>
                        <option value="test">Test</option>
                        <option value="patientTest">Patient Test</option>
                        <option value="stock">Stock</option>
                        <option value="branch">Branch</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="box-body">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('permission.index') }}" class="btn btn-success">Go to permission</a>
                </div>

            </div>

        </div>
    </form>
@stop