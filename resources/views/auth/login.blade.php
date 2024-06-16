@extends('layouts.layout')

@section('title', 'Login')

@section('content')

@include('layouts._partials.messages')

<form action="{{ route('auth') }}" method="post">
    @csrf
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

    <button type="submit">Ingresar</button>

    <small>No tienes cuenta? <a href="{{ route('register') }}">Registrar</a></small>

</form>

@endsection