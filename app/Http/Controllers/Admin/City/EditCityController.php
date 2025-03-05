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
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string',
            'coordinates' => 'nullable|string',
        ]);

        $city = City::findOrFail($id);
        $city->update($request->all());

        return redirect()->route('admin.city.edit', ['id' => $id])
            ->with('success', 'City updated successfully.');
    }
}
