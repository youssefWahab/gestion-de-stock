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
        Schema::create('achat_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('demande_achat_id');
            $table->foreign('demande_achat_id')->references('id')->on('demande_achats')->onDelete('cascade');
            $table->unsignedBigInteger('stock_id')->nullable();
            $table->string('articleDemande');
            $table->integer('quantite');
            $table->string('unite',10)->nullable();
            $table->decimal('prix', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achat_articles');
    }
};
