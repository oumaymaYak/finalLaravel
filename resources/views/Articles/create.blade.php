@extends('layouts.app')

@section('content')
    <h2>{{ isset($article) ? 'Modifier l\'Article' : 'Ajouter un Article' }}</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ isset($article) ? route('articles.update', $article->id_article) : route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($article))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="nom_article">Nom de l'Article:</label>
            <input type="text" name="nom_article" class="form-control" value="{{ isset($article) ? $article->nom_article : '' }}" required>
        </div>
        <div class="form-group">
            <label for="prix">Prix:</label>
            <input type="number" name="prix" class="form-control" value="{{ isset($article) ? $article->prix : '' }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" required>{{ isset($article) ? $article->description : '' }}</textarea>
        </div>
        <div class="form-group">
            <label for="quantite_en_stock">Quantité en Stock:</label>
            <input type="number" name="quantite_en_stock" class="form-control" value="{{ isset($article) ? $article->quantite_en_stock : '' }}" required>
        </div>
        <div class="form-group">
            <label for="id_categorie">Catégorie:</label>
            <select name="id_categorie" class="form-control" required>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id_categorie }}" {{ isset($article) && $categorie->id_categorie === $article->id_categorie ? 'selected' : '' }}>{{ $categorie->nom_categorie }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
    <label for="id_marque">Marque:</label>
    <select name="id_marque" class="form-control" required>
        @foreach($marques as $marque)
            <option value="{{ $marque->id_marque }}">{{ $marque->nom_marque }}</option>
        @endforeach
    </select>
</div>
        @if(isset($article) && $article->image)
    <div class="form-group">
        <label>Image Actuelle:</label>
        <img src="{{ asset('images/' . $article->image) }}" alt="Image Actuelle" style="max-width: 200px;">
    </div>
@endif

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($article) ? 'Mettre à jour' : 'Ajouter' }}</button>
    </form>
@endsection
