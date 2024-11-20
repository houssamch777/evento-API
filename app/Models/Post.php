<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image_url',
        'event_id',
    ];

    // Relationship: A post belongs to a user (author)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: A post can have many likes
    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }

    // Relationship: A post can have many comments
    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    // Relationship: A post can belong to many tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    // Relationship: A post can belong to an event (optional)
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
