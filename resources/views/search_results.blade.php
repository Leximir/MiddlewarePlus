@php use Illuminate\Support\Facades\Session; @endphp
@extends('layout')

@section('content')

    <div class="d-flex flex-wrap container mt-5">

        @if(Session::has('error'))
            <p class="text-danger fw-bold col-12">{{ Session::get('error') }}</p>
            <a class="btn btn-primary" href="/login">Ulogujte se</a>
        @endif

        @foreach($cities as $city)

            @php
                $icon = \App\Http\Helpers\ForecastsHelper::getIconByWeatherType($city->todaysForecast->weather_type);
            @endphp

            <p>
                <a href="{{ route('city.favourite', ['city' => $city->id]) }}"><i
                        class="fa-regular fa-heart btn btn-primary text-white"></i></a>
                <a class="btn btn-primary text-white me-4"
                   href="{{ route('forecast.permalink', ['city' => $city->name]) }}">
                    <i class="fa-solid {{$icon}}"></i> {{ $city->name }}
                </a>
            </p>
        @endforeach
    </div>

@endsection
