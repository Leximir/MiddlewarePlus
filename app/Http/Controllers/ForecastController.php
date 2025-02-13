<?php

namespace App\Http\Controllers;

use App\Models\CitiesModel;
use App\Models\ForecastsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForecastController extends Controller
{
    public function index(CitiesModel $city)
    {
        return view('forecasts', compact('city'));
    }
    public function search(Request $request){
        $cityName = $request->get('city');

        $cities = CitiesModel::with('todaysForecast')->where('name' , 'LIKE' , "%$cityName%")->get();

        if(count($cities) === 0){
            return redirect()->back()->with('error', 'Nismo pronasli gradove koji su za vase kriterijume');
        }

        $userFavourites = [];
        if(Auth::check()){
            $userFavourites = Auth::user()->cityFavourites;
            $userFavourites = $userFavourites->pluck('city_id')->toArray();
        }

        return
            view('search_results',
            compact('cities' , 'userFavourites'));
    }
}
