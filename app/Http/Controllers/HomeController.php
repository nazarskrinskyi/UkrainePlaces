<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $regions = City::all();

        $topRatedLocations = Location::with('reviews')
            ->select('locations.*', DB::raw('(SELECT AVG(rating) FROM reviews WHERE reviews.location_id = locations.id) as avg_rating'))
            ->orderByDesc('avg_rating')
            ->take(4)
            ->get();

        $latestLocations = Location::with('reviews')
            ->select('locations.*', DB::raw('(SELECT AVG(rating) FROM reviews WHERE reviews.location_id = locations.id) as avg_rating'))
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        return view('home', compact('regions', 'topRatedLocations', 'latestLocations'));
    }

}
