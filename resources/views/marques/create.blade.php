<!-- resources/views/marques/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Créer une Marque</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Erreur!</strong> Veuillez vérifier le formulaire ci-dessous.
            </div>
        @endif

        <form action="{{ route('marques.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nom_marque">Nom de la Marque:</label>
                <input type="text" class="form-control" id="nom_marque" name="nom_marque" required>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
