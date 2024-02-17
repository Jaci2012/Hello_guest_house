@extends('base')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Reservations /</span> Ajout
</h4>
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif
<form action="{{ route('Reservations Store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="chambre_id" class="form-label">Chambre Disponibles</label>
        <select class="form-control" name="chambre_id" id="chambre_id">
            <option value="">--Selectionnez--</option>
            @foreach($chambres as $chambre)
                @if($chambre->statut == 'non réservée')
                    <option value="{{ $chambre->id }}">{{ $chambre->numero }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="client_id" class="form-label">Client</label>
        <select class="form-control" name="client_id" id="client_id">
            <option value="">--Selectionnez--</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="date_debut" class="form-label">Date de début</label>
        <input type="date" class="form-control" name="date_debut" id="date_debut">
    </div>
    <div class="mb-3">
        <label for="date_fin" class="form-label">Date de fin</label>
        <input type="date" class="form-control" name="date_fin" id="date_fin">
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
@endsection
