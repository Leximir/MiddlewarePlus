<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amount = 500;

        $faker = Factory::create();

        $this->command->getOutput()->progressStart($amount);
        for($i = 0; $i < $amount; $i++){
            User::create([
                'name' => $faker->name,
                'email' => $faker->email ,
                'password' => Hash::make('123456') ,
            ]);

            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
