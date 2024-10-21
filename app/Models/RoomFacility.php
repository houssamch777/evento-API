<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFacility extends Model
{

    use HasFactory;

    // Specify the table name (if different from the default)
    protected $table = 'room_facilities';

    // Set the fillable attributes to allow mass assignment
    protected $fillable = [
        'room_id',
        'facility_id',
        'is_available'
    ];

    /**
     * Define the relationship with the Room model
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Define the relationship with the Facility model
     */
    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
