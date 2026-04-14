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
        Schema::create('consommations', function (Blueprint $table) {
            // $table->id('numConsommation');
            // $table->string('chantier');
            // $table->integer('quantiteDemande');
            // $table->integer('quantiteConsomme');
            // $table->string('unite');
            // $table->decimal('coutUnitaire', 10, 2);
            // $table->timestamps();
            // $table->unsignedBigInteger('demande_achat_id'); // numeric foreign key
            // $table->foreign('demande_achat_id')->references('id')->on('demande_achats')->onDelete('cascade');
            $table->id();
            $table->string('chantier');
            $table->string('article');
            $table->integer('quantiteDemande');
            $table->integer('quantiteConsomme');
            $table->string('unite',10);
            $table->decimal('coutUnitaire', 10, 2);
            $table->timestamps();

            // Relations
            $table->unsignedBigInteger('demande_achat_id');
            // $table->unsignedBigInteger('article_id'); 
            $table->unsignedBigInteger('numProduction')->nullable(); 

            $table->foreign('demande_achat_id')->references('id')->on('demande_achats')->onDelete('cascade');
            // $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('numProduction')->references('numProduction')->on('productions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consommations');
    }
};
