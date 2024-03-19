@extends('base')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Reservations /</span> Listes
</h4>
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif
<div class="container">
    <div id="reservations-calendar">
        <div class="calendar-navigation">
            <button id="prev-week">&#10094;</button>
            <div class="dates-header" style="flex-grow: 1;">
                <!-- Les dates initiales seront chargées ici et mises à jour dynamiquement par le script JS -->
                @foreach($dates as $date)
                <span class="date">{{ $date['formatted'] }}</span>
                @endforeach
            </div>
            <button id="next-week">&#10095;</button>
        </div>
        <div class="rooms-availability">
            @foreach($chambres as $chambre)
            <div class="room-availability">
                <p>{{ $chambre->numero }}</p>
                @foreach($dates as $date)
                    <div class="date-availability">
                        <input type="checkbox" 
                            id="room{{ $chambre->id }}-date{{ $date['date'] }}" 
                            data-room-id="{{ $chambre->id }}" 
                            data-date="{{ $date['date'] }}"
                            @if(isset($datesReserveesParChambre[$chambre->id][$date['date']]))
                            checked disabled
                            @else
                            disabled
                            @endif>
                        <label for="room{{ $chambre->id }}-date{{ $date['date'] }}"></label>
                    </div>
                    @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
