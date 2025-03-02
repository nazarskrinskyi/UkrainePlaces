<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = ['name', 'code', 'coordinates'];

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
