<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherModel extends Model
{
    protected $table = 'weather';

    protected $fillable = [
        'city_id', 'temperature'
    ];

    public function city()
    {
        return $this->hasOne(CitiesModel::class, 'id', 'city_id');
    }
}
