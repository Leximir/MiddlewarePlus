<?php

namespace Database\Seeders;

use App\Models\WeatherModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $forecast = [
            'Beograd' => 22 ,
            'Novi Sad' => 23 ,
            'Sarajevo' => 24 ,
            'Zagreb' => 26
        ];

        foreach ($forecast as $city => $temperature){

            $cityCheck = WeatherModel::where('city', $city)->exists();
            if($cityCheck){
                $this->command->getOutput()->error("$city vec postoji u bazi !");
                continue;
            }

            WeatherModel::create([
                'city' => $city ,
                'temperature' => $temperature
            ]);

            $this->command->getOutput()->info("$city je unijet u bazu !");
        }
    }
}
