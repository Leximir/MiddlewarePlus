<?php

namespace Database\Seeders;

use App\Models\CitiesModel;
use App\Models\ForecastsModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

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
                ForecastsModel::create([
                    'city_id' => $id ,
                    'temperature' => $faker->randomFloat(2,-10,40),
                    'date' => $faker->date
                ]);
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        }
    }
}
