<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class LocationController extends Controller
{
    public function store(Request $request): RedirectResponse
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
            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            $validated['image_path'] = $filename;
        }

        $location = Location::create($validated + ['user_id' => auth()->id()]);

        return redirect()->route('location.show', ['id' => $location->id]);
    }

    public function findByName(Request $request): JsonResponse
    {
        $query = $request->get('query');

        if ($query) {
            $locations = Location::where('name', 'like', '%' . $query . '%')->limit(5)->get();
            return response()->json($locations);
        }

        return response()->json();
    }

    public function showByCity(Request $request, string $city): View
    {
        $filter = $request->input('filter');
        $region = City::where('code', $city)->firstOrFail();

        if ($filter !== null) {
            [$key, $value] = explode(':', $filter);
            $locations = $key === 'rating' ? Location::with('reviews')
                ->select('locations.*', DB::raw('(SELECT AVG(rating) FROM reviews WHERE reviews.location_id = locations.id) as avg_rating'))
                ->where('city_id', $region->id)
                ->orderBy(DB::raw('avg_rating'), $value)
                ->get() : Location::where('city_id', $region->id)->orderBy($key, $value)->get();

            return view('region', compact('locations', 'region', 'filter'));
        }

        $locations = Location::where('city_id', $region->id)->get();

        return view('region', compact('locations', 'region', 'filter'));
    }

    public function show($id): View
    {
        $location = Location::findOrFail($id);
        $user_name = $location->user->name;

        return view('location', compact('location', 'user_name'));
    }

    public function create(): View
    {
        $cities = City::all();

        return view('location.form', compact('cities'));
    }

    public function editForm($id): View
    {
        $location = Location::findOrFail($id);
        $cities = City::all();

        return view('location.form', compact('location', 'cities'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'city_id' => 'required|exists:cities,id',
            'image_path' => 'nullable|image|max:2048',
        ]);

        $location = Location::findOrFail($id);
        $location->update($validated);

        return redirect()->route('location.show', ['id' => $id])
            ->with('success', 'Location updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        Location::destroy($id);
        return redirect()->route('city.index')->with('success', 'Location deleted successfully.');
    }
}
