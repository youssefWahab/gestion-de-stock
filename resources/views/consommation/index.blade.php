@extends('layout.master')

@section('title', 'Consommations')
@section('content')
<div class="w-full bg-white/90 rounded-2xl shadow-lg p-6">
    <div class="flex items-center justify-between mb-9">
        <h1 class="text-3xl font-bold text-gray-800">Consommations</h1>
        <a href="{{ route('consommation.create') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-6 py-2 rounded-xl shadow transition flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            Ajouter une consommation
        </a>
    </div>

    {{--  Filter Section --}}
    <div class="mb-9 px-5 py-3.5 bg-white rounded-xl shadow-lg border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Filtres des consommations</h2>
            <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold px-6 py-2 rounded-xl shadow hover:from-blue-700 hover:to-purple-700 transition flex items-center gap-2">
                <i class="fa-solid fa-search"></i> Rechercher
            </button>
        </div>
        <form action="{{ route('consommation.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- N° Consommation --}}
            <div>
                <label for="filterNumCons" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-hashtag text-gray-400 mr-1"></i> N° Consommation
                </label>
                <input type="text" id="filterNumCons" name="filterNumCons" value="{{ request('filterNumCons') }}" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" placeholder="Filtrer par numéro">
            </div>

            {{-- N° Fiche --}}
            <div>
                <label for="filterNumFiche" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-file-lines text-gray-400 mr-1"></i> N° Fiche
                </label>
                <input type="text" id="filterNumFiche" name="filterNumFiche" value="{{ request('filterNumFiche') }}" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" placeholder="Filtrer par fiche">
            </div>

            {{-- Chantier --}}
            <div>
                <label for="filterChantier" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-building text-gray-400 mr-1"></i> Chantier
                </label>
                <input type="text" id="filterChantier" name="filterChantier" value="{{ request('filterChantier') }}" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" placeholder="Filtrer par chantier">
            </div>

            {{-- Article --}}
            <div>
                <label for="filterArticle" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-box text-gray-400 mr-1"></i> Article
                </label>
                <input type="text" id="filterArticle" name="filterArticle" value="{{ request('filterArticle') }}" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" placeholder="Filtrer par article">
            </div>
        </form>
    </div>

    {{-- Table Consommations --}}
    <div class="bg-white rounded-xl shadow" style="max-height: 400px; overflow-y: auto;">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="sticky top-0 z-10 bg-gradient-to-r from-blue-50 via-purple-50 to-blue-100 shadow">
                <tr>
                    <th class="px-4 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest rounded-tl-2xl">
                        <i class="fa-solid fa-hashtag mr-1 text-blue-400"></i> N° Consommation
                    </th>
                    <th class="px-4 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        <i class="fa-solid fa-file-lines mr-1 text-blue-400"></i> N° Fiche
                    </th>
                    <th class="px-4 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        <i class="fa-solid fa-building mr-1 text-blue-400"></i> Chantier
                    </th>
                    <th class="px-4 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        <i class="fa-solid fa-box mr-1 text-blue-400"></i> Article
                    </th>
                    <th class="px-4 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        <i class="fa-solid fa-layer-group mr-1 text-blue-400"></i> Quantité
                    </th>
                    <th class="px-4 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                        <i class="fa-solid fa-sack-dollar mr-1 text-blue-400"></i> Coût
                    </th>
                    <th class="px-4 py-4 text-center text-xs font-extrabold text-blue-700 uppercase tracking-widest rounded-tr-2xl">
                        <i class="fa-solid fa-gears mr-1 text-blue-400"></i> Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($consommations as $cons)
                    <tr class="hover:bg-blue-50/30 transition">
                        <td class="px-4 py-2 font-mono font-bold text-blue-700">{{ $cons['numConsommation'] }}</td>
                        <td class="px-4 py-2">{{ $cons['numFiche'] }}</td>
                        <td class="px-4 py-2">{{ $cons['chantier'] }}</td>
                        <td class="px-4 py-2">{{ $cons['article'] }}</td>
                        <td class="px-4 py-2 text-center">
                            <span class="inline-block bg-purple-100 text-purple-700 font-bold rounded px-3 py-1 text-xs">
                                {{ $cons['quantite'] }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-green-600 font-semibold text-center">{{ $cons['coutUnitaire'] }}</td>
                        <td class="px-4 py-2 flex flex-wrap gap-2 justify-center">
                            <a href="{{ route('consommation.show', $cons['numConsommation']) }}" class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-lg text-xs font-semibold hover:bg-blue-200 transition" title="Voir">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('consommation.edit', $cons['numConsommation']) }}" class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-800 rounded-lg text-xs font-semibold hover:bg-indigo-200 transition" title="Modifier">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('consommation.destroy', $cons['numConsommation']) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 rounded-lg text-xs font-semibold hover:bg-red-200 transition" title="Supprimer" onclick="return confirm('Supprimer cette consommation ?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-400">Aucune consommation trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
