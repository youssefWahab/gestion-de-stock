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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('article');
            $table->string('atelier');
            $table->string('unite')->nullable();
            $table->integer('entree')->default(0);
            $table->integer('sortie')->default(0);
            $table->integer('stockInitial')->default(0);
            $table->integer('stockActuel');
            $table->integer('minimum')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
