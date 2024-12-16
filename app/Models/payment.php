<?php

namespace App\Models;


use App\Models\Event\EventRegistrant;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public function registrant()
    {
        return $this->belongsTo(EventRegistrant::class);
    }
}
