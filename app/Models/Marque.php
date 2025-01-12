<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    protected $primaryKey = 'id_marque';
    protected $fillable = ['nom_marque'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'id_marque');
    }
}
