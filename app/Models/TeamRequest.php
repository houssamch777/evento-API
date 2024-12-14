<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamRequest extends Model
{
    //
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id',
        'user_id',
        'role',
        'status',
    ];

    public function accept()
    {
        $this->status = 'accepted';
        $this->save();
    }
    public function reject()
    {
        $this->status = 'rejected';
        $this->save();
    }
    public function isAccepted()
    {
        return $this->status === 'accepted';
    }
    public function isRejected()
    {
        return $this->status === 'rejected';
    }
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
