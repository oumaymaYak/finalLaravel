<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $primaryKey = 'id_commande';

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'lignes_de_commande', 'id_commande', 'id_article')
            ->withPivot('quantite_commande')
            ->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
