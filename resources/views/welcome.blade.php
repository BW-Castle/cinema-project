@extends('layout.index')

@section('title', 'Афиша')
@section('content')
<div class="container my-4">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($movies as $m)
            <div class="col">
                <div class="card h-100">
                    @if($m->poster_url)
                        <img src="{{ asset($m->poster_url) }}" class="card-img-top" alt="{{ $m->title }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $m->title }}</h5>
                        <p class="card-text flex-grow-1">{{ Str::limit($m->description, 100) }}</p>
                        <div class="mt-2">
                            <strong>Жанры:</strong>
                            @foreach($m->genres as $g) <span class="badge bg-secondary">{{ $g->name }}</span> @endforeach
                        </div>
                        <a href="{{ route('movies.show', $m->slug) }}" class="btn btn-primary mt-3">Подробнее</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Фильмы не найдены</div>
            </div>
        @endforelse
    </div>
</div>
@endsection