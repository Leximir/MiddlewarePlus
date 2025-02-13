@extends('layout')

@section('content')

    <form method="GET" action="{{ route('forecast.search') }}">

        <h1><i class="fa-solid fa-house"></i> Pronadji svoj grad</h1>

        @if(\Illuminate\Support\Facades\Session::has('error'))
            <p>{{ \Illuminate\Support\Facades\Session::get('error') }}</p>
        @endif

        <div>
            <input type="text" name="city" placeholder="Unesite ime grada">
        </div>
        <button type="submit">Pronadji</button>
    </form>

    @foreach($userFavourites as $userFavourite)
        <p>{{ ($userFavourite->city->name) }}: {{ ($userFavourite->city->todaysForecast->temperature) }}</p>
    @endforeach

@endsection
