<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Location;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $cities = City::all();

        $topRatedLocations = Location::orderByDesc('rating')->take(4)->get();

        $latestLocations = Location::orderByDesc('created_at')->take(4)->get();

        return view('home', compact('cities', 'topRatedLocations', 'latestLocations'));
    }

}
