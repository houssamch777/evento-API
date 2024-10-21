<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurnitureCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function furniture()
    {
        return $this->hasMany(Furniture::class);
    }
}
