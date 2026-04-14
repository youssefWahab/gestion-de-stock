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
        Schema::create('fiche_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fiche_numFiche');
            $table->string('articleDemande');
            $table->integer('quantite');
            $table->string('unite',10)->nullable();
            $table->timestamps();
            $table->foreign('fiche_numFiche')->references('numFiche')->on('fiche_commandes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiche_articles');
    }
};
