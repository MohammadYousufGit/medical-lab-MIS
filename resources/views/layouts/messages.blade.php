@if(count($errors) > 0)

	<div class="container">

			<div class="alert alert-danger">

				<ul>

					@foreach($errors->all() as $error)

					 <li>{{$error}}</li>

					@endforeach

				</ul>

			</div>

	</div>

@endif
@if(Session::has('exception'))
        <h1 class="alert alert-danger">{{Session::get('exception')}}</h1>
@endif
@if(Session::has('success'))
        <h4 class="alert alert-success">{{Session::get('success')}}</h4>
@endif

@if(Session::has('info'))
        <h4 class="alert alert-info">{{Session::get('info')}}</h4>
@endif
@if(Session::has('warning'))
        <h4 class="alert alert-warning">{{Session::get('warning')}}</h4>
@endif
