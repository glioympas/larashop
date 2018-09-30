@extends('layouts.app')

@section('title')
	Shopping Cart - Checkout
@endsection

@section('content')


	<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">


				<h1>Checkout</h1>
				<h4>Total: {{ $total }} $</h4>

				<div id="charge-error" class="alert alert-danger {{ Session::has('error') ? '' : 'hidden'  }}">
					{{ Session::get('error') }}
				 </div>
					

				{!! Form::open(['method'=>'POST', 'action'=>'ProductController@postCheckout', 'id'=>'checkout-form']) !!}

				  <div class="form-group">
					{!! Form::label('name','Name:') !!}
					{!! Form::text('name',null,['class'=>'form-control', 'required',]) !!}
				 </div>

				  <div class="form-group">
					{!! Form::label('address','Address:') !!}
					{!! Form::text('address',null,['class'=>'form-control', 'required',]) !!}
				 </div>

				   <div class="form-group">
					{!! Form::label('card-name','Card Holder Name:') !!}
					{!! Form::text('card-name',null,['class'=>'form-control', 'required',]) !!}
				 </div>

				   <div class="form-group">
					{!! Form::label('card-number','Card Number:') !!}
					{!! Form::text('card-number',null,['class'=>'form-control', 'required',]) !!}
				 </div>

				 <div class="form-group">
					{!! Form::label('card-expiry-month','Card Expiration Month:') !!}
					{!! Form::text('card-expiry-month',null,['class'=>'form-control', 'required',]) !!}
				 </div>

				 <div class="form-group">
					{!! Form::label('card-expiry-year','Card Expiration Year:') !!}
					{!! Form::text('card-expiry-year',null,['class'=>'form-control', 'required',]) !!}
				 </div>

				  <div class="form-group">
					{!! Form::label('card-cvc','CVC:') !!}
					{!! Form::text('card-cvc',null,['class'=>'form-control', 'required',]) !!}
				 </div>

				 <div class="form-group">
				 	{!! Form::submit('Checkout' , ['class'=>'btn btn-success']) !!}
				 </div>

				{!! Form::close() !!}

			</div>
	</div>



@endsection


@section('scripts')

<script src="https://js.stripe.com/v2/"></script>

<script src="{{ URL::to('src/js/checkout.js') }}"></script>
@endsection