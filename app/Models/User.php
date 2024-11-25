<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Skill;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'phone_number',
        'location',
        'date_of_birth',
        'gender',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class, 'organizer_id');
    }
    public function getParticipantDetails()
    {
        return [
        'id' => $this->id,
        'name' => $this->first_name.' '.$this->last_name,
        'email' => $this->email,
        'phone' => $this->phone_number,
        // Add more fields as needed
        ];
    }
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_user')->withPivot('role')->withTimestamps();
    }
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user')->withTimestamps();
    }
}
