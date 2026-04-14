<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsommationController extends Controller
{
    private $consommations = [
        [
            'id' => 1,
            'numConsommation' => 'C-001',
            'dateConsommation' => '2025-09-06',
            'chantier' => 'Chantier A',
            'numFiche' => 'F-101',
            'article' => 'Ciment',
            'quantite' => 20,
            'unite' => 'Sac',
            'coutUnitaire' => 75.5,
        ],
        [
            'id' => 2,
            'numConsommation' => 'C-002',
            'dateConsommation' => '2025-09-07',
            'chantier' => 'Chantier B',
            'numFiche' => 'F-202',
            'article' => 'Fer',
            'quantite' => 15,
            'unite' => 'Kg',
            'coutUnitaire' => 120,
        ],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consommations = $this->consommations;
        return view('consommation.index', compact('consommations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('consommation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numConsommation' => 'required|string|max:50',
            'dateConsommation' => 'required|date',
            'chantier' => 'required|string|max:100',
            'numFiche' => 'required|string|max:50',
            'article' => 'required|string|max:100',
            'quantite' => 'required|numeric|min:1',
            'unite' => 'required|string|max:20',
            'coutUnitaire' => 'nullable|numeric|min:0',
        ]);

        // Simulation: store in array
        $validated['id'] = count($this->consommations) + 1;

        // Normally: Consommation::create($validated);
        return redirect()->route('consommation.index')
                         ->with('success', 'Consommation ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $consommation =  [
            'id' => 1,
            'numConsommation' => 'C-001',
            'dateConsommation' => '2025-09-06',
            'chantier' => 'Chantier A',
            'numFiche' => 'F-101',
            'article' => 'Ciment',
            'quantite' => 20,
            'unite' => 'Sac',
            'coutUnitaire' => 75.5,
        ];
        return view('consommation.show', compact('consommation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $consommation =  [
            'id' => 1,
            'numConsommation' => 'C-001',
            'dateConsommation' => '2025-09-06',
            'chantier' => 'Chantier A',
            'numFiche' => 'F-101',
            'article' => 'Ciment',
            'quantite' => 20,
            'unite' => 'Sac',
            'coutUnitaire' => 75.5,
        ];
        return view('consommation.edit', compact('consommation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'numConsommation' => 'required|string|max:50',
            'dateConsommation' => 'required|date',
            'chantier' => 'required|string|max:100',
            'numFiche' => 'required|string|max:50',
            'article' => 'required|string|max:100',
            'quantite' => 'required|numeric|min:1',
            'unite' => 'required|string|max:20',
            'coutUnitaire' => 'nullable|numeric|min:0',
        ]);

        // Simulation: update array
        // Normally: Consommation::findOrFail($id)->update($validated);

        return redirect()->route('consommation.index')
                         ->with('success', 'Consommation mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Simulation: remove from array
        // Normally: Consommation::destroy($id);

        return redirect()->route('consommation.index')
                         ->with('success', 'Consommation supprimée avec succès.');
    }
}