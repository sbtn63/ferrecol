@extends('layouts.layout')


@section('title', 'Posts')

@section('navbar')

@include('layouts._partials.navbar')

@endsection

@section('content')

<div class="absolute mt-2 right-0 mr-6">
@include('layouts._partials.messages')
</div>


<div class="font-sans flex items-center justify-center">
    <div x-data="{ openTab: 1 }" class="p-8 w-full w-full max-w-3xl">
        <div class="mb-4 flex space-x-4 p-2 bg-white rounded-lg shadow-md dark:text-white dark:bg-gray-900">
            <button x-on:click="openTab = 1" :class="{ 'bg-blue-600 text-white': openTab === 1 }" class="flex-1 py-2 font-semibold px-4 text-xs rounded-md focus:outline-none focus:shadow-outline-blue transition-all duration-300">Publicaciones ({{ $user->posts->count() }})</button>
            <button x-on:click="openTab = 2" :class="{ 'bg-blue-600 text-white': openTab === 2 }" class="flex-1 py-2 px-4 font-semibold rounded-md text-xs focus:outline-none focus:shadow-outline-blue transition-all duration-300">Comentarios ({{ $user->comments->count() }})</button>
        </div>

        <div class="flex w-full">
            <div x-show="openTab === 1" class="w-full">
                @forelse ($user->posts->sortByDesc('created_at') as $post)
                <div class="w-full transition-all duration-300 bg-white p-4 rounded-lg shadow-md border-l-4 border-blue-600 dark:bg-gray-900 mb-4">
                    @include('layouts._partials.profile.post')
                </div>  
                @empty
                    <p class="p-4 rounded-lg shadow-md border-l-4 font-semibold text-gray-400 bg-white border-blue-600 mb-6 dark:bg-gray-900 dark:text-withe">No existen posts</p>
                @endforelse
            </div>

            <div x-show="openTab === 2" class="w-full">
                @forelse ($user->comments->sortByDesc('created_at') as $comment)
                <div class="w-full transition-all duration-300 bg-white p-4 rounded-lg shadow-md border-l-4 border-blue-600 dark:bg-gray-900 mb-4">
                    @include('layouts._partials.profile.comment')
                </div>
                @empty
                    <p class="p-4 rounded-lg shadow-md border-l-4 font-semibold text-gray-400 bg-white border-blue-600 mb-6 dark:bg-gray-900 dark:text-withe">No existen comentarios</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection