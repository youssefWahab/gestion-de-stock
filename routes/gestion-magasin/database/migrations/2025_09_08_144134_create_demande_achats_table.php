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
        Schema::create('demande_achats', function (Blueprint $table) {
            $table->id();
            $table->string('numBonCommande')->unique();
            $table->unsignedBigInteger('numFiche');
            $table->foreign('numFiche')->references('numFiche')->on('fiche_commandes')->onDelete('cascade');
            $table->string('atelier');
            $table->string('natureTravaux',200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_achats');
    }
};
