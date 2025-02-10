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

        foreach ($cities as $city){
            $id = $city->id;
            $name = $city->name;

            $this->command->getOutput()->info($name);
            $this->command->getOutput()->progressStart(5);
            for($i = 0; $i < 5; $i++){

                $weatherType = ForecastsModel::WEATHERS[rand(0, 3)];

                $probability = null;

                if($weatherType == 'rainy' || $weatherType == 'snowy' || $weatherType == 'cloudy')
                {
                    $probability = rand(1, 100);
                }

                $temperature = rand(-300, 400) / 10;
                if($weatherType === 'cloudy'){
                    $temperature = rand(-100, 150) / 10;
                } else if($weatherType === 'snowy'){
                    $temperature = rand(-300, 0) / 10;
                } else if($weatherType === 'rainy'){
                    $temperature = rand(0, 10) / 10;
                }

                ForecastsModel::create([
                    'city_id' => $id ,
                    'temperature' => $temperature,
                    'date' => Carbon::now()->addDays(rand(1,30)), // Carbon je dobar za datume
                    'weather_type' => $weatherType ,
                    'probability' => $probability
                ]);
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        }
    }
}
