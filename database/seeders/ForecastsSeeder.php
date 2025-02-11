<?php

namespace Database\Seeders;

use App\Models\CitiesModel;
use App\Models\ForecastsModel;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ForecastsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = CitiesModel::all();

        $forecastsNumber = $this->command->getOutput()->ask("Koliko prognoza zelite da dodate svakom gradu u tabeli ?" , 5);

        foreach ($cities as $city){

            $lastTemperature = null;

            $id = $city->id;
            $name = $city->name;

            $this->command->getOutput()->info($name);
            $this->command->getOutput()->progressStart(5);
            for($i = 0; $i < $forecastsNumber; $i++){

                $weatherType = ForecastsModel::WEATHERS[rand(0, 3)];

                $probability = null;

                if($weatherType == 'rainy' || $weatherType == 'snowy' || $weatherType == 'cloudy')
                {
                    $probability = rand(1, 100);
                }

                $temperature = null;

                if($lastTemperature !== null){
                    $minTemperature = $lastTemperature - 5;
                    $maxTemperature = $lastTemperature + 5;
                    $temperature = rand($minTemperature, $maxTemperature);
                } else {
                    switch ($weatherType){
                        case 'sunny':
                            $temperature = rand(-500, 500) / 10;
                            break;
                        case 'cloudy':
                            $temperature = rand(-500, 150) / 10;
                            break;
                        case 'rainy':
                            $temperature = rand(-100, 500) / 10;
                            break;
                        case 'snowy':
                            $temperature = rand(-500, 10) / 10;
                            break;
                    }
                }



                ForecastsModel::create([
                    'city_id' => $id ,
                    'temperature' => $temperature,
                    'date' => Carbon::now()->addDays($i), // Carbon je dobar za datume
                    'weather_type' => $weatherType ,
                    'probability' => $probability
                ]);
                $this->command->getOutput()->progressAdvance();

                $lastTemperature = $temperature;

            }
            $this->command->getOutput()->progressFinish();
        }
    }
}
