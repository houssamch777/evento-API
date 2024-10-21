<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAssetNeed extends Model
{
    
    use HasFactory;


    protected $fillable = ['event_id', 'quantity', 'notes', 'assetable_id', 'assetable_type'];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function assetable()
    {
        return $this->morphTo();
    }
}
