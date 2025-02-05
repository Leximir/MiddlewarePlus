@php use App\Http\Helpers\ForecastsHelper;use App\Models\CitiesModel;use App\Models\ForecastsModel; @endphp
<form action="{{ route('forecasts.update') }}" method="POST">
    {{ csrf_field() }}
    <select name="city_id" id="">
        @foreach(CitiesModel::all() as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
        @endforeach
    </select>
    <input name="temperature" placeholder="Unesite temperaturu" type="text">
    <select name="weather_type">
        @foreach(ForecastsModel::WEATHERS as $type)
            <option value="{{ $type }}">{{ $type }}</option>
        @endforeach
    </select>
    <input name="probability" placeholder="Unesite sansu za padavine" type="text">
    <input name="date" type="date">
    <button type="submit">Snimi</button>
</form>

@foreach($cities as $city)
    <p>{{ $city->name }}</p>
    <ul>
        @foreach($city->forecasts as $forecasts)

            @php $color=ForecastsHelper::getColorByTemperature($forecasts->temperature);@endphp

            <li>{{ $forecasts->date }} - <span style="color: {{ $color }}">{{ $forecasts->temperature }}</span></li>

        @endforeach
    </ul>
@endforeach
