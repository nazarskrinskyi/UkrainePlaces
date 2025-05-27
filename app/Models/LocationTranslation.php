<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LocationTranslation extends Model
{
    protected $fillable = ['location_id', 'locale', 'name', 'description'];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
