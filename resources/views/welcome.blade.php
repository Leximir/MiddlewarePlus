@extends('layout')

@section('content')

    <form method="GET" action="{{ route('forecast.search') }}">
        <div>
            <input type="text" name="city" placeholder="Unesite ime grada">
        </div>
        <button type="submit">Pronadji</button>
    </form>

@endsection
