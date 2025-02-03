<?php

namespace App\Http\Controllers;

use App\Models\CitiesModel;
use App\Models\ForecastsModel;

class ForecastController extends Controller
{
    public function index(CitiesModel $city)
    {
        return view('forecasts', compact('city'));
    }
}
