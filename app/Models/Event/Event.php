<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(EventCategory::class);
    }

    // Scope untuk Upcoming Events
    public function scopeUpcoming($query)
    {
        return $query->where('start_event_at', '>', now());
    }

    // Scope untuk Ongoing Events
    public function scopeOngoing($query)
    {
        return $query->where('start_event_at', '<=', now())
                     ->where('end_event_at', '>=', now());
    }

    // Scope untuk Open Events
    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }
}
