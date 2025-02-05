<?php

namespace App\Http\Controllers;

use App\Models\CitiesModel;
use App\Models\ForecastsModel;
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
    public function forecasts(){
        return view('admin.all-forecasts' , [
            'cities' => CitiesModel::all()
        ]);
    }

    public function forecastsUpdate(Request $request){
        $request->validate([
            'city_id' => "required|exists:cities,id", // Mora da postoji u tabeli cities id koji smo proslijedili
            'temperature' => 'required|numeric',
            'weather_type' => 'required|in:sunny,rainy,snowy' ,
            'probability' => 'required|integer|between:0,100',
            'date' => 'required|date_format:Y-m-d'
        ]);

        ForecastsModel::create($request->all());

        return redirect()->back();
    }
}
