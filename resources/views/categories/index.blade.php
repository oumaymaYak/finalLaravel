@extends('layouts.app')

@section('content')
    <h2>Liste des Catégories</h2>

    <a href="{{ route('categories.create') }}" class="btn btn-success">Ajouter une Catégorie</a>
<!-- 
    @if($categories->count() > 0)
        <ul>
            @foreach($categories as $categorie)
                <li>{{ $categorie->nom_categorie }}
                    <a href="{{ route('categories.edit', $categorie->id_categorie) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('categories.destroy', $categorie->id_categorie) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?')">Supprimer</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>Aucune catégorie trouvée.</p>
    @endif -->

    <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de la Categorie</th>
                    <th>Action</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $categorie)
                    <tr>
                        <td>{{ $categorie->id_categorie }}</td>
                        <td>{{ $categorie->nom_categorie }}</td>
                        <td>
                        <a href="{{ route('categories.edit', $categorie->id_categorie) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('categories.destroy', $categorie->id_categorie) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?')">Supprimer</button>
                    </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection
