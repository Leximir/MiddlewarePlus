@php use App\Http\Helpers\ForecastsHelper;use App\Models\CitiesModel;use App\Models\ForecastsModel; @endphp

@extends('admin.layout')
    <div class="container mt-3">
        <h1 class="mb-5">Kreiranje novog Forecasta</h1>
        <form action="{{ route('forecasts.update') }}" method="POST" class="d-flex">
            {{ csrf_field() }}

            <div class="mb-3">
                <select name="city_id" class="form-select">
                    @foreach(CitiesModel::all() as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <input name="temperature" placeholder="Unesite temperaturu" class="form-control" type="text">
            </div>

            <div class="mb-3">
                <select name="weather_type" class="form-select">

                    @foreach(ForecastsModel::WEATHERS as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <input name="probability" placeholder="Unesite sansu za padavine" class="form-control" type="text">
            </div>

            <div class="mb-3">
                <input name="date" type="date" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Snimi</button>
        </form>

        <div class="d-flex flex-wrap">
            @foreach($cities as $city)
                <div class="ms-2">
                    <p>{{ $city->name }}</p>
                    <ul class="list-group mb-4">
                        @foreach($city->forecasts as $forecasts)

                            @php $color=ForecastsHelper::getColorByTemperature($forecasts->temperature);@endphp

                            <li class="list-group-item">{{ $forecasts->date }} - <span style="color: {{ $color }}">{{ $forecasts->temperature }}</span></li>

                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>


    </div>
@section('content')
@endsection


