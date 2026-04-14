@extends('layout.master')

@section('title', 'Modifier entrée')

@section('content')
<div class="max-w-3xl mx-auto bg-white/90 rounded-2xl shadow-lg p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Modifier l'entrée</h1>

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

    <form action="{{ route('entrees.update', $entree->id) }}" method="POST" class="space-y-6">
        {{--  --}}
        @csrf
        @method('PUT')

        <div>
            <label for="article" class="block text-sm font-semibold text-gray-700 mb-1">
                <i class="fa-solid fa-box text-gray-400 mr-1"></i> Article
            </label>
            <select id="article" name="stock_id" required class="w-full border border-gray-200 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
                <option value="">Sélectionner un article</option>
                @foreach($stocks as $stock)
                    <option value="{{ $stock->id }}" {{ $entree->stock_id == $stock->id ? 'selected' : '' }}>
                        {{ $stock->article }} (Stock actuel: {{ $stock->stockActuel }})
                    </option>
                @endforeach
            </select>
            @error('stock_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="type" class="block text-sm font-semibold text-gray-700 mb-1">
                <i class="fa-solid fa-tag text-gray-400 mr-1"></i> Type
            </label>
            <input type="text" id="type" name="type" value="{{ $entree->type }}" readonly class="w-full border border-gray-200 rounded-lg px-3 py-2 text-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
        </div>

        <div>
            <label for="quantite" class="block text-sm font-semibold text-gray-700 mb-1">
                <i class="fa-solid fa-layer-group text-gray-400 mr-1"></i> Quantité
            </label>
            <input type="number" id="quantite" name="quantite" value="{{ old('quantite', $entree->quantite) }}" required min="1" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
            @error('quantite')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- reference --}}
        <div>
            <label for="reference" class="block text-sm font-semibold text-gray-700 mb-1">
                <i class="fa-solid fa-hashtag text-gray-400 mr-1"></i> Référence
            </label>
            <input type="text" id="reference" name="reference" value="{{ old('reference', $entree->reference) }}" placeholder="Entrer une référence" class="w-full border border-gray-200 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
            @error('reference')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="date_entree" class="block text-sm font-semibold text-gray-700 mb-1">
                <i class="fa-regular fa-calendar-days text-gray-400 mr-1"></i> Date d’entrée
            </label>
            <input type="datetime-local" id="date_entree" name="date_movement" value="{{ old('date_movement', $entree->date_movement->format('Y-m-d\TH:i') ) }}" required class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
            @error('date_movement')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="note" class="block text-sm font-semibold text-gray-700 mb-1">
                <i class="fa-solid fa-file-lines text-gray-400 mr-1"></i> Remarque
            </label>
            <input type="text" id="note" name="note" value="{{ old('note', $entree->note) }}" placeholder="Entrer une remarque" class="w-full border border-gray-200 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
            @error('note')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('entrees.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-6 py-2 rounded-xl shadow transition">
                Annuler
            </a>
            <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold px-6 py-2 rounded-xl shadow">
                <i class="fa-solid fa-check"></i> Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection