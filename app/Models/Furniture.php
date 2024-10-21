<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Furniture extends Model
{
    use HasFactory;
    protected $table = 'furnitures';
    protected $fillable = [
        'furniture_category_id', 
        'available_quantity', 
    ];

    // Inverse of the polymorphic relationship
    public function assets()
    {
        return $this->morphMany(Asset::class, 'assetable');
    }

    public function category()
    {
        return $this->belongsTo(FurnitureCategory::class, 'furniture_category_id');
    }
}
