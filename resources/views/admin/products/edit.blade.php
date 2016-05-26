@extends('layouts.templateAdmin')

@section('title')
	Edit Product
@stop
@section('content')
	<div class="container">

		@if($errors->any())
			
			<ul class="alert-danger">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>

		@endif

		<h1>Edit Product {{$product->name}}</h1>
		
		{!! Form::model($product,['route'=>['products.update',$product->id], 'method'=>'put']) !!}
			
			@include('admin.products._form')

        {!! Form::submit('Save Product', ['class'=>'btn btn-info']) !!}

		<a href="{{ route('products.index') }}" class="btn btn-danger">Voltar</a>

		{!! Form::close() !!}
		
	</div>

		<br>
		<br>	

@stop

