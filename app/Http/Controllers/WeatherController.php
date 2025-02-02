<?php

namespace App\Http\Controllers;

use App\Models\WeatherModel;

class WeatherController extends Controller
{
    public function index()
    {

        $forecast = WeatherModel::all();

        return view('weather', [
            'forecast' => $forecast
        ]);
    }
}
