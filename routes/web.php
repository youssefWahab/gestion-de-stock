<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockMovementController;

Route::get('/', [StockMovementController::class, 'indexSorties'])->name('sorties.index');

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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
