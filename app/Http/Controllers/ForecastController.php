<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForecastController extends Controller
{
    public function index($city)
    {
        $city = strtolower($city);
        $forecasts = [
            'beograd' => [22 , 24 , 25 , 20 , 18],
            'sarajevo' => [20 , 24 , 22 , 22 , 25],
        ];

        if(!array_key_exists($city , $forecasts)){
            die('Ovaj grad ne postoji');
        }
    }
}
