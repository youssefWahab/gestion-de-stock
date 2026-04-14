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
        Schema::create('productions', function (Blueprint $table) {
            // $table->id('numProduction');
            // $table->string('chantier');
            // $table->string('numBonTransfert')->nullable();
            // $table->integer('quantite')->default(0);
            // $table->string('unite', 50)->nullable();
            // $table->decimal('coutReviens', 10, 2)->default(0);
            // $table->unsignedBigInteger('demande_achat_id'); 
            // $table->foreign('demande_achat_id')->references('id')->on('demande_achats')->onDelete('cascade');
            $table->id('numProduction');
            $table->string('chantier');
            $table->string('produitFinale');
            $table->string('numBonTransfert')->nullable();
            $table->integer('quantite')->default(0);
            $table->string('unite', 10)->nullable();
            $table->decimal('coutReviens', 10, 2)->default(0);
            
            // $table->unsignedBigInteger('demande_achat_id');
            // $table->foreign('demande_achat_id')->references('id')->on('demande_achats')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productions');
    }
};
