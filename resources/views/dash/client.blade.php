@extends('base')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Clients /</span> Listes
</h4>
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif
<a href="{{ route('Clients Add') }}" class="btn btn-primary">Ajout</a>
    <br>
    <br>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th width="15px"></th>
                    <th>#ID</th>
                    <th>Nom & prénom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($clients as $client)
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>{{ $client->id }}</td>
                        <td>{{ $client->nom }} {{ $client->prenom }}</td>
                        <td>
                            <div class="dropdown">
                                    <a class="btn btn-primary btn-sm" href="{{ route('Clients Edit', $client->id) }}">Edit</a>
                                    <form id="delete-form-{{ $client->id }}"
                                        action="{{ route('Clients Destroy', $client->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a class="btn btn-danger btn-sm" href="#"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $client->id }}').submit();">
                                        Delete
                                    </a>                                    
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Aucune client disponible.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
