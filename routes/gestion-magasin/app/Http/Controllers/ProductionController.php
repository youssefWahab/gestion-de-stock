<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Models\Stock;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductionController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'filterNumBonTransfert' => 'nullable|string|max:50',
            'filterChantier' => 'nullable|string|max:50',
            'filterQuantite' => 'nullable|integer',
            'filterCoutReviens' => 'nullable|numeric',
        ]);
        $query = Production::query();

        if ($request->filled('filterNumBonTransfert')) {
            $query->where('numBonTransfert', 'like', '%' . $request->filterNumBonTransfert . '%');
        }
        if ($request->filled('filterChantier')) {
            $query->where('chantier', 'like', '%' . $request->filterChantier . '%');
        }
        if ($request->filled('filterQuantite')) {
            $query->where('quantite', $request->filterQuantite);
        }
        if ($request->filled('filterCoutReviens')) {
            $query->where('coutReviens', 'like', $request->filterCoutReviens . '%');
        }

        $productions = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return view('production.index',compact('productions'));
    }
    function create()
    {
        $stocks = Stock::select('id','article')->orderBy('article','asc')->get();
        return view('production.create',compact('stocks'));
    }
    function store(Request $request)
    {
        $validated = $request->validate([
            'chantier' => 'required|string',
            'numBonTransfert' => 'required|string',
            'produitFinale' => 'required|string',
            'quantite' => 'required|integer|min:1',
            'unite' => 'required|string',
            'coutReviens' => 'required|numeric|min:1',

            'articles' => 'required|array|min:1',
            'articles.*' => 'required|integer',
            'quantites' => 'required|array|min:1',
            'quantites.*' => 'required|integer|min:1',
            'unites' => 'nullable|array',
            'unites.*' => 'nullable|string|max:10',
            'prix' => 'nullable|array',
            'prix.*' => 'nullable|numeric|min:1',
        ]);

        $articles = $request->input('articles', []);
        $quantites = $request->input('quantites', []);
        $unites = $request->input('unites', []);
        $prixList = $request->input('prix', []);

        DB::beginTransaction();

        try {
            $production = Production::create($validated);

            foreach ($articles as $index => $articleId) {
                $quantity = $quantites[$index] ?? null; 
                $unite = $unites[$index] ?? null;
                $prix = $prixList[$index] ?? 0;

                if ($quantity === null || $quantity <= 0) continue;

                if (!is_numeric($articleId)) {
                    throw new \Exception("Article invalide à l'index {$index}.");
                }

                $stock = Stock::find($articleId);
                if (!$stock) {
                    throw new \Exception("Stock non trouvé pour l'article ID {$articleId}.");
                }

                if ($stock->stockActuel < $quantity) {
                    throw new \Exception("La quantité de sortie ({$quantity}) dépasse le stock actuel ({$stock->stockActuel}) pour l'article '{$stock->article}'.");
                }

                $productionArticle = $production->articles()->create([
                    'stock_id'       => $stock->id,
                    'articleDemande' => $stock->article,
                    'quantite'       => $quantity,
                    'unite'          => $unite,
                    'prix'           => $prix,
                ]);

                $stock->decrement('stockActuel', $productionArticle->quantite);
                $stock->increment('sortie', $productionArticle->quantite);

                StockMovement::create([
                    'stock_id' => $stock->id,
                    'type'     => 'sortie',
                    'quantite' => $quantity,
                    'date_movement' => now(),
                    'note' => "Sortie de stock pour la production ID {$production->numBonTransfert}, article '{$stock->article}'",
                ]);
            }

            DB::commit();
            return redirect()->route('production.index')->with('success', 'Production ajoutée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('production.index')->with('success', 'Fiche de production créée avec succès !');
    }
    function show($id)
    {
        $production = Production::findOrFail($id);
        return view('production.show',compact('production'));
    }
    function edit($id)
    {
        // Logique pour afficher le formulaire d'édition d'une fiche de production
        $production = Production::findOrFail($id);
        // $fiches = [
        //     [
        //         'nom' => 'Dupont',
        //         'chantier' => 'Chantier A',
        //         'dateLivraison' => '2025-09-06',
        //         'numFiche' => 'FC-001',
        //         'articleDemande' => 'Ciment',
        //         'qte' => 10,
        //         'description' => 'Sac de ciment 35kg',
        //         'schema' => 'Plan général',
        //     ],
        //     [
        //         'nom' => 'Martin',
        //         'chantier' => 'Chantier B',
        //         'dateLivraison' => '2025-09-07',
        //         'numFiche' => 'FC-002',
        //         'articleDemande' => 'Bétonnière',
        //         'qte' => 2,
        //         'description' => 'Bétonnière électrique',
        //         'schema' => 'Schéma bétonnière',
        //     ],
        //     [
        //         'nom' => 'Durand',
        //         'chantier' => 'Chantier C',
        //         'dateLivraison' => '2025-09-08',
        //         'numFiche' => 'FC-003',
        //         'articleDemande' => 'Sable',
        //         'qte' => 5,
        //         'description' => 'Sable fin pour maçonnerie',
        //         'schema' => 'Plan sable',
        //     ],
        //     [
        //         'nom' => 'Bernard',
        //         'chantier' => 'Chantier D',
        //         'dateLivraison' => '2025-09-09',
        //         'numFiche' => 'FC-004',
        //         'articleDemande' => 'Gravier',
        //         'qte' => 8,
        //         'description' => 'Gravier 10/20',
        //         'schema' => 'Schéma gravier',
        //     ],
        //     [
        //         'nom' => 'Petit',
        //         'chantier' => 'Chantier E',
        //         'dateLivraison' => '2025-09-10',
        //         'numFiche' => 'FC-005',
        //         'articleDemande' => 'Fer à béton',
        //         'qte' => 20,
        //         'description' => 'Fer 8mm',
        //         'schema' => 'Plan fer',
        //     ],
        //     [
        //         'nom' => 'Robert',
        //         'chantier' => 'Chantier F',
        //         'dateLivraison' => '2025-09-11',
        //         'numFiche' => 'FC-006',
        //         'articleDemande' => 'Briques',
        //         'qte' => 500,
        //         'description' => 'Briques rouges',
        //         'schema' => 'Schéma briques',
        //     ],
        //     [
        //         'nom' => 'Richard',
        //         'chantier' => 'Chantier G',
        //         'dateLivraison' => '2025-09-12',
        //         'numFiche' => 'FC-007',
        //         'articleDemande' => 'Peinture',
        //         'qte' => 15,
        //         'description' => 'Peinture blanche',
        //         'schema' => 'Plan peinture',
        //     ],
        //     [
        //         'nom' => 'Simon',
        //         'chantier' => 'Chantier H',
        //         'dateLivraison' => '2025-09-13',
        //         'numFiche' => 'FC-008',
        //         'articleDemande' => 'Plâtre',
        //         'qte' => 12,
        //         'description' => 'Plâtre pour finitions',
        //         'schema' => 'Schéma plâtre',
        //     ],
        // ];

        return view('production.edit',compact('production'));
    }
    function update(Request $request, $id)
    {
        $production = Production::findOrfail($id);
        $validated = $request->validate([
            'chantier' => 'required|string',
            'numBonTransfert' => 'required|string',
            'quantite' => 'required|integer|min:1',
            'unite' => 'required|string',
            'coutReviens' => 'required|numeric|min:1',
        ]);
        $production->update($validated);
        // Rediriger vers la liste des productions avec un message de succès
        return redirect()->route('production.index')->with('success', 'Fiche de production mise à jour avec succès !');
    }
    function destroy($id)
    {
        // Logique pour supprimer une fiche de production spécifique
        return redirect()->route('production.index')->with('success', 'Fiche de production supprimée avec succès !');
    }

    public function manageArticles($id)
    {
        // $production = Production::with('articles')->where('id', $id)->firstOrFail();
        $production = Production::with(['articles' => function($query) {
            $query->select('id', 'numProduction', 'articleDemande', 'quantite', 'unite', 'prix'); 
        }])->select('numProduction', 'numBonTransfert')->where('numProduction', $id)->firstOrFail();
        // return response()->json($production);
        return view('production.manage-articles', compact('production'));
    }
    
}
