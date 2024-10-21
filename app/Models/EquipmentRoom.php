<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentRoom extends Model
{
    use HasFactory;

    // Specify the table name (if different from the default)
    protected $table = 'equipment_room';

    // Set the fillable attributes for mass assignment
    protected $fillable = [
        'equipment_id',
        'room_id',
        'quantity',
    ];

    /**
     * Define the relationship with the Equipment model
     */
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * Define the relationship with the Room model
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
