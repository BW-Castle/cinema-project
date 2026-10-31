@extends('layout.index')

@section('title', 'Админ-панель')
@section('content')
<div class="container">
    <h1>Админ-панель</h1>
    <ul class="list-group w-25">
        <li class="list-group-item"><a href="{{ route('home') }}">Залы</a></li>
        <li class="list-group-item"><a href="{{ route('home') }}">Фильмы</a></li>
        <li class="list-group-item"><a href="{{ route('home') }}">Сеансы</a></li>
        <li class="list-group-item"><a href="{{ route('home') }}">Билеты</a></li>
    </ul>
</div>