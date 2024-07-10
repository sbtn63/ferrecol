@extends('layouts.layout')

@section('title', 'Registro')

@section('navbar')

@include('layouts._partials.navbar')

@endsection

@section('content')

<div class="absolute mt-2 right-0 mr-6">
@include('layouts._partials.messages')
</div>

<div class="h-full">
	<!-- Container -->
	<div class="mx-auto">
		<div class="flex justify-center px-6 py-8">
			<!-- Row -->
			<div class="w-full xl:w-3/4 lg:w-11/12 flex">
				<!-- Col -->
				<div class="w-full h-auto bg-gray-400 dark:bg-gray-800 hidden lg:block lg:w-5/12 bg-cover rounded-l-lg"
					style="background-image: url({{ asset('images/image_1.jpg') }})"></div>
				<!-- Col -->
				<div class="w-full lg:w-7/12 bg-white dark:bg-gray-800 p-5 rounded-lg lg:rounded-l-none">
					<h3 class="py-4 text-2xl font-semibold text-center text-gray-800 dark:text-white">¡Crear Cuenta!</h3>
					<form class="px-8 pt-6 mb-4" action="{{ route('create') }}" method="post">

                        @csrf

                        <div class="mb-4">
							<label class="block mb-2 text-sm font-bold text-gray-700 dark:text-white" for="username">
                                Nombre usuario
                            </label>
							<input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700  border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="username"
                                name="username"
                                type="text"
                                placeholder="example"
								autocomplete="off"
                            />
                            @error('username') <p class="text-xs italic text-red-500">{{ $message }}</p> @enderror
						</div>
						<div class="mb-4">
							<label class="block mb-2 text-sm font-bold text-gray-700 dark:text-white" for="email">
								Correo electrónico
                            </label>
							<input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="email"
                                name="email"
                                type="email"
                                placeholder="example@example.com"
								autocomplete="off"
                            />
                            @error('email') <p class="text-xs italic text-red-500">{{ $message }}</p> @enderror
						</div>
						<div class="mb-4 md:flex md:justify-between">
							<div class="mb-4 md:mr-2 md:mb-0">
								<label class="block mb-2 text-sm font-bold text-gray-700 dark:text-white" for="password">
                                    Contraseña
                                </label>
								<input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="password"
                                    name="password"
                                    type="password"
                                    placeholder="******************"
                                />
                                @error('password') <p class="text-xs italic text-red-500">{{ $message }}</p> @enderror
							</div>
							<div class="md:ml-2">
								<label class="block mb-2 text-sm font-bold text-gray-700 dark:text-white" for="password_confirmation">
                                    Confirmar Contraseña
                                </label>
								<input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    placeholder="******************"
                                />
							</div>
						</div>
						<div class="mb-6 text-center">
							<button
                                class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 dark:bg-blue-700 dark:text-white dark:hover:bg-blue-900 focus:outline-none focus:shadow-outline"
                                type="submit"
                            >
                                Registrarse
                            </button>
						</div>
						<hr class="mb-6 border-t" />
						<div class="text-center">
							<a class="inline-block text-sm text-blue-500 dark:text-blue-500 align-baseline hover:text-blue-800"
								href="{{ route('login') }}">
								¿Ya tienes cuenta? ¡Iniciar sesión!
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection