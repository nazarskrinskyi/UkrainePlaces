<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\City;

use App\Models\City;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EditCityController
{
    public function editForm($id): View
    {
        $city = City::findOrFail($id);
        return view('admin.city.form', compact('city'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'translations.*.name' => 'required|string|max:255',
            'code' => 'nullable|string',
            'coordinates' => 'nullable|string',
        ]);

        $city = City::findOrFail($id);

        $city->update([
            'code' => $request->get('code'),
            'coordinates' => $request->get('coordinates'),
        ]);

        foreach ($validated['translations'] as $locale => $data) {
            $city->translations()->updateOrCreate(
                ['locale' => $locale],
                ['name' => $data['name']]
            );
        }

        return redirect()
            ->route('admin.city.edit', ['id' => $id])
            ->with('success', 'Місто успішно оновлено.');
    }
}
