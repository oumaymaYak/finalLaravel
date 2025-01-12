<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $primaryKey = 'id_categorie';
    protected $fillable = ['nom_categorie'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'id_categorie', 'id_categorie');
    }
}
