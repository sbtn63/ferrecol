@extends('layouts.layout')

@section('title', 'Posts')

@section('content')

<h1>Posts</h1>

<p>User : {{ '@'.Auth::user()->username }}</p>

<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">Logout</button>
</form>

@endsection