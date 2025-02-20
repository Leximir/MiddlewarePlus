<?php

namespace App\Console\Commands;

use App\Models\CitiesModel;
use App\Models\ForecastsModel;
use App\Services\WeatherService;
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

        $weatherService = new WeatherService();
        $jsonResponse = $weatherService->getForecast($city);

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

        $forecastDay = $jsonResponse['forecast']['forecastday'][0];

        $forecastDate = $forecastDay['date'];
        $temperature = $forecastDay['day']['avgtemp_c'];
        $weatherType = $forecastDay['day']['condition']['text'];
        $probability = $forecastDay['day']['daily_chance_of_rain'];

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
