@extends('base')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Historiques /</span> Listes
</h4>
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th width="15px"></th>
                    <th>Identifiant de reservation</th>
                    <th>Numero de chambre</th>
                    <th>Nom du client</th>
                    <th>Date de debut</th>
                    <th>Date fin</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($reservationHistory as $reservationHistories)
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>{{ $reservationHistories->reservation_id }}</td>
                        <td>{{ $reservationHistories->chambre->numero }}</td>
                        <td>{{ $reservationHistories->client->nom }}</td>
                        <td>{{ $reservationHistories->date_debut }}</td>
                        <td>{{ $reservationHistories->date_fin }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Aucune historiques disponible.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
