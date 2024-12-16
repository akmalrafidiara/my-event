<?php

namespace App\Models\Event;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class EventRegistrant extends Model
{
    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
