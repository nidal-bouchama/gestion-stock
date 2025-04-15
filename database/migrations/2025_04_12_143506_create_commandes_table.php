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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id('id_Cmd');
            $table->unsignedBigInteger('id_Prd');
            $table->unsignedBigInteger('id_clt')->nullable();
            $table->integer('Quantite')->unsigned();
            $table->integer('Prix')->unsigned();
            $table->timestamp('Date_commande')->useCurrent();

            // Foreign key constraints
            $table->foreign('id_Prd')
                ->references('id_Prd')
                ->on('produits')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_clt')
                ->references('id_clt')
                ->on('clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
