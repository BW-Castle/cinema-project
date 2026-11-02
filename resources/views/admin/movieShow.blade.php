@extends('layout.index')

@section('title', $movie->title)
@section('content')
<div class="container my-4">
    <div class="row">
        {{-- Левая часть: Постер --}}
        <div class="col-md-4 text-center">
            @if($movie->poster_url)
                <img src="{{ asset($movie->poster_url) }}" class="img-fluid rounded shadow" alt="{{ $movie->title }}">
            @else
                <div class="bg-secondary text-white text-center py-5 rounded">Нет постера</div>
            @endif
        </div>

        {{-- Правая часть: Инфо --}}
        <div class="col-md-8">
            <h1>{{ $movie->title }}</h1>
            <p class="lead">{{ $movie->description }}</p>

            <div class="row text-muted small">
                <div class="col-auto"><strong>Год:</strong> {{ $movie->release_year }}</div>
                <div class="col-auto"><strong>Длительность:</strong> {{ $movie->duration }} мин</div>
                <div class="col-auto"><strong>Возраст:</strong> {{ $movie->age_rating }}</div>
            </div>

            <div class="mt-3">
                <strong>Жанры:</strong>
                @foreach($movie->genres as $g)
                    <span class="badge bg-info me-1">{{ $g->name }}</span>
                @endforeach
            </div>

            {{-- Трейлер --}}
            @if($movie->trailer_url)
                <div class="mt-4">
                    <h5>Трейлер</h5>
                    @if(str_contains($movie->trailer_url, 'youtube.com') || str_contains($movie->trailer_url, 'youtu.be'))
                        @php
                            $videoId = preg_match('/(?:v=|\/)([0-9A-Za-z_-]{11}).*/', $movie->trailer_url, $matches) ? $matches[1] : '';
                        @endphp
                        @if($videoId)
                            <div style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden;">
                                <iframe src="https://www.youtube.com/embed/{{ $videoId }}" style="position:absolute; top:0; left:0; width:100%; height:100%;" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        @endif
                    @elseif(str_contains($movie->trailer_url, 'storage/trailers/'))
                        <video controls class="w-100" style="max-height: 400px;">
                            <source src="{{ asset($movie->trailer_url) }}" type="video/mp4">
                            Ваш браузер не поддерживает видео.
                        </video>
                    @endif
                </div>
            @endif
        </div>
    </div>

    @if($movie->images()->where('type', 'frame')->count() > 0)
        <hr class="my-5">
        <h3>Галерея кадров</h3>
        <div class="row">
            @foreach($movie->images()->where('type', 'frame')->orderBy('sort_order')->get() as $img)
                <div class="col-md-3 col-sm-4 col-6 mb-3">
                    <img src="{{ asset($img->image_url) }}" class="img-fluid rounded" alt="Кадр" data-bs-toggle="modal" data-bs-target="#imgModal-{{ $img->id }}">
                    
                    <div class="modal fade" id="imgModal-{{ $img->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <img src="{{ asset($img->image_url) }}" class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection