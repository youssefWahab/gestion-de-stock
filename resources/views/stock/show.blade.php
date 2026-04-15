@extends('layout.master')

@section('title', 'Détail du stock')

@section('content')
<div class="bg-gradient-to-tr from-blue-50 via-purple-50 to-blue-100 rounded-2xl shadow-xl p-8 border border-green-100">
    
    {{-- Header --}}
    <div class="flex items-center gap-4 mb-8">
        <div class="flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-blue-600 to-purple-600 shadow-lg">
            <i class="fa-solid fa-boxes-stacked text-white text-2xl"></i>
        </div>
        <div>
            <div class="text-xs uppercase tracking-widest text-green-700 font-bold">Détail du  stock</div>
            <div class="text-xl font-extrabold text-gray-800">{{ $stock->article }}</div>
        </div>
    </div>

    {{-- Stock Details Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        {{-- Article --}}
        <div>
            <span class="block text-xs text-gray-500 uppercase font-semibold">Article</span>
            <span class="block text-lg font-bold text-gray-800 mt-2">{{ $stock->article }}</span>
        </div>
        {{-- Catégorie --}}
        <div>
            <span class="block text-xs text-gray-500 uppercase font-semibold">Catégorie</span>
            <span class="block text-lg font-bold text-gray-800 mt-2">{{ $stock->categorie }}</span>
        </div>
        {{-- Date --}}
        <div>
            <span class="block text-xs text-gray-500 uppercase font-semibold">Dernière mise à jour</span>
            @if ($stock->updated_at)
            <span class="block text-lg font-bold text-gray-800 mt-2">{{ \Carbon\Carbon::parse($stock->updated_at)->locale('fr')->diffForHumans() }}</span>
            @else
                <span class="block text-lg text-sm  text-gray-600 mt-3.5">Pas encore mis à jour</span>
            @endif
        </div>
        {{-- Entrée --}}
        <div>
            <span class="block text-xs text-gray-500 uppercase font-semibold">Entrée</span>
            <span class="inline-block bg-green-100 text-green-800  shadow font-bold rounded-lg px-4 py-1 mt-2 text-lg">{{ $stock->entree }}</span>
        </div>
        {{-- Sortie --}}
        <div>
            <span class="block text-xs text-gray-500 uppercase font-semibold">Sortie</span>
            <span class="inline-block bg-red-100 text-red-800 shadow font-bold rounded-lg px-4 py-1 mt-2 text-lg">{{ $stock->sortie }}</span>
        </div>
        {{-- Stock Initial --}}
        <div>
            <span class="block text-xs text-gray-500 uppercase font-semibold">Stock initial</span>
            <span class="inline-block bg-purple-100 text-purple-800 shadow font-bold rounded-lg px-3.5 py-1 mt-3 text-lg">{{ $stock->stockInitial }}</span>
        </div>
        {{-- Stock actuel --}}
        <div>
            <span class="block text-xs text-gray-500 uppercase font-semibold">Stock actuel</span>
            <span class="inline-block bg-purple-100 text-purple-800 shadow font-bold rounded-lg px-3.5 py-1 mt-3 text-lg">{{ $stock->stockActuel }}</span>
        </div>
        
        {{-- Type --}}
        {{-- <div>
            <span class="block text-xs text-gray-500 uppercase font-semibold">Type</span>
            <span class="inline-block bg-blue-100 text-blue-700 font-bold rounded-lg px-4 py-1 mt-2 text-lg">{{ $stock['type'] }}</span>
        </div> --}}
        
    </div>

    <div class="mt-8">
        <h2 class="text-xl font-bold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-box text-purple-600"></i> Les movements
        </h2>
        <table class="min-w-full divide-y divide-gray-200 text-sm shadow-md rounded-xl overflow-hidden">
            <thead class="bg-gradient-to-r from-indigo-50 via-blue-50 to-purple-50">
                <tr>
                    {{-- <th class="px-4 py-3 text-xs font-extrabold text-indigo-700 uppercase tracking-widest">Type</th>
                    <th class="px-4 py-3 text-xs font-extrabold text-indigo-700 uppercase tracking-widest">Quantité</th>
                    <th class="px-4 py-3 text-xs font-extrabold text-indigo-700 uppercase tracking-widest">Date mouvement</th>
                    <th class="px-4 py-3 text-xs font-extrabold text-indigo-700 uppercase tracking-widest">Note</th> --}}
                    <th class="px-4 py-3 text-xs font-bold text-gray-600 uppercase tracking-widest">
                        <i class="fa-solid fa-tag text-blue-400 mr-1"></i> Type
                    </th>
                    <th class="px-4 py-3 text-xs font-bold text-gray-600 uppercase tracking-widest">
                        <i class="fa-solid fa-layer-group text-blue-400 mr-1"></i> Quantité
                    </th>
                    {{-- Reference --}}
                    <th class="px-4 py-3 text-xs font-bold text-gray-600 uppercase tracking-widest">
                        <i class="fa-solid fa-receipt text-blue-400 mr-1"></i> Bon de livraison / Nom
                    </th>
                    <th class="px-4 py-3 text-xs font-bold text-gray-600 uppercase tracking-widest">
                        <i class="fa-solid fa-calendar-days text-blue-400 mr-1"></i> Date mouvement
                    </th>
                    <th class="px-4 py-3 text-xs font-bold text-gray-600 uppercase tracking-widest">
                        <i class="fa-solid fa-note-sticky text-blue-400 mr-1"></i> Note
                    </th>

                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white text-center">
                @forelse($stock->movements as $movement)
                    <tr class="hover:bg-indigo-50/20 transition">
                        {{-- <td class="px-4 py-3 font-medium text-gray-700">{{ $movement->id }}</td> --}}
                        <td class="px-4 py-3">
                            <span class="px-3 py-1 rounded-lg text-xs font-semibold 
                                @if($movement->type === 'entrée') bg-green-100 text-green-800 
                                @elseif($movement->type === 'sortie') bg-red-100 text-red-800
                                @elseif($movement->type === 'retour') bg-blue-100 text-blue-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ ucfirst($movement->type) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-700">{{ $movement->quantite }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $movement->reference ?? '—' }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $movement->date_movement->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-3 text-gray-500 italic">{{ $movement->note ?? '—' }}</td>
                        {{-- <td class="px-4 py-3 text-gray-500">
                            @if($movement->updated_at)
                                {{ \Carbon\Carbon::parse($movement->updated_at)->diffForHumans() }}
                            @else
                                <span class="text-gray-400 italic">En attente de mise à jour</span>
                            @endif
                        </td>
                    </tr> --}}
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-400 italic">Aucun mouvement trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    {{-- Actions --}}
    <div class="mt-10 flex gap-4 justify-end">
        <a href="{{ route('stock.index') }}"
           class="px-6 py-2 rounded-xl bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300 transition flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Retour
        </a>
        <a href="{{ route('stock.edit', $stock->id) }}"
           class="px-6 py-2 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 flex items-center gap-2 shadow transition">
            <i class="fa-solid fa-pen"></i> Modifier
        </a>
    </div>
</div>
@endsection