@foreach($forecast as $city => $temperature)
    <p>Trenutno je {{ $temperature }} stepena u gradu: {{ $city }}.</p>
@endforeach
