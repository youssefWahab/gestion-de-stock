@extends('layout.master')

@section('title', 'Détail du mouvement')

@section('content')
<div class="bg-gradient-to-tr from-blue-50 via-purple-50 to-blue-100 rounded-2xl shadow-xl p-8 border border-blue-100 max-w-4xl mx-auto mt-10">
    {{-- Header --}}
    <div class="flex items-center gap-4 mb-8">
        <div class="flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-blue-600 to-purple-600 shadow-lg">
            <i class="fa-solid fa-dolly-flatbed text-white text-2xl"></i>
        </div>
        <div>
            <div class="text-xs uppercase tracking-widest text-blue-700 font-bold">Mouvement de stock</div>
            <div class="text-xl font-extrabold text-gray-800">ID #{{ $movement->id }}</div>
        </div>
    </div>

    {{-- Details --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Left column --}}
        <div>
            <div class="mb-4">
                <span class="block text-xs text-gray-500 uppercase font-semibold">Article</span>
                <span class="block text-lg font-bold text-gray-800">{{ $movement->stock?->article ?? '—' }}</span>
            </div>
            <div class="mb-4">
                <span class="block text-xs text-gray-500 uppercase font-semibold">Type</span>
                <span class="block text-lg font-bold text-gray-800">{{ ucfirst($movement->type) }}</span>
            </div>
            {{-- reference --}}
            <div>
                <span class="block text-xs text-gray-500 uppercase font-semibold">Bon de livraison / Nom</span>
                <span class="inline-block bg-yellow-100 text-yellow-800 shadow font-bold rounded-lg px-3.5 py-1 mt-2 text-lg">{{ $movement->reference ?? '—' }}</span>
            </div>
        </div>

        {{-- Right column --}}
        <div>
            <div class="mb-4">
                <span class="block text-xs text-gray-500 uppercase font-semibold">Quantité</span>
                <span class="block text-lg font-bold text-gray-800">{{ $movement->quantite }}</span>
            </div>
            <div class="mb-4">
                <span class="block text-xs text-gray-500 uppercase font-semibold">Date</span>
                <span class="block text-lg font-bold text-gray-800">{{ $movement->date_movement->format('d/m/Y H:i') }}</span>
            </div>
        </div>

        {{-- Note full width --}}
        <div class="md:col-span-2 mb-4">
            <span class="block text-xs text-gray-500 uppercase font-semibold mb-3">Note</span>
            <div class="bg-white border-l-4 border-purple-400 p-4 rounded-lg text-gray-700 shadow">
                {{ $movement->note }}
            </div>
        </div>
    </div>


    {{-- Actions --}}
    <div class="mt-10 flex gap-4 justify-end">
        <a href="{{ route('sorties.index') }}"
           class="px-6 py-2 rounded-xl bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300 transition flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Retour
        </a>

        <a href="{{ route('entrees.edit', $movement->id) }}"
           class="px-6 py-2 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition flex items-center gap-2">
            <i class="fa-solid fa-pen"></i> Modifier
        </a>
    </div>
</div>
@endsection
