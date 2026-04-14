@extends('layout.master')

@section('title', 'Modifier une consommation')

@section('content')
<div class="bg-white/90 rounded-2xl shadow-xl p-8">
    <h1 class="text-4xl font-extrabold text-gray-800 mb-10">
        <i class="fa-solid fa-pen-to-square text-indigo-600"></i>
        Modifier la consommation
    </h1>

    <form action="{{ route('consommation.update', 5) }}" method="POST" class="space-y-10">
        @csrf
        @method('PUT')

        {{-- Section: Détails de la consommation --}}
        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-200 shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-file-pen text-indigo-500"></i>
                Détails de la consommation
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label for="numConsommation" class="block text-sm font-semibold text-gray-600 mb-2">
                        N° Consommation
                    </label>
                    <input 
                        type="text" 
                        name="numConsommation" 
                        id="numConsommation" 
                        value="{{ old('numConsommation', $consommation['numConsommation']) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl shadow-sm text-gray-700 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:outline-none transition" 
                        required
                    >
                </div>

                <div>
                    <label for="chantier" class="block text-sm font-semibold text-gray-600 mb-2">
                        Chantier
                    </label>
                    <select 
                        name="chantier" 
                        id="chantier" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl shadow-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:outline-none transition" 
                        required
                    >
                        <option value="">Sélectionner un chantier</option>
                        <option value="Chantier A" {{ old('chantier', $consommation['chantier']) == 'Chantier A' ? 'selected' : '' }}>Chantier A</option>
                        <option value="Chantier B" {{ old('chantier', $consommation['chantier']) == 'Chantier B' ? 'selected' : '' }}>Chantier B</option>
                        <option value="Chantier C" {{ old('chantier', $consommation['chantier']) == 'Chantier C' ? 'selected' : '' }}>Chantier C</option>
                    </select>
                </div>

                <div>
                    <label for="numFiche" class="block text-sm font-semibold text-gray-600 mb-2">
                        N° Fiche liée
                    </label>
                    <input 
                        type="text" 
                        name="numFiche" 
                        id="numFiche" 
                        value="{{ old('numFiche', $consommation['numFiche']) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl shadow-sm text-gray-700 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:outline-none transition" 
                        required
                    >
                </div>
            </div>
        </div>

        {{-- Section: Article consommé --}}
        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-200 shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-cubes-stacked text-purple-600"></i>
                Détails de l’article consommé
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="article" class="block text-sm font-semibold text-gray-600 mb-2">Article</label>
                    <input 
                        type="text" 
                        name="article" 
                        id="article" 
                        value="{{ old('article', $consommation['article']) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl shadow-sm text-gray-700 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:outline-none transition" 
                        required
                    >
                </div>
                <div>
                    <label for="quantite" class="block text-sm font-semibold text-gray-600 mb-2">Quantité consommée</label>
                    <input 
                        type="number" 
                        name="quantite" 
                        id="quantite" 
                        value="{{ old('quantite', $consommation['quantite']) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl shadow-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:outline-none transition" 
                        required
                    >
                </div>
                <div>
                    <label for="unite" class="block text-sm font-semibold text-gray-600 mb-2">Unité</label>
                    <input 
                        type="text" 
                        name="unite" 
                        id="unite" 
                        value="{{ old('unite', $consommation['unite']) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl shadow-sm text-gray-700 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:outline-none transition" 
                        required
                    >
                </div>
                <div>
                    <label for="coutUnitaire" class="block text-sm font-semibold text-gray-600 mb-2">Coût unitaire</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="coutUnitaire" 
                        id="coutUnitaire" 
                        value="{{ old('coutUnitaire', $consommation['coutUnitaire']) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl shadow-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:outline-none transition"
                    >
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex justify-end items-center gap-5 mt-10">
            <a href="{{ route('consommation.index') }}" class="bg-gray-200 text-gray-800 font-semibold px-6 py-2 rounded-xl shadow hover:bg-gray-300 transition flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i>
                Retour
            </a>
            <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-8 py-3 rounded-xl shadow-lg transition flex items-center gap-2">
                <i class="fa-solid fa-save text-xl"></i>
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection