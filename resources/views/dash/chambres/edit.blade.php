@extends('base') 
@section('content')
<div class="container">
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Chambres /</span> Édition
    </h4>

    <form id="formClientUpdate" class="mb-3" action="{{ route('Chambres Update', $chambre->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="numero" class="form-label">Numero</label>
            <input type="text" class="form-control" id="numero" name="numero" value="{{ $chambre->numero }}" autofocus>
        </div>
        
        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
