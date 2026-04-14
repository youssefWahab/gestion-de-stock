@extends('layout.master')

@section('title', 'Stock')

@section('content')
<div class="w-full bg-white/90 rounded-2xl shadow-lg p-6">
    <div class="flex items-center justify-between mb-10 bg-gradient-to-r from-purple-500 via-indigo-500 to-purple-600 px-6 py-4 rounded-xl shadow-lg">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-white flex items-center gap-5">
                <i class="fa-solid fa-boxes-stacked"></i> Gestion de stock
            </h1>
            <p class="mt-1.5 text-white">Créer, gérer et suivre le stock facilement.</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('stock.create') }}" class="bg-white text-gray-800 font-semibold px-3.5 py-2.5 rounded-xl shadow hover:shadow-lg transition-all duration-200 flex items-center gap-2.5">
                <i class="fa-solid fa-plus border-2 border-indigo-600 py-0.5  px-1 rounded-full text-indigo-600 text-md"></i>
                <span>Nouvelle article</span>
            </a>
            <a href="{{ route('stock.export-excel') }}" class="bg-white text-gray-800 font-semibold px-3.5 py-2.5 rounded-xl shadow hover:shadow-lg transition-all duration-200 flex items-center gap-2.5">
                <i class="fa-solid fa-file-excel border-2 border-green-600 py-0.5  px-1 rounded-full text-green-600 text-md"></i>
                <span>Exporter</span>
            </a>
            <a href="{{ route('stock.export-excel-with-movements') }}" class="bg-white text-gray-800 font-semibold px-3.5 py-2.5 rounded-xl shadow hover:shadow-lg transition-all duration-200 flex items-center gap-2.5">
                <i class="fa-solid fa-file-excel border-2 border-green-600 py-0.5  px-1 rounded-full text-green-600 text-md"></i>
                <span>Exporter avec mouvements</span>
            </a>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    {{-- Filter Section --}}
    <form action="{{ route('stock.index') }}" method="GET" class="mb-8 px-4 py-3 bg-white rounded-xl shadow-md border border-gray-100">
        <div class="flex items-center justify-between mb-3.5">
            <h2 class="text-2xl font-semibold text-gray-700 flex items-center gap-2">
                <i class="fa-solid fa-filter text-indigo-600"></i> 
                Filtrer du stock
            </h2>
            <div class="flex items-center gap-4">
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold px-6 py-2 rounded-xl shadow hover:from-blue-700 hover:to-purple-700 transition flex items-center gap-2">
                    <i class="fa-solid fa-search"></i> Rechercher
                </button>

                <a href="{{ route('stock.index') }}" class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-meddium px-6 py-2 rounded-xl shadow-sm transition  flex items-center gap-2">
                    <i class="fa-solid fa-rotate-right"></i> Réinitialiser
                </a>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- Search by Article --}}
            <div>
                <label for="filterArticle" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-box text-gray-400 mr-1"></i> Article
                </label>
                {{-- <input type="text" id="filterArticle" name="filterArticle" value="{{ request('filterArticle') }}" placeholder="Filtrer par article"class="w-full rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition"> --}}
                <input 
                    list="articleList" 
                    id="filterArticle" 
                    name="filterArticle" 
                    value="{{ request('filterArticle') }}" 
                    placeholder="Filtrer par article"
                    autocomplete="off"
                    class="w-full rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                />

                <datalist id="articleList">
                    @foreach($articles as $article)
                        <option value="{{ $article->article }}"></option>
                    @endforeach
                </datalist>

            </div>

            {{-- Search by Chantier --}}
            <div>
                <label for="filterAtelier" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-building text-gray-400 mr-1"></i> Atelier
                </label>
                <input list="atelierList" type="text" id="filterAtelier" name="filterAtelier" 
                    value="{{ request('filterAtelier') }}"
                    class="w-full rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" 
                    placeholder="Filtrer par atelier"
                    autocomplete="off">
                    <datalist id="atelierList">
                    @foreach($ateliers as $atelier)
                        <option value="{{ $atelier->atelier }}"></option>
                    @endforeach
                </datalist>
            </div>

            {{-- Filter by Stock actuel (Min) --}}
            <div>
                <label for="stockMin" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-arrow-down-1-9 text-green-500 mr-1"></i> Stock actuel (Min)
                </label>
                <input type="number" id="stockMin" name="stockMin" 
                    value="{{ request('stockMin') }}"
                    class="w-full rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" 
                    placeholder="Quantité min">
            </div>

            {{-- Filter by Stock actuel (Max) --}}
            <div>
                <label for="stockMax" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-arrow-up-9-1 text-red-500 mr-1"></i> Stock actuel (Max)
                </label>
                <input type="number" id="stockMax" name="stockMax" 
                    value="{{ request('stockMax') }}"
                    class="w-full rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" 
                    placeholder="Quantité max">
            </div>
        </div>
        {{-- </div> --}}
    </form>

    <div class="flex flex-wrap justify-end gap-3 mb-5">
        <a href="{{ route('stock.export-sorties') }}" 
        class="bg-white text-gray-800 font-semibold px-4 py-2.5 rounded-xl shadow hover:shadow-lg transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-file-export border-2 border-red-600 py-0.5 px-1 rounded-full text-red-600 text-md"></i>
            <span>Exporter Sorties</span>
        </a>

        <a href="{{ route('stock.export-entrees') }}" 
        class="bg-white text-gray-800 font-semibold px-4 py-2.5 rounded-xl shadow hover:shadow-lg transition-all duration-200 flex items-center gap-2">
            <i class="fa-solid fa-file-export border-2 border-green-600 py-0.5 px-1 rounded-full text-green-600 text-md"></i>
            <span>Exporter Entrées</span>
        </a>
    </div>


    {{-- Stock Table --}}
    <div class="bg-white rounded-xl overflow-x-auto shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-blue-50 via-purple-50 to-blue-100 shadow">
                <tr>
                    <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        Article
                    </th>
                    <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        Atelier
                    </th>
                    {{-- <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        Unite
                    </th> --}}
                    <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        Minimum
                    </th>
                    <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        Entrée
                    </th>
                    <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        Sortie
                    </th>
                    <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        Stock actuel
                    </th>
                    <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        Stock initail
                    </th>
                    <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-center">
                @forelse($stocks as $stock)
                    <tr class="hover:bg-blue-50/40 transition">
                        <td class="px-4 py-2">{{ $stock->article }}</td>
                        <td class="px-4 py-2">{{ $stock->atelier }}</td>
                        {{-- <td class="px-4 py-2">{{ $stock->unite }}</td> --}}
                        <td class="px-4 py-2">
                            <span class="inline-flex items-center rounded px-3 py-1 text-sm font-semibold bg-red-100 text-red-800">
                                {{ $stock->minimum }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            <span class="inline-flex items-center rounded px-3 py-1 text-sm font-semibold bg-green-100 text-green-800">
                                {{ $stock->entree }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            <span class="inline-flex items-center rounded px-3 py-1 text-sm font-semibold bg-red-100 text-red-800">
                                {{ $stock->sortie }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            <span class="inline-flex items-center rounded px-3 py-1 text-sm font-semibold 
                                {{ $stock->stockActuel > 0 ? 'bg-purple-100 text-purple-700' : 'bg-gray-200 text-gray-600' }}">
                                {{ $stock->stockActuel }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            <span class="inline-flex items-center rounded px-3 py-1 text-sm font-semibold 
                                {{ $stock->stockInitial > 0 ? 'bg-purple-100 text-purple-700' : 'bg-gray-200 text-gray-600' }}">
                                {{ $stock->stockInitial }}
                            </span>
                        </td>

                        <td class="px-4 py-2 flex flex-wrap gap-3 justify-center">
                            <a href="{{ route('stock.show', $stock->id) }}" class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-800 rounded-lg text-xs font-semibold hover:bg-blue-200 transition" title="Voir">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('stock.edit', $stock->id) }}" class="inline-flex items-center px-3 py-2  bg-green-100 text-green-800 rounded-lg text-xs font-semibold hover:text-green-900 hover:bg-green-200 transition" title="Modifier">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('stock.destroy', $stock->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce stock ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-100 text-red-800 rounded-lg text-xs font-semibold hover:text-red-900 hover:bg-red-200 transition" title="Supprimer">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-400">Aucun mouvement de stock trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $stocks->links() }}
    </div>
</div>
@endsection