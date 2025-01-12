<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $primaryKey = 'id_article';

    protected $fillable = ['nom_article', 'prix', 'description', 'image', 'quantite_en_stock', 'id_categorie','id_marque'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie', 'id_categorie');
    }
    public function marque()
    {
        return $this->belongsTo(Marque::class, 'id_marque');
    }
    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'lignes_de_commande', 'id_article', 'id_commande')
            ->withPivot('quantite_commande')
            ->withTimestamps();
    }

}

 
