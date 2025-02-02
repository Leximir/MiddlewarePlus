<?php

namespace App\Http\Controllers;

class WeatherController extends Controller
{
    public function index(){
        $forecast = [
            'Beograd' => 22 ,
            'Novi Sad' => 23 ,
            'Sarajevo' => 24 ,
            'Zagreb' => 26
        ];

        return view('weather' , [
            'forecast' => $forecast
        ]);
    }
}
