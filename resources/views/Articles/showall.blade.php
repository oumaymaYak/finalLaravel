

@extends('layouts.app')
<style>



.articles-container {
    display: flex; /* Utiliser un conteneur flexible pour aligner les articles horizontalement */
    flex-wrap: wrap; /* Permettre aux articles de passer à la ligne lorsque l'espace est insuffisant */
    justify-content: space-around; /* Espacement égal entre les articles */
}

.article-container {
    flex: 0 0 calc(33.33% - 20px); /* Chaque article aura une largeur de 33.33%, en soustrayant la marge */
    max-width: 300px; /* Largeur maximale de chaque div article */
    margin: 20px; /* Marge autour de chaque div article */
    padding: 15px; /* Ajouter de l'espace intérieur à chaque div article */
    border: 1px solid #ddd; /* Ajouter une bordure avec une couleur grise */
    border-radius: 8px; /* Coins arrondis */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Ombre légère */
    text-align: center; /* Centrer le texte à l'intérieur de chaque div article */
    /* background-color: #f8d7da; Couleur de fond rose clair */
}


</style>
@section('content')
<h1 style="text-align:center ; font-family: Lucida Sans Unicode">TOUS LES ARTICLES</h1>

    <div class="articles-container">
       
        @foreach($articles as $article)
            <div class="article-container">
                <h3>{{ $article->nom_article }}</h3>
                @if($article->image)
                    <img src="{{ asset('images/' . $article->image) }}" alt="{{ $article->nom_article }}" style="max-width: 200px;">
                @endif
                <p>Prix: {{ $article->prix }}</p>
                <p>Description: {{ $article->description }}</p>
                <p>Marque: {{ $article->marque->nom_marque }}</p>
               
                <a style="background-color: black; color: #ddd;"  href="{{ route('articles.command', ['id_article' => $article->id_article]) }}" class="btn btn-info">Commander</a>

               
            </div>
        @endforeach
    </div>
    @if(session('success'))
    <div class="alert alert-success" style="text-align:center;">
        {{ session('success') }}
    </div>
@endif
@endsection
