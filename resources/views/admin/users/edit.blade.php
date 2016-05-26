@extends('layouts.templateAdmin')

@section('content')
    <h1>Edit User: {{ $user->name }}</h1>
    @if($errors->any())
        <ul class="alert">
            @foreach($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    @endif

    {!! Form::model($user, ['route'=>['users.update', $user->id], 'method' => 'put']) !!}
        @include('admin.users._form')
        <div class="form-group">
            {!! Form::label('is_admin', 'Admin:') !!}
            {!! Form::checkbox('is_admin') !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Save User', ['class'=>'btn btn-info']) !!}
            <a href="{{ route('users.index') }}" class='btn btn-danger '>Voltar</a>
        </div>
    {!! Form::close() !!}
    <br>
    <br>
    <br>

@endsection