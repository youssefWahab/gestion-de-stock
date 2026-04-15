<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockMovement;
use Carbon\Carbon;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\DB;

class StockMovementController extends Controller
{
    // --------------------- Entrées -------------------

    public function indexEntrees(Request $request)
    {
        $validated = $request->validate([
            'filterSearch'       => 'nullable|string|max:255',
            'filterDateMovement' => 'nullable|date',
            'quantiteMin'  => 'nullable|integer|min:1',
            'quantiteMax'  => 'nullable|integer|min:1',
        ]);

       
        $entrees = StockMovement::with('stock:id,article')->where('type', 'entrée')
        ->when($validated['filterSearch'] ?? null, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('stock', function ($q2) use ($search) {
                    $q2->where('article', 'like', "%{$search}%")
                    ->orWhere('categorie', 'like', "%{$search}%");
                })
                ->orWhere('reference', 'like', "%{$search}%");
            });
        })
        ->when($validated['filterDateMovement'] ?? null, function ($query, $date) {
            $query->whereDate('date_movement', $date);
        })->when($validated['quantiteMin'] ?? null, function ($query, $min) {
            $query->where('quantite', '>=', $min);
        })->when($validated['quantiteMax'] ?? null, function ($query, $max) {
            $query->where('quantite', '<=', $max);
        })->orderBy('date_movement', 'desc')->paginate(10)->withQueryString();

        // return response()->json($entrees);
        return view('stock.entrees.index', compact('entrees'));

    }

    public function createEntree()
    {
        $stocks = Stock::select(["id", "article", "stockActuel", "categorie"])->orderBy('article')->get();
        $date = Carbon::now('Europe/Paris')->format('Y-m-d\TH:i');
        return view('stock.entrees.create', compact('stocks','date'));
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

        return redirect()->route('entrees.create')->with('success', 'Entrée ajoutée avec succès.');
    }

    public function editEntree($id)
    {
        $entree = StockMovement::with('stock:id,article')->findOrFail($id);
        $stocks = Stock::select(['id', 'article', 'stockActuel'])->orderBy('article')->get();
        return view('stock.entrees.edit', compact('entree', 'stocks'));
    }



    // ------------------- Sorties --------------------
 
    public function indexSorties(Request $request)
    {
        $validated = $request->validate([
            'filterSearch'      => 'nullable|string',
            'filterDateMovement' => 'nullable|date',
            'quantiteMin'        => 'nullable|integer|min:0',
            'quantiteMax'        => 'nullable|integer|min:0',

        ]);

        $sorties = StockMovement::with('stock:id,article')
            ->where('type', 'sortie')

            ->when($validated['filterSearch'] ?? null, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('stock', function ($q2) use ($search) {
                        $q2->where('article', 'like', "%{$search}%")
                        ->orWhere('categorie', 'like', "%{$search}%");
                    })
                    ->orWhere('reference', 'like', "%{$search}%");
                });
            })
            ->when($validated['filterDateMovement'] ?? null, fn($query, $date) =>
                $query->whereDate('date_movement', $date)
            )
            ->when($validated['quantiteMin'] ?? null, fn($query, $min) =>
                $query->where('quantite', '>=', $min)
            )
            ->when($validated['quantiteMax'] ?? null, fn($query, $max) =>
                $query->where('quantite', '<=', $max)
            )->orderBy('date_movement', 'asc')->paginate(10)->withQueryString();

        // return response()->json($sorties);
        return view('stock.sorties.index', compact('sorties'));
    }


    public function createSortie()
    {
        $stocks = Stock::select(['id', 'article', 'stockActuel', "categorie"])->orderBy('article')->get();
        $date = Carbon::now('Europe/Paris')->format('Y-m-d\TH:i');    
        return view('stock.sorties.create', compact('stocks','date'));
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
    public function editSortie($id)
    {
        $sortie = StockMovement::with('stock:id,article')->findOrFail($id);
        $stocks = Stock::select(['id', 'article', 'stockActuel'])->orderBy('article')->get();
        return view('stock.sorties.edit', compact('sortie', 'stocks'));
    }

    // ------------------- Emprunts --------------------
    public function indexEmprunts(Request $request)
{
    $validated = $request->validate([
        'filterSearch'       => 'nullable|string|max:255',
        'filterDateMovement' => 'nullable|date',
        'quantiteMin'        => 'nullable|integer|min:1',
        'quantiteMax'        => 'nullable|integer|min:1',
    ]);

    $emprunts = StockMovement::with('stock:id,article')
        ->where('type', 'emprunt')
        ->when($validated['filterSearch'] ?? null, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('stock', function ($q2) use ($search) {
                    $q2->where('article', 'like', "%{$search}%")
                       ->orWhere('categorie', 'like', "%{$search}%");
                })
                ->orWhere('reference', 'like', "%{$search}%");
            });
        })
        ->when($validated['filterDateMovement'] ?? null, function ($query, $date) {
            $query->whereDate('date_movement', $date);
        })
        ->when($validated['quantiteMin'] ?? null, function ($query, $min) {
            $query->where('quantite', '>=', $min);
        })
        ->when($validated['quantiteMax'] ?? null, function ($query, $max) {
            $query->where('quantite', '<=', $max);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10)->withQueryString();

    return view('stock.emprunts.index', compact('emprunts'));
}
    public function createEmprunt()
    {
        $stocks = Stock::select(['id', 'article', 'stockActuel', 'categorie'])->orderBy('article')->get();
        $date = Carbon::now('Europe/Paris')->format('Y-m-d\TH:i');
        return view('stock.emprunts.create', compact('stocks','date'));
    }
    public function storeEmprunt(Request $request)
    {
        $validated = $request->validate([
            'stock_id'       => 'required|exists:stocks,id',
            'quantite'       => 'required|integer|min:1',
            'reference'     => 'nullable|string|max:255',
            'date_movement'  => 'required|date',
            'note'           => 'nullable|string',
        ]);
        $validated['type'] = 'emprunt';

        DB::beginTransaction();

        try {
            $stock = Stock::findOrFail($validated['stock_id']);

            if ($stock->stockActuel < ($validated['quantite'] ?? 0)) {
                throw new \Exception("La quantité d'emprunt ({$validated['quantite']}) dépasse le stock actuel ({$stock->stockActuel}) pour l'article '{$stock->article}'.");
            }

            $stock->decrement('stockActuel', $validated['quantite']);
            $stock->increment('sortie', $validated['quantite']);
    
            if (empty($validated['note'])) {
                $validated['note'] = "Empruntée manuellement pour l'article '{$stock->article}'";
            }
            StockMovement::create($validated);
            DB::commit();
            return redirect()->route('emprunts.create')->with('success', 'Emprunt ajouté avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('emprunts.create')->with('error', $e->getMessage());
        }
    }
    public function editEmprunt($id)
    {
        $emprunt = StockMovement::with('stock:id,article')->findOrFail($id);
        $stocks = Stock::select(['id', 'article', 'stockActuel'])->orderBy('article')->get();
        return view('stock.emprunts.edit', compact('emprunt', 'stocks'));
    }
    function return($id)
    {
        // dd('enter return function');
        $emprunt = StockMovement::findOrFail($id);
        if ($emprunt->type !== 'emprunt') {
            return redirect()->back()->with('error', 'Un problème est survenu lors du retour de l\'emprunt.');
        }

        DB::beginTransaction();
        try {
            $stock = Stock::findOrFail($emprunt->stock_id);
            $stock->increment('stockActuel', $emprunt->quantite);
            $stock->decrement('sortie', $emprunt->quantite);
            $emprunt->delete();

            DB::commit();
            return redirect()->route('emprunts.index')->with('success', "Retour d’emprunt enregistré avec succès.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('emprunts.index')->with('error', $e->getMessage());
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
            'reference' => 'nullable|string|max:255',
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
        } elseif($type === 'emprunt'){
            return redirect()->route('emprunts.index')->with('success', 'La ' . $type . ' a été mise à jour avec succès.');
        } elseif($type === 'sortie'){
            return redirect()->route('sorties.index')->with('success', 'Le ' . $type . ' a été mis à jour avec succès.');
        } else {
            return redirect()->route('retours.index')->with('success', 'La ' . $type . ' a été mise à jour avec succès.');
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
        }elseif ($movement->type === 'retour') {
            // Ajuster le stock
            Stock::where('id', $movement->stock_id)->decrement('stockActuel', $movement->quantite);
            Stock::where('id', $movement->stock_id)->decrement('sortie', $movement->quantite);

            $sortie = StockMovement::where('stock_id', $movement->stock_id)
                ->where('type', 'sortie')
                ->orderBy('date_movement', 'desc')
                ->first();

            if ($sortie) {
                $sortie->increment('quantite', $movement->quantite);
            } else {
                StockMovement::create([
                    'stock_id'      => $movement->stock_id,
                    'type'          => 'sortie',
                    'quantite'      => $movement->quantite,
                    'date_movement' => now(),
                    'note'          => 'Sortie générée suite à la suppression d’un retour',
                ]);
            }
        }
        else {
            return redirect()->back()->with('error', 'un problème est survenu lors de la suppression du mouvement.');
        }

        $movement->delete();

        return redirect()->back()->with('success', 'Mouvement supprimé avec succès.');
    }


    public function storeRetour(Request $request)
    {
        $validated = $request->validate([
            'sortie_id' => 'required|exists:stock_movements,id',
            'quantite' => 'required|integer|min:1',
            'reference' => 'nullable|string|max:255',
            'date_movement' => 'required|date',
            'note' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $sortieMovement = StockMovement::with('stock')->findOrFail($validated['sortie_id']);
            $stock = $sortieMovement->stock;

            if ($sortieMovement->quantite < $validated['quantite']) {
                throw new \Exception("La quantité de retour dépasse la quantité de sortie disponible.");
            }

            if ($sortieMovement->quantite - $validated['quantite'] === 0) {
                $sortieMovement->delete();
                $stock->increment('stockActuel', $validated['quantite']);
                $stock->decrement('sortie', $validated['quantite']);
            } else {
                $sortieMovement->decrement('quantite', $validated['quantite']);
                $stock->increment('stockActuel', $validated['quantite']);
                $stock->decrement('sortie', $validated['quantite']);
            }

            $retourData = [
                'stock_id' => $stock->id,
                'type' => 'retour',
                'quantite' => $validated['quantite'],
                'reference' => $validated['reference'] ?? null,
                'date_movement' => $validated['date_movement'],
                'note' => $validated['note'] ?? "Retour enregistré pour l'article {$stock->article}",
            ];
            StockMovement::create($retourData);
            DB::commit();
            return redirect()->back()->with('success', 'Retour enregistré avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function indexRetours(Request $request)
    {
        $validated = $request->validate([
            'filterSearch'       => 'nullable|string|max:255',
            'filterDateMovement' => 'nullable|date',
            'quantiteMin'        => 'nullable|integer|min:1',
            'quantiteMax'        => 'nullable|integer|min:1',
        ]);

        $retours = StockMovement::with('stock:id,article')
            ->where('type', 'retour')
            ->when($validated['filterSearch'] ?? null, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('stock', function ($q2) use ($search) {
                        $q2->where('article', 'like', "%{$search}%")
                            ->orWhere('categorie', 'like', "%{$search}%");
                    })
                    ->orWhere('reference', 'like', "%{$search}%");
                });
            })
            ->when($validated['filterDateMovement'] ?? null, function ($query, $date) {
                $query->whereDate('date_movement', $date);
            })
            ->when($validated['quantiteMin'] ?? null, function ($query, $min) {
                $query->where('quantite', '>=', $min);
            })
            ->when($validated['quantiteMax'] ?? null, function ($query, $max) {
                $query->where('quantite', '<=', $max);
            })
            ->orderBy('date_movement', 'desc')
            ->paginate(10)->withQueryString();
            // return response()->json($retours);
        return view('stock.retours.index', compact('retours'));
    }

    public function createRetour()
    {
        $sorties = StockMovement::with('stock:id,article')
            ->where('type', 'sortie')
            ->orderBy('date_movement', 'desc')
            ->get();
        $date = Carbon::now('Europe/Paris')->format('Y-m-d\TH:i');
        return view('stock.retours.create', compact('sorties','date'));
    }
    public function editRetour($id)
    {
        $retour = StockMovement::with('stock:id,article')->findOrFail($id);
        $stocks = Stock::select(['id', 'article', 'stockActuel'])->orderBy('article')->get();
        return view('stock.retours.edit', compact('retour', 'stocks'));
    }
}
