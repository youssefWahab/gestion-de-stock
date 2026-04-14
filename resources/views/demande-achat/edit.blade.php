@extends('layout.master')

@section('title', 'Modifier demande d\'achat')

@section('content')
    <div class="min-h-screen w-full bg-transparent">
        <div class="w-full mx-auto bg-white/80 rounded-2xl shadow-2xl p-10 border border-blue-100 backdrop-blur-lg">
            <h1 class="text-5xl text-center font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-indigo-700 via-blue-600 to-purple-500 mb-12 drop-shadow-lg tracking-tight leading-snug">
                demande d'achat
            </h1>

            {{-- Success --}}
            @if(session('success'))
                <x-alert type="success" :message="session('success')" />
            @endif

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

            <form class="space-y-12" method="POST" action="{{ route('demande-achat.update',$demande->id) }}">
                @csrf
                @method('PUT')

                <!-- Section des info sur la demande -->
                <section>
                    <h2 class="text-xl font-bold text-gray-700 mb-6 border-b-2 border-blue-100 pb-2">
                        Informations sur la demande 
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <label for="bonCommande" class="block text-sm font-semibold text-gray-600 mb-2">
                                Numéro de bon de commande
                            </label>
                            <input type="text" id="bonCommande" name="numBonCommande" value="{{ $demande->numBonCommande }}" class="w-full border border-blue-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-400 transition shadow" placeholder="Entrez le numéro"  />
                        </div>
                        <div>
                            <label for="atelier" class="block text-sm font-semibold text-gray-600 mb-2">
                                Atelier
                            </label>
                            <input type="text" id="atelier" name="atelier" value="{{ $demande->atelier }}" class="w-full border border-blue-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-400 transition shadow" placeholder="Entrez la nature des travaux" />
                        </div>
                        <div>
                            <label for="natureTravaux" class="block text-sm font-semibold text-gray-600 mb-2">
                                Nature de travaux
                            </label>
                            <input type="text" id="natureTravaux" name="natureTravaux" value="{{ $demande->natureTravaux }}" class="w-full border border-blue-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-400 transition shadow" placeholder="Entrez la nature des travaux" />
                        </div>
                    </div>
                </section>

                <!-- Section des articles -->
                <section>
                    <h2 class="text-xl font-bold text-gray-700 mb-6 border-b-2 border-purple-100 pb-2">Articles</h2>

                    <a href="{{ route('demande-achat.manage-articles', $demande->id) }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-purple-500 text-white font-semibold rounded-xl shadow-md hover:from-blue-700 hover:to-purple-600 transition">
                        <i class="fas fa-cogs mr-2"></i> Gérer les articles
                    </a>

                    <!-- table des articles -->
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
                                @forelse($demande->articles as $article)
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

                </section>

                <section>
                    <h2 class="text-xl font-bold text-gray-700 mb-6 border-b-2 border-purple-100 pb-2">
                        Fiche de Commande associée
                    </h2>

                                

                    <!-- table pour l'article assoicie a cette demande -->
                    <div class="mt-6 overflow-x-auto rounded-xl shadow-md border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200 bg-white rounded-xl">
                            <thead class="bg-gradient-to-r from-blue-50 via-purple-50 to-blue-100">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-extrabold text-blue-700 uppercase">Numéro de fiche</th>
                                    <th class="px-6 py-4 text-xs font-extrabold text-blue-700 uppercase">Nom du demandeur</th>
                                    <th class="px-6 py-4 text-xs font-extrabold text-blue-700 uppercase">Atelier</th>
                                    <th class="px-6 py-4 text-xs font-extrabold text-blue-700 uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody id="fichesTableBody" class="divide-y divide-gray-100 text-center">
                                    <tr>
                                        <td class="px-4 py-2 text-gray-700 font-medium">{{ $demande->ficheCommande->numFiche }}</td>
                                        <td class="px-4 py-2 text-gray-700">{{ $demande->ficheCommande->nomDemandeur }}</td>
                                        <td class="px-4 py-2 text-gray-700">{{ $demande->ficheCommande->atelier }}</td>
                                        <td class="px-4 py-2 text-gray-700 flex justify-center gap-3">
                                            <a href="{{ route('demande-achat.manage-fiche', $demande->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold rounded-xl shadow transition">
                                                <i class="fas fa-exchange-alt mr-2"></i> Changer
                                            </a>
                                        </td>
                                    </tr>
                                @empty($demande->ficheCommande)
                                    <tr id="empty-fiche-row">
                                        <td colspan="4" class="p-4 text-center text-gray-400 italic">
                                            Aucune fiche de commande ajoutée.
                                        </td>
                                    </tr>
                                @endempty
                            </tbody>
                        </table>
                    </div>
                </section>

                <div class="flex justify-end gap-5 mt-8">
                    <a href="{{ route('demande-achat.index') }}" class="px-8 py-3 rounded-xl bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300 transition flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i> Retour
                    </a>
                    <button
                        type="submit"
                        class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold px-10 py-3 rounded-xl transition-all duration-200 transform flex items-center gap-2"
                    >
                        <i class="fa-solid fa-save text-xl"></i>
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
