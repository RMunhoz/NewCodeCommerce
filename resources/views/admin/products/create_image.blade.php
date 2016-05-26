@extends('layouts.templateAdmin')

@section('title')
	New Image
@stop
@section('content')
	<div class="container">
		<h1>Upload Image</h1>
		
		@if($errors->any())
			
			<ul class="alert-danger">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>

		@endif		

		{!! Form::open(['route'=>['products.images.store', $product->id],'method'=>'post', 
						'enctype'=>"multipart/form-data"]) !!}

			<div class="form-group">
				{!! Form::label('image', 'Image:') !!}
				{!! Form::file('image',null,['class'=>'form-control']) !!}
			</div>

			{!! Form::submit('Upload Image',['class'=>'btn btn-info']) !!}

		{!! Form::close() !!}

	</div>
	<br>
	<br>
	<br>
@stop