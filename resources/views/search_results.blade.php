@extends('layout')

@section('content')

    @foreach($cities as $city)
        <p><a href="{{ route('forecast.permalink', ['city' => $city->name]) }}">{{ $city->name }}</a></p>
    @endforeach

@endsection
