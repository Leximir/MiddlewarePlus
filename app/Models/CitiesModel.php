<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CitiesModel extends Model
{
    protected $table = 'cities';

    protected $fillable = ['name'];
    public function forecasts()
    {
        return $this->hasMany(ForecastsModel::class, 'city_id', 'id')->orderBy('date');
    }
    public function todaysForecast(){
        return $this->hasOne(ForecastsModel::class, 'city_id', 'id')
            ->whereDate('date', Carbon::now()); // Pronadji mi relaciju izmedju CitiesModel-a i ForecastModela i usput datum isti kao danasji dan
    }
}
