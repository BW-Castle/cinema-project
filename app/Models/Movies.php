<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Genres;
use App\Models\Movie_images;
use App\Models\Screenings;

class Movies extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'duration', 'release_year', 
        'age_rating', 'poster_url', 'trailer_url', 'seo_title', 'seo_description'
    ]; 

    public function genres() 
    { 
        return $this->belongsToMany(Genres::class, 'movie_genre', 'movie_id', 'genre_id'); 
    }
    
    public function images() 
    { 
        return $this->hasMany(Movie_images::class, 'movie_id')->orderBy('sort_order');
    } 
    
    public function screenings() 
    { 
        return $this->hasMany(Screenings::class, 'movie_id'); 
    }    

    public function scopeByGenre(Builder $query, string $genreSlug): void 
    { 
        $query->whereHas('genres', fn($q) => $q->where('slug', $genreSlug)); 
    }
}