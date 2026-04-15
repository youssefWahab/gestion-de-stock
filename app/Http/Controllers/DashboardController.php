<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FicheCommande;
use App\Models\DemandeAchat;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\Production;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stocksCount = Stock::count();
        $entreesCount = StockMovement::where('type','entree')->count();
        $sortiesCount = StockMovement::where('type','sortie')->count();
        $empruntsCount = StockMovement::where('type','emprunt')->count();

        $topSorties = StockMovement::select('stock_id', DB::raw('SUM(quantite) as total_sortie'))
            ->where('type', 'sortie')
            ->groupBy('stock_id')
            ->orderByDesc('total_sortie')
            ->limit(10)
            ->get();

        $topStocks = Stock::select('article', 'entree', 'sortie')->orderByDesc('sortie')->limit(15)->get();

        $stockLabels = $topStocks->pluck('article');
        $stockEntrees = $topStocks->pluck('entree');
        $stockSorties = $topStocks->pluck('sortie');


        $productions = Production::all();
        $productionLabels = $productions->pluck('produitFinale');
        $productionQuantites = $productions->pluck('quantite');


        
        $sortieLabels = $topSorties->map(function($item) {
            return optional($item->stock)->article ?? 'Unknown';
        });

        $sortieQuantites = $topSorties->pluck('total_sortie');

        $totalSorties = $sortieQuantites->sum();
        $sortiePercentages = $sortieQuantites->map(function($q) use ($totalSorties) {
            return round(($q / $totalSorties) * 100, 1);
        });

        $categorieCounts = Stock::select('categorie', DB::raw('count(*) as total'))
        ->groupBy('categorie')
        ->orderBy('categorie')
        ->get();

        $productionsThisWeek = Production::whereBetween('created_at', [
        Carbon::now()->startOfWeek(),
        Carbon::now()->endOfWeek(),
        ])->count();
        $productionsThisMonth = Production::whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->count();
        

        $mostActiveAtelier = Production::select('chantier', DB::raw('SUM(quantite) as total'))
        ->groupBy('chantier')
        ->orderByDesc('total')
        ->first();

    $topChantiers = DB::table('productions')
        ->select('chantier', DB::raw('SUM(quantite) as total'))
        ->groupBy('chantier')
        ->orderByDesc('total')
        ->limit(5) 
        ->get();

        
        $topArticles = DB::table('achat_articles')
            ->select(
                'articleDemande',
                DB::raw('SUM(quantite) as total_quantite'),
                'unite',
                DB::raw('SUM(prix * quantite) as total_prix')
            )
            ->groupBy('articleDemande', 'unite')
            ->orderByDesc('total_quantite')
            ->limit(5)
            ->get();
        
        $topFicheArticles = DB::table('fiche_articles')
            ->select(
                'articleDemande',
                DB::raw('SUM(quantite) as total_quantite'),
                'unite'
            )
            ->groupBy('articleDemande', 'unite')
            ->orderByDesc('total_quantite')
            ->limit(5)
            ->get();
        
        $recentStockMovements = StockMovement::with('stock')
        ->orderBy('date_movement', 'desc')
        ->limit(5)
        ->get();


        return view('dashboard.index', compact(
            'stocksCount',
            'entreesCount',
            'sortiesCount',
            'empruntsCount',
            'stockLabels',
            'stockEntrees',
            'stockSorties',
            'categorieCounts',
            'productionLabels',// remove
            'productionQuantites',//remove
            'topSorties',
            'sortieLabels',
            'sortieQuantites',
            'totalSorties',
            'sortiePercentages',
            'productionsThisWeek',
            'productionsThisMonth',
            'mostActiveAtelier',
            'topChantiers',
            'topArticles',
            'topFicheArticles',
            'recentStockMovements'
        ));
    }
}
