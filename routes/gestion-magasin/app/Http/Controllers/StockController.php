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
            'filterAtelier' => 'nullable|string',
            'stockMin' => 'nullable|integer',
            'stockMax' => 'nullable|numeric',
        ]);
        $query = Stock::query();

        if ($request->filled('filterArticle')) {
            $query->where('article', 'like', '%' . $request->filterArticle . '%');
        }
        if ($request->filled('filterAtelier')) {
            $query->where('atelier', 'like', '%' . $request->filterAtelier . '%');
        }

        if ($request->filled('stockMin') && $request->filled('stockMax')) {
            $query->whereBetween('stockActuel', [$request->stockMin, $request->stockMax]);
        } elseif ($request->filled('stockMin')) {
            $query->where('stockActuel', '>=', $request->stockMin);
        } elseif ($request->filled('stockMax')) {
            $query->where('stockActuel', '<=', $request->stockMax);
        }

        $stocks = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $ateliers = Stock::select('atelier')->distinct()->get();
        $articles = Stock::select('article')->distinct()->get();

        // return response()->json($ateliers);
        return view('stock.index', compact('stocks', 'ateliers','articles'));
    }

    /**
     * Show the form for adding new stock (Entrée).
     */
    public function create()
    {
        // You can also pass list of articles, fiches, or fournisseurs
        // $articles = ['Article A', 'Article B', 'Article C'];
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
            'atelier' => 'required|string',
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
        // $stock = collect($this->stocks)->firstWhere('id', $id);
        // if (!$stock) abort(404);
        $stock = Stock::with('movements')->findOrFail($id);
        // $stock = Stock::findOrFail($id);
        // return response()->json($stock);
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
            'atelier' => 'required|string',
            'unite' => 'nullable|string|max:10',
            'entree' => 'required|integer',
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

        $stocks = Stock::orderBy('article', 'asc')->get()
        ->groupBy(fn($s) => strtolower(trim($s->atelier)));

        // Order of ateliers
        $orderedAteliers = ['soudor', 'marber', 'ba 13', 'aluminium', 'amv'];

        $startRow = 5;
        $currentRow = $startRow;

        // Template row for styles
        $templateRow = $startRow;

        // Walk ateliers in the required order
        foreach ($orderedAteliers as $atelier) {
            if (!isset($stocks[$atelier])) {
                continue;
            }

            foreach ($stocks[$atelier] as $index => $stock) {
                foreach (range('G', 'L') as $col) {
                    $sheet->duplicateStyle($sheet->getStyle("{$col}{$templateRow}"), "{$col}{$currentRow}");
                }

                // $sheet->setCellValue("G{$currentRow}", strtoupper($stock->atelier));
                if ($index === 0) {
                    $sheet->setCellValue("G{$currentRow}", strtoupper($stock->atelier));
                } else {
                    $sheet->setCellValue("G{$currentRow}", ''); // leave empty
                }
                $sheet->setCellValue("H{$currentRow}", $stock->article);
                $sheet->setCellValue("I{$currentRow}", $stock->stockInitial);
                $sheet->setCellValue("J{$currentRow}", $stock->unite ?? 'U');
                $sheet->setCellValue("K{$currentRow}", $stock->entree);
                $sheet->setCellValue("L{$currentRow}", $stock->sortie);

                $currentRow++;
            }
        }

        // Save & download
        $writer = new Xlsx($spreadsheet);
        $fileName = 'INVENTAIRE MAGASIN ' . now()->format('d-m-y') . '.xlsx';
        $filePath = storage_path("app/public/{$fileName}");

        $writer->save($filePath);
        return response()->download($filePath)->deleteFileAfterSend(true);
    
    }
    public function exportWithMovementsToExcel()
    {
        $templatePath = storage_path('templates/inventaire_stock.XLSX');
        if (!file_exists($templatePath)) {
            return redirect()->back()->with('error', "Template Excel introuvable: {$templatePath}");
        }

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        // Récupérer les stocks triés par article
        $stocks = Stock::with('movements')
            ->orderBy('article', 'asc')
            ->get()
            ->groupBy(fn($s) => strtolower(trim($s->atelier)));

        // Ordre des ateliers
        $orderedAteliers = ['soudor', 'marber', 'ba 13', 'aluminium', 'amv'];

        $startRow   = 5;
        $currentRow = $startRow;
        $templateRow = $startRow;

        // Parcours des ateliers dans l’ordre voulu
        foreach ($orderedAteliers as $atelier) {
            if (!isset($stocks[$atelier])) {
                continue;
            }

            foreach ($stocks[$atelier] as $stock) {
                // Récupérer mouvements d’entrée et de sortie
                $entrees = $stock->movements->where('type', 'entrée');
                $sorties = $stock->movements->where('type', 'sortie');

                // ========================
                // LIGNE STOCK (résumé)
                // ========================
                foreach (range('G', 'O') as $col) {
                    $sheet->duplicateStyle($sheet->getStyle("{$col}{$templateRow}"), "{$col}{$currentRow}");
                }

                $sheet->setCellValue("G{$currentRow}", strtoupper($stock->atelier));
                $sheet->setCellValue("H{$currentRow}", strtoupper($stock->article));
                $sheet->setCellValue("I{$currentRow}", $stock->stockActuel);
                $sheet->setCellValue("J{$currentRow}", $stock->unite ?? 'U');

                $currentRow++;

                // ========================
                // DÉTAILS ENTRÉES
                // ========================
                if ($entrees->count() > 0) {
                    // En-tête Entrées
                    // $sheet->setCellValue("H{$currentRow}", "Entrées");
                    // $currentRow++;

                    // Sous-en-têtes
                    $sheet->setCellValue("H{$currentRow}", "Bon / Nom");
                    $sheet->setCellValue("I{$currentRow}", "Quantité");
                    $sheet->setCellValue("J{$currentRow}", "Unité");
                    $sheet->setCellValue("K{$currentRow}", "Date entrée");
                    // $sheet->setCellValue("L{$currentRow}", "heure");
                    $currentRow++;

                    foreach ($entrees as $mvt) {
                        $sheet->setCellValue("H{$currentRow}", $mvt->reference ?? '-');
                        $sheet->setCellValue("I{$currentRow}", $mvt->quantite);
                        $sheet->setCellValue("J{$currentRow}", $stock->unite ?? 'U');
                        $sheet->setCellValue("K{$currentRow}", $mvt->date_movement->format('d-m-Y'));
                        $currentRow++;
                    }
                }

                // ========================
                // DÉTAILS SORTIES
                // ========================
                if ($sorties->count() > 0) {
                    // En-tête Sorties
                    // $sheet->setCellValue("H{$currentRow}", "Sorties");
                    // $currentRow++;

                    // Sous-en-têtes
                    $sheet->setCellValue("H{$currentRow}", "Bon / Nom");
                    $sheet->setCellValue("I{$currentRow}", "Quantité");
                    $sheet->setCellValue("J{$currentRow}", "Unité");
                    $sheet->setCellValue("K{$currentRow}", "Date sortie");
                    // $sheet->setCellValue("L{$currentRow}", "heure");
                    $currentRow++;

                    foreach ($sorties as $mvt) {
                        $sheet->setCellValue("H{$currentRow}", $mvt->reference ?? '-');
                        $sheet->setCellValue("I{$currentRow}", $mvt->quantite);
                        $sheet->setCellValue("J{$currentRow}", $stock->unite ?? 'U');
                        $sheet->setCellValue("K{$currentRow}", $mvt->created_at->format('d-m-Y'));
                        $currentRow++;
                    }
                }

                // Ligne vide entre les stocks
                // $currentRow++;
            }
        }

        // Sauvegarde & téléchargement
        $writer = new Xlsx($spreadsheet);
        $fileName = 'INVENTAIRE MAGASIN ' . now()->format('d-m-y') . '.xlsx';
        $filePath = storage_path("app/public/{$fileName}");

        $writer->save($filePath);
        return response()->download($filePath)->deleteFileAfterSend(true);
    }

}