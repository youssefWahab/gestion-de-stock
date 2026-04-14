@extends('layout.master')

@section('title', 'Retours de Stock')

@section('content')
<div class="w-full bg-white/90 rounded-2xl shadow-lg p-6">
    <div class="flex items-center justify-between mb-7 bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-600 p-5 rounded-xl shadow-lg">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-white flex items-start gap-3">
                <i class="fa-solid fa-rotate-left text-4xl"></i> <span>Les retours de stock</span>
            </h1>
            <p class="mt-1.5 text-white ml-2">Gérer tous les mouvements de type « retour » du stock.</p>
        </div>
        <div class="flex items-center gap-6">
            <a href="{{ route('retours.create') }}" class="bg-white text-gray-800 font-semibold px-6 py-2.5 rounded-xl shadow hover:shadow-lg transition-all duration-200 flex items-center gap-3">
                <i class="fa-solid fa-plus py-0.5  px-1 rounded-full text-indigo-600 text-md"></i>
                <span>Ajouter</span>
            </a>

            <a href="{{ route('stock.index') }}" class=" text-white font-semibold px-7 py-1.5 border-2 border-white/90 rounded-xl transition-all duration-200 flex items-center gap-3">
                <i class="fa-solid fa-boxes-stacked text-lg"></i>
                <span>Stock</span>
            </a>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    <!-- Filter Section -->
    <form action="{{ route('retours.index') }}" method="GET" class="mb-8 px-4 py-3 bg-white rounded-xl shadow-md border border-gray-100">
        <div class="flex items-center justify-between mb-3.5">
            <h2 class="text-2xl font-semibold text-gray-700 flex items-center gap-2">
                <i class="fa-solid fa-filter text-indigo-600"></i> 
                Filtrer les retours
            </h2>
            <div class="flex items-center gap-4">
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold px-6 py-2 rounded-xl shadow hover:from-blue-700 hover:to-indigo-700 transition flex items-center gap-2">
                    <i class="fa-solid fa-search"></i> Rechercher
                </button>

                <a href="{{ route('retours.index') }}" class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-meddium px-6 py-2 rounded-xl shadow-sm transition  flex items-center gap-2">
                    <i class="fa-solid fa-rotate-right"></i> Réinitialiser
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- Filter by Search --}}
            <div>
                <label for="search" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-search text-gray-400 mr-1"></i> Search
                </label>
                <input type="text" id="search" name="filterSearch" 
                    value="{{ request('filterSearch') }}"
                    class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" 
                    placeholder="Filtrer par search">
            </div>

            {{-- Filter by Date mouvement --}}
            <div>
                <label for="date_movement" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-calendar-days text-indigo-500 mr-1"></i> Date mouvement
                </label>
                <input type="date" id="date_movement" name="filterDateMovement" 
                    value="{{ request('filterDateMovement') }}"
                    class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
            </div>

            {{-- Quantité min --}}
            <div>
                <label for="quantiteMin" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-arrow-down-1-9 text-green-500 mr-1"></i> Quantité min
                </label>
                <input type="number" min="1" id="quantiteMin" name="quantiteMin" 
                    value="{{ request('quantiteMin') }}"
                    class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" 
                    placeholder="Min">
            </div>

            {{-- Quantité max --}}
            <div>
                <label for="quantiteMax" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-arrow-up-9-1 text-red-500 mr-1"></i> Quantité max
                </label>
                <input type="number" min="1" id="quantiteMax" name="quantiteMax" 
                    value="{{ request('quantiteMax') }}"
                    class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" 
                    placeholder="Max">
            </div>
        </div>
    </form>

    {{-- Table Retours --}}
    <div class="bg-white rounded-xl overflow-x-auto shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-blue-50 via-indigo-50 to-blue-100 shadow">
                <tr>
                    <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">Article</th>
                    <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">Quantité</th>
                    <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">Date de retour</th>
                    <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">Référence</th>
                    {{-- <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">Remarque</th> --}}
                    <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-center">
                @forelse($retours as $retour)
                    <tr class="hover:bg-blue-50/40 transition">
                        <td class="px-4 py-3">{{ $retour->stock->article }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center rounded px-3 py-1 text-sm font-semibold bg-blue-100 text-blue-800">
                                {{ $retour->quantite }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            {{$retour->date_movement}}
                        </td>
                        <td class="px-4 py-3">
                            @if ($retour->reference)
                                {{ Str::limit($retour->reference,30) }}
                            @else
                                Aucune référence
                            @endif
                        </td>
                        {{-- <td class="px-4 py-3">
                            @if ($retour->note)
                                {{ Str::limit($retour->note,28) }}
                            @else
                                Aucune remarque
                            @endif
                        </td> --}}
                        <td class="px-4 py-3 flex flex-wrap gap-3 justify-center">
                            <a href="{{ route('retours.show', $retour->id) }}" class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-800 rounded-lg text-xs font-semibold hover:bg-blue-200 transition" title="Voir">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('retours.edit', $retour->id) }}" class="inline-flex items-center px-3 py-2 bg-green-100 text-green-800 rounded-lg text-xs font-semibold hover:text-green-900 hover:bg-green-200 transition" title="Modifier">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('retours.destroy', $retour->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce retour ?');">
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
                        <td colspan="6" class="px-4 py-6 text-center text-gray-400">Aucun retour enregistré.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $retours->links() }}

    </div>
</div>
@endsection
