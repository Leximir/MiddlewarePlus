@foreach($city->forecasts as $forecast)

    <p>Sunrise: {{ $sunrise }}</p>
    <p>Sunset: {{ $sunset }}</p>
    <p>Datum : {{ $forecast->date }} - Temperatura : {{ $forecast->temperature }}</p>

@endforeach
