<?php

namespace Database\Seeders;

use App\Models\CitiesModel;
use App\Models\WeatherModel;
use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $city_name = $this->command->getOutput()->ask("Kojem gradu zelite da dodate trenutnu temperaturu ?");

        $degree = $this->command->getOutput()->ask("Kolika je trenutna temperatura ?");

        $city_id = CitiesModel::where('name' , $city_name)->pluck('id')->first();
        if($city_id === null){
            die('Grad koji ste unijeli ne postoji u bazi !');
        }

        WeatherModel::create([
            'city_id' => $city_id ,
            'temperature' => $degree
        ]);

        $this->command->getOutput()->info("Uspjesno ste dodijelili temperaturu gradu '$city_name'");
    }
}
