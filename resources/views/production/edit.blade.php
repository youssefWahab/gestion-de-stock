@extends('layout.master')

@section('title', 'Modifier Production')

@section('content')
<div class="bg-white/95 rounded-2xl shadow-xl p-8 max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-10 flex items-center gap-3">
        <i class="fa-solid fa-industry text-blue-600"></i>
        Modifier production
    </h1>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800 border border-red-200">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('production.update', $production->numProduction) }}" method="POST" class="space-y-10">
        {{--  --}}
        @csrf
        @method('PUT')

        {{-- Section: Détails de la production --}}
        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-circle-info text-indigo-500"></i>
                Détails de la production
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="chantier" class="block text-sm font-semibold text-gray-600 mb-2">Chantier</label>
                    <input type="text" name="chantier" id="chantier" value="{{ old('chantier', $production->chantier) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition"/>
                </div>

                <div>
                    <label for="numBonTransfert" class="block text-sm font-semibold text-gray-600 mb-2">
                        N° Bon de transfert
                    </label>
                    <input type="text" name="numBonTransfert" id="numBonTransfert" value="{{ old('numBonTransfert', $production->numBonTransfert) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm text-gray-700 placeholder-gray-400 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition">
                </div>
            </div>
        </div>

        {{-- Section: Articles de production --}}
        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-200 shadow-sm">
            <h3 class="text-lg font-semibold text-gray-700 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-cubes text-purple-600"></i>
                Articles de production
            </h3>

            <a href="{{ route('production.manage-articles', $production->numProduction) }}"
                {{-- --}}
               class="inline-block px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl shadow hover:from-blue-700 hover:to-purple-700 transition">
               <i class="fas fa-cogs"></i> Gérer les articles
            </a>

            <!-- Articles Table -->
                <div class="mt-6 overflow-x-auto rounded-xl shadow-md border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200 bg-white rounded-xl">
                        <thead class="bg-gradient-to-r from-blue-50 via-purple-50 to-blue-100">
                            <tr>
                                <th class="px-6 py-4 text-xs font-extrabold text-blue-700 uppercase">Article demandé</th>
                                <th class="px-6 py-4 text-xs font-extrabold text-blue-700 uppercase">Quantité</th>
                                <th class="px-6 py-4 text-xs font-extrabold text-blue-700 uppercase">Unité</th>
                                <th class="px-6 py-4 text-xs font-extrabold text-blue-700 uppercase">Prix</th>
                            </tr>
                        </thead>
                        <tbody id="articlesTableBody" class="divide-y divide-gray-100 text-center">
                            @forelse($production->articles as $article)
                                <tr data-article-id="{{ $article->id }}">
                                    <td class="px-4 py-2 text-gray-700 font-medium">{{ $article->articleDemande }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ $article->quantite }}</td>
                                    <td class="px-4 py-2 text-gray-700">
                                        @if ($article->unite)
                                            {{ $article->unite }}
                                        @else
                                            <span class="text-gray-400 italic">Aucune</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-gray-700">
                                        @if ($article->prix)
                                            {{ $article->prix }}
                                        @else
                                            <span class="text-gray-400 italic">Aucune</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr id="empty-article-row">
                                    <td colspan="4" class="p-4 text-center text-gray-400 italic">Aucun article ajouté.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

        </div>

        {{-- Section: Articles produits --}}
        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-cubes text-purple-600"></i>
                Articles produits
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="quantite" class="block text-sm font-semibold text-gray-600 mb-2">Quantité</label>
                    <input type="number" name="quantite" id="quantite" min="1" value="{{ old('quantite', $production->quantite) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition">
                </div>
                <div>
                    <label for="unite" class="block text-sm font-semibold text-gray-600 mb-2">Unité</label>
                    <input type="text" name="unite" id="unite" value="{{ old('unite', $production->unite) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition">
                </div>
                <div>
                    <label for="coutReviens" class="block text-sm font-semibold text-gray-600 mb-2">Coût de revient unitaire</label>
                    <input type="number" step="0.01" name="coutReviens" id="coutReviens" value="{{ old('coutReviens', $production->coutReviens) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition">
                </div>
            </div>
        </div>

        {{-- Buttons --}}
        <div class="flex justify-end items-center gap-4">
            <a href="{{ route('production.index') }}"
               class="bg-gray-100 text-gray-700 font-medium px-6 py-2 rounded-xl shadow hover:bg-gray-200 transition">
               <i class="fa-solid fa-arrow-left"></i> Retour
            </a>
            <button type="submit"
               class="bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold px-8 py-3 rounded-xl shadow-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center gap-2">
               <i class="fa-solid fa-check"></i> Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection