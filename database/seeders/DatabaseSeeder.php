<?php

namespace Database\Seeders;

use App\Models\AchatArticle;
use App\Models\ChargePersonnel;
use App\Models\Consommation;
use App\Models\DemandeAchat;
use App\Models\FicheArticle;
use App\Models\FicheCommande;
use App\Models\Production;
use App\Models\ProductionArticle;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(3)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
