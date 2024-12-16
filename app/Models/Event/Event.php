<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Cast date attributes to Carbon instances
    protected $casts = [
        'start_event_at' => 'datetime',
        'end_event_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(EventCategory::class);
    }

    // Scope for Upcoming Events
    public function scopeUpcoming($query)
    {
        return $query->where('start_event_at', '>', now());
    }

    // Scope for Ongoing Events
    // Scope untuk Ongoing Events
public function scopeOngoing($query)
{
    return $query->where('status', 'ongoing')
                 ->where('start_event_at', '<=', now())
                 ->where('end_event_at', '>=', now());
}


    // Scope for Open Events
    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }
}
