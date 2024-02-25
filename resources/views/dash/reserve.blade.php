@extends('base')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">État global des chambres</span>
    </h4>
    <a href="{{ route('Reservations Add') }}" class="btn btn-success btn-sm">Ajouter</a><br><br>

    <div class="row">
        @foreach($chambres as $chambre)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        Chambre {{ $chambre->numero }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Disponibilité</h5>
                        @if($chambre->estDisponible())
                            <p class="card-text text-success">Disponible</p>
                            <!-- Formulaire de réservation avec sélecteur de date -->
                            <form action="{{ route('Reservations Add') }}" method="GET">
                                <input type="hidden" name="chambre_id" value="{{ $chambre->id }}">
                                <label for="date_debut">Date de début :</label>
                                <input type="date" id="date_debut" name="date_debut" value="{{ now()->toDateString() }}">
                                <button type="submit" class="btn btn-primary">Réserver</button>
                            </form>
                        @else
                            <p class="card-text text-danger">Occupée</p>
                            <h5 class="card-title">Dates d'occupation</h5>
                            @foreach($chambre->reservations as $reservation)
                                <p class="card-text">{{ $reservation->date_debut }} - {{ $reservation->date_fin }}</p>
                                <p class="card-text">Réservé par: {{ $reservation->client->nom }}</p>
                                <!-- Bouton "Supprimer" pour chaque réservation -->
                                <form action="{{ route('Reservations Destroy', ['id' => $reservation->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
