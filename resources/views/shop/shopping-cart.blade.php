@extends('layouts.app')

@section('title')
	Shopping Cart
@endsection

@section('content')

 <div id="shopping-cart">

	@if(Session::has('cart'))

		<div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
				<ul class="list-group">
					@foreach($products as $product)

						<li class="list-group-item">
							<span class="badge">{{ $product['qty'] }}</span>
							<img  height=20 src="{{$product['item']['imagePath']}}">
							<strong>{{ $product['item']['title'] }} </strong>
							<span class="label label-success">
								{{ $product['price'] }} $
							</span>
							<div class="btn-group">
								 <button type="button" data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle"> Action <span class="caret"></span></button>
								 <ul class="dropdown-menu">
								 	<li><a href="#">Reduce by 1</a></li>
								 	<li><a href="#">Increase by 1</a></li>
								 </ul>
							</div>
						</li>

					@endforeach
				</ul>
			</div>
		</div>



		<div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
				<p>Summary of {{ $totalQty }} items.</p>
				<strong>Total: {{ $totalPrice }} $</strong>
			</div>
		</div>

		<hr>
		<div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
				<a href="{{ route('checkout') }}" type="button" class="btn btn-success">Checkout</a>
			</div>
		</div>
		<div class="row emptycart">
			<div class="col-sm-6 col-md-3 col-md-offset-3 col-sm-offset-3">
				{!! Form::open(['method'=>'POST', 'action'=> 'ProductController@emptyCart', 'class'=>'emptyCart']) !!}
					{!! Form::submit('Empty Cart', ['class'=>'btn btn-danger']) !!}
				{!! Form::close() !!}
			</div>
		</div>


	@else

		
		<div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
				<h2>No Items in cart!</h2>
			</div>
		</div>

	@endif

</div>

@endsection


@section('scripts')

	<script>
		$(document).ready(function(){

			//Ajax Empty Cart.
			$('.emptyCart').on('submit', function(e){
				e.preventDefault();
				var form = $(this);

				$.ajax({
					type: form.attr('method'),
					 url:  form.attr('action'),
					 data : form.serialize(),
					 success: function(data)
					 {
					 	if(data.empty)
					 	{
					 		$('#shopping-cart').load(location.href + ' #shopping-cart'); //reload main content.
					 		$('#itemsAmmount').load(location.href + ' #itemsAmmount');  //reload header number.
					 	}

					 }
				});

			});

			//End Ajax Empty Cart

		});
	</script>

@endsection