@extends('layouts.templateAdmin')

@section('title')
	New Category
@stop
@section('content')
	<div class="container">
		<h1>Create Category</h1>
		
		@if($errors->any())
			
			<ul class="alert-danger">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>

		@endif		

		{!! Form::open(['route'=>'categories.store', 'method'=>'post']) !!}

			@include('admin.categories._form')

			{!! Form::submit('Add Category',['class'=>'btn btn-info']) !!}
			
			<a href="{{ route('categories.index') }}" class="btn btn-danger">Voltar</a>

		{!! Form::close() !!}

	</div>
	<br>
	<br>
	<br>
	<br>		
@stop