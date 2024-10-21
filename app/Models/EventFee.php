<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventFee extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'type', 'amount'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
