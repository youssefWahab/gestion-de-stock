<?php

namespace App\Http\Controllers;

use App\Models\DemandeAchat;
use App\Models\FicheCommande;
use App\Models\Stock;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Log;
use ZipArchive;


class DemandeAchatController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'filterNumFiche' => 'nullable|integer',
            'filterBonCommande' => 'nullable|string|max:100',
            'filterNatureTravaux' => 'nullable|string|max:200',
            'filterAtelier' => 'nullable|string',
        ]);
        $query = DemandeAchat::query();

        if ($request->filled('filterNumFiche')) {
            $query->where('numFiche', $request->filterNumFiche);
        }
        if ($request->filled('filterBonCommande')) {
            $query->where('numBonCommande', 'like', '%' . $request->filterBonCommande . '%');
        }
        if ($request->filled('filterNatureTravaux')) {
            $query->where('natureTravaux', 'like', '%' . $request->filterNatureTravaux . '%');
        }
        if ($request->filled('filterAtelier')) {
            $query->where('atelier', 'like', '%' . $request->filterAtelier . '%');
        }

        $demandes = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $ateliers  = DemandeAchat::select('atelier')->get();
        // return response()->json($ateliers);
        return view('demande-achat.index', compact('demandes','ateliers'));
    }
    public function create()
    {
        $fiches = FicheCommande::select('numFiche', 'nomDemandeur', 'atelier')->get();
        $stocks = Stock::select('id','article')->orderBy('article','asc')->get();
        return view('demande-achat.create',compact('fiches','stocks'));
    }

    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numFiche' => 'required|integer|exists:fiche_commandes,numFiche',
            'numBonCommande' => 'required|string|unique:demande_achats,numBonCommande',
            'atelier' => 'required|string|max:100',
            'natureTravaux' => 'nullable|string|max:150',

            'articles' => 'nullable|array|min:1',
            'articles.*' => [
                'required',
                'string',
                'regex:/^[0-9]+$|^[A-Za-z0-9\s\'-]{2,}$/',
            ],

            'quantites' => 'required|array|min:1',
            'quantites.*' => 'required|integer|min:1',
            'unites' => 'nullable|array',
            'unites.*' => 'nullable|string|max:10',
            'prix' => 'nullable|array',
            'prix.*' => 'nullable|numeric',
        ]);

        $demande = DemandeAchat::create([
            'numFiche'      => $validated['numFiche'],
            'numBonCommande'=> $validated['numBonCommande'],
            'atelier'       => $validated['atelier'],
            'natureTravaux' => $validated['natureTravaux'] ?? null,
        ]);

       $articles = $request->input('articles', []);
$quantites = $request->input('quantites', []);
$unites = $request->input('unites', []);
$prixList = $request->input('prix', []);

foreach ($articles as $index => $articleValue) {
    $quantity = $quantites[$index] ?? null; 
    $unite    = $unites[$index] ?? null;
    $prix     = $prixList[$index] ?? 0;

    if ($quantity === null || $quantity <= 0) continue;

    if (is_numeric($articleValue)) {
        $stock = Stock::find($articleValue);
        if (!$stock) {
            return redirect()->route('demande-achat.index')
                ->with('error', "Une erreur est survenue lors de l'ajout de cette demande");
        }
    } else {
        $stock = Stock::create([
            'article'     => $articleValue,
            'chantier'    => $demande->atelier,
            'stockActuel' => 0,  
            'entree'      => 0,
            'sortie'      => 0,
        ]);
    }
    $article = $demande->articles()->create([
        'stock_id'       => $stock->id,
        'articleDemande' => $stock->article,
        'quantite'       => $quantity,
        'unite'          => $unite,
        'prix'           => $prix,
    ]);

    StockMovement::create([
        'stock_id' => $article->stock_id,
        'type'     => 'entrée',
        'quantite' => $article->quantite,
        'date_movement' => now(),
        'note' => "Ajoutée au stock de la demande {$demande->numBonCommande}, article '{$article->articleDemande}'",
    ]);

    $stock->increment('entree', $article->quantite);
    $stock->increment('stockActuel', $article->quantite);
}


        return redirect()->route('demande-achat.index')->with('success', 'Demande ajoutée avec succès !');
    }

    public function show($id)
    {
        $demande = DemandeAchat::with('ficheCommande')->findOrFail($id);
        return view('demande-achat.show', compact('demande'));
    }

    public function edit($id)
    {
        $demande = DemandeAchat::with('articles','ficheCommande')->findOrFail($id);
        return view('demande-achat.edit', compact('demande'));
    }

    public function update(Request $request, $id)
    {
        $demande = DemandeAchat::findOrFail($id);
        $validated = $request->validate([
            'numBonCommande' => 'required|string|unique:demande_achats,numBonCommande,'.$id,
            'atelier' => 'required|string|max:100',
            'natureTravaux' => 'nullable|string|max:150',
        ]);
        $demande->update($validated);

        return redirect()->route('demande-achat.index')->with('success', 'Demande modifiée !');
    }

    public function destroy($id)
    {
        $demande = DemandeAchat::findOrFail($id);
        $demande->delete();
        return redirect()->route('demande-achat.index')->with('success', 'Demande supprimé avec succès.');
    }
    public function generateDemande($id)
    {
        $demande = DemandeAchat::with('articles')->findOrFail($id);
        
        $outputDir = storage_path('generated_docs');
        if (!File::exists($outputDir)) {
            File::makeDirectory($outputDir,0755,true);
        }

        $template = new TemplateProcessor(storage_path('templates/demande_template.docx'));

        $template->setValue('date_demande', date('d/ m /Y',strtotime($demande->created_at)));
        $template->setValue('num_boncommande', $demande->numBonCommande);
        $template->setValue('atelier', $demande->atelier);
        $articles = $demande->articles->map(function($item) {
            return [
                'article_demande' => $item->articleDemande,
                'quantite' => $item->quantite,
                'unite' => $item->unite ?? ' ',
                'prix' => $item->prix ?? ' ',
                'total_prix' => (float) $item->prix * (int) $item->quantite,

            ];
        })->toArray();

        $totalHt = array_sum(array_column($articles, 'total_prix'));
        $template->cloneRow('article_demande', count($articles));

        foreach ($articles as $index => $row) {
            $i = $index + 1;
            $template->setValue("article_demande#{$i}", $row['article_demande']);
            $template->setValue("quantite#{$i}", $row['quantite']);
            $template->setValue("unite#{$i}", $row['unite']);
            $template->setValue("prix#{$i}", $row['prix']);
            $template->setValue("total_prix#{$i}", $row['total_prix']);
        }

        $template->setValue('total_ht', $totalHt);
        
        $tempFileName = $outputDir.'/temp_'.uniqid().'.docx';
        $template->saveAs($tempFileName);
        
        $outputFile = "demande d'Achat " .$demande->numBonCommande.'.docx';
        return response()->download($tempFileName,$outputFile)->deleteFileAfterSend(true);
    }

    public function downloadDemandeAndFiche($id)
    {
        $demande = DemandeAchat::with('articles')->findOrFail($id);

        $fiche = FicheCommande::with('articles')->where('numFiche', $demande->numFiche)->firstOrFail();

        $outputDir = storage_path('generated_docs');
        if (!File::exists($outputDir)) {
            File::makeDirectory($outputDir, 0755, true);
        }

        //  demande achat file

        $articlesDemande = $demande->articles->map(function($item) {
            return [
                'article_demande' => $item->articleDemande,
                'quantite' => $item->quantite,
                'unite' => $item->unite ?? ' ',
                'prix' => $item->prix ?? ' ',
                'total_prix' => (float) $item->prix * (int) $item->quantite,
            ];
        })->toArray();

        $totalHt = array_sum(array_column($articlesDemande, 'total_prix'));

        $template1 = new TemplateProcessor(storage_path('templates/demande_template.docx'));
        $template1->setValue('date_demande', date('d/m/Y', strtotime($demande->created_at)));
        $template1->setValue('num_boncommande', $demande->numBonCommande);
        $template1->setValue('atelier', $demande->atelier);

        $template1->cloneRow('article_demande', count($articlesDemande));
        foreach ($articlesDemande as $index => $row) {
            $i = $index + 1;
            $template1->setValue("article_demande#{$i}", $row['article_demande']);
            $template1->setValue("quantite#{$i}", $row['quantite']);
            $template1->setValue("unite#{$i}", $row['unite']);
            $template1->setValue("prix#{$i}", $row['prix']);
            $template1->setValue("total_prix#{$i}", $row['total_prix']);
        }
        $template1->setValue('total_ht', $totalHt);

        $file1 = $outputDir.'/demande_'.uniqid().'.docx';
        $template1->saveAs($file1);

        // fiche de commmande 
        
        $articlesFiche = $fiche->articles->map(function($item) {
            return [
                'article_demande' => $item->articleDemande,
                'quantite' => $item->quantite,
                'unite' => $item->unite ?? ' ',
            ];
        })->toArray();

        if (count($articlesFiche) < 4) {
            for ($i = 0; $i < 3; $i++) {
                $articles[] = [
                    'article_demande' => ' ',
                    'quantite' => ' ',
                    'unite' => ' ',
                ];
            }
        }
        

        $template2 = new TemplateProcessor(storage_path('templates/fiche_template.docx'));

        $template2->setValue('num_fiche', $fiche->numFiche);
        $template2->setValue('date_commande', date('d/m/Y', strtotime($fiche->dateCommande)));
        $template2->setValue('nom_demandeur', $fiche->nomDemandeur);
        $template2->setValue('chantier', $fiche->chantier);
        $template2->setValue('chef_atelier', $fiche->chefAtelier);

        $template2->cloneRow('article_demande', count($articlesFiche));
        foreach ($articlesFiche as $index => $row) {
            $i = $index + 1;
            $template2->setValue("article_demande#{$i}", $row['article_demande']);
            $template2->setValue("quantite#{$i}", $row['quantite']);
            $template2->setValue("unite#{$i}", $row['unite']);
        }

        $template2->setValue('description', $fiche->description);
        if ($fiche->schemaPlan) {
            try {
                $template2->setImageValue('shema', [
                    'path' => storage_path('app/public/'.$fiche->schemaPlan),
                    'width' => 620,
                    'height' => 180,
                    'ratio' => true
                ]);
            } catch (\Exception $e) {
                Log::error("Erreur lors de l'installation de la fiche #{$fiche->id}: ".$e->getMessage(), [
                    'fiche_id' => $fiche->id,
                    'schemaPlan' => $fiche->schemaPlan,
                ]);
                return redirect()->route('fiche-commande.index')->with('error_intallation', "Veuillez vérifier l’image et réessayer.");
            }
        } else {
            $template2->setValue('shema', '<w:br/><w:br/><w:br/><w:br/><w:br/>');
        }

        $file2 = $outputDir.'/fiche_'.uniqid().'.docx';
        $template2->saveAs($file2);

        // ziper les deux fichier

        $zipPath = $outputDir.'/demande_fiche_'.$demande->numBonCommande.'.zip';
        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
            $zip->addFile($file1, "Demande_Achat.docx");
            $zip->addFile($file2, "Fiche_Commande.docx");
            $zip->close();
        }

        unlink($file1);
        unlink($file2);

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }

    public function rapport(Request $request)
    {
        // $demandes = DemandeAchat::with([
        //     'articles',
        //     'ficheCommande.articles'
        // ])
        // ->orderBy('created_at', 'desc')
        // ->get();
        //  $query = DemandeAchat::with(['articles', 'ficheCommande.articles']);

        // // --- Filters ---
        // if ($request->filled('atelier')) {
        //     $query->where('atelier', 'like', '%' . $request->atelier . '%');
        // }

        // if ($request->filled('natureTravaux')) {
        //     $query->where('natureTravaux', 'like', '%' . $request->natureTravaux . '%');
        // }

        // if ($request->filled('date_from')) {
        //     $query->whereDate('created_at', '>=', $request->date_from);
        // }

        // if ($request->filled('date_to')) {
        //     $query->whereDate('created_at', '<=', $request->date_to);
        // }

        // $demandes = $query->paginate(10); // pagination
        // $count = $query->count();

        // return view('demande-achat.rapport', compact('demandes','count'));
    $query = DemandeAchat::with(['articles', 'ficheCommande.articles']);

// --- Filters ---
if ($request->filled('atelier')) {
    $query->where('atelier', 'like', '%' . $request->atelier . '%');
}

if ($request->filled('natureTravaux')) {
    $query->where('natureTravaux', 'like', '%' . $request->natureTravaux . '%');
}

if ($request->filled('date_from')) {
    $query->whereDate('created_at', '>=', $request->date_from);
}

if ($request->filled('date_to')) {
    $query->whereDate('created_at', '<=', $request->date_to);
}

if ($request->boolean('withFiche')) {
    $query->whereHas('ficheCommande');
}

$query->orderByDesc('created_at');

// --- Pagination ---
$demandes = $query->paginate(10)->appends($request->all());
$count = $query->count();

// --- Statistics based on filtered results ---
$todayDemandes = (clone $query)->whereDate('created_at', now())->count();
$totalArticles = (clone $query)->get()->pluck('articles')->flatten()->count();
$totalFiches = (clone $query)->whereHas('ficheCommande')->count();

return view('demande-achat.rapport', compact('demandes', 'count', 'todayDemandes', 'totalArticles', 'totalFiches'));


    }



    public function manageArticles($id)
    {
        $demande = DemandeAchat::with('articles')->where('id', $id)->firstOrFail();
        return view('demande-achat.manage-articles', compact('demande'));
    }

    public function manageFiche($demandeId)
    {
        $demande = DemandeAchat::findOrFail($demandeId);
        $fiche = $demande->ficheCommande;
        $fiches = FicheCommande::select('numFiche', 'nomDemandeur', 'atelier')->whereDoesntHave('demandeAchats')->where('numFiche', '!=', $fiche->numFiche)->get();
        return view('demande-achat.manage-fiche', compact('demande', 'fiche', 'fiches'));

    }

    public function changeFiche(Request $request, $demandeId)
    {
        $request->validate([
            'new_fiche' => 'required|exists:fiche_commandes,numFiche',
        ]);

        $demandeAchat = DemandeAchat::findOrFail($demandeId);
        
        try {
            $demandeAchat->numFiche = $request->new_fiche;
            $demandeAchat->save();

            return redirect()->route('demande-achat.edit',$demandeId)->with('success', 'La fiche a été changée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Impossible de changer la fiche pour le moment.');
        }
    }

    public function exportDemandesExcel()
    {
        $demandes = DemandeAchat::with(['articles', 'ficheCommande'])->get();
        $templatePath = storage_path('templates/demandes_achat.xlsx');
        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        $dataTemplateRow = 3;
        $articleHeaderRow = 4;
        $articleDataRow = 5;
        $currentRow = $dataTemplateRow;

        foreach ($demandes as $demande) {
            // --- Fill demande data ---
            foreach (range('B', 'K') as $col) {
                $sheet->duplicateStyle($sheet->getStyle("{$col}{$dataTemplateRow}"), "{$col}{$currentRow}");
            }
            $sheet->mergeCells("B{$currentRow}:C{$currentRow}"); // Date
            $sheet->mergeCells("D{$currentRow}:F{$currentRow}"); // Numéro Bon
            $sheet->mergeCells("G{$currentRow}:H{$currentRow}"); // Atelier
            $sheet->mergeCells("I{$currentRow}:K{$currentRow}"); // Nature travaux

            $sheet->setCellValue("B{$currentRow}", $demande->created_at->format('d/m/Y'));
            $sheet->setCellValue("D{$currentRow}", $demande->numBonCommande);
            $sheet->setCellValue("G{$currentRow}", $demande->atelier);
            $sheet->setCellValue("I{$currentRow}", $demande->natureTravaux);

            $currentRow++;

            // --- Duplicate article header ---
            foreach (range('B', 'K') as $col) {
                $sheet->duplicateStyle($sheet->getStyle("{$col}{$articleHeaderRow}"), "{$col}{$currentRow}");
                $sheet->setCellValue("{$col}{$currentRow}", $sheet->getCell("{$col}{$articleHeaderRow}")->getValue());
            }
            $sheet->mergeCells("B{$currentRow}:C{$currentRow}");
            $sheet->mergeCells("D{$currentRow}:F{$currentRow}");
            $sheet->mergeCells("G{$currentRow}:H{$currentRow}");
            $sheet->mergeCells("J{$currentRow}:K{$currentRow}");
            $currentRow++;

            $articlesCount = $demande->articles->count();

            if ($articlesCount === 0) {
                foreach (range('B', 'K') as $col) {
                    $sheet->duplicateStyle($sheet->getStyle("{$col}{$articleDataRow}"), "{$col}{$currentRow}");
                }

                $sheet->mergeCells("B{$currentRow}:C{$currentRow}");
                $sheet->mergeCells("D{$currentRow}:F{$currentRow}");
                $sheet->mergeCells("G{$currentRow}:H{$currentRow}");
                $sheet->mergeCells("J{$currentRow}:K{$currentRow}");

                $sheet->setCellValue("B{$currentRow}", ' ');
                $sheet->setCellValue("D{$currentRow}", ' ');
                $sheet->setCellValue("G{$currentRow}", ' ');
                $sheet->setCellValue("I{$currentRow}", ' ');
                $sheet->setCellValue("J{$currentRow}", ' ');

                $currentRow++;
            } else {
                foreach ($demande->articles as $article) {
                    foreach (range('B', 'K') as $col) {
                        $sheet->duplicateStyle($sheet->getStyle("{$col}{$articleDataRow}"), "{$col}{$currentRow}");
                    }
                    $sheet->mergeCells("B{$currentRow}:C{$currentRow}");
                    $sheet->mergeCells("D{$currentRow}:F{$currentRow}");
                    $sheet->mergeCells("G{$currentRow}:H{$currentRow}");
                    $sheet->mergeCells("J{$currentRow}:K{$currentRow}");

                    $sheet->setCellValue("B{$currentRow}", ' ');
                    $sheet->setCellValue("D{$currentRow}", $article->articleDemande);
                    $sheet->setCellValue("G{$currentRow}", $article->quantite);
                    $sheet->setCellValue("I{$currentRow}", $article->unite);
                    $sheet->setCellValue("J{$currentRow}", $article->prix);

                    $currentRow++;
                }
            }

            foreach (range('B', 'K') as $col) {
                $sheet->duplicateStyle($sheet->getStyle("{$col}{$articleDataRow}"), "{$col}{$currentRow}");
            }

            $sheet->mergeCells("B{$currentRow}:C{$currentRow}");
            $sheet->mergeCells("D{$currentRow}:E{$currentRow}"); // numero fiche
            $sheet->mergeCells("F{$currentRow}:G{$currentRow}"); // nom demandeur
            $sheet->mergeCells("H{$currentRow}:I{$currentRow}"); // atelier
            $sheet->mergeCells("J{$currentRow}:K{$currentRow}"); // date commande

            // Fill colors
            $sheet->getStyle("B{$currentRow}:C{$currentRow}")->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setRGB('D9D9D9');
            $sheet->getStyle("D{$currentRow}:K{$currentRow}")->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setRGB('BDD7EE');

            $sheet->setCellValue("B{$currentRow}", 'Ca fiche');
            $sheet->setCellValue("D{$currentRow}", 'N fiche ');
            $sheet->setCellValue("F{$currentRow}", 'Nom demandeur');
            $sheet->setCellValue("H{$currentRow}", 'Atelier');
            $sheet->setCellValue("J{$currentRow}", 'Date de commande');

            $currentRow++;

            foreach (range('B', 'K') as $col) {
                $sheet->duplicateStyle($sheet->getStyle("{$col}{$articleDataRow}"), "{$col}{$currentRow}");
            }

            $sheet->mergeCells("B{$currentRow}:C{$currentRow}"); // empty gray
            $sheet->mergeCells("D{$currentRow}:E{$currentRow}"); // numero fiche
            $sheet->mergeCells("F{$currentRow}:G{$currentRow}"); // nom demandeur
            $sheet->mergeCells("H{$currentRow}:I{$currentRow}"); // atelier
            $sheet->mergeCells("J{$currentRow}:K{$currentRow}"); // date commande

            // Keep B:C gray
            $sheet->getStyle("B{$currentRow}:C{$currentRow}")->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setRGB('D9D9D9'); // gray

            $sheet->setCellValue("D{$currentRow}", $demande->ficheCommande->numFiche);
            $sheet->setCellValue("F{$currentRow}", $demande->ficheCommande->nomDemandeur);
            $sheet->setCellValue("H{$currentRow}", $demande->ficheCommande->atelier);
            $sheet->setCellValue("J{$currentRow}", $demande->ficheCommande->dateCommande);

            $currentRow++;

            $sheet->mergeCells("B{$currentRow}:K{$currentRow}");
            $sheet->setCellValue("B{$currentRow}", '');
            $sheet->getStyle("B{$currentRow}:K{$currentRow}")->applyFromArray([
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['rgb' => '000000']
                ]
            ]);
            $currentRow++;

            }

        $outputDir = storage_path('generated_docs');
        if (!File::exists($outputDir)) {
            File::makeDirectory($outputDir, 0755, true);
        }
        $filePath = $outputDir . '/demandes_export.xlsx';

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

}