<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Models\ProductionArticle;
use Illuminate\Http\Request;

class ProductionArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'filterNomProduction' => 'nullable|string|max:100',
            'filterArticle' => 'nullable|string|max:100',
            'quantiteMin' => 'nullable|integer',
            'quantiteMax' => 'nullable|integer',
        ]);

        $query = ProductionArticle::query()->with('production');

        if ($request->filled('filterNomProduction')) {
            $query->whereHas('production', function ($q) use ($request) {
                $q->where('produitFinale', 'like', '%' . $request->filterNomProduction . '%');
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
        $productions = Production::select('numProduction', 'produitFinale')->whereHas('articles')->get();
        return view('production-article.index', compact('articles', 'productions'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'numProduction' => 'required|exists:productions,numProduction',
            'articleDemande' => 'required|string|min:2',
            'quantite' => 'required|integer|min:1',
            'unite' => 'nullable|string|max:10',
            'prix' => 'nullable|numeric|min:1',
        ]);
        
        if (!$validated['prix']) {
            $validated['prix'] = 0;
        }
        ProductionArticle::create($validated);
        return redirect()->back()->with('success', 'Article créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = ProductionArticle::findOrFail($id);
        return view('production-article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = ProductionArticle::findOrFail($id);
        $validated = $request->validate([
            'articleDemande' => 'required|string|min:2',
            'quantite' => 'required|integer|min:1',
            'unite' => 'nullable|string|max:10',
            'prix' => 'nullable|numeric|min:0',
        ]);

        $article->update($validated);
        return redirect()->route('production-article.edit',$id)->with('success', 'Article mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = ProductionArticle::findOrFail($id);

        try {
            $article->delete();
            return redirect()->back()->with('success', 'Article supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Impossible de supprimer l\'article.');
        }
    }
}
