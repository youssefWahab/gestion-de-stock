@extends('layout.master')

@section('title', 'Modifier un stock')

@section('content')
<div class="w-full bg-white/90 rounded-2xl shadow-lg p-6 max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Modifier un mouvement de stock</h1>
        <a href="{{ route('stock.index') }}" 
           class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded-xl shadow flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Retour au stock
        </a>
    </div>

    {{-- Errors --}}
    @if($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800 border border-red-200">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('stock.update', $stock['id']) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Article --}}
        <div>
            <label for="article" class="block text-sm font-semibold text-gray-700 mb-1">
                <i class="fa-solid fa-box text-gray-400 mr-1"></i> Article
            </label>
            <input type="text" id="article" name="article" value="{{ old('article', $stock['article']) }}"
                   class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                   placeholder="Nom de l'article" required>
        </div>

        {{-- Atelier --}}
        <div>
            <label for="atelier" class="block text-sm font-semibold text-gray-700 mb-1">
                <i class="fa-solid fa-building text-gray-400 mr-1"></i> atelier
            </label>
            <input type="text" id="atelier" name="atelier" value="{{ old('atelier', $stock['atelier']) }}"
                   class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                   placeholder="Nom du atelier" required>
        </div>

        {{-- Unite --}}
        <div>
            <label for="unite" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fa-solid fa-ruler-combined text-indigo-500 mr-1"></i> Unité
            </label>
            <input type="text" id="unite" name="unite" value="{{ old('unite',$stock->unite) }}" 
                    class="w-full focus:border rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" 
                    placeholder="Unité de mesure (ex: kg, m, pcs)" required>
        </div>


        {{-- Entrée --}}
        <div>
            <label for="entree" class="block text-sm font-semibold text-gray-700 mb-1">
                <i class="fa-solid fa-circle-arrow-down text-green-500 mr-1"></i> Entrée
            </label>
            <input type="number" id="entree" name="entree" value="{{ old('entree', $stock['entree']) }}"
                   class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 transition"
                   placeholder="Quantité entrée" min="0">
        </div>

        {{-- Sortie --}}
        <div>
            <label for="sortie" class="block text-sm font-semibold text-gray-700 mb-1">
                <i class="fa-solid fa-circle-arrow-up text-red-500 mr-1"></i> Sortie
            </label>
            <input type="number" id="sortie" name="sortie" value="{{ old('sortie', $stock['sortie']) }}"
                   class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-400 transition"
                   placeholder="Quantité sortie" min="0">
        </div>

        {{-- stock initial --}}
        <div>
            <label for="stock_initial" class="block text-sm font-semibold text-gray-700 mb-1">
                <i class="fa-solid fa-boxes-packing text-yellow-500 mr-1"></i> Stock initial
            </label>
            <input type="number" id="stockInitial" name="stockInitial" value="{{ old('stockInitial', $stock['stockInitial']) }}" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 transition" placeholder="Stock initial" min="0">
        </div>

        {{-- Stock Actuel --}}
        <div>
            <label for="stock_actuel" class="block text-sm font-semibold text-gray-700 mb-1">
                <i class="fa-solid fa-boxes-stacked text-purple-500 mr-1"></i> Stock actuel
            </label>
            <input type="number" id="stockActuel" name="stockActuel" value="{{ old('stockActuel', $stock['stockActuel']) }}"
                   class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-400 transition"
                   placeholder="Stock disponible">
        </div>

        <div class="flex justify-end gap-4">
            <button type="reset" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-6 py-2 rounded-xl shadow transition">
                Réinitialiser
            </button>
            <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-6 py-2 rounded-xl shadow transition flex items-center gap-2">
                <i class="fa-solid fa-save text-xl"></i> Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection