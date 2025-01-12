@extends('layouts.app')

@section('content')
    <h2>Modifier la Catégorie</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('categories.update', $categorie->id_categorie) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nom_categorie">Nom de la Catégorie:</label>
            <input type="text" name="nom_categorie" class="form-control" value="{{ $categorie->nom_categorie }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
@endsection
