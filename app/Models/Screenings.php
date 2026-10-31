<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Movies;
use App\Models\Halls;
use App\Models\Tickets;

class Screenings extends Model
{

    protected $fillable = ['movie_id','hall_id','start_time','format','ticket_price'];
    public function movie() { return $this->belongsTo(Movies::class); }
    public function hall() { return $this->belongsTo(Halls::class); }
    public function tickets() { return $this->hasMany(Tickets::class); }

    // Проверка занятости мест
    public function bookedSeats(): Collection
    {
        return $this->tickets()->where('status','paid')->pluck('row','seat');
    }

    // Проверка пересечения
    public function overlapsWith(?Carbon $start, ?Carbon $end): bool
    {
        $existing = Screening::where('hall_id', $this->hall_id)->where('id', '!=', $this->id)>get();
        
        foreach ($existing as $screening) {
            if ($screening->start_time->lt($end) && $screening->end_time()->gt($start)) {
                return true;
            }
        }
        return false;
    }
    public function endTime(): Carbon
    {
        return $this->start_time->addMinutes($this->movie->duration);
    }
}
