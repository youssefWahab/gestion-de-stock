@extends('layout.master')

@section('title', 'Détail fiche de commande')

@section('content')
    <div class="bg-gradient-to-tr from-blue-50 via-purple-50 to-blue-100 rounded-2xl shadow-xl p-8 border border-blue-100">
        <div class="flex items-center gap-4 mb-8">
            <div class="flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-blue-600 to-purple-600 shadow-lg">
                <i class="fa-solid fa-file-lines text-white text-2xl"></i>
            </div>
            <div>
                <div class="text-xs uppercase tracking-widest text-blue-700 font-bold">Fiche de commande</div>
                <div class="text-xl font-extrabold text-gray-800">N° {{ $fiche->numFiche }}</div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <div class="mb-4">
                    <span class="block text-xs text-gray-500 uppercase font-semibold">Nom</span>
                    <span class="block text-lg font-bold text-gray-800">{{ $fiche->nomDemandeur }}</span>
                </div>
                <div class="mb-4">
                    <span class="block text-xs text-gray-500 uppercase font-semibold">Chantier</span>
                    <span class="block text-lg font-bold text-gray-800">{{ $fiche->chantier }}</span>
                </div>
                <div class="mb-4">
                    <span class="block text-xs text-gray-500 uppercase font-semibold">Chef atelier</span>
                    <span class="block text-lg font-bold text-gray-800">{{ $fiche->chefAtelier }}</span>
                </div>
                <div class="mb-4">
                    <span class="block text-xs text-gray-500 uppercase font-semibold">Date de commande</span>
                    <span class="block text-lg font-bold text-gray-800">{{ $fiche->dateCommande }}</span>
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <span class="block text-xs text-gray-500 uppercase font-semibold">Schéma</span>
                        @if($fiche->schemaPlan)
                            <a href="{{ asset('storage/'.$fiche->schemaPlan) }}" target="_blank" class="text-blue-600 hover:underline">Voir le schéma</a>
                        @else
                            <span class="text-gray-400 italic">Aucun schéma</span>
                        @endif
                </div>
            </div>
        </div>

        {{-- Description --}}
        <div class="mt-6">
            <span class="block text-xs text-gray-500 uppercase font-semibold mb-2">Description</span>
            <div class="bg-white border-l-4 border-blue-400 p-4 rounded-lg text-gray-700 shadow">
                {{ $fiche->description ?? 'Pas de description.' }}
            </div>
        </div>
        {{-- Articles --}}
        <div class="mt-10">
            <h2 class="text-xl font-bold text-gray-700 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-box text-purple-600"></i> Les articles
            </h2>
            <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-md">
                <table class="min-w-full bg-white rounded-2xl">
                    <thead class="bg-gradient-to-r from-indigo-50 via-blue-50 to-purple-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase text-left"><i class="fa-solid fa-box mr-1 text-blue-400"></i> Article</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase"><i class="fa-solid fa-layer-group mr-1 text-blue-400"></i> Quantité</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-600 uppercase"><i class="fa-solid fa-ruler-vertical text-md mr-1 text-blue-400"></i> Unité</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm text-center">
                        @forelse($fiche->articles as $article)
                            <tr class="hover:bg-blue-50/30 transition">
                                <td class="px-6 py-2.5 text-gray-800 font-medium text-left">{{ $article->articleDemande }}</td>
                                <td class="px-6 py-2.5">
                                    <span class="inline-block bg-purple-100 text-purple-700 font-semibold rounded px-4 py-1">
                                        {{ $article->quantite }}
                                    </span>
                                </td>
                                <td class="px-6 py-2.5 text-gray-800 font-medium">
                                    @if ($article->unite)
                                        {{ $article->unite }}
                                    @else
                                        <span class="text-gray-400 italic">Aucune</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-400 italic">
                                    Aucun article ajouté à cette fiche.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


        <div class="mt-10 flex gap-4 justify-end">
            <a href="{{ route('fiche-commande.index') }}"
               class="px-6 py-2 rounded-xl bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300 transition flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Retour
            </a>
            {{-- <x-return-button >Retour</x-return-button> --}}

            <a href="{{route('fiche-commande.edit',$fiche->numFiche)}}"
               class="px-6 py-2 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition flex items-center gap-2">
                <i class="fa-solid fa-pen"></i> Modifier
            </a>

            <a href="{{ route('fiche-commande.generate', $fiche->numFiche) }}"
               class="px-6 py-2 rounded-xl bg-green-600 text-white font-semibold hover:bg-green-700 transition flex items-center gap-2">
                <i class="fa-solid fa-download"></i> Installer
            </a>
        </div>
    </div>
@endsection