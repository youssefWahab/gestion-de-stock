<?php

namespace App\Http\Controllers;

use App\Models\AchatArticle;
use App\Models\DemandeAchat;
use Illuminate\Http\Request;

class AchatArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'filterBonCommande' => 'nullable|exists:demande_achats,numBonCommande',
            'filterArticle' => 'nullable|string|max:100',
            'filterQuantite' => 'nullable|integer',
            'quantiteMin' => 'nullable|integer',
            'quantiteMax' => 'nullable|integer',
        ]);

        $query = AchatArticle::query();

        if ($request->filled('filterBonCommande')) {
            $query->whereHas('demandeAchat', function ($q) use ($request) {
                $q->where('numBonCommande', $request->filterBonCommande);
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

        $articles = $query->with('demandeAchat')->orderBy('created_at', 'desc')->paginate(10);
        $demandes = DemandeAchat::select('numBonCommande', 'atelier', 'natureTravaux')->whereHas('articles')->get();
        return view('article-achat.index', compact('articles','demandes'));
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'demande_achat_id' => 'required|exists:demande_achats,id',
            'articleDemande' => 'required|string|min:2',
            'quantite' => 'required|integer|min:1',
            'unite' => 'nullable|string|max:10',
            'prix' => 'nullable|numeric',
        ]);
        AchatArticle::create($validated);
        return redirect()->back()->with('success', 'Article créé avec succès.');
    }

    public function show(AchatArticle $achatArticle)
    {
        //
    }


    public function edit($id)
    {
        $article = AchatArticle::findOrFail($id);
        return view('article-achat.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = AchatArticle::findOrFail($id);

        $validated = $request->validate([
            'articleDemande' => 'required|string|min:2',
            'quantite' => 'required|integer|min:1',
            'unite' => 'nullable|string|max:10',
            'prix' => 'nullable|numeric',
        ]);

        $article->update($validated);
        return redirect()->route('article-achat.edit',$article->id)->with('success', 'Article mis à jour avec succès.');
    }
    
    public function destroy($id)
    {
        $article = AchatArticle::findOrFail($id);

        
        $articlesCount = AchatArticle::where('demande_achat_id', $article->demande_achat_id)->count();

        if ($articlesCount <= 1) {
            return redirect()->back()->with('warning', 'Impossible de supprimer cette article, Chaque demande doit contenir au moins un article.');
        }
        $article->delete();
        return redirect()->back()->with('success', 'Article supprimé avec succès.');
    }
}
