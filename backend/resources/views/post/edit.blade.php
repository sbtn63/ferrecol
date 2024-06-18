@extends('layouts.layout')

@section('title', 'Posts')

@section('content')

@include('layouts._partials.messages')


<h5>Editar Post</h5>
<form action="{{ route('post.update', $post->id) }}" method="post">
    @csrf
    @method('PUT')
    <div>
        @error('title') <p class="text-red-500">{{ $message }}</p> @enderror
        <label for="title">Titulo</label>
        <input name="title" type="text" value="{{ $post->title }}">
    </div>
    <div>
        @error('content') <p class="text-red-500">{{ $message }}</p> @enderror
        <label for="content">Contenido</label>
        <textarea name="content" rows="4">{{ $post->content }}</textarea>
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
                <option @if ($post->train_station_id == $train_sation->id) selected @endif" value="{{ $train_sation->id }}">{{$train_sation->name}}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Editar</button>
</form>


@endsection