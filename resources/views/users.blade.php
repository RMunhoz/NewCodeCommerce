@extends('template')

@section('title')
	Users
@stop
@section('content')
	<div class="container">
		<h1>Users</h1>

		<table class="table">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Action</th>
			</tr>
			
			@foreach($users as $user)
				<tr>
					<td>{{$user->id}}</td>
					<td>{{$user->name}}</td>
					<td>{{$user->email}}</td>
					<td>
						<a href="{{route('users.destroy', ['id' => $user->id]) }}" 
						class="btn btn-danger">Delete</a>
					</td>
				</tr>	
			@endforeach	
			
		</table>	
	</div>		
@stop