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
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id('id_user'); // Equivalent à INT AUTO_INCREMENT PRIMARY KEY
            $table->string('Nom', 30)->nullable();
            $table->string('Prenom', 30)->nullable();
            $table->string('Email', 30)->nullable()->unique();
            $table->string('Password', 30)->nullable();
            $table->enum('Role', ['admin', 'client'])->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
