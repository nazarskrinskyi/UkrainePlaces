<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\View\View;

class LocationController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'city_id' => 'required|exists:cities,id',
            'image_path' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('locations', 'public');
        }

        $location = Location::create($validated + ['user_id' => auth()->id()]);

        return response()->json(['message' => 'Location added successfully', 'location' => $location], 201);
    }


    public function showByCity($city = null): View
    {
        $locations = Location::where('city', $city)->get() ?? null;
        return view('location.index', compact('locations'));
    }

    public function show($id): View
    {
        $location = Location::findOrFail($id);
        return view('location.show', compact('location'));
    }

    public function create(): View
    {
        return view('location.create');
    }

    public function editForm($id): View
    {
        $location = Location::findOrFail($id);
        return view('location.edit', compact('location'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $location = Location::findOrFail($id);
        $location->update($request->all());

        return redirect()->route('location.show', ['id' => $id])
            ->with('success', 'Location updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        Location::destroy($id);
        return redirect()->route('city.index')->with('success', 'Location deleted successfully.');
    }
}
