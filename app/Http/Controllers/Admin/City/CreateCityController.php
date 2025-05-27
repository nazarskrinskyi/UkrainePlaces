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
            'name.*' => 'required|string|max:255',
            'code' => 'nullable|string',
            'coordinates' => 'nullable|string',
        ]);

        $city = City::create([
            'code' => $request->get('code'),
            'coordinates' => $request->get('coordinates'),
        ]);

        foreach ($validated['name'] as $locale => $translatedName) {
            $city->translations()->create([
                'city_id' => $city->id,
                'locale' => $locale,
                'name' => $translatedName,
            ]);
        }

        return redirect()->route('admin.city.edit', ['id' => $city->id]);
    }
}
