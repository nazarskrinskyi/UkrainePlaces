<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Location::create([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect('/map')->with('success', 'Місце збережено!');
    }
}
