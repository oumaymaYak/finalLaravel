<!-- resources/views/marques/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des Marques</h1>
        <a href="{{ route('marques.create') }}" class="btn btn-primary mb-2">Ajouter une Marque</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de la Marque</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach($marques as $marque)
                    <tr>
                        <td>{{ $marque->id_marque }}</td>
                        <td>{{ $marque->nom_marque }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
