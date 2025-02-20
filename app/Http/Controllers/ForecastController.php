<?php

namespace App\Http\Controllers;

use App\Models\CitiesModel;
use App\Models\ForecastsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ForecastController extends Controller
{
    public function index(CitiesModel $city)
    {

        $response = Http::get(env('WEATHER_API_URL').'/v1/astronomy.json', [
            'key' => env('WEATHER_API_KEY'),
            'q' => $city->name,
            'aqi' => 'no',
        ]);

        $jsonResponse = $response->json();
        $sunrise = $jsonResponse['astronomy']['astro']['sunrise'];
        $sunset = $jsonResponse['astronomy']['astro']['sunset'];

        return view('forecasts', compact('city', 'sunrise', 'sunset'));
    }
    public function search(Request $request){
        $cityName = $request->get('city');

        Artisan::call('app:test-command', ['city' => $cityName]);

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
