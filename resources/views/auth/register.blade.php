@extends('layouts.layout')

@section('title', 'Registro')

@section('content')

<form action="{{ route('create') }}" method="post">
    @csrf
    <div>
        @error('username') <p class="text-red-500">{{ $message }}</p> @enderror
        <label for="username">Username</label>
        <input name="username" type="text">
    </div>
    <div>
        @error('email') <p class="text-red-500">{{ $message }}</p> @enderror
        <label for="email">Email</label>
        <input name="email" type="email">
    </div>
    <div>
        @error('password') <p class="text-red-500">{{ $message }}</p> @enderror
        <label for="password">Contraseña</label>
        <input name="password" type="password">
    </div>
    <div>
        <label for="password_confirmation">Confirmar Contraseña</label>
        <input name="password_confirmation" type="password">
    </div>

    <button type="submit">Registrar</button>

    <small>Ya tienes cuenta? <a href="{{ route('login') }}">Ingresar</a></small>

</form>

@endsection