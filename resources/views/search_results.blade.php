@extends('layout')

@section('content')

    <div class="d-flex flex-wrap container mt-5">
        @foreach($cities as $city)

            @php
            $icon = \App\Http\Helpers\ForecastsHelper::getIconByWeatherType($city->todaysForecast->weather_type);
            @endphp

            <p>
                <a href=""><i class="fa-regular fa-heart btn btn-primary text-white"></i></a>
                <a class="btn btn-primary text-white me-4" href="{{ route('forecast.permalink', ['city' => $city->name]) }}">
                    <i class="fa-solid {{$icon}}"></i> {{ $city->name }}
                </a>
            </p>
        @endforeach
    </div>

@endsection
