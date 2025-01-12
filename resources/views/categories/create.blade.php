@extends('layouts.app')

@section('content')
    <h2>Ajouter une Catégorie</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom_categorie">Nom de la Catégorie:</label>
            <input type="text" name="nom_categorie" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
@endsection
