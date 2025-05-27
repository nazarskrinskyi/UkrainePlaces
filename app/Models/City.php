<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

/**
 * @property mixed $translations
 */
class City extends Model
{
    use HasTranslations;

    public array $translatable = ['name'];
    protected $fillable = ['name', 'code', 'coordinates'];

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(CityTranslation::class);
    }

    public function translate($locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        return $this->translations->where('locale', $locale)->first();
    }
}
