<?php

namespace App\Http\Controllers;

use App\Models\CitiesModel;
use App\Models\ForecastsModel;
use Illuminate\Http\Request;

class ForecastController extends Controller
{
    public function index(CitiesModel $city)
    {
        return view('forecasts', compact('city'));
    }
    public function search(Request $request){
        $cityName = $request->get('city');

        $cities = CitiesModel::where('name' , 'LIKE' , "%$cityName%")->get();

        return view('search_results', compact('cities'));
    }
}
