@extends('layouts.layout')

@section('title', 'FerreCol')

@section('navbar')

@include('layouts._partials.navbar')

@endsection

@section('content')

<div class="flex flex-col sm:flex-row justify-center mt-10">
    <div class="w-full sm:w-1/2 lg:w-1/3 p-4">
        <div class="container mx-auto">
            <header class="mt-10">
                <h1 class="text-4xl lg:text-4xl font-bold">Bienvenido a <span class="text-green-700">FerreCol</span></h1>
                <div class="w-20 h-2 bg-green-700 my-4"></div>
                <p class="text-xl mb-10 dark:text-white">Explora, comparte y conéctate con entusiastas del sistema ferroviario colombiano a través de la API de la Red Social Ferroviaria Fercol. Nuestra plataforma permite a los usuarios crear y compartir publicaciones, interactuar con la comunidad y mantenerse actualizado sobre las últimas noticias y eventos relacionados con la red ferroviaria en Colombia.</p>
                <a href="https://ferrecol-1.onrender.com/docs" class="bg-green-500 text-white text-2xl font-medium px-4 py-2 rounded shadow">Explorar API</a>
            </header>
        </div>
    </div>

    <div class="w-full sm:w-1/2 lg:w-2/5 p-4 flex flex-col mt-10 justify-center items-center">
        <div id="map" class="w-64 h-64 rounded sm:w-96 sm:h-96 lg:w-full lg:h-[400px] bg-gray-800 p-6 rounded-lg shadow-lg">
        </div>
    </div>
</div>

@endsection