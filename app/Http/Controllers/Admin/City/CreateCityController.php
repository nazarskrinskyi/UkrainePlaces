<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\City;

use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CreateCityController
{
    public function create(): View
    {
        return view('admin.city.create');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:cities,name',
            'code' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $city = City::create($validated);

        return response()->json(['message' => 'City created successfully', 'city' => $city], 201);
    }
}
