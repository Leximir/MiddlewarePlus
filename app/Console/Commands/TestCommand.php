<?php

namespace App\Console\Commands;

use App\Models\CitiesModel;
use App\Models\ForecastsModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $city = $this->argument('city');

        $response = Http::get(env('WEATHER_API_URL').'/v1/forecast.json', [
            'key' => env('WEATHER_API_KEY'),
            'q' => $city,
            'aqi' => 'no',
            'days' => 1
        ]);

        $jsonResponse = $response->json();

        if(isset($jsonResponse['error'])){
            $this->output->error($jsonResponse['error']['message']);
            die();
        }
        $dbCity = CitiesModel::where(['name' => $city])->first();

        if($dbCity === null){
            $dbCity = CitiesModel::create(['name' => $city]);
        }

        // Ako vec postoji danasnja prognoza , neka dadne ovaj komentar u termialu
        if($dbCity->todaysForecast !== null){
            $this->output->comment('Command finished');
            return;
        }

        $forecastDate = $jsonResponse['forecast']['forecastday'][0]['date'];
        $temperature = $jsonResponse['forecast']['forecastday'][0]['day']['avgtemp_c'];
        $weatherType = $jsonResponse['forecast']['forecastday'][0]['day']['condition']['text'];
        $probability = $jsonResponse['forecast']['forecastday'][0]['day']['daily_chance_of_rain'];

        $forecast = [
            'city_id' => $dbCity->id,
            'temperature' => $temperature,
            'date' => $forecastDate,
            'weather_type' => strtolower($weatherType),
            'probability' => $probability
        ];

        ForecastsModel::create($forecast);
        $this->output->comment('Added new forecast');

        // Provjeriti da li grad postoji / ako postoji uzimamo ID (ID iz tabele Cities)
        // Ako ne postoji napraviti novi grad sa tim imenom i uzeti njegov City ID
        // Upisati forecast za taj city

    }
}
