@extends('layout.master')

@section('title', 'Articles de Fiche')
@section('content')
    <div class="w-full bg-white/90 rounded-2xl shadow-lg p-6">
        {{-- <div class="flex items-center justify-between mb-9">
            <h1 class="text-3xl font-bold text-gray-800">Articles des demandes</h1>
        </div> --}}
        <div class="flex items-center justify-between mb-7 bg-gradient-to-r from-purple-500 via-indigo-500 to-purple-600 p-5 rounded-xl shadow-lg">
            <h1 class="text-2xl md:text-3xl font-bold text-white flex items-center gap-4">
                <i class="far fa-file-lines"></i>Articles des demandes d' achat
            </h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('demande-achat.index') }}" class=" text-white font-semibold px-5 py-1 border-2 border-white/90 rounded-lg transition-all duration-200 flex items-center gap-3">
                    <i class="fa-solid fa-file-invoice-dollar text-xl"></i>
                    <span>Voir les demandes</span>
                </a>
            </div>
        </div>

        {{-- les messages --}}
        @if(session('warning'))
            <x-alert type="warning" :message="session('warning')" />
        @endif
        
        {{-- Success Message --}}
        @if(session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        {{-- Filter Section --}}
        <form action="{{ route('article-achat.index') }}" method="GET" class="mb-8 px-5 py-3.5 bg-white rounded-xl shadow-md border border-gray-100">
            <div class="flex items-center justify-between mb-3.5">
                <h2 class="text-2xl font-semibold text-gray-700 flex items-center gap-2">
                    <i class="fa-solid fa-filter text-indigo-600"></i> 
                    Filtrer les articles
                </h2>
                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold px-6 py-2 rounded-xl shadow hover:from-blue-700 hover:to-purple-700 transition flex items-center gap-2">
                        <i class="fa-solid fa-search"></i> Rechercher
                    </button>

                    <a href="{{ route('article-achat.index') }}" class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-meddium px-6 py-2 rounded-xl shadow-sm transition  flex items-center gap-2">
                        <i class="fa-solid fa-rotate-right"></i> Réinitialiser
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="filterBonCommande" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fa-solid fa-hashtag text-gray-400 mr-1"></i> N° de bon de commande
                    </label>
                    <input list="demandesList" id="filterBonCommande" name="filterBonCommande" value="{{ request('filterBonCommande') }}" placeholder="Numéro de fiche" autocomplete="off" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    <datalist id="demandesList">
                        @foreach($demandes as $demande)
                            <option value="{{ $demande->numBonCommande }}"> {{ $demande->atelier }} - {{ $demande->natureTravaux }}</option>
                        @endforeach
                    </datalist>
                </div>
                <div>
                    <label for="filterArticle" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fa-solid fa-box text-gray-400 mr-1"></i> Nom de l'article
                    </label>
                    <input type="text" id="filterArticle" name="filterArticle" value="{{ request('filterArticle') }}" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" placeholder="Filtrer par nom">
                </div>
                 <div>
                    <label for="quantiteMin" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fa-solid fa-layer-group text-gray-400 mr-1"></i> Quantité min
                    </label>
                    <input type="number" id="quantiteMin" name="quantiteMin" value="{{ request('quantiteMin') }}" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" placeholder="Quantité minimale">
                </div>
                <div>
                    <label for="quantiteMax" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fa-solid fa-layer-group text-gray-400 mr-1"></i> Quantité max
                    </label>
                    <input type="number" id="quantiteMax" name="quantiteMax" value="{{ request('quantiteMax') }}" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" placeholder="Quantité maximale">
                </div>
            </div>
        </form>


        {{-- table des articles --}}
        <div class="bg-white rounded-xl overflow-x-auto shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-50 via-purple-50 to-blue-100 shadow">
                    <tr>
                        <th class="px-4 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest rounded-tl">
                            <i class="fa-solid fa-hashtag mr-1 text-blue-400"></i> N° de bon de commande
                        </th>
                        <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                            <i class="fa-solid fa-box mr-1 text-blue-400"></i> Article
                        </th>
                        <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                            <i class="fa-solid fa-layer-group mr-1 text-blue-400"></i> Quantité
                        </th>
                        <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                            <i class="fa-solid fa-ruler-vertical mr-1 text-blue-400"></i> Unite
                        </th>
                        <th class="px-4 py-4 text-center text-xs font-extrabold text-blue-700 uppercase tracking-widest rounded-tr">
                            <i class="fa-solid fa-gears mr-1 text-blue-400"></i> Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-center">
                    @forelse($articles as $article)
                        <tr class="hover:bg-blue-50/30 transition">
                            <td class="px-4 py-2 font-semibold font-mono font-bold text-left text-gray-500"></span>{{ $article->demandeAchat->numBonCommande }}</td>
                            <td class="px-4 py-2 font-semibold text-gray-800">{{ $article->articleDemande }}</td>
                            <td class="px-4 py-2">{{ $article->quantite }}</td>
                            <td class="px-4 py-2">
                                @if ( $article->unite)
                                    {{ $article->unite }}
                                @else
                                    <span class="text-gray-400">Aucune</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 min-w-52 flex flex-wrap gap-2 justify-center">
                                <a href="{{ route('article-achat.edit', $article->id) }}"
                                   class="inline-flex items-center px-3 py-1  bg-green-100 text-green-800 rounded-lg text-xs font-semibold hover:bg-green-200 hover:text-green-900 transition"
                                   title="Modifier">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('article-achat.destroy', $article->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-3.5 py-2 bg-red-100 text-red-800 rounded-lg text-xs font-semibold hover:bg-red-200 transition"
                                            title="Supprimer"
                                            onclick="return confirm('Supprimer cet article ?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-6 text-center text-gray-400">Aucun article trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $articles->links() }}
        </div>
    </div>
@endsection
