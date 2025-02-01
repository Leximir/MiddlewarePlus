<?php

namespace Database\Seeders;

use App\Models\WeatherModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserWeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $city = $this->command->getOutput()->ask('Unesite ime grada !');
        if($city === null){
            $this->command->getOutput()->error('Niste unijeli ime grada');
        }

        $temperature = $this->command->getOutput()->ask('Unesite temperaturu !');
        if($temperature === null){
            $this->command->getOutput()->error('Niste unijeli temperaturu');
        }

        WeatherModel::create([
            'city' => $city ,
            'temperature' => $temperature
        ]);

        $this->command->getOutput()->info("Uspjesno ste unijeli novi grad $city sa temperaturom $temperature.");
    }
}
