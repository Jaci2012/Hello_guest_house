@extends('base') <!-- Assurez-vous que le nom de la vue que vous avez défini dans votre page de base est correctement référencé ici -->

@section('content')
<div class="container">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Clients /</span> Ajout
    </h4>

    <form id="formCategoryStore" class="mb-3" action="{{ route('Clients Store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" autofocus>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" autofocus>
        </div>
        <div class="mb-3">
            <label for="identifiant" class="form-label">ID</label>
            <input type="text" class="form-control" id="identifiant" name="identifiant" autofocus>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">Ajouter</button>
        </div>
    </form>
</div>


@endsection
