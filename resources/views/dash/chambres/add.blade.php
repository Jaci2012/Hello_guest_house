@extends('base') <!-- Assurez-vous que le nom de la vue que vous avez défini dans votre page de base est correctement référencé ici -->

@section('content')
<div class="container">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Chambres /</span> Ajout
    </h4>

    <form id="formCategoryStore" class="mb-3" action="{{ route('Chambres Store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="numero" class="form-label">Numero</label>
            <input type="text" class="form-control" id="numero" name="numero" autofocus>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">Ajouter</button>
        </div>
    </form>
</div>


@endsection
