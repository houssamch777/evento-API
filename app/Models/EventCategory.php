<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    use HasFactory;
    
    protected $fillable = ['name',
        'slug',
        'img_url',
         'description'];

    /**
     * The events that belong to the category.
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_category', 'category_id', 'event_id')
            ->withTimestamps();
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = \Str::slug($value);
    }
}
