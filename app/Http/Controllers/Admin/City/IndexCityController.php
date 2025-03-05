<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\City;

use App\Models\City;
use Illuminate\View\View;

class IndexCityController
{
    public function index(): View
    {
        $cities = City::all();

        return view('admin.city.index', compact('cities'));
    }
}
