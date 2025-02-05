<?php

namespace App\Http\Helpers;

class ForecastsHelper
{
    public static function getColorByTemperature($temperature)
    {
        if ($temperature <= 0){
            $color='lightblue';
        } elseif ($temperature >= 1 && $temperature <= 15){
            $color='blue';
        } elseif ($temperature >= 15 && $temperature <= 25){
            $color='green';
        } else {
            $color='red';
        }
        return $color;
    }
}
