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

        if(count($cities) === 0){
            return redirect()->back()->with('error', 'Nismo pronasli gradove koji su za vase kriterijume');
        }

        return view('search_results', compact('cities'));
    }
}
