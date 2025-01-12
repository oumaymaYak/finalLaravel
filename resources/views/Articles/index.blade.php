@extends('layouts.app')

@section('content')
<div >
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des Articles</h2>
        <a href="{{ route('articles.create') }}" class="btn btn-success">Ajouter un Article</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-hover table-striped" border="1"  style="background-color:#deeaee" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom de l'Article</th>
                <th>Prix</th>
                <th>Description</th>
                <th>Quantité en Stock</th>
                <th>Catégorie</th>
                <th>Marque</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->id_article }}</td>
                    <td>{{ $article->nom_article }}</td>
                    <td>{{ $article->prix }}</td>
                    <td>{{ $article->description }}</td>
                    <td>{{ $article->quantite_en_stock }}</td>
                    <td>{{ $article->categorie->nom_categorie }}</td>
                    <td>{{ $article->marque->nom_marque }}</td>-

                    <td>
                        @if($article->image)
                            <img src="{{ asset('images/' . $article->image) }}" alt="Image de l'Article" style="max-width: 50px;">
                        @else
                            Aucune image
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('articles.edit', $article->id_article) }}" class="btn btn-primary" style="font-size: 5px;" >Modifier</a>
                        <form action="{{ route('articles.destroy', $article->id_article) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button style="font-size: 5px;" type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
