@extends('layouts.dashboard')
@section('title', 'Clients')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Liste des Clients</h1>
<a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Ajouter un client</a>
    @if(isset($clients) && count($clients) > 0)
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Email</th>
<th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->id_clt }}</td>
                            <td>{{ $client->Nom }}</td>
                            <td>{{ $client->Prenom }}</td>
                            <td>{{ $client->Telephone }}</td>
                            <td>{{ $client->Adresse }}</td>
                            <td>{{ $client->Email }}</td>
                            <td>
                                <a href="{{ route('clients.edit', $client->id_clt) }}" class="btn btn-sm btn-warning">Modifier</a>
                                <form action="{{ route('clients.destroy', $client->id_clt) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce client ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">Aucun client trouvé.</div>
    @endif
</div>
@endsection

@section('head')
    <link rel="icon" type="image" href="Images/logo.svg">
@endsection
