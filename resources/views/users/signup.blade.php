@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h1>Sign Up</h1>

			@include('partials.form_errors')

			{!! Form::open(['method'=>'POST', 'action'=> 'UsersController@postSignup']) !!}

				<div class="form-group">
					{!! Form::label('email','Email:') !!}
					{!! Form::email('email', null, ['class'=>'form-control']) !!}
				</div>
				
				<div class="form-group">
					{!! Form::label('password','Password:') !!}
					{!! Form::password('password',  ['class'=>'form-control']) !!}
				</div>

				{!! Form::submit('Sign Up', ['class'=>'btn btn-primary']) !!}

			{!! Form::close() !!}

		</div>
	</div>
@endsection