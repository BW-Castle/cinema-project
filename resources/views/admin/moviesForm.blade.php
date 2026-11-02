@extends('admin.panel')

@section('admin-content')
    <h2>{{ $movie ? 'Редактирование фильма' : 'Добавление фильма' }}</h2>
    
    <form action="{{ $movie ? route('admin.movies.form', $movie) : route('admin.movies.form') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if($movie) @method('PUT') @endif

        <div class="row">
            <div class="col-md-8">
                {{-- Основные поля (без изменений) --}}
                <div class="mb-3"><label class="form-label">Название *</label><input type="text" name="title" class="form-control" value="{{ old('title', $movie->title ?? '') }}" required></div>
                <div class="mb-3"><label class="form-label">Slug (URL)</label><input type="text" name="slug" class="form-control" value="{{ old('slug', $movie->slug ?? '') }}"><small class="text-muted">Можно оставить пустым</small></div>
                <div class="mb-3"><label class="form-label">Описание</label><textarea name="description" class="form-control" rows="4">{{ old('description', $movie->description ?? '') }}</textarea></div>
                
                {{-- Параметры --}}
                <div class="row">
                    <div class="col-md-4"><div class="mb-3"><label class="form-label">Длительность (мин) *</label><input type="number" name="duration" class="form-control" value="{{ old('duration', $movie->duration ?? 90) }}" required min="1"></div></div>
                    <div class="col-md-4"><div class="mb-3"><label class="form-label">Год *</label><input type="number" name="release_year" class="form-control" value="{{ old('release_year', $movie->release_year ?? date('Y')) }}" required min="1900"></div></div>
                    <div class="col-md-4"><div class="mb-3"><label class="form-label">Возраст *</label>
                        <select name="age_rating" class="form-control" required>
                            @foreach(['0+', '6+', '12+', '16+', '18+'] as $r)
                                <option value="{{ $r }}" {{ (old('age_rating', $movie->age_rating ?? '') == $r) ? 'selected' : '' }}>{{ $r }}</option>
                            @endforeach
                        </select>
                    </div></div>
                </div>

                <div class="mb-3"><label class="form-label">Жанры</label>
                    <select name="genres[]" class="form-control" multiple size="8">
                        @foreach($allGenres as $g)
                            <option value="{{ $g->id }}" {{ (is_array(old('genres')) && in_array($g->id, old('genres'))) || ($movie && $movie->genres->contains($g->id)) ? 'selected' : '' }}>{{ $g->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                {{-- Постер --}}
                <div class="mb-3"><label class="form-label">Постер</label><input type="file" name="poster" class="form-control" accept="image/*"></div>
                @if($movie?->poster_url)
                    <div class="mt-2"><img src="{{ asset($movie->poster_url) }}" class="img-fluid mb-3" style="max-height: 200px;"></div>
                @endif

                {{-- Трейлер --}}
                <div class="mb-3"><label class="form-label">Трейлер (Файл)</label><input type="file" name="trailer" class="form-control" accept="video/*"></div>
                <div class="mb-3"><label class="form-label">Трейлер (Ссылка)</label><input type="url" name="trailer_url_input" class="form-control" placeholder="https://" value="{{ old('trailer_url_input', $movie->trailer_url ?? '') }}"></div>

                {{-- Галерея кадров --}}
                <div class="mb-3">
                    <label class="form-label">Кадры из фильма (Галерея)</label>
                    <input type="file" name="frames[]" class="form-control" accept="image/*" multiple>
                    <small class="text-muted">Можно выбрать несколько файлов (Shift/Ctrl)</small>
                </div>
                
                @if($movie)
                    <div class="row">
                        @foreach($movie->images()->where('type', 'frame')->orderBy('sort_order')->get() as $img)
                            <div class="col-3 mb-2">
                                <img src="{{ asset($img->image_url) }}" class="img-thumbnail" style="height: 80px; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-success">{{ $movie ? 'Сохранить' : 'Создать' }}</button>
        <a href="{{ route('admin.movies') }}" class="btn btn-secondary ms-2">Отмена</a>
    </form>
@endsection