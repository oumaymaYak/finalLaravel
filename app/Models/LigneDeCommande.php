<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LigneDeCommande extends Model
{
    protected $table = 'lignes_de_commande';

    protected $primaryKey = 'id_ligne_de_commande';

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'id_commande');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'id_article');
    }
}
