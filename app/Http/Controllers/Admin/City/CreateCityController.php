<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\City;

use App\Models\City;
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
            'name' => 'required|string|max:255|unique:cities,name',
            'code' => 'nullable|string',
            'coordinates' => 'nullable|string',
        ]);

        $city = City::create($validated);

        return redirect()->route('admin.city.edit', ['id' => $city->id]);
    }
}
