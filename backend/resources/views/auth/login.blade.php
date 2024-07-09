@extends('layouts.layout')

@section('title', 'Login')

@section('content')

<div class="absolute mt-2 right-0 mr-6">
@include('layouts._partials.messages')
</div>

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden w-full max-w-sm lg:max-w-4xl">
        <div class="lg:flex">
            <div class="lg:w-1/2 bg-cover bg-center hidden lg:block"
                 style="background-image: url('{{ asset('images/image_2.jpg') }}');">
            </div>
            <div class="w-full p-8 lg:w-1/2 dark:bg-gray-800">
                <h2 class="text-2xl font-semibold text-gray-700 text-center dark:text-white">FerreCol</h2>
                <p class="text-xl text-gray-600 text-center dark:text-white">¡Bienvenido de nuevo!</p>

                <form action="{{ route('auth') }}" method="post">

                    @csrf

                    <div class="mt-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2 dark:text-white">Correo electrónico</label>
                        <input class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="email" name="email" autocomplete="off" />
                        @error('email') <p class="text-xs italic text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-between">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2 dark:text-white">Contraseña</label>
                        </div>
                        <input class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="password" name="password" />
                        @error('password') <p class="text-xs italic text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="mt-8">
                        <button class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600 dark:bg-blue-700" type="submit">Iniciar sesión</button>
                    </div>

                </form>

                <div class="mt-4 flex items-center justify-between">
                    <span class="border-b w-1/5 md:w-1/4"></span>
                    <p class="text-xs text-gray-500 dark:text-white">
                        ¿No tienes cuenta? <a href="{{ route('register') }}" class="text-blue-500"> ¡Registrarse!</a>
                    </p>
                    <span class="border-b w-1/5 md:w-1/4"></span>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection