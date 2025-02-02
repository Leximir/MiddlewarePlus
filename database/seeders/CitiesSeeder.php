<?php

namespace Database\Seeders;

use App\Models\CitiesModel;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amount = $this->command->getOutput()->ask("Koliko gradova zelite da dodate u tabelu ?" , 100);

        $faker = Factory::create();

        $this->command->getOutput()->progressStart($amount);
        for($i = 0; $i < $amount; $i++){
            CitiesModel::create([
                'name' => $faker->city
            ]);

            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
