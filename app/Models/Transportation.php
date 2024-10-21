<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    use HasFactory;
    //protected $table = 'transportation';
     // Specify the table name
    protected $fillable = [
        'transportation_category_id', 
        'capacity', 
    ];

    // Inverse of the polymorphic relationship
    public function assets()
    {
        return $this->morphMany(Asset::class, 'assetable');
    }

    public function category()
    {
        return $this->belongsTo(TransportationCategory::class, 'transportation_category_id');
    }
}
