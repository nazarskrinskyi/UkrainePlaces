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
    public function navigateToLocation($id): RedirectResponse
    {
        $location = Location::findOrFail($id);

        $latitude = $location->latitude;
        $longitude = $location->longitude;

        $mapsUrl = "https://www.google.com/maps/dir/?api=1&destination=$latitude,$longitude&travelmode=driving";

        return redirect()->away($mapsUrl);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'city_id' => 'required|exists:cities,id',
            'image_path' => 'nullable|image|max:2048',
            'translations' => 'nullable|array',
            'translations.*.name' => 'required_with:translations|string|max:255',
            'translations.*.description' => 'nullable|string',
        ]);

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $validated['image_path'] = $filename;
        }

        DB::transaction(function () use ($validated, $request, &$location) {
            $location = Location::create($validated + ['user_id' => auth()->id()]);

            if (!empty($validated['translations'])) {
                foreach ($validated['translations'] as $locale => $data) {
                    $location->translations()->create([
                        'location_id' => $location->id,
                        'locale' => $locale,
                        'name' => $data['name'] ?? '',
                        'description' => $data['description'] ?? '',
                    ]);
                }
            }
        });

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
                ->get() : Location::with('reviews')
                ->select('locations.*', DB::raw('(SELECT AVG(rating) FROM reviews WHERE reviews.location_id = locations.id) as avg_rating'))
                ->where('city_id', $region->id)->orderBy($key, $value)->get();

            return view('region', compact('locations', 'region', 'filter'));
        }

        $locations = Location::with('reviews')
            ->select('locations.*', DB::raw('(SELECT AVG(rating) FROM reviews WHERE reviews.location_id = locations.id) as avg_rating'))
            ->where('city_id', $region->id)->get();

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
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'city_id' => 'required|exists:cities,id',
            'image_path' => 'nullable|image|max:2048',
            'translations' => 'nullable|array',
            'translations.*.name' => 'required_with:translations|string|max:255',
            'translations.*.description' => 'nullable|string',
        ]);

        $location = Location::findOrFail($id);

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $validated['image_path'] = $filename;
        }

        $location->update($validated);

        DB::transaction(function () use ($location, $validated) {
            if (!empty($validated['translations'])) {
                foreach ($validated['translations'] as $locale => $data) {
                    $location->translations()->updateOrCreate(
                        ['locale' => $locale],
                        [
                            'name' => $data['name'],
                            'description' => $data['description'] ?? '',
                        ]
                    );
                }
            }
        });

        return redirect()->route('location.show', ['id' => $location->id])
            ->with('success', 'Локацію успішно оновлено.');
    }

    public function destroy($id): RedirectResponse
    {
        Location::destroy($id);
        return redirect()->route('city.index')->with('success', 'Location deleted successfully.');
    }
}
