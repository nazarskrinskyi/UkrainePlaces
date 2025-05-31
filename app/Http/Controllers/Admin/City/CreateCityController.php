<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\City;

use App\Models\City;
use App\Models\CityTranslation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CreateCityController
{
    public function create(): View
    {
        return view('admin.city.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'translations.uk.name' => 'required|string|max:255',
            'translations.en.name' => 'required|string|max:255',
            'code' => 'nullable|string',
            'coordinates' => 'nullable|string',
        ]);

        $city = City::create([
            'code' => $validated['code'],
            'coordinates' => $validated['coordinates'],
        ]);

        foreach ($validated['translations'] as $locale => $translation) {
            $city->translations()->create([
                'city_id' => $city->id,
                'locale' => $locale,
                'name' => $translation['name'],
            ]);
        }

        return redirect()->route('admin.city.edit', ['id' => $city->id]);
    }
}
