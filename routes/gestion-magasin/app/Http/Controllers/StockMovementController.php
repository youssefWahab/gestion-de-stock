<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockMovement;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\DB;

class StockMovementController extends Controller
{
    // --------------------- Entrées -------------------

    public function indexEntrees(Request $request)
    {
        $validated = $request->validate([
            'filterArticle'       => 'nullable|string|max:255',
            'filterDateMovement' => 'nullable|date',
            'quantiteMin'  => 'nullable|integer|min:1',
            'quantiteMax'  => 'nullable|integer|min:1',
        ]);

        // dd($validated);

        // ✅ Query
        $entrees = StockMovement::with('stock:id,article')->where('type', 'entrée')->when($validated['filterArticle'] ?? null, function ($query, $article) {
            $query->whereHas('stock', function ($q) use ($article) {
                $q->where('article', 'like', "%{$article}%");
            });
        })->when($validated['filterDateMovement'] ?? null, function ($query, $date) {
            $query->whereDate('date_movement', $date);
        })->when($validated['quantiteMin'] ?? null, function ($query, $min) {
            $query->where('quantite', '>=', $min);
        })->when($validated['quantiteMax'] ?? null, function ($query, $max) {
            $query->where('quantite', '<=', $max);
        })->orderBy('created_at', 'desc')->paginate(10);

        // return response()->json($entrees);
        return view('stock.entrees.index', compact('entrees'));

    }

    public function createEntree()
    {
        $stocks = Stock::select(["id", "article", "stockActuel", "atelier"])->orderBy('article')->get();
        // return response()->json($stocks);
        return view('stock.entrees.create', compact('stocks'));
    }

    public function storeEntree(Request $request)
    {
        $validated = $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'reference' => 'nullable|string|max:255',
            'quantite' => 'required|integer|min:1',
            'date_movement' => 'required|date',
            'note' => 'nullable|string',
        ]);
        // $validated['type'] = 'entrée';
        // if (!$validated['note']) {
        //     $stock = Stock::findOrfail($validated['stock_id']);
        //     $validated['note'] = "ajoutée manuellement  pour l'article '{$stock->article}'";
        // }
        // StockMovement::create($validated);

        // Stock::where('id', $validated['stock_id'])->increment('entree', $validated['quantite']);
        // Stock::where('id', $validated['stock_id'])->increment('stockActuel', $validated['quantite']);
        $stock = Stock::findOrFail($validated['stock_id']);
        if ($stock) {
            $stock->increment('entree', $validated['quantite']);
            $stock->increment('stockActuel', $validated['quantite']);
    
            $validated['type'] = 'entrée';
            if (empty($validated['note'])) {
                $validated['note'] = "Ajoutée manuellement pour l'article '{$stock->article}'";
            }
            StockMovement::create($validated);
        }
        else{
            return redirect()->route('entrees.index')->with('error', 'une problem est survenu lors de l\'ajout d\'une entrée.');
        }

        return redirect()->route('entrees.index')->with('success', 'Entrée ajoutée avec succès.');
    }

    public function editEntree($id)
    {
        $entree = StockMovement::with('stock:id,article')->findOrFail($id);
        $stocks = Stock::select(['id', 'article', 'stockActuel'])->orderBy('article')->get();
        // return response()->json($entree);
        return view('stock.entrees.edit', compact('entree', 'stocks'));
    }



    // ------------------- Sorties --------------------
 
    public function indexSorties(Request $request)
    {
        $validated = $request->validate([
            'filterArticle'      => 'nullable|string',
            'filterDateMovement' => 'nullable|date',
            'quantiteMin'        => 'nullable|integer|min:0',
            'quantiteMax'        => 'nullable|integer|min:0',

        ]);

        $sorties = StockMovement::with('stock:id,article')
            ->where('type', 'sortie')
            ->when($validated['filterArticle'] ?? null, function ($query, $article) {
                $query->whereHas('stock', fn($q) => $q->where('article', 'like', "%{$article}%"));
            })
            ->when($validated['filterDateMovement'] ?? null, fn($query, $date) =>
                $query->whereDate('date_movement', $date)
            )
            ->when($validated['quantiteMin'] ?? null, fn($query, $min) =>
                $query->where('quantite', '>=', $min)
            )
            ->when($validated['quantiteMax'] ?? null, fn($query, $max) =>
                $query->where('quantite', '<=', $max)
            )->orderBy('created_at', 'desc')->paginate(10);
            

        return view('stock.sorties.index', compact('sorties'));
    }


    public function createSortie()
    {
        $stocks = Stock::select(['id', 'article', 'stockActuel', "atelier"])->orderBy('article')->get();
        return view('stock.sorties.create', compact('stocks'));
    }

    public function storeSortie(Request $request)
    {
        $validated = $request->validate([
            'stock_id'       => 'required|exists:stocks,id',
            'quantite'       => 'required|integer|min:1',
            'reference'     => 'nullable|string|max:255',
            'date_movement'  => 'required|date',
            'note'           => 'nullable|string',
        ]);
        $validated['type'] = 'sortie';

        DB::beginTransaction();

        try {
            $stock = Stock::findOrFail($validated['stock_id']);

            if ($stock->stockActuel < ($validated['quantite'] ?? 0)) {
                throw new \Exception("La quantité de sortie ({$validated['quantite']}) dépasse le stock actuel ({$stock->stockActuel}) pour l'article '{$stock->article}'.");
            }

            $stock->decrement('stockActuel', $validated['quantite']);
            $stock->increment('sortie', $validated['quantite']);
    
            if (empty($validated['note'])) {
                $validated['note'] = "Ajoutée manuellement pour l'article '{$stock->article}'";
            }
            StockMovement::create($validated);

            DB::commit();
            return redirect()->route('sorties.create')->with('success', 'Sortie ajoutée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('sorties.create')->with('error', $e->getMessage());
        }

    }

    public function show($id)
    {
        $movement = StockMovement::with('stock')->findOrFail($id);
        $type = $movement->type;
        if($type === 'entrée') {
            return view('stock.entrees.show', compact('movement'));
        }else{
            return view('stock.sorties.show', compact('movement'));

        }
    }


        public function update(Request $request, $id)
    {
        $movement = StockMovement::findOrFail($id);
        
        $validated = $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'quantite' => 'required|numeric|min:1',
            'date_movement' => 'required|date',
            'note' => 'nullable|string|max:255',
        ]);

        DB::transaction(function() use ($movement, $validated) {
            $oldStock      = Stock::find($movement->stock_id);
            $oldQuantity   = $movement->quantite;
            $oldType       = $movement->type;

            if ($oldStock->id !== $validated['stock_id']) {
                $newStock = Stock::find($validated['stock_id']);

                if ($oldType === 'entrée') {
                    $oldStock->decrement('stockActuel', $oldQuantity);
                    $oldStock->decrement('entree', $oldQuantity);

                    $newStock->increment('stockActuel', $validated['quantite']);
                    $newStock->increment('entree', $validated['quantite']);
                } else {
                    $oldStock->increment('stockActuel', $oldQuantity);
                    $oldStock->decrement('sortie', $oldQuantity);

                    $newStock->decrement('stockActuel', $validated['quantite']);
                    $newStock->increment('sortie', $validated['quantite']);
                }
            } else {
                $newStock = $oldStock;
                $diff = $validated['quantite'] - $oldQuantity;

                if ($oldType === 'entrée') {
                    $oldStock->increment('stockActuel', $diff);
                    $oldStock->increment('entree', $diff);
                } else {
                    $oldStock->decrement('stockActuel', $diff);
                    $oldStock->increment('sortie', $diff);
                }
            }

            $movement->update(array_merge($validated, [
                'note' => ($movement->note ?? '') . " (modifié)"
            ]));

            // $note = "Modification de stock. Ancien Stock: '{$oldStock->article}', Nouvelle Stock: '{$newStock->article}', Quantité: {$validated['quantite']}, Ancienne Quantité: {$oldQuantity}";
            
            // StockMovement::create([
            //     'stock_id' => $newStock->id,
            //     'type'     => $oldType,
            //     'quantite' => 0,
            //     'date_movement' => now(),
            //     'note'     => $note,
            //     // 'user_id'  => auth()->id(),
            // ]);
        });


        $type = $movement->type;
        if($type === 'entrée') {
            return redirect()->route('entrees.index')->with('success', 'La ' . $type . ' a été mise à jour avec succès.');
        } else {
            return redirect()->route('sorties.index')->with('success', 'La ' . $type . ' a été mise à jour avec succès.');
}

    }


    public function destroy($id)
    {
        $movement = StockMovement::findOrFail($id);

        // Adjust stock based on movement type
        if ($movement->type === 'entrée') {
            Stock::where('id', $movement->stock_id)->decrement('stockActuel', $movement->quantite);
            Stock::where('id', $movement->stock_id)->decrement('entree', $movement->quantite);
        } elseif ($movement->type === 'sortie') {
            Stock::where('id', $movement->stock_id)->increment('stockActuel', $movement->quantite);
            Stock::where('id', $movement->stock_id)->decrement('sortie', $movement->quantite);
        }

        $movement->delete();

        return redirect()->back()->with('success', 'Mouvement supprimé avec succès.');
    }


}
