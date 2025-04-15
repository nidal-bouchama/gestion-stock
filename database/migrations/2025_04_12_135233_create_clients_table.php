<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id('id_clt')->autoIncrement()->unique();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('Nom', 30);
            $table->string('Prenom', 30);
            $table->string('Telephone', 30);
            $table->string('Adresse', 60);
            $table->string('Email', 30)->nullable()->unique();
            $table->string('Password', 30)->nullable();

            $table->foreign('id_user')
                ->references('id_user')
                ->on('utilisateurs')
                ->onDelete('set null');

            $table->timestamps(); // Ajoute created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
