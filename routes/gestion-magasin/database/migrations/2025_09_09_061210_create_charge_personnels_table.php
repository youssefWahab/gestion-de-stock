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
        Schema::create('charge_personnels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('numProduction');
            $table->string('nom');
            $table->string('role', 100)->nullable();
            // $table->integer('heures_travail')->default(0);
            // $table->decimal('cout_horaire', 10, 2)->default(0);
            $table->timestamps();
            $table->foreign('numProduction')->references('numProduction')->on('productions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charge_personnels');
    }
};
