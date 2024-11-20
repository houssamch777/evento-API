<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDomain extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * The events that belong to the domain.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_domain', 'domain_id', 'event_id')
            ->withTimestamps();
    }
}
