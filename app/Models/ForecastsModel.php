<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForecastsModel extends Model
{
    protected $table = 'forecasts';

    protected $fillable = [
        'city_id', 'temperature', 'date', 'weather_type', 'probability'
    ];

    const WEATHERS = [
        'rainy' , 'sunny', 'snowy', 'cloudy'
    ];

    public function city()
    {
        return $this->hasOne(CitiesModel::class, 'id', 'city_id');
    }
}
