<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FicheCommandeController;
use App\Http\Controllers\StockMovementController;

Route::get('/', [StockMovementController::class, 'indexSorties'])->name('sorties.index');

// Routes personnalisées pour fiche-commande (sans resource)
Route::get('/fiche-commande', [FicheCommandeController::class, 'index'])->name('fiche-commande.index');
Route::get('/fiche-commande/ajouter', [FicheCommandeController::class, 'create'])->name('fiche-commande.create');
Route::post('/fiche-commande', [FicheCommandeController::class, 'store'])->name('fiche-commande.store');
Route::get('/fiche-commande/{id}', [FicheCommandeController::class, 'show'])->name('fiche-commande.show');
Route::get('/fiche-commande/{id}/modifier', [FicheCommandeController::class, 'edit'])->name('fiche-commande.edit');
Route::put('/fiche-commande/{id}', [FicheCommandeController::class, 'update'])->name('fiche-commande.update');
Route::delete('/fiche-commande/{id}', [FicheCommandeController::class, 'destroy'])->name('fiche-commande.destroy');

Route::get('/fiche-commande/{id}/generate', [FicheCommandeController::class, 'generateFiche'])->name('fiche-commande.generate');
// Route pour gerer les articles liés à une fiche de commande
Route::get('/fiche-commande/{id}/articles', [FicheCommandeController::class, 'manageArticles'])->name('fiche-commande.manage-articles');
// Route pour articles liés à une fiche de commande
use App\Http\Controllers\FicheArticleController;
// almost delete it
Route::get('/article-fiche/{id}/ajouter', [FicheArticleController::class, 'create'])->name('fiche-article.create');
Route::post('/article-fiche', [FicheArticleController::class, 'store'])->name('fiche-article.store');
Route::get('/article-fiche/{id}/modifier', [FicheArticleController::class, 'edit'])->name('fiche-article.edit');
Route::put('/article-fiche/{id}', [FicheArticleController::class, 'update'])->name('fiche-article.update');
Route::delete('/article-fiche/{id}', [FicheArticleController::class, 'destroy'])->name('fiche-article.destroy');
// Routes pour demande-achat
use App\Http\Controllers\DemandeAchatController;

Route::get('/demande-achat/rapport', [DemandeAchatController::class, 'rapport'])->name('demande-achat.rapport');
Route::get('/demande-achat/export-excel', [DemandeAchatController::class, 'exportDemandesExcel'])->name('demande-achat.export-excel');
Route::get('/demande-achat', [DemandeAchatController::class, 'index'])->name('demande-achat.index');
Route::get('/demande-achat/ajouter', [DemandeAchatController::class, 'create'])->name('demande-achat.create');
Route::post('/demande-achat', [DemandeAchatController::class, 'store'])->name('demande-achat.store');
Route::get('/demande-achat/{id}', [DemandeAchatController::class, 'show'])->name('demande-achat.show');
Route::get('/demande-achat/{id}/modifier', [DemandeAchatController::class, 'edit'])->name('demande-achat.edit');
Route::put('/demande-achat/{id}', [DemandeAchatController::class, 'update'])->name('demande-achat.update');
Route::delete('/demande-achat/{id}', [DemandeAchatController::class, 'destroy'])->name('demande-achat.destroy');


Route::get('/demande-achat/{id}/generate', [DemandeAchatController::class, 'downloadDemandeAndFiche'])->name('demande-achat.generate');
// generateDemande
// Route::get('/demande-achat/export-excel', [DemandeAchatController::class, 'exportDemandesExcel'])->name('demande-achat.export-excel');
// Route::get('/demande-achat/{numFiche}/fiche', [DemandeAchat::class, 'manageFiche'])->name('demande-achat.manage');

Route::put('/demande-achat/{fiche}/change', [DemandeAchatController::class, 'changeFiche'])->name('demande-achat.change');

// pour gerer les articles liés à une demande d'achat
Route::get('/demande-achat/{id}/articles', [DemandeAchatController::class, 'manageArticles'])->name('demande-achat.manage-articles');
Route::get('/demande-achat/{id}/fiche', [DemandeAchatController::class, 'manageFiche'])->name('demande-achat.manage-fiche');





// Route pour articles liés à une fiche de commande
use App\Http\Controllers\AchatArticleController;
use App\Http\Controllers\ProductionArticleController;

Route::get('/article-achat', [AchatArticleController::class, 'index'])->name('article-achat.index');
Route::get('/article-achat/{id}/ajouter', [AchatArticleController::class, 'create'])->name('article-achat.create');
Route::post('/article-achat', [AchatArticleController::class, 'store'])->name('article-achat.store');
Route::get('/article-achat/{id}/modifier', [AchatArticleController::class, 'edit'])->name('article-achat.edit');
Route::put('/article-achat/{id}', [AchatArticleController::class, 'update'])->name('article-achat.update');
Route::delete('/article-achat/{id}', [AchatArticleController::class, 'destroy'])->name('article-achat.destroy');





// Routes pour production
use App\Http\Controllers\ProductionController;
Route::get('/production', [ProductionController::class, 'index'])->name('production.index');
Route::get('/production/ajouter', [ProductionController::class, 'create'])->name('production.create');
Route::post('/production', [ProductionController::class, 'store'])->name('production.store');
Route::get('/production/{id}', [ProductionController::class, 'show'])->name('production.show');
Route::get('/production/{id}/modifier', [ProductionController::class, 'edit'])->name('production.edit');
Route::put('/production/{id}', [ProductionController::class, 'update'])->name('production.update');
Route::delete('/production/{id}', [ProductionController::class, 'destroy'])->name('production.destroy');

// pour gerer les articles liés à une demande d'achat
Route::get('/production/{id}/articles', [ProductionController::class, 'manageArticles'])->name('production.manage-articles');
// Routes pour  gerer les articles liés à une production
Route::get('/production-article', [ProductionArticleController::class, 'index'])->name('production-article.index');
Route::get('/production-article/{id}/ajouter', [ProductionArticleController::class, 'create'])->name('production-article.create');
Route::post('/production-article', [ProductionArticleController::class, 'store'])->name('production-article.store');
Route::get('/production-article/{id}/modifier', [ProductionArticleController::class, 'edit'])->name('production-article.edit');
Route::put('/production-article/{id}', [ProductionArticleController::class, 'update'])->name('production-article.update');
Route::delete('/production-article/{id}', [ProductionArticleController::class, 'destroy'])->name('production-article.destroy');

// Routes pour consommation
use App\Http\Controllers\ConsommationController;
use App\Http\Controllers\DashboardController;

Route::get('/consommation', [ConsommationController::class, 'index'])->name('consommation.index');
Route::get('/consommation/ajouter', [ConsommationController::class, 'create'])->name('consommation.create');
Route::post('/consommation', [ConsommationController::class, 'store'])->name('consommation.store');
Route::get('/consommation/{id}', [ConsommationController::class, 'show'])->name('consommation.show');
Route::get('/consommation/{id}/modifier', [ConsommationController::class, 'edit'])->name('consommation.edit');
Route::put('/consommation/{id}', [ConsommationController::class, 'update'])->name('consommation.update');
Route::delete('/consommation/{id}', [ConsommationController::class, 'destroy'])->name('consommation.destroy');
// Routes pour stock
use App\Http\Controllers\StockController;
Route::get('/stock/export-excel/', [StockController::class, 'exportToExcel'])->name('stock.export-excel');
Route::get('/stock/export-excel/avec-mouvements', [StockController::class, 'exportWithMovementsToExcel'])->name('stock.export-excel-with-movements');
Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
Route::get('/stock/ajouter', [StockController::class, 'create'])->name('stock.create');
Route::post('/stock', [StockController::class, 'store'])->name('stock.store');
Route::get('/stock/{id}', [StockController::class, 'show'])->name('stock.show');
Route::get('/stock/{id}/modifier', [StockController::class, 'edit'])->name('stock.edit');
Route::put('/stock/{id}', [StockController::class, 'update'])->name('stock.update');
Route::delete('/stock/{id}', [StockController::class, 'destroy'])->name('stock.destroy');
// Routes pour movements des stocks


// ---- Entrées ----
Route::get('/stock/entrees/export-entrees', [StockController::class, 'exportEntreesToExcel'])->name('stock.export-entrees');
Route::get('/stocks/entrees', [StockMovementController::class, 'indexEntrees'])->name('entrees.index');
Route::get('/stocks/entrees/ajouter', [StockMovementController::class, 'createEntree'])->name('entrees.create');
Route::post('/stocks/entrees', [StockMovementController::class, 'storeEntree'])->name('entrees.store');
Route::get('/stocks/entrees/{id}/modifier', [StockMovementController::class, 'editEntree'])->name('entrees.edit');
Route::get('/stocks/entrees/{id}', [StockMovementController::class, 'show'])->name('entrees.show');
Route::put('/stocks/entrees/{id}', [StockMovementController::class, 'update'])->name('entrees.update');
Route::delete('/stocks/entrees/{id}', [StockMovementController::class, 'destroy'])->name('entrees.destroy');


// ---- Sorties ----
Route::get('/stock/sorties/export-sorties', [StockController::class, 'exportSortiesToExcel'])->name('stock.export-sorties');
Route::get('/stocks/sorties', [StockMovementController::class, 'indexSorties'])->name('sorties.index');
Route::get('/stocks/sorties/create', [StockMovementController::class, 'createSortie'])->name('sorties.create');
Route::post('/stocks/sorties', [StockMovementController::class, 'storeSortie'])->name('sorties.store');
Route::get('/stocks/sorties/{id}/edit', [StockMovementController::class, 'editSortie'])->name('sorties.edit');
Route::get('/stocks/sorties/{id}', [StockMovementController::class, 'show'])->name('sorties.show');
Route::put('/stocks/sorties/{id}', [StockMovementController::class, 'update'])->name('sorties.update');
Route::delete('/stocks/sorties/{id}', [StockMovementController::class, 'destroy'])->name('sorties.destroy');
// ---- Emprunts ----
Route::get('/stocks/emprunts', [StockMovementController::class, 'indexEmprunts'])->name('emprunts.index');
Route::get('/stocks/emprunts/create', [StockMovementController::class, 'createEmprunt'])->name('emprunts.create');
Route::post('/stocks/emprunts', [StockMovementController::class, 'storeEmprunt'])->name('emprunts.store');
Route::get('/stocks/emprunts/{id}/edit', [StockMovementController::class, 'editEmprunt'])->name('emprunts.edit');
Route::get('/stocks/emprunts/{id}', [StockMovementController::class, 'show'])->name('emprunts.show');
Route::put('/stocks/emprunts/{id}', [StockMovementController::class, 'update'])->name('emprunts.update');
Route::delete('/stocks/emprunts/{id}', [StockMovementController::class, 'destroy'])->name('emprunts.destroy');
Route::get('/stocks/emprunts/{id}/retours', [StockMovementController::class, 'return'])->name('emprunts.return');
// ---- Retours ----
Route::get('/stocks/retours', [StockMovementController::class, 'indexRetours'])->name('retours.index');
Route::get('/stocks/retours/create', [StockMovementController::class, 'createRetour'])->name('retours.create');
Route::post('/stocks/retours', [StockMovementController::class, 'storeRetour'])->name('retours.store');
Route::get('/stocks/retours/{id}/edit', [StockMovementController::class, 'editRetour'])->name('retours.edit');
Route::get('/stocks/retours/{id}', [StockMovementController::class, 'show'])->name('retours.show');
Route::put('/stocks/retours/{id}', [StockMovementController::class, 'update'])->name('retours.update');
Route::delete('/stocks/retours/{id}', [StockMovementController::class, 'destroy'])->name('retours.destroy');
// Entrées
// Route::prefix('/stocks/entrees')->group(function () {
//     Route::get('/', [StockMovementController::class, 'indexEntrees'])->name('entrees.index');
//     Route::get('/create', [StockMovementController::class, 'createEntree'])->name('entrees.create');
//     Route::post('/store', [StockMovementController::class, 'storeEntree'])->name('entrees.store');
//     Route::get('/{id}/edit', [StockMovementController::class, 'editEntree'])->name('entrees.edit');
//     Route::put('/{id}', [StockMovementController::class, 'update'])->name('entrees.update');
//     Route::delete('/{id}', [StockMovementController::class, 'destroy'])->name('entrees.destroy');
// });

// Sorties
// Route::prefix('/stock/sorties')->group(function () {
//     Route::get('/', [StockMovementController::class, 'indexSorties'])->name('sorties.index');
//     Route::get('/create', [StockMovementController::class, 'createSortie'])->name('sorties.create');
//     Route::post('/store', [StockMovementController::class, 'storeSortie'])->name('sorties.store');
//     Route::get('/{id}/edit', [StockMovementController::class, 'editEntree'])->name('sorties.edit'); // reuse edit function
//     Route::put('/{id}', [StockMovementController::class, 'update'])->name('sorties.update');      // reuse update
//     Route::delete('/{id}', [StockMovementController::class, 'destroy'])->name('sorties.destroy');  // reuse destroy
// });


// Routes pour stockDashboard
Route::get('/stock-dashboard', function () {
    return view('stockDashboard');
})->name('stockDashboard');
// Route pour fiche article
Route::get('/fiche-article', [FicheArticleController::class, 'index'])->name('fiche-article.index');
Route::get('/fiche-article/ajouter', [FicheArticleController::class, 'create'])->name('fiche-article.create');
Route::post('/fiche-article', [FicheArticleController::class, 'store'])->name('fiche-article.store');
Route::get('/fiche-article/{id}', [FicheArticleController::class, 'show'])->name('fiche-article.show');
Route::get('/fiche-article/{id}/modifier', [FicheArticleController::class, 'edit'])->name('fiche-article.edit');
Route::put('/fiche-article/{id}', [FicheArticleController::class, 'update'])->name('fiche-article.update');
Route::delete('/fiche-article/{id}', [FicheArticleController::class, 'destroy'])->name('fiche-article.destroy');




Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
