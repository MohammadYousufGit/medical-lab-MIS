@extends('layouts.app',['title'=>'test Create'])
@section('content')

@if(count($department)>0)
<div class="container">
	<div class="panel panel-primary" style="border: none;padding:0px;box-shadow: -2px 2px 6px 2px rgba(0,100,0,0.3)">
		
		<div class="panel-heading">
			Create New Test
		</div>

		<form action="{{ route('test.store') }}" method="post">
			<div class="panel-body">
				{{ csrf_field() }}
	         <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	             <label for="name" class="control-label">test Name</label>

                 <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required="required">

                 @if ($errors->has('name'))
                     <span class="help-block">
                         <strong>{{ $errors->first('name') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-6 form-group{{ $errors->has('fee') ? ' has-error' : '' }}">
	             <label for="fee" class="control-label">Fee</label>

                 <input id="fee" type="text" class="form-control" name="fee" value="{{ old('fee') }}" required="required">

                 @if ($errors->has('fee'))
                     <span class="help-block">
                         <strong>{{ $errors->first('fee') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-6 form-group{{ $errors->has('code') ? ' has-error' : '' }}">
	             <label for="code" class="control-label">Code</label>

                 <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" required="required">

                 @if ($errors->has('code'))
                     <span class="help-block">
                         <strong>{{ $errors->first('code') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-6 form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
	             <label for="comment" class="control-label">test comment</label>

                 <input id="comment" type="text" class="form-control" name="comment" value="{{ old('comment') }}">

                 @if ($errors->has('comment'))
                     <span class="help-block">
                         <strong>{{ $errors->first('comment') }}</strong>
                     </span>
                 @endif
	         </div>
	         <div class="col-md-6 form-group{{ $errors->has('department') ? ' has-error' : '' }}">
	             <label for="department" class="control-label">Department</label>
	             <select name="department" required="required" class="form-control">
	             	<option>select department</option>
	             	@foreach($department as $row)
	             	<option value="{{$row->id}}">{{$row->name}}</option>
	             	@endforeach
	             </select>
                 @if ($errors->has('department'))
                     <span class="help-block">
                         <strong>{{ $errors->first('department') }}</strong>
                     </span>
                 @endif
	         </div>
			</div>
			<div class="panel-footer">
				
				<div class="form-group">
					<a href="/test" class="btn btn-default">Cancel</a>
	            <input type="submit" class="btn btn-primary" value="Save">
	         </div>

			</div>
		</form>

	</div>
</div>
@else
	<div class="conainter">
		<h4 class="alert alert-warning">Please Register Department First</h4>
	</div>
@endif
@stop