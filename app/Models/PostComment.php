<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'user_id',
        'content',
    ];

    // Relationship: A comment belongs to a post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Relationship: A comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}