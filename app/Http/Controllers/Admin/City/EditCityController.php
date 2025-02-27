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
        return view('admin.city.edit', compact('city'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $city = City::findOrFail($id);
        $city->update($request->all());

        return redirect()->route('admin.city.edit.form', ['id' => $id])
            ->with('success', 'City updated successfully.');
    }
}
