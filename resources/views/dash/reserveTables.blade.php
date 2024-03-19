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
<br><br>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th width="15px"></th>
                    <th>Numero de chambre</th>
                    <th>Clients</th>
                    <th>Dates debuts</th>
                    <th>Dates fin</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($reservations as $reservation)
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>{{ $reservation->chambre->numero }}</td>
                        <td>{{ $reservation->client->nom }} {{ $reservation->client->prenom }}</td>
                        <td>{{ $reservation->date_debut }}</td>
                        <td>{{ $reservation->date_fin }}</td>
                        <td>
                            <div class="dropdown">
                                    <a class="btn btn-primary btn-sm" href="{{ route('Reservations Edit', $reservation->id) }}">Edit</a>
                                    <form id="delete-form-{{ $reservation->id }}"
                                        action="{{ route('Reservations Destroy', $reservation->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a class="btn btn-danger btn-sm" href="#"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $reservation->id }}').submit();">
                                        Delete
                                    </a>                                    
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucune reservation disponible.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
