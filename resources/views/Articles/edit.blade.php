@extends('layouts.app')

@section('content')
    <h2>Modifier l'Article</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('articles.update', $article->id_article) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nom_article">Nom de l'Article:</label>
            <input type="text" name="nom_article" class="form-control" value="{{ $article->nom_article }}" required>
        </div>
        <div class="form-group">
            <label for="prix">Prix:</label>
            <input type="number" name="prix" class="form-control" value="{{ $article->prix }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" required>{{ $article->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="quantite_en_stock">Quantité en Stock:</label>
            <input type="number" name="quantite_en_stock" class="form-control" value="{{ $article->quantite_en_stock }}" required>
        </div>
        <div class="form-group">
            <label for="id_categorie">Catégorie:</label>
            <select name="id_categorie" class="form-control" required>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id_categorie }}" {{ $categorie->id_categorie === $article->id_categorie ? 'selected' : '' }}>{{ $categorie->nom_categorie }}</option>
                @endforeach
            </select>
        </div>

        <!-- edit.blade.php -->
<div class="form-group">
    <label for="id_marque">Marque:</label>
    <select name="id_marque" class="form-control" required>
        @foreach($marques as $marque)
            <option value="{{ $marque->id_marque }}" {{ isset($article) && $article->id_marque === $marque->id_marque ? 'selected' : '' }}>{{ $marque->nom_marque }}</option>
        @endforeach
    </select>
</div>

        <div class="form-group">
            <label for="image">Image Actuelle:</label>
            @if($article->image)
                <img src="{{ asset('path/to/your/images/' . $article->image) }}" alt="Image Actuelle" style="max-width: 200px;">
            @else
                Aucune image
            @endif
        </div>
        <div class="form-group">
            <label for="image">Nouvelle Image:</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
@endsection
