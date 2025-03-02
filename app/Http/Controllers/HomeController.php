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
        $cities = City::all();


        $topRatedLocations = Location::with('reviews')
            ->select('locations.*', DB::raw('(SELECT AVG(rating) FROM reviews WHERE reviews.location_id = locations.id) as avg_rating'))
            ->orderByDesc('avg_rating')
            ->take(4)
            ->get();

        $latestLocations = Location::orderByDesc('created_at')->take(4)->get();

        return view('home', compact('cities', 'topRatedLocations', 'latestLocations'));
    }

}
