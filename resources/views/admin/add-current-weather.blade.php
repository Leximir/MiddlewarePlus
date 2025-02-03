@php use App\Models\CitiesModel;use App\Models\WeatherModel; @endphp
<form method="POST" action="{{ route('weather.update') }}">
    {{csrf_field()}}
    <input name="temperature" type="text" placeholder="Unesite temperaturu">
    <select name="city_id">
        @foreach(CitiesModel::all() as $city)
            <option value="{{$city->id}}">{{$city->name}}</option>
        @endforeach
    </select>
    <button type="submit">Snimi</button>
</form>



@foreach(WeatherModel::all() as $weather)
    <p>{{$weather->city->name}} - {{$weather->temperature}}</p>
@endforeach
