<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    
    protected $fillable = ['room_category_id', 'location', 'capacity'];

    public function category()
    {
        return $this->belongsTo(RoomCategory::class, 'room_category_id');
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'room_facilities')
                    ->withPivot('is_available')
                    ->withTimestamps();
    }

    public function equipment()
    {
        return $this->belongsToMany(Equipment::class, 'equipment_room')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    // Inverse of the polymorphic relationship
    public function assets()
    {
        return $this->morphMany(Asset::class, 'assetable');
    }
}
