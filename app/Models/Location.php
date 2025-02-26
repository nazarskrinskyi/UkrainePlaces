<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = [
        'name',
        'description',
        'latitude',
        'longitude',
        'city_id',
        'user_id',
        'image_path'
    ];

    // A location belongs to a city
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    // A location is created by a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // A location can have many reviews/ratings
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}

