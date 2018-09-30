@extends('layouts.app')

@section('title')
	Shopping Cart
@endsection

@section('content')

@if(Session::has('success'))
	<div class="row">
		<div id="charge-message">
			{{ Session::get('success') }}
		</div>
	</div>
@endif
 <div id="products">
	@foreach($products->chunk(3) as $productChunk)
		<div class="row">
			@foreach($productChunk as $product)
				<div class="col-sm-6 col-md-4">
		    <div class="thumbnail">
		      <img src="{{ $product->imagePath }}" alt='' class="img-responsive" >
		      <div class="caption">
		        <h3>{{ $product-> title }}</h3>
		        <p class="description">
		        	{{ $product->description }}
		        </p>
		        <div class="clearfix">
		        	<div class="pull-left price">${{$product->price}}</div>
		         	{{-- <a href="{{ route('products.addToCart', $product->id) }}" class="btn btn-success pull-right" role="button">Add to cart</a> --}}

		         	{!! Form::open(['method'=>'POST', 'action'=> ['ProductController@addToCart', $product->id], 'class'=>'addCart' ]) !!}

		         		{!! Form::submit('Add to cart', ['class'=> 'btn btn-success pull-right']) !!}

		         	{!! Form::close() !!}

		     	</div>
		      </div>
		    </div>
		  </div>

			@endforeach
		</div>
	@endforeach
</div>
	

@endsection

@section('scripts')
	
	<script>
		
		
		$(document).ready(function(){

			// //Ajax add to card.
			$(document).on('submit','.addCart', function(e){
				e.preventDefault();
						var form = $(this);
						$.ajax({
							type: form.attr('method'),
							url: form.attr('action'),
							data: form.serialize(),
							success: function(data)
							{
								if(data.added)
								{
									$('#products').load(location.href + ' #products'); //reload main content.
									$('#itemsAmmount').load(location.href + ' #itemsAmmount');  //reload header number.
								}
							}
						});
			});


		});

		

	</script>

@endsection