<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

/**
 * @property mixed $translations
 */
class Location extends Model
{
    use HasTranslations;

    public array $translatable = ['name', 'description'];

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

    public function translations(): HasMany
    {
        return $this->hasMany(LocationTranslation::class);
    }

    public function getTranslatedName(string $locale): ?string
    {
        return $this->translations()->firstWhere('locale', $locale)?->name;
    }

    public function getTranslatedDescription(string $locale): ?string
    {
        return $this->translations()->firstWhere('locale', $locale)?->description;
    }

    public function translate($locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        return $this->translations->where('locale', $locale)->first();
    }
}

