@extends('layouts.templateAdmin')

@section('content')

    <div class="container">
        <h1>Show User: {{ $user->name }}</h1>
        <br>

        <p><b>Name:</b> {{$user->name}}</p>
        <p><b>Email:</b> {{$user->email}}</p>
        <p><b>Endereço:</b> {{$user->address . ", " . $user->number . ", " . $user->district . ", " . $user->city . " - " . $user->state }}</p>
        <p><b>Admin:</b> {{$user->is_admin ? "Sim" : "Não"}}</p>

        <br>
        <a href="{{ route('users.edit', ['id'=>$user->id]) }}" class='btn btn-info '>Edit</a>
        <a href="{{ route('users.destroy', ['id'=>$user->id]) }}" class='btn btn-danger '>Delete</a>
        <a href="{{ route('users.index') }}" class='btn btn-default '>Voltar</a>
    </div>
    <br>
    <br>
    <br>

@endsection