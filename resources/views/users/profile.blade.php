@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h1>User's Profile</h1>
			<hr>

			<h2>Your orders</h2>

			@if(count($orders) > 0)

				{{-- You can put whatever you want here :) , it's not the purpose of the project. --}}
				<p>You have done orders.</p>

			@else

				<p>You don't have any orders.</p>

			@endif


		</div>
	</div>
@endsection