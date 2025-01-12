<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use Illuminate\Http\Request;

class MarqueController extends Controller
{
    public function index()
    {
        $marques = Marque::all();
        return view('marques.index', compact('marques'));
    }

    public function create()
    {
        return view('marques.create');
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire

        Marque::create($request->all());

        return redirect()->route('marques.index')->with('success', 'Marque ajoutée avec succès.');
    }

    // public function show($id)
    // {
    //     $marque = Marque::findOrFail($id);
    //     return view('marques.show', compact('marque'));
    // }

    // public function edit($id)
    // {
    //     $marque = Marque::findOrFail($id);
    //     return view('marques.edit', compact('marque'));
    // }

    // public function update(Request $request, $id)
    // {
    //     // Valider les données du formulaire

    //     $marque = Marque::findOrFail($id);
    //     $marque->update($request->all());

    //     return redirect()->route('marques.index')->with('success', 'Marque mise à jour avec succès.');
    // }

    // public function destroy($id)
    // {
    //     $marque = Marque::findOrFail($id);
    //     $marque->delete();

    //     return redirect()->route('marques.index')->with('success', 'Marque supprimée avec succès.');
    // }


}
