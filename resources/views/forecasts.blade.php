@foreach($city->forecasts as $forecast)

    <p>Datum : {{ $forecast->date }} - Temperatura : {{ $forecast->temperature }}</p>

@endforeach
