@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h1>Sign In</h1>

			@include('partials.form_errors')

			@if(Session::has('wrong_credentials')) 
				<div class="alert alert-danger">
					<p>{{ session('wrong_credentials') }}</p>
				</div>
			@endif

			{!! Form::open(['method'=>'POST', 'action'=> 'UsersController@postSignin']) !!}

				<div class="form-group">
					{!! Form::label('email','Email:') !!}
					{!! Form::email('email', null, ['class'=>'form-control']) !!}
				</div>
				
				<div class="form-group">
					{!! Form::label('password','Password:') !!}
					{!! Form::password('password',  ['class'=>'form-control']) !!}
				</div>

				{!! Form::submit('Sign In', ['class'=>'btn btn-primary']) !!}

			{!! Form::close() !!}

		</div>
	</div>
@endsection