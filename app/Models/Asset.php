<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'name', 
        'description', 
        'daily_rental_price', 
        'is_available', 
        'location', 
        'assetable_id', 
        'assetable_type',
        'image_url'
    ];

    // Polymorphic relationship
    public function assetable()
    {
        return $this->morphTo();
    }

    // Relationship to the user
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function reviews()
    {
        return $this->hasMany(AssetReview::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
}
