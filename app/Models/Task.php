<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'event_id',
        'title',
        'description',
        'due_date',
        'category',
    ];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user')->withTimestamps();
    }

}
