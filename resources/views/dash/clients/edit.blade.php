@extends('base') 
@section('content')
<div class="container">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Clients /</span> Édition
    </h4>

    <form id="formClientUpdate" class="mb-3" action="{{ route('Clients Update', $client->id) }}" method="POST">
        @csrf
        @method('PUT') 

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ $client->nom }}" autofocus>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $client->prenom }}" autofocus>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
