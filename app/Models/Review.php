<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'location_id',
        'rating',   // e.g., a numeric rating
        'comment'
    ];

    // A review belongs to a location
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    // A review is authored by a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
