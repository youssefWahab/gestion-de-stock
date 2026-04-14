@extends('layout.master')

@section('title', 'Productions')

@section('content')
<div class="w-full bg-white/90 rounded-2xl shadow-lg p-6">
    <div class="flex items-center justify-between mb-7 bg-gradient-to-r from-purple-500 via-indigo-500 to-purple-600 p-5 rounded-xl shadow-lg">
            <h1 class="text-2xl md:text-3xl font-bold text-white flex items-center gap-4">
                <i class="fa-solid fa-sitemap"></i> Productions
            </h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('production.create') }}" class="bg-white text-gray-800 font-semibold px-5 py-2.5 rounded-xl shadow hover:shadow-lg transition-all duration-200 flex items-center gap-2.5">
                    <i class="fa-solid fa-plus border-2 border-indigo-600 py-0.5  px-1 rounded-full text-indigo-600 text-md"></i>
                    <span>Nouvelle production</span>
                </a>

                <a href="{{ route('production-article.index') }}" class=" text-white font-semibold px-4 py-1 border-2 border-white/90 rounded-lg transition-all duration-200 flex items-center gap-2.5">
                    <i class="far fa-file-lines text-xl"></i>
                    <span>Voir les articles</span>
                </a>
            </div>
        </div>

      @if(session('error'))
            <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800 border border-red-200 flex items-center gap-3">
                {{ session('error') }}
                <button onclick="this.parentElement.remove()" class="ml-auto font-bold hover:opacity-70">✕</button>
            </div>
        @endif

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-7 p-4 rounded-xl bg-green-50 text-green-700 border border-green-200 flex items-center justify-between gap-4 shadow-md">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p>{{ session('success') }}</p>
            <button onclick="this.parentElement.remove()" class="ml-auto text-green-500 hover:text-green-700  font-bold">✕</button>
        </div>
    @endif

    {{-- filter section --}}
    <form action="{{ route('production.index') }}" method="GET" class="mb-8 px-5 py-3.5 bg-white rounded-xl shadow-md border border-gray-100">
        <div class="flex items-center justify-between mb-3.5">
            <h2 class="text-2xl font-semibold text-gray-700 flex items-center gap-2">
                <i class="fa-solid fa-filter text-indigo-600"></i> 
                Filtrer les productions
            </h2>
            <div class="flex items-center gap-4">
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold px-6 py-2 rounded-xl shadow hover:from-blue-700 hover:to-purple-700 transition flex items-center gap-2">
                    <i class="fa-solid fa-search"></i> Rechercher
                </button>

                <a href="{{ route('production.index') }}" class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-meddium px-6 py-2 rounded-xl shadow-sm transition  flex items-center gap-2">
                    <i class="fa-solid fa-rotate-right"></i> Réinitialiser
                </a>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            
            {{-- Search by Bon de Transfert Number --}}
            <div>
                <label for="filterNumBonTransfert" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-file-invoice text-gray-400 mr-1"></i> N° Bon de Transfert
                </label>
                <input type="text" id="filterNumBonTransfert" name="filterNumBonTransfert" value="{{ request('filterNumBonTransfert') }}" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" placeholder="Filtrer par numéro">
            </div>
            {{-- Search by Chantier --}}
            <div>
                <label for="filterChantier" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-building text-gray-400 mr-1"></i> Chantier
                </label>
                <input type="text" id="filterChantier" name="filterChantier" value="{{ request('filterChantier') }}" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" placeholder="Filtrer par chantier">
            </div>
            
            {{-- Search by Quantity --}}
            <div>
                <label for="filterQuantite" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-layer-group text-gray-400 mr-1"></i> Quantité
                </label>
                <input type="number" id="filterQuantite" name="filterQuantite" value="{{ request('filterQuantite') }}" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" placeholder="Filtrer par numéro">
            </div>
            {{-- Search by cout unitaire --}}
            <div>
                <label for="filterCoutReviens" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-dollar-sign text-gray-400 mr-1"></i> Coût unitaire
                </label>
                <input type="text" id="filterCoutReviens" name="filterCoutReviens" value="{{ request('filterCoutReviens') }}" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" placeholder="Filtrer par coût">
            </div>
        </div>
    </form>

    {{-- Table of productions --}}
    <div class="bg-white rounded-xl overflow-x-auto shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="sticky top-0 z-10 bg-gradient-to-r from-blue-50 via-purple-50 to-blue-100 shadow">
                <tr>
                    <th class="px-4 py-3 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        <i class="fa-solid fa-hashtag mr-1 text-blue-400"></i>
                        N° Bon Transfert
                    </th>
                    <th class="px-4 py-3 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        Produit finale
                    </th>
                    <th class="px-4 py-3 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        Chantier
                    </th>
                    <th class="px-4 py-3 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        Quantité
                    </th>
                    <th class="px-4 py-3 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        Coût unitaire
                    </th>
                    <th class="px-4 py-3 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        <i class="fa-solid fa-gears mr-1 text-blue-400"></i> Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-center">
                @forelse($productions as $prod)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="px-4 py-2">{{ $prod->numBonTransfert }}</td>
                        <td class="px-4 py-2">{{ $prod->produitFinale }}</td>
                        <td class="px-4 py-2">{{ Str::limit($prod->chantier, 24, '...')  }}</td>
                        {{-- <td class="px-4 py-2 font-mono font-bold text-blue-700">{{ $prod->numProduction }}</td> --}}
                        <td class="px-4 py-2 text-center">
                            <span class="inline-block bg-purple-100 text-purple-700 font-bold rounded px-3 py-1 text-xs">
                                {{ $prod->quantite }}
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ $prod->coutReviens }}</td>
                        <td class="px-4 py-2 flex flex-wrap gap-2 justify-center">
                            <a href="{{ route('production.show', $prod->numProduction) }}" class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-lg text-xs font-semibold hover:bg-blue-200 transition" title="Voir">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('production.edit', $prod->numProduction) }}" class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-800 rounded-lg text-xs font-semibold hover:bg-indigo-200 transition" title="Modifier">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            {{-- <a href="#" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-lg text-xs font-semibold hover:bg-green-200 transition" title="Télécharger">
                                <i class="fa-solid fa-download"></i>
                            </a> --}}
                            <form action="{{ route('production.destroy', $prod->numProduction) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 rounded-lg text-xs font-semibold hover:bg-red-200 transition" title="Supprimer" onclick="return confirm('Supprimer cette production ?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-400">Aucune production trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
            {{ $productions->links() }}
    </div>
</div>
@endsection
