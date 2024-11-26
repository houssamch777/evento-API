<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'organizer_id',
        'fee',
        'privacy',
        'type',
        'certificate'
    ];

    /**
     * Get the organizer of the event (user).
     */
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    /**
     * The categories that belong to the event.
     */


     public function categories()
    {
        return $this->belongsToMany(EventCategory::class, 'event_category', 'event_id', 'category_id')
                    ->withTimestamps();
    }

    public function domains()
    {
        return $this->belongsToMany(EventDomain::class, 'event_domain', 'event_id', 'domain_id')
            ->withTimestamps();
    }
    /**
     * The fees associated with the event.
     */
    public function fees()
    {
        return $this->hasMany(EventFee::class);
    }

    public function assetNeeds()
    {
        return $this->hasMany(EventAssetNeed::class);
    }
    public function reviews()
    {
        return $this->hasMany(EventReview::class);
    }
    public function timeLine()
    {
        return $this->hasMany(EventTimeline::class)->orderBy('start_time', 'asc');
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating');
    }
    public function skillNeeds()
    {
        return $this->hasMany(EventSkillNeed::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function visualIdentity()
    {
        return $this->hasOne(EventVisualIdentity::class, 'event_id'); // or belongsTo depending on your schema
    }

}
