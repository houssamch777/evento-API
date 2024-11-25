<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Team extends Model
{
    //
    use HasFactory;
    protected $fillable = ['event_id', 'name', 'description', 'slug'];

    protected static function booted()
    {
        static::creating(function ($team) {
            $team->slug = Str::uuid(); // Generate a unique UUID
        });
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'team_user')->withPivot('role')->withTimestamps();
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
