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
        Schema::create('produits', function (Blueprint $table) {
            $table->id('id_Prd'); // Auto-incrementing primary key
            $table->unsignedBigInteger('id_cat');
            $table->string('Nom_Produit', 50);
            $table->string('Categorie', 50);
            $table->integer('Quantite');
            $table->integer('Prix_unitaire');
            $table->dateTime('Date_fabrication');
            $table->dateTime('Date_expiration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
