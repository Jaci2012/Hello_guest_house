@extends('base')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Chambres /</span> Listes
</h4>
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif
<a href="{{ route('Chambres Add') }}" class="btn btn-primary">Ajout</a>
    <br>
    <br>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th width="15px"></th>
                    <th>Numero</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($chambres as $chambre)
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>{{ $chambre->numero }}</td>
                        <td>{{ $chambre->statut }}</td>
                        <td>
                            <div class="dropdown">
                                    <a class="btn btn-primary btn-sm" href="{{ route('Chambres Edit', $chambre->id) }}">Edit</a>
                                    <form id="delete-form-{{ $chambre->id }}"
                                        action="{{ route('Chambres Destroy', $chambre->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a class="btn btn-danger btn-sm" href="#"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $chambre->id }}').submit();">
                                        Delete
                                    </a>                                    
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucune chambre disponible.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
