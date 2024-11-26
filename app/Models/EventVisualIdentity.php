<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventVisualIdentity extends Model
{
    //
    use HasFactory;
    

    protected $fillable = [
        'event_id',
        'logo_url',
        'banner_url',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    
}
