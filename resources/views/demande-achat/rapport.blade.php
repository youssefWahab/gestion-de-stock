{{-- resources/views/demandes/rapport-all.blade.php --}}
@extends('layout.master')

@section('title', 'Rapport de toutes les demandes')

@section('content')
<div class="bg-gradient-to-tr from-blue-50 via-purple-50 to-blue-100 rounded-2xl shadow-xl p-8 border border-blue-100">

    <h1 class="text-3xl font-bold text-gray-800 mb-8 flex items-center gap-3">
        <i class="fa-solid fa-file-lines text-blue-600"></i>
        Rapport de toutes les demandes
    </h1>

        {{-- Statistics Section --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">

    {{-- Total demandes --}}
    <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center justify-center border border-gray-100">
        <i class="fa-solid fa-list-check text-3xl text-blue-600 mb-2"></i>
        <p class="text-gray-500 text-sm">Total demandes</p>
        <p class="text-2xl font-bold text-gray-900">{{ $count }}</p>
    </div>

    {{-- Today's demandes --}}
    <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center justify-center border border-gray-100">
        <i class="fa-solid fa-calendar-day text-3xl text-green-600 mb-2"></i>
        <p class="text-gray-500 text-sm">Demandes aujourd'hui</p>
        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\DemandeAchat::whereDate('created_at', now())->count() }}</p>
    </div>

    {{-- Total articles --}}
    <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center justify-center border border-gray-100">
        <i class="fa-solid fa-boxes-packing text-3xl text-purple-600 mb-2"></i>
        <p class="text-gray-500 text-sm">Total articles</p>
        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\AchatArticle::count() }}</p>
    </div>

    {{-- Total fiches --}}
    <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center justify-center border border-gray-100">
        <i class="fa-solid fa-file-invoice text-3xl text-indigo-600 mb-2"></i>
        <p class="text-gray-500 text-sm">Fiches liées</p>
        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\FicheCommande::count() }}</p>
    </div>
</div>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('demande-achat.rapport') }}" 
      class="mb-10 bg-gradient-to-tr from-white via-blue-50 to-purple-50 p-8 rounded-3xl shadow-xl border border-gray-100">

    {{-- Header --}}
    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-3">
        <i class="fa-solid fa-filter text-indigo-600 text-lg"></i> 
        <span>Filtres de recherche</span>
    </h2>

    {{-- Grid filters --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Atelier --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Atelier</label>
            <input type="text" name="atelier" value="{{ request('atelier') }}" 
                   placeholder="Ex: Menuiserie"
                   class="w-full px-4 py-2.5 border rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition bg-white/90">
        </div>

        {{-- Nature Travaux --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nature des travaux</label>
            <input type="text" name="natureTravaux" value="{{ request('natureTravaux') }}" 
                   placeholder="Ex: Réparation"
                   class="w-full px-4 py-2.5 border rounded-2xl shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition bg-white/90">
        </div>

        {{-- Date From --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Date de début</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}"
                   class="w-full px-4 py-2.5 border rounded-2xl shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition bg-white/90">
        </div>

        {{-- Date To --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Date de fin</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}"
                   class="w-full px-4 py-2.5 border rounded-2xl shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition bg-white/90">
        </div>

        {{-- With Fiche --}}
        <div class="flex items-center mt-7">
            <input type="checkbox" name="withFiche" value="1" {{ request('withFiche') ? 'checked' : '' }} 
                   class="h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 transition">
            <label class="ml-2 text-sm font-medium text-gray-700">Avec fiche de commande</label>
        </div>
    </div>

    {{-- Buttons --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mt-10">
        <button type="submit"
                class="w-full md:w-auto px-6 py-3 rounded-2xl bg-gradient-to-r from-blue-600 to-purple-600 
                       text-white font-semibold shadow-md hover:from-blue-700 hover:to-purple-700 
                       transition flex items-center justify-center gap-2">
            <i class="fa-solid fa-magnifying-glass"></i> Appliquer les filtres
        </button>

        {{-- Export Excel --}}
        <a href="{{ route('demande-achat.export-excel', request()->all()) }}"
           class="w-full md:w-auto group inline-flex items-center justify-center gap-2 px-6 py-3 
                  rounded-2xl bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-semibold 
                  shadow-md hover:from-indigo-600 hover:to-blue-700 transition-all duration-300">
            <i class="fa-solid fa-cloud-arrow-down text-lg transform group-hover:scale-110 group-hover:-translate-y-1 transition-transform duration-300"></i>
            <span>Télécharger en Excel</span>
        </a>
    </div>
</form>


    {{-- Count --}}
    {{-- <div class="bg-white p-4 rounded-xl shadow mb-8 flex items-center justify-between border border-gray-100">
        <p class="text-gray-700 text-lg">
            <i class="fa-solid fa-list-check text-blue-600 mr-2"></i>
            Total : <span class="font-bold text-gray-900">{{ $count }}</span> demandes
        </p>
    </div> --}}



    {{-- List demandes --}}
    @forelse($demandes as $demande)
        <div class="mb-10 bg-white rounded-xl shadow p-6 border border-gray-200 hover:shadow-lg transition">
            {{-- Header demande --}}
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">
                        Demande : {{ $demande->numBonCommande ?? 'Sans N° Bon' }}
                    </h2>
                    <p class="text-sm text-gray-500">Atelier : {{ $demande->atelier }}</p>
                    <p class="text-sm text-gray-500">Nature travaux : {{ $demande->natureTravaux }}</p>
                </div>
                <span class="text-xs text-gray-400">Créée le {{ $demande->created_at->format('d/m/Y') }}</span>
            </div>

            {{-- Articles demande --}}
            <h3 class="text-md font-semibold text-purple-700 mb-2">Articles de la demande</h3>
            <div class="overflow-x-auto border border-gray-200 rounded-lg mb-6">
                <table class="min-w-full bg-white">
                    <thead class="bg-indigo-50 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-2">Article</th>
                            <th class="px-4 py-2">Quantité</th>
                            <th class="px-4 py-2">Unité</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm text-center">
                        @forelse($demande->articles as $article)
                            <tr>
                                <td class="px-4 py-2 font-medium text-gray-800">{{ $article->articleDemande }}</td>
                                <td class="px-4 py-2">{{ $article->quantite }}</td>
                                <td class="px-4 py-2">{{ $article->unite ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-gray-400 italic">Aucun article</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Fiche commande liée --}}
            <h3 class="text-md font-semibold text-blue-700 mb-2">Fiche de commande liée</h3>
            @if($demande->ficheCommande)
                <p class="text-sm mb-2">N° Fiche :
                    <span class="font-bold text-gray-800">{{ $demande->ficheCommande->numFiche }}</span>
                </p>
                <div class="overflow-x-auto border border-gray-200 rounded-lg">
                    <table class="min-w-full bg-white">
                        <thead class="bg-purple-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-2">Article</th>
                                <th class="px-4 py-2">Quantité</th>
                                <th class="px-4 py-2">Unité</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-sm text-center">
                            @forelse($demande->ficheCommande->articles as $ficheArticle)
                                <tr>
                                    <td class="px-4 py-2 font-medium text-gray-800">{{ $ficheArticle->articleDemande }}</td>
                                    <td class="px-4 py-2">{{ $ficheArticle->quantite }}</td>
                                    <td class="px-4 py-2">{{ $ficheArticle->unite ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-gray-400 italic">Aucun article</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-400 italic">Aucune fiche de commande liée</p>
            @endif
        </div>
    @empty
        {{-- Modern Empty State --}}
        <div class="flex flex-col items-center justify-center text-center py-16 bg-white rounded-2xl shadow-md border border-gray-200">
            <i class="fa-solid fa-folder-open text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucune demande trouvée</h3>
            <p class="text-gray-500 mb-6">Essayez d’ajuster vos filtres ou votre recherche.</p>
            <a href="{{ route('demande-achat.index') }}" 
               class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:from-blue-700 hover:to-purple-700 transition flex items-center gap-2">
                <i class="fa-solid fa-rotate-left"></i> Retour à la liste
            </a>
        </div>
    @endforelse

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $demandes->links() }}
    </div>
</div>
@endsection
