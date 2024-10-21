<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $table = 'equipments';
    protected $fillable = [
        'equipment_category_id', 
        'available_quantity', 
        'condition', 
    ];

    // Inverse of the polymorphic relationship
    public function assets()
    {
        return $this->morphMany(Asset::class, 'assetable');
    }

    public function category()
    {
        return $this->belongsTo(EquipmentCategory::class, 'equipment_category_id');
    }
}
