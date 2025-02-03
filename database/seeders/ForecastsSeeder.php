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
        $faker = Factory::create();

        $cities = CitiesModel::all();

        foreach ($cities as $city){
            $id = $city->id;
            $name = $city->name;

            $this->command->getOutput()->info($name);
            $this->command->getOutput()->progressStart(5);
            for($i = 0; $i < 5; $i++){

                $weatherType = ForecastsModel::WEATHERS[rand(0, 2)];

                $probability = null;

                if($weatherType == 'rainy' || $weatherType == 'snowy')
                {
                    $probability = rand(1, 100);
                }

                ForecastsModel::create([
                    'city_id' => $id ,
                    'temperature' => $faker->randomFloat(1,15,30),
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
