

@extends('layouts.app')

@section('content')
   

    <div class="article-container">

                <h1>Détails de l'article</h1>
                <h3>{{ $article->nom_article }}</h3>
                @if($article->image)
                    <img src="{{ asset('images/' . $article->image) }}" alt="{{ $article->nom_article }}" style="max-width: 200px;">
                @endif
                <p>Prix: {{ $article->prix }}</p>
                <p>Description: {{ $article->description }}</p>
                <p>Marque: {{ $article->marque->nom_marque }}</p>
    </div>

    <form method="post" action="{{ route('articles.confirmCommand', $article->id_article) }}">
        @csrf
        <label for="quantite">Quantité :</label>
        <input type="number" name="quantite" required>
        <button type="submit" style="background-color: black; color: #ddd;" class="btn btn-info">Confirmer commande</button>
    </form>
@endsection
