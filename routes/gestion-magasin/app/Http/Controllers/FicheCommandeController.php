<?php

namespace App\Http\Controllers;

// use App\Models\FicheArticle;
use App\Models\FicheCommande;
// use FFI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
// use mikehaertl\pdftk\Pdf;
// use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\TemplateProcessor;

use Illuminate\Support\Facades\Log;

class FicheCommandeController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'filterNom' => 'nullable|string|max:45',
            'filterChantier' => 'nullable|string|max:255',
            'filterNumFiche' => 'nullable|string|max:50',
            'filterAtelier' => 'nullable|string',
        ]);

        $query = FicheCommande::query();

        if ($request->filled('filterNom')) {
            $query->where('nomDemandeur', 'like', '%' . $request->filterNom . '%');
        }

        if ($request->filled('filterChantier')) {
            $query->where('chantier', 'like', '%' . $request->filterChantier . '%');
        }

        if ($request->filled('filterNumFiche')) {
            $query->where('numFiche', $request->filterNumFiche);
        }

        if ($request->filled('filterAtelier')) {
            $query->where('atelier', $request->filterAtelier );
        }

        $fiches = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('fiche-commande.index', compact('fiches'));
    }

    public function create()
    {
        return view('fiche-commande.create');
    }

    public function store(Request $request)
    {
        $validatedFiche = $request->validate([
            'numFiche' => 'required|unique:fiche_commandes,numFiche',
            'nomDemandeur' => 'required|string|min:3|max:100',
            'chantier' => 'required|string|min:3|max:100',
            'chefAtelier' => 'required|string|min:3|max:100',
            'atelier' => 'required|string|min:3|max:100',
            'dateCommande' => 'required|date',
            'description' => 'nullable|string',
            'schemaPlan' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            
            'articles' => 'required|array|min:1',
            'articles.*' => 'required|string|min:3',
            'quantites' => 'required|array|min:1',
            'quantites.*' => 'required|integer|min:1',
        ]);

        if ($request->hasFile('schemaPlan')) {
            $file = $request->file('schemaPlan');
            $path = $file->store('schemas', 'public');
            $validatedFiche['schemaPlan'] = $path;
        }

        $fiche = FicheCommande::create($validatedFiche);

        $articles = $request->input('articles', []);
        $quantites = $request->input('quantites', []);
        $unites = $request->input('unites', []);

        if (count($articles) !== count($quantites)) {
            return redirect()->route('fiche-commande.index')->with('error', "Une erreur est survenue lors de l'ajout de cette fiche.");
        }

        foreach ($articles as $index => $articleName) {
            $quantity = $quantites[$index] ?? null; 
            $unite = $unites[$index] ?? null;

            if (!empty($articleName) && $quantity !== null && $quantity > 0) {
                $fiche->articles()->create([
                    'articleDemande' => $articleName,
                    'quantite'       => $quantity,
                    'unite'          => $unite, 
                ]);
            }
        }

        return redirect()->route('fiche-commande.index')->with('success', 'Fiche de commande créée avec succès.');
    }

    public function show($id)
    {
        $fiche = FicheCommande::with('articles')->findOrFail($id);
        return view('fiche-commande.show', compact('fiche'));
    }

    public function edit($id)
    {
        $fiche = FicheCommande::with('articles')->findOrFail($id);
        return view('fiche-commande.edit', compact('fiche'));
    }



    public function update(Request $request, $id)
    {
        $fiche = FicheCommande::findOrFail($id);

        $validated = $request->validate([
            'nomDemandeur' => 'required|string|min:3|max:100',
            'chantier' => 'required|string|min:3|max:100',
            'chefAtelier' => 'required|string|min:3|max:100',
            'atelier' => 'required|string|min:3|max:100',
            'dateCommande' => 'required|date',
            'description' => 'nullable|string',
            'schemaPlan' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('schemaPlan')) {
            $file = $request->file('schemaPlan');
            $path = $file->store('schemas', 'public');
            $validated['schemaPlan'] = $path;
        }
        
        $fiche->update($validated);

        return redirect()->route('fiche-commande.index')->with('success', 'Fiche de commande mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $fiche = FicheCommande::findOrFail($id);
        $fiche->delete();
        return redirect()->route('fiche-commande.index')->with('success','Fiche de commande supprimé avec succès.');
    }

    public function generateFiche($id)
    {
        $fiche = FicheCommande::with('articles')->findOrFail($id);
        
        $outputDir = storage_path('generated_docs');
        if (!File::exists($outputDir)) {
            File::makeDirectory($outputDir,0755,true);
        }
        $template = new TemplateProcessor(storage_path('templates/fiche_template.docx'));
        $template->setValue('num_fiche', $fiche->numFiche);
        $template->setValue('date_commande', date('d / m / Y',strtotime($fiche->dateCommande)));
        $template->setValue('nom_demandeur', $fiche->nomDemandeur);
        $template->setValue('chantier', $fiche->chantier);
        $template->setValue('chef_atelier', $fiche->chefAtelier);

        $articles = $fiche->articles->map(function($item) {
            return [
                'article_demande' => $item->articleDemande,
                'quantite' => $item->quantite,
                'unite' => $item->unite ?? ' ',
            ];
        })->toArray();

        if (count($articles) < 4) {
            for ($i = 0; $i < 3; $i++) {
                $articles[] = [
                    'article_demande' => ' ',
                    'quantite' => ' ',
                    'unite' => ' ',
                ];
            }
        }
        
        $template->cloneRow('article_demande', count($articles));

        foreach ($articles as $index => $row) {
            $i = $index + 1;
            $template->setValue("article_demande#{$i}", $row['article_demande']);
            $template->setValue("quantite#{$i}", $row['quantite']);
            $template->setValue("unite#{$i}", $row['unite']);
        }

        $template->setValue('description', $fiche->description);
        if ($fiche->schemaPlan) {
            try {
                $template->setImageValue('shema', [
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
                return redirect()->route('fiche-commande.index')->with('error', "Veuillez vérifier l’image et réessayer.");
            }

        } else {
            $template->setValue('shema', '<w:br/><w:br/><w:br/><w:br/><w:br/>');
        }
        
        $tempFileName = $outputDir.'/temp_'.uniqid().'.docx';
        $template->saveAs($tempFileName);
        
        $outputFile = 'Fiche de commande '.$fiche->numFiche.'.docx';
        return response()->download($tempFileName,$outputFile)->deleteFileAfterSend(true);
    }
    
    public function manageArticles($numFiche)
    {
        $fiche = FicheCommande::with('articles')->where('numFiche', $numFiche)->firstOrFail();
        return view('fiche-commande.manage-articles', compact('fiche'));
    }
}