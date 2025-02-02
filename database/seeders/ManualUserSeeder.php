<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManualUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $username = $this->command->getOutput()->ask('Unesite username !');
        if($username === null){
            $this->command->getOutput()->error('Niste unijeli username !');
        }
        $usernameCheck = User::where('name', $username)->exists();
        if($usernameCheck){
            $this->command->getOutput()->error('Username koji ste unijeli vec postoji u bazi !');
            return;
        }

        $email = $this->command->getOutput()->ask('Unesite email !');
        if($email === null){
            $this->command->getOutput()->error('Niste unijeli email !');
        }
        $emailCheck = User::where('email', $email)->exists();
        if($emailCheck){
            $this->command->getOutput()->error('Email koji ste unijeli vec postoji u bazi !');
            return;
        }

        $password = $this->command->getOutput()->ask('Unesite password ili ostavite default !' , 1234);

        User::create([
            'name' => $username ,
            'email' => $email ,
            'password' => Hash::make($password)
        ]);

        $this->command->getOutput()->info("Uspjesno ste dodali novog korisnika.");
    }
}
