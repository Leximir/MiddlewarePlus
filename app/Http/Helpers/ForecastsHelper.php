<?php

namespace App\Http\Helpers;

class ForecastsHelper
{
    const WEATHER_ICONS = [
        'rainy' => 'fa-cloud-rain',
        'snowy' => 'fa-snowflake',
        'sunny' => 'fa-sun' ,
        'cloudy' => 'fa-cloud'
    ];
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
    public static function getIconByWeatherType($type){

        $icon = self::WEATHER_ICONS[$type]; // WEATHER_ICONS['rainy] => 'fa-cloud-rain'

        return $icon;
    }
}
