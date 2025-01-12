<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id('id_article');
            $table->string('nom_article');
            $table->decimal('prix', 8, 2);
            $table->text('description');
            $table->string('image')->nullable();
            $table->integer('quantite_en_stock');
            $table->unsignedBigInteger('id_categorie'); // Utilisez unsignedBigInteger au lieu de foreignId
            $table->foreign('id_categorie')->references('id_categorie')->on('categories'); // Utilisez references sur 'id_categorie' de la table 'categories'
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
