@foreach($forecast as $weather)
    <p>Trenutno je {{ $weather->temperature }} stepena u gradu: {{ $weather->city->name }}</p>
@endforeach
