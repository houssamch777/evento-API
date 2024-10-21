<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    /**
     * The rooms that belong to the facility.
     */
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_facility')->withPivot('is_available')->withTimestamps();
    }
}
