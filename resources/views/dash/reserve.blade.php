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
<a href="{{ route('Reservations Add') }}" class="btn btn-primary">Ajout</a>
    <br>
    <br>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th width="15px"></th>
                    <th>#ID</th>
                    <th>Numero de chambre</th>
                    <th>Nom du client</th>
                    <th>Date de debut</th>
                    <th>Date fin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($reservations as $reservation)
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->chambre->numero }}</td>
                        <td>{{ $reservation->client->nom }}</td>
                        <td>{{ $reservation->date_debut }}</td>
                        <td>{{ $reservation->date_fin }}</td>
                        <td>
                            <td>
                                <div class="dropdown">
                                    <form action="{{ route('Reservations Destroy', $reservation->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Aucune reservation disponible.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
