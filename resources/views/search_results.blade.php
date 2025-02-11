@extends('layout')

@section('content')

    @foreach($cities as $city)
        <p> {{ $city->name }}</p>
    @endforeach

@endsection
