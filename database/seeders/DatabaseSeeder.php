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
        FicheCommande::factory(10)->create();


        DemandeAchat::factory(10)->create();

        Stock::factory(15)->create();

        Production::factory(5)->create();

        Consommation::factory(10)->create();

        ChargePersonnel::factory(10)->create();

        ProductionArticle::factory(10)->create();

        FicheArticle::factory(10)->create();

        AchatArticle::factory(10)->create();

        StockMovement::factory()->count(25)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
