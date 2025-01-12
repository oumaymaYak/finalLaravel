<?php

    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use App\Models\Article;
    use App\Models\Categorie;
use App\Models\Commande;
use App\Models\LigneDeCommande;
use App\Models\Marque;
use Illuminate\Support\Facades\Auth;

    class ArticleController extends Controller
    {
        public function index()
        {
            $articles = Article::with('categorie')->get();
           $articles = Article::with('marque')->get();

            return view('articles.index', compact('articles'));
        }

        
       
        

    
        public function create()
        {
            $categories = Categorie::all();

            $marques = Marque::all();
        return view('articles.create', compact('categories', 'marques'));
    }
        
    
        public function store(Request $request)
        {

            
            $request->validate([
                'nom_article' => 'required|string|max:255',
                'prix' => 'required|numeric',
                'description' => 'required|string',
                'quantite_en_stock' => 'required|integer',
                'id_categorie' => 'required|exists:categories,id_categorie',

                'id_marque' => 'required|exists:marques,id_marque',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            $articleData = $request->except('image');
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $articleData['image'] = $imageName;
            }
    
            Article::create($articleData);
    
            return redirect()->route('articles.index')->with('success', 'Article créé avec succès.');
        }
    
        public function update(Request $request, $id_article)
        {
            $request->validate([
                'nom_article' => 'required|string|max:255',
                'prix' => 'required|numeric',
                'description' => 'required|string',
                'quantite_en_stock' => 'required|integer',
                'id_categorie' => 'required|exists:categories,id_categorie',
                'id_marque' => 'required|exists:marques,id_marque',

                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            $articleData = $request->except('image');
    
            $article = Article::findOrFail($id_article);
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $articleData['image'] = $imageName;
    
                
                if ($article->image) {
                    unlink(public_path('images/' . $article->image));
                }
            }
    
            $article->update($articleData);
    
            return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès.');
        }
    
      



        public function destroy($id_article)
{
    $article = Article::findOrFail($id_article);

    if ($article->image) {
        unlink(public_path('images/' . $article->image));
    }

    $article->delete();

    return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès.');
}

public function edit($id_article)
{
    $article = Article::findOrFail($id_article);
    $categories = Categorie::all();
    $marques = Marque::all();
        return view('articles.edit', compact('article', 'categories', 'marques'));
    
     // Assurez-vous d'avoir la liste des catégories disponible

}

public function showall()
{
    $articles = Article::all();
    return view('articles.showall', compact('articles'));
}


public function showCommandPage($id_article)
{
    $article = Article::find($id_article);
    return view('articles.command', compact('article'));
}
public function confirmCommand(Request $request, $id_article)
{
    // Valider le formulaire
    $request->validate([
        'quantite' => 'required|integer|min:1',
    ]);

    // Créer une nouvelle commande
    $commande = new Commande();
    $commande->date_commande = now();
    $commande->user_id = Auth::id(); 
    $commande->save();

    // Ajouter une ligne de commande pour l'article
    $ligneDeCommande = new LigneDeCommande();
    $ligneDeCommande->id_commande = $commande->id_commande;
    $ligneDeCommande->id_article = $id_article;
    $ligneDeCommande->quantite_commande = $request->input('quantite');
    $ligneDeCommande->save();

    return redirect()->route('articles.showall')->with('success', 'Commande confirmée avec succès.');
}



    }