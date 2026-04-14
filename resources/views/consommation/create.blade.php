@extends('layout.master')

@section('title', 'Ajouter une consommation')

@section('content')
<div class="bg-white/90 rounded-2xl shadow-xl p-8">
    <h1 class="text-4xl font-extrabold text-gray-800 mb-10">
        {{-- <i class="fa-solid fa-bottle-water text-green-600"></i> --}}
        Ajouter une consommation
    </h1>

    <div class="space-y-10">
        {{-- {{ route('consommations.store') }} --}}
        {{-- @csrf --}}

        {{-- Section: Détails de la consommation --}}
        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-200 shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-file-circle-plus text-indigo-500"></i>
                la demande
            </h3>
            <form class="flex items-end gap-8">
                
                <div class="flex-1">
                    <label for="demande" class="block text-sm font-semibold text-gray-600 mb-2">
                        La demande 
                    </label>
                    <input 
                        type="text" 
                        list="demande"
                        name="demande" 
                        id="demande"
                        autocomplete="off"
                        placeholder="Entrez la demande"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl shadow-sm text-gray-700 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:outline-none transition" 
                        required
                    >
                    <datalist id="demandeList">
                        <option value="BC-1234 soudor - construction">BC-1234 soudor - construction</option>
                        <option value="BC-5654 atelier - Lorem, ipsum dolor">BC-5654 atelier - Lorem, ipsum dolor</option>
                        <option value="BC-4444 soudor - dolor sit amet.">BC-4444 soudor - dolor sit amet.</option>
                    </datalist>
                </div>
                <button type="button" id="addArticleBtn" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> Selectionner la demande
                </button>
            </form>
        </div>

        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-200 shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-box text-indigo-500"></i>
                Choiser l'article
            </h3>
            <form class="flex items-end gap-8">
                
                <div class="flex-1">
                    <label for="article" class="block text-sm font-semibold text-gray-600 mb-2">
                        L'article
                    </label>
                    <input 
                        type="text" 
                        list="articleList"
                        name="article" 
                        id="article"
                        autocomplete="off"
                        placeholder="Entrez la article"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-xl shadow-sm text-gray-700 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:outline-none transition" 
                        required
                    >
                    <datalist id="articleList">
                        <option value="BC-1234 soudor - construction">BC-1234 soudor - construction</option>
                        <option value="BC-5654 atelier - Lorem, ipsum dolor">BC-5654 atelier - Lorem, ipsum dolor</option>
                        <option value="BC-4444 soudor - dolor sit amet.">BC-4444 soudor - dolor sit amet.</option>
                    </datalist>
                </div>
                <button type="button" id="addArticleBtn" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> Selectionner l'article
                </button>
            </form>
        </div>

        <form action="#" method="POST">
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
                            placeholder="Ex: Acier, Bois..."
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl shadow-sm text-gray-700 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:outline-none transition" 
                            required
                        >
                    </div>
                    <div>
                        <label for="quantite" class="block text-sm font-semibold text-gray-600 mb-2">Quantité</label>
                        <input 
                            type="number" 
                            name="quantite" 
                            id="quantite" 
                            placeholder="Ex: 20"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl shadow-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:outline-none transition" 
                            required
                        >
                    </div>
                    <div>
                        <label for="quantiteConsomme" class="block text-sm font-semibold text-gray-600 mb-2">Quantité consommée</label>
                        <input 
                            type="number" 
                            name="quantiteConsomme" 
                            id="quantiteConsomme" 
                            placeholder="Ex: 20"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl shadow-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:outline-none transition" 
                            required
                        >
                    </div>
                </div>
            </div>
    
            {{-- Actions --}}
            <div class="flex justify-end items-center gap-5 mt-10">
                <a href="{{route('consommation.index')}}" class="bg-gray-200 text-gray-800 font-semibold px-6 py-2 rounded-xl shadow hover:bg-gray-300 transition flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i>
                    Retour
                </a>
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold px-8 py-3 rounded-xl shadow-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i>
                    Enregistrer la consommation
                </button>
            </div>
        </form>
    </div>
</div>
@endsection