@extends('layouts.templateAdmin')

@section('title')
	Images
@stop
@section('content')

	@include('alerts.error')
	@include('alerts.success')
	
	<div class="container">
		<h1>Images of {{ $product->name }}</h1>

		@if($errors->any())
			
			<ul class="alert-danger">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>

		@endif

		<a href="{{ route('products.images.create', ['id'=>$product->id]) }}"
			class="btn btn-default">New Image</a>
		<br>
		<br>
		<table class="table">
			<tr>
				<th>ID</th>
				<th>Image</th>
				<th>Extension</th>
				<th>Action</th>
			</tr>
			
			@foreach($product->images as $image)
				<tr>
					<td>{{$image->id}}</td>
					<td>
						<img src="{{ url('uploads/'.$image->id.'.'.$image->extension) }}" 
							width="80" />
					</td>
					<td>{{$image->extension}}</td>
					<td>
						<a href="{{ route('products.images.destroy', ['id'=>$image->id]) }}"
							class="btn btn-danger">Delete</a>
					</td>
				</tr>	
			@endforeach				
		</table>

		<a href="{{ route('products.index') }}" class="btn btn-danger">Voltar</a>

	</div>		
	<br>
	<br>
	<br>
@stop