<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Genres;
use App\Models\Movies_images;
use App\Models\Screenings;

class Movies extends Model
{
    protected $fillable = [ 'title','slug','description','duration','release_year', 
    'age_rating','poster_url','trailer_url','seo_title','seo_description' ]; 

    public function genres() { return $this->belongsToMany(Genres::class); } 
    public function images() { return $this->hasMany(Movies_images::class)->orderBy('sort_order'); } 
    public function screenings() { return $this->hasMany(Screenings::class); }
    
    // scope для фильтрации 
    public function scopeByGenre(Builder $query, string $genreSlug): void 
    { 
        $query->whereHas('genres', fn($q) => $q->where('slug', $genreSlug)); 
    }
}
