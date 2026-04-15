<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class StockController extends Controller
{

    /**
     * Display a listing of stock history.
     */
    public function index(Request $request)
    {
        $request->validate([
            'filterArticle' => 'nullable|string|max:50',
            'filterCategories' => 'nullable|string',
            'stockMin' => 'nullable|integer',
            'stockMax' => 'nullable|numeric',
        ]);
        $query = Stock::query();

        if ($request->filled('filterArticle')) {
            $query->where('article', 'like', '%' . $request->filterArticle . '%');
        }
        if ($request->filled('filterCategories')) {
            $query->where('categorie', 'like', '%' . $request->filterCategories . '%');
        }

        if ($request->filled('stockMin') && $request->filled('stockMax')) {
            $query->whereBetween('stockActuel', [$request->stockMin, $request->stockMax]);
        } elseif ($request->filled('stockMin')) {
            $query->where('stockActuel', '>=', $request->stockMin);
        } elseif ($request->filled('stockMax')) {
            $query->where('stockActuel', '<=', $request->stockMax);
        }

        $stocks = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $categories = Stock::select('categorie')->distinct()->get();
        $articles = Stock::select('article')->distinct()->get();

        // return response()->json($ateliers);
        return view('stock.index', compact('stocks', 'categories','articles'));
    }

    /**
     * Show the form for adding new stock (Entrée).
     */
    public function create()
    {
        return view('stock.create');
    }

    /**
     * Store a newly added stock.
     */
    public function store(Request $request)
    {
        // Normally you would validate and save to DB
        $validated = $request->validate([
            'article' => 'required|string',
            'categorie' => 'required|string',
            'unite' => 'nullable|string|max:10',
            'entree' => 'required|integer',
            'stockInitial' => 'required|integer',
            'minimum' => 'required|integer',
            'stockActuel' => 'required|integer',
            'sortie' => 'required|integer',
        ]);
        // dd('enter');

        Stock::create($validated);

        return redirect()->route('stock.create')->with('success', 'Stock ajouté avec succès.');
    }

    /**
     * Display a single stock entry.
     */
    public function show($id)
    {
        $stock = Stock::with(['movements' => function ($query) {
            $query->orderBy('date_movement', 'asc'); // or 'desc'
        }])->findOrFail($id);

        return view('stock.show', compact('stock'));
    }

    /**
     * Show the form for editing a stock entry.
     */
    public function edit($id)
    {
        $stock = Stock::with('movements')->findOrFail($id);
        return view('stock.edit', ['stock' => $stock]);
    }

    /**
     * Update the specified stock entry.
     */
    public function update(Request $request, $id)
    {
        $stock = Stock::findOrFail($id);
        $validated = $request->validate([
            'article' => 'required|string',
            'categorie' => 'required|string',
            'unite' => 'nullable|string|max:10',
            'entree' => 'required|integer',
            'stockInitial' => 'required|integer',
            'stockActuel' => 'required|integer',
            'sortie' => 'required|integer',
        ]);
        $stock->update($validated);
        return redirect()->route('stock.index')->with('success', 'Stock modifié avec succès.');
    }

    /**
     * Remove a stock entry.
     */
    public function destroy($id)
    {
        Stock::destroy($id);
        return redirect()->route('stock.index')->with('success', 'Stock supprimé avec succès.');
    }

    public function exportToExcel()
    {
        $templatePath = storage_path('templates/inventaire_stock.XLSX');
        if (!file_exists($templatePath)) {
            return redirect()->back()->with('error', "Template Excel introuvable: {$templatePath}");
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        $stocksGrouped = Stock::orderBy('categorie', 'asc')
            ->orderBy('article', 'asc')
            ->get()
            ->groupBy(fn($s) => strtoupper(trim($s->categorie)));

        $currentRow = 5;
        $templateRow = 5;

        foreach ($stocksGrouped as $catName => $items) {
            
            foreach ($items as $index => $stock) {
                
                foreach (range('G', 'M') as $col) {
                    $sheet->duplicateStyle($sheet->getStyle("{$col}{$templateRow}"), "{$col}{$currentRow}");
                }

                if ($index === 0) {
                    $sheet->setCellValue("G{$currentRow}", $catName);
                } else {
                    $sheet->setCellValue("G{$currentRow}", ''); 
                }

                $sheet->setCellValue("H{$currentRow}", $stock->article);
                $sheet->setCellValue("I{$currentRow}", $stock->stockInitial);
                $sheet->setCellValue("J{$currentRow}", $stock->unite ?? 'U');
                $sheet->setCellValue("K{$currentRow}", $stock->entree);
                $sheet->setCellValue("L{$currentRow}", $stock->sortie);
                $sheet->setCellValue("M{$currentRow}", $stock->stockActuel);

                $currentRow++;
            }
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'INVENTAIRE MAGASIN ' . now()->format('d-m-y') . '.xlsx';
        $filePath = storage_path("app/public/{$fileName}");

        $writer->save($filePath);
        return response()->download($filePath)->deleteFileAfterSend(true);
    
    }
    
    public function exportWithMovementsToExcel()
    {
        $templatePath = storage_path('templates/gestion_stock.xlsx');
        if (!file_exists($templatePath)) {
            return redirect()->back()->with('error', "Template Excel introuvable: {$templatePath}");
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // 1. Groupement dynamique par 'categorie' au lieu d'atelier
        $stocks = Stock::with('movements')
            ->orderBy('categorie', 'asc')
            ->orderBy('article', 'asc')
            ->get()
            ->groupBy(fn($s) => strtoupper(trim($s->categorie)));

        $startRow    = 5;
        $currentRow  = $startRow;
        $templateRow = $startRow;

        $headerRowEntree = 6;
        $dataRowEntree   = $headerRowEntree + 1;

        $headerRowSortie = 9;
        $dataRowSortie   = $headerRowSortie + 1;

        // 2. On boucle sur les catégories existantes (plus besoin de $orderedAteliers)
        foreach ($stocks as $categoryName => $items) {

            foreach ($items as $index => $stock) {
                $entrees = $stock->movements->where('type', 'entrée');
                $sorties = $stock->movements->where('type', 'sortie');

                // STOCK SUMMARY LINE
                // J'ai étendu à 'L' pour couvrir tout le style du template
                foreach (range('G', 'L') as $col) {
                    $sheet->duplicateStyle($sheet->getStyle("{$col}{$templateRow}"), "{$col}{$currentRow}");
                }

                // On utilise le nom de la catégorie ici
                if ($index === 0) {
                    $sheet->setCellValue("G{$currentRow}", $categoryName);
                } else {
                    $sheet->setCellValue("G{$currentRow}", '');
                }

                $sheet->setCellValue("H{$currentRow}", 'Stock Initial');
                $sheet->setCellValue("I{$currentRow}", strtoupper($stock->article));
                $sheet->setCellValue("J{$currentRow}", $stock->stockInitial);
                $sheet->setCellValue("K{$currentRow}", $stock->unite ?? 'U');

                $currentRow++;

                // --------------------------
                // ENTRÉES
                // --------------------------
                if ($entrees->count() > 0) {
                    foreach (range('G', 'L') as $col) {
                        $sheet->duplicateStyle($sheet->getStyle("{$col}{$headerRowEntree}"), "{$col}{$currentRow}");
                    }
                    $sheet->setCellValue("H{$currentRow}", 'Les Entrées');
                    $sheet->setCellValue("I{$currentRow}", 'Bon de la livraison');
                    $sheet->setCellValue("J{$currentRow}", 'DATE ENTRÉE');
                    $sheet->setCellValue("K{$currentRow}", 'QUANTITE');
                    $currentRow++;

                    $totalEntrees = 0;
                    foreach ($entrees as $mvt) {
                        foreach (range('G', 'L') as $col) {
                            $sheet->duplicateStyle($sheet->getStyle("{$col}{$dataRowEntree}"), "{$col}{$currentRow}");
                        }
                        $sheet->setCellValue("I{$currentRow}", $mvt->reference ?? '-');
                        $sheet->setCellValue("J{$currentRow}", $mvt->date_movement->format('d-m-Y'));
                        $sheet->setCellValue("K{$currentRow}", $mvt->quantite);
                        $totalEntrees += $mvt->quantite;
                        $currentRow++;
                    }

                    foreach (range('G', 'L') as $col) {
                        $sheet->duplicateStyle($sheet->getStyle("{$col}{$dataRowEntree}"), "{$col}{$currentRow}");
                    }
                    $sheet->setCellValue("H{$currentRow}", 'Total Entrées');
                    $sheet->setCellValue("K{$currentRow}", $totalEntrees);
                    $currentRow++;
                } else {
                    foreach (range('G', 'L') as $col) {
                        $sheet->duplicateStyle($sheet->getStyle("{$col}{$headerRowEntree}"), "{$col}{$currentRow}");
                    }
                    $sheet->setCellValue("H{$currentRow}", 'Les Entrées');
                    $sheet->setCellValue("I{$currentRow}", 'Bon de la livraison');
                    $sheet->setCellValue("J{$currentRow}", 'DATE ENTRÉE');
                    $sheet->setCellValue("K{$currentRow}", 'QUANTITE');
                    $currentRow++;
                    foreach (range('G', 'L') as $col) {
                        $sheet->duplicateStyle($sheet->getStyle("{$col}{$dataRowEntree}"), "{$col}{$currentRow}");
                    }
                    $sheet->mergeCells("I{$currentRow}:K{$currentRow}");
                    $sheet->setCellValue("I{$currentRow}", 'Aucune entrée enregistrée');
                    $sheet->getStyle("I{$currentRow}:K{$currentRow}")->getFont()->setBold(true)->setItalic(true);
                    $currentRow++;
                }

                // --------------------------
                // SORTIES
                // --------------------------
                if ($sorties->count() > 0) {
                    foreach (range('G', 'L') as $col) {
                        $sheet->duplicateStyle($sheet->getStyle("{$col}{$headerRowSortie}"), "{$col}{$currentRow}");
                    }
                    $sheet->setCellValue("H{$currentRow}", 'Les sorties');
                    $sheet->setCellValue("I{$currentRow}", 'Bon /Nom demanduer');
                    $sheet->setCellValue("J{$currentRow}", 'DATE SORTIE');
                    $sheet->setCellValue("K{$currentRow}", 'QUANTITE');
                    $currentRow++;

                    $totalSorties = 0;
                    foreach ($sorties as $mvt) {
                        foreach (range('G', 'L') as $col) {
                            $sheet->duplicateStyle($sheet->getStyle("{$col}{$dataRowSortie}"), "{$col}{$currentRow}");
                        }
                        $sheet->setCellValue("I{$currentRow}", $mvt->reference ?? '-');
                        $sheet->setCellValue("J{$currentRow}", $mvt->date_movement->format('d-m-Y'));
                        $sheet->setCellValue("K{$currentRow}", $mvt->quantite);
                        $totalSorties += $mvt->quantite;
                        $currentRow++;
                    }

                    foreach (range('G', 'L') as $col) {
                        $sheet->duplicateStyle($sheet->getStyle("{$col}{$dataRowSortie}"), "{$col}{$currentRow}");
                    }
                    $sheet->setCellValue("H{$currentRow}", 'Total Sorties');
                    $sheet->setCellValue("K{$currentRow}", $totalSorties);
                    $currentRow++;
                } else {
                    foreach (range('G', 'L') as $col) {
                        $sheet->duplicateStyle($sheet->getStyle("{$col}{$headerRowSortie}"), "{$col}{$currentRow}");
                    }
                    $sheet->setCellValue("H{$currentRow}", 'Les sorties');
                    $sheet->setCellValue("I{$currentRow}", 'Bon /Nom demanduer');
                    $sheet->setCellValue("J{$currentRow}", 'DATE SORTIE');
                    $sheet->setCellValue("K{$currentRow}", 'QUANTITE');
                    $currentRow++;
                    foreach (range('G', 'L') as $col) {
                        $sheet->duplicateStyle($sheet->getStyle("{$col}{$dataRowSortie}"), "{$col}{$currentRow}");
                    }
                    $sheet->mergeCells("I{$currentRow}:K{$currentRow}");
                    $sheet->setCellValue("I{$currentRow}", 'Aucune sortie enregistrée');
                    $sheet->getStyle("I{$currentRow}:K{$currentRow}")->getFont()->setBold(true)->setItalic(true);
                    $currentRow++;
                }
            }
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'GESTION MAGASIN ' . now()->format('d-m-y') . '.xlsx';
        $filePath = storage_path("app/public/{$fileName}");

        $writer->save($filePath);
        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function exportEntreesToExcel()
    {
        $templatePath = storage_path('templates/entrees_stock.xlsx');

        if (!file_exists($templatePath)) {
            return redirect()->back()->with('error', "Template Excel introuvable: {$templatePath}");
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // 1. Groupement dynamique par 'categorie'
        $stocks = Stock::with(['movements' => function ($q) {
                $q->where('type', 'entrée');
            }])
            ->whereHas('movements', function ($q) {
                $q->where('type', 'entrée');
            })
            ->orderBy('categorie', 'asc') // Tri par catégorie
            ->orderBy('article', 'asc')   // Puis par article
            ->get()
            ->groupBy(fn($s) => strtoupper(trim($s->categorie))); // Groupement en majuscules

        $startRow   = 5; 
        $currentRow = $startRow;

        // 2. Boucle dynamique sur les catégories
        foreach ($stocks as $categoryName => $items) {

            foreach ($items as $index => $stock) {
                foreach ($stock->movements as $mvt) {
                    
                    // Dupliquer le style (Plage G à L)
                    foreach (range('G', 'L') as $col) {
                        $sheet->duplicateStyle($sheet->getStyle("{$col}{$startRow}"), "{$col}{$currentRow}");
                    }

                    // Affichage de la catégorie sur la première ligne de l'article seulement
                    if ($index === 0) {
                        $sheet->setCellValue("G{$currentRow}", $categoryName);
                    } else {
                        $sheet->setCellValue("G{$currentRow}", '');
                    }

                    // Remplissage des données
                    $sheet->setCellValue("H{$currentRow}", strtoupper($stock->article));
                    $sheet->setCellValue("I{$currentRow}", $mvt->quantite);
                    $sheet->setCellValue("J{$currentRow}", $stock->unite ?? 'U');
                    $sheet->setCellValue("K{$currentRow}", $mvt->reference ?? '-');
                    $sheet->setCellValue("L{$currentRow}", $mvt->date_movement->format('d-m-Y'));

                    $currentRow++;
                }
            }
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'ENTREES STOCK ' . now()->format('d-m-y') . '.xlsx';
        $filePath = storage_path("app/public/{$fileName}");

        $writer->save($filePath);
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    public function exportSortiesToExcel()
    {
        $templatePath = storage_path('templates/sorties_stock.xlsx');

        if (!file_exists($templatePath)) {
            return redirect()->back()->with('error', "Template Excel introuvable: {$templatePath}");
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // 1. Groupement dynamique par 'categorie' au lieu de 'atelier'
        $stocks = Stock::with(['movements' => function ($q) {
                $q->whereIn('type', ['sortie', 'emprunt']);
            }])
            ->whereHas('movements', function ($q) {
                $q->whereIn('type', ['sortie', 'emprunt']);
            })
            ->orderBy('categorie', 'asc') // Tri par catégorie
            ->orderBy('article', 'asc')   // Puis par article
            ->get()
            ->groupBy(fn($s) => strtoupper(trim($s->categorie)));

        $startRow   = 5; 
        $currentRow = $startRow;

        // 2. Boucle dynamique sur les catégories présentes en base
        foreach ($stocks as $categoryName => $items) {

            foreach ($items as $index => $stock) {
                foreach ($stock->movements as $mvt) {
                    
                    // Dupliquer le style (Plage G à L)
                    foreach (range('G', 'L') as $col) {
                        $sheet->duplicateStyle($sheet->getStyle("{$col}{$startRow}"), "{$col}{$currentRow}");
                    }

                    // Affichage de la catégorie sur la première ligne de l'article seulement
                    if ($index === 0) {
                        $sheet->setCellValue("G{$currentRow}", $categoryName);
                    } else {
                        $sheet->setCellValue("G{$currentRow}", '');
                    }

                    // Remplissage des données
                    $sheet->setCellValue("H{$currentRow}", strtoupper($stock->article));
                    $sheet->setCellValue("I{$currentRow}", $mvt->quantite);
                    $sheet->setCellValue("J{$currentRow}", $stock->unite ?? 'U');
                    $sheet->setCellValue("K{$currentRow}", $mvt->reference ?? '-');
                    $sheet->setCellValue("L{$currentRow}", $mvt->date_movement->format('d-m-Y'));

                    $currentRow++;
                }
            }
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'SORTIES STOCK ' . now()->format('d-m-y') . '.xlsx';
        $filePath = storage_path("app/public/{$fileName}");

        $writer->save($filePath);
        return response()->download($filePath)->deleteFileAfterSend(true);
    }




}