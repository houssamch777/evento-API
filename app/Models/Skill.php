<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
class Skill extends Model
{

    
    use HasFactory;
    protected $fillable =[
        'user_id',
        'name',
        'experience',
        'offer_as_service',
        'portfolio_url',
        'cost',
        'cost_type',
        'availability',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'offer_as_service' => 'boolean',
        'cost' => 'decimal:2',
        'availability' => 'array',
    ];

    /**
     * Get the user that owns the skill.
     */
    public function user(){
        return $this->BelongsTo(User::class);
    }
}
