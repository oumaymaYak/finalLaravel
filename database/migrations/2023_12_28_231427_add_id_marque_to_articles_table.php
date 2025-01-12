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
    Schema::table('articles', function (Blueprint $table) {
        $table->unsignedBigInteger('id_marque')->nullable();
        $table->foreign('id_marque')->references('id_marque')->on('marques');
    });
    }

      
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            //
        });
    }
};
