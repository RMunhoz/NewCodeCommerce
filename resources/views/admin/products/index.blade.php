@extends('layouts.templateAdmin')

@section('title')
	Products
@stop
@section('content')

	@include('alerts.error')
	@include('alerts.success')

	<div class="container">
		<h1>Products</h1>

		@if($errors->any())
			
			<ul class="alert-danger">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>

		@endif

		<a href="{{ route('products.create') }}" class="btn btn-default">New Product</a>
		<br>
		<br>
		<table class="table">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Description</th>
				<th>Price</th>
				<th>Category</th>
				<th>Action</th>
			</tr>
			
			@foreach($products as $product)
				<tr>
					<td>{{$product->id}}</td>
					<td>{{$product->name}}</td>
					<td>{{$product->description}}</td>
					<td>{{$product->price}}</td>
					<td>{{$product->category->name}}</td>
					<td>
						<a href="{{ route('products.edit',['id' => $product->id]) }}" 
									class="btn btn-info">Edit</a>
						<a href="{{ route('products.images',['id' => $product->id]) }}" 
									class="btn btn-warning">Images</a>
						<a href="{{ route('products.destroy',['id' => $product->id]) }}" 
									class="btn btn-danger">Delete</a>
					</td>
				</tr>	
			@endforeach				
		</table>

		{!! $products->render() !!}

	</div>		
@stop