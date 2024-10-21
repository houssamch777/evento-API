<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSkillNeed extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        'skill_name_id',
        'quantity',
    ];

    // Relationship with the Event model
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relationship with the SkillName model
    public function skillName()
    {
        return $this->belongsTo(SkillName::class);
    }
}
