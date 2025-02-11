@extends('layout')

@section('content')

    @foreach($cities as $city)

        @php
        $icon = \App\Http\Helpers\ForecastsHelper::getIconByWeatherType($city->todaysForecast->weather_type);
        @endphp

        <p><a href="{{ route('forecast.permalink', ['city' => $city->name]) }}">
                <i class="fa-solid {{$icon}}"></i> {{ $city->name }}
        </a></p>
    @endforeach

@endsection
