<?php

namespace App\Http\Controllers;

use App\Models\FicheArticle;
use App\Models\FicheCommande;
use Illuminate\Http\Request;

class FicheArticleController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'filterNumfiche' => 'nullable|exists:fiche_commandes,numFiche',
            'filterArticle' => 'nullable|string|max:100',
            'filterQuantite' => 'nullable|integer',
            'quantiteMin' => 'nullable|integer',
            'quantiteMax' => 'nullable|numeric',
        ]);

        $query = FicheArticle::query();

        if ($request->filled('filterNumfiche')) {
            $query->whereHas('fiche', function ($q) use ($request) {
                $q->where('numFiche', $request->filterNumfiche);
            });
        }
        if ($request->filled('filterArticle')) {
            $query->where('articleDemande', 'like', '%' . $request->filterArticle . '%');
        }
        if ($request->filled('quantiteMin')) {
            $query->where('quantite', '>=', $request->quantiteMin);
        }

        if ($request->filled('quantiteMax')) {
            $query->where('quantite', '<=', $request->quantiteMax);
        }


        $articles = $query->orderBy('created_at', 'desc')->paginate(10);
        $fiches = FicheCommande::select('numFiche', 'nomDemandeur', 'chantier')->whereHas('articles')->get();

        return view('fiche-article.index', compact('articles', 'fiches'));
    }

    public function store(Request $request)
    {
        // dd('enter');
        $validated = $request->validate([
            'fiche_numFiche' => 'required|exists:fiche_commandes,numFiche',
            'articleDemande' => 'required|string|min:3',
            'quantite' => 'required|integer|min:1',
            'unite' => 'nullable|string|max:10',
        ]);
        $article = FicheArticle::create($validated);
        return redirect()->route('fiche-commande.manage-articles',$article->fiche_numFiche)->with('success','Article créé avec succès.');
    }

    public function edit($id)
    {
        $article = FicheArticle::findOrFail($id);
        return view('fiche-article.edit', compact('article'));
    }

    public function update(Request $request, string $id)
    {
        $article = FicheArticle::findOrFail($id);
        $validated = $request->validate([
            'articleDemande' => 'required|string|min:3',
            'quantite' => 'required|integer|min:1',
            'unite' => 'nullable|string|max:10',
        ]);

        $article->update($validated);

        return redirect()->route('fiche-article.edit',$article->id)->with('success', 'Article mis à jour avec succès.');
    }


    public function destroy($id)
    {
        $article = FicheArticle::findOrFail($id);
        $articlesCount = FicheArticle::where('fiche_numFiche', $article->fiche_numFiche)->count();

        if ($articlesCount <= 1) {
            return redirect()->back()->with('warning', 'Impossible de supprimer cette article, Chaque fiche doit contenir au moins un article.');
        }
        $article->delete();
        return redirect()->back()->with('success', 'Article supprimé avec succès.');
    }

}
