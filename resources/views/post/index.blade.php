@extends('layouts.layout')

@section('title', 'Posts')

@section('content')

@include('layouts._partials.messages')

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
    <hr>
    <div>
        <h5>Titulo: {{ $post->title }}</h5>
        <p><strong>Usuario:</strong> {{ '@'.$post->user->username }}</p>
        <p><strong>Creado: </strong>{{ $post->created_at_for_humans }}</p>
        <p><strong>Contenido:</strong> {{ $post->content }}</p>
        <p><strong>Estacion: </strong>{{ $post->train_station->name }}</p>
        @if ($post->user_id == Auth::user()->id)
            <div style="display:flex;gap:4em;">
            <a href="{{ route('post.edit', $post->id) }}">Actualizar</a>
            <form action="{{ route('post.destroy', $post->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
            </div>
        @endif

        <div style="margin-top:10px;">
            <h5>Comentarios - ( {{ $post->comments->count() }} )</h5>
            <form style="display:flex;gap:1em;" action="{{ route('comment.store') }}" method="post">
                @csrf
    
                <div>
                    <input type="number" hidden name="post" value="{{ $post->id }}">
                </div>
                <div>
                    <input name="content" type="text">
                </div>

                <button type="submit">Comentar</button>
            </form>
            <ul>
                @foreach ($post->comments as $comment )
                <li>
                    {{ '@'.$comment->user->username }} - {{ $comment->content }}
                </li>
                @endforeach
            </ul>
        </div>
        <hr>

    </div>
@empty
    <p>No existen posts</p>
@endforelse

@endsection