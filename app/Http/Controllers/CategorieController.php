<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_categorie' => 'required|string|max:255',
        ]);

        Categorie::create($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    public function edit($id_categorie)
    {
        $categorie = Categorie::findOrFail($id_categorie);
        return view('categories.edit', compact('categorie'));
    }

    public function update(Request $request, $id_categorie)
    {
        $request->validate([
            'nom_categorie' => 'required|string|max:255',
        ]);

        $categorie = Categorie::findOrFail($id_categorie);
        $categorie->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy($id_categorie)
    {
        $categorie = Categorie::findOrFail($id_categorie);
        $categorie->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
}
