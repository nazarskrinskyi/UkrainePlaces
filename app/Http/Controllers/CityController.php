<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    public function index(): JsonResponse
    {
        $cities = City::all();
        return new JsonResponse(compact('cities'));
    }
}
