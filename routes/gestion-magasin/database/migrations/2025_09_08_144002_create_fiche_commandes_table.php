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
        Schema::create('fiche_commandes', function (Blueprint $table) {
            $table->id('numFiche');
            $table->string('nomDemandeur',100);
            $table->string('chantier',150);
            $table->string('chefAtelier',100);
            $table->string('atelier',100);
            $table->date('dateCommande');
            $table->string('schemaPlan')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiche_commandes');
    }
};
