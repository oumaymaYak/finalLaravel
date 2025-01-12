<?php

// database/migrations/YYYY_MM_DD_create_lignes_de_commande_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLignesDeCommandeTable extends Migration
{
    public function up()
    {
        Schema::create('lignes_de_commande', function (Blueprint $table) {
            $table->id('id_ligne_de_commande');
            $table->unsignedBigInteger('id_commande');
            $table->unsignedBigInteger('id_article');
            $table->integer('quantite_commande');
            $table->timestamps();

            $table->foreign('id_commande')->references('id_commande')->on('commandes')->onDelete('cascade');
            $table->foreign('id_article')->references('id_article')->on('articles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lignes_de_commande');
    }
}
