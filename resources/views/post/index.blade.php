@extends('layouts.layout')

@section('title', 'Posts')

@section('content')

<h1>Posts</h1>

<p>User : {{ '@'.Auth::user()->username }}</p>

<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">Logout</button>
</form>

<h5>Crear Post</h5>
<form action="{{ route('post.store') }}" method="post">
    @csrf
    <div>
        @error('title') <p class="text-red-500">{{ $message }}</p> @enderror
        <label for="title">Titulo</label>
        <input name="title" type="text">
    </div>
    <div>
        @error('content') <p class="text-red-500">{{ $message }}</p> @enderror
        <label for="content">Contenido</label>
        <textarea name="content" rows="4"></textarea>
    </div>
    <div>
        <input name="image" type="file">
    </div>
    <div>
        @error('train_station') <p class="text-red-500">{{ $message }}</p> @enderror
        <label for="title">Estacion de tren</label>
        <select name="train_station">
            <option value="">Seleccione una estacion</option>
            @foreach ($train_stations as $train_sation)
                <option value="{{ $train_sation->id }}">{{$train_sation->name}}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Crear</button>
</form>

@forelse ($posts as $post)
    <div>
        <h5>{{ $post->title }}</h5>
        <p>{{ $post->content }}</p>
        <p>{{ '@'.$post->user->username }}</p>
        <p>{{ $post->train_station->name }}</p>
    </div>
@empty
    <p>No existen posts</p>
@endforelse

@endsection