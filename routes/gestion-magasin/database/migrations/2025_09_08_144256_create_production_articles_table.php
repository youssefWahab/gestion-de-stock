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
        Schema::create('production_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('numProduction');
            $table->string('articleDemande');
            // $table->unsignedBigInteger('numBonCommande')->nullable();
            $table->integer('quantite')->default(0);
            $table->string('unite', 10)->nullable();
            $table->decimal('prix', 10, 2)->default(0);
            $table->foreign('numProduction')->references('numProduction')->on('productions')->onDelete('cascade');
            // $table->unsignedBigInteger('article_id'); 
            // $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_articles');
    }
};
