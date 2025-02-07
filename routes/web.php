<?php

use App\Http\Controllers\AdminWeatherController;
use App\Http\Controllers\ForecastController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/forecast' , [WeatherController::class , 'index']);
Route::get('/forecast/{city:name}' , [ForecastController::class , 'index']);

Route::middleware(['auth'])->prefix('admin')->group(function() {
    Route::get('/weather' , [WeatherController::class , 'addCurrentWeather']);
    Route::post('/weather/update', [AdminWeatherController::class, 'update'])
        ->name('weather.update');
    Route::get('forecasts', [AdminWeatherController::class, 'forecasts'])
        ->name('forecasts.view');
    Route::post('forecasts/save', [AdminWeatherController::class, 'forecastsUpdate'])
        ->name('forecasts.update');
});

require __DIR__.'/auth.php';
