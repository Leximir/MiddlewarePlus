<?php

namespace App\Http\Controllers;

use App\Models\WeatherModel;
use Illuminate\Http\Request;

class AdminWeatherController extends Controller
{
    public function update(Request $request){
        $request->validate([
           'temperature' => 'required',
           'city_id' => "required|exists:cities,id" // Mora da postoji u tabeli cities id koji smo proslijedili
        ]);

        $weather = WeatherModel::where(['city_id' => $request->get('city_id')])->first();
        $weather->temperature = $request->get('temperature');
        $weather->save();

        return redirect()->back();
    }
}
