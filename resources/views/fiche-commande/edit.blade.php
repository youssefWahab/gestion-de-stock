@extends('layout.master')

@section('title', 'Modifier une fiche de commande')

@section('content')
    <div class="bg-white/80 rounded-2xl shadow-2xl p-10 border border-blue-100 backdrop-blur-lg">

        <h1 class="text-4xl font-black bg-clip-text text-transparent bg-gradient-to-r from-indigo-800 via-blue-600 to-purple-500 mb-12 text-center">
            Modifier la fiche de commande
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

        {{-- Success Message --}}
        {{-- @if(session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif --}}

        <form method="POST" action="{{ route('fiche-commande.update', $fiche->numFiche) }}" enctype="multipart/form-data" class="space-y-12">
            @csrf
            @method('PUT')

            {{-- Section Demandeur --}}
            <section>
                <h2 class="text-xl font-bold text-gray-700 mb-6 border-b-2 border-blue-100 pb-2">Demandeur</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="nomDemandeur" class="block text-sm font-semibold text-gray-600 mb-1">Nom</label>
                            <input type="text" id="nomDemandeur" name="nomDemandeur" value="{{ old('nomDemandeur', $fiche->nomDemandeur) }}" required class="w-full border border-blue-200 rounded-xl px-4 py-2 bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow"/>
                        </div>
                        <div>
                            <label for="chantier" class="block text-sm font-semibold text-gray-600 mb-1">Chantier</label>
                            <input type="text" id="chantier" name="chantier" value="{{ old('chantier', $fiche->chantier) }}" required  class="w-full border border-blue-200 rounded-xl px-4 py-2 bg-blue-50 focus:outline-none focus:ring-2 focus:ring-purple-400 shadow"/>
                        </div>
                        <div>
                            <label for="atelier" class="block text-sm font-semibold text-gray-600 mb-1">Atelier</label>
                            <input type="text" id="atelier" name="atelier" value="{{ old('atelier', $fiche->atelier) }}" required class="w-full border border-blue-200 rounded-xl px-4 py-2 bg-blue-50 focus:outline-none focus:ring-2 focus:ring-purple-400 shadow"/>
                        </div>
                        <div>
                            <label for="chefAtelier" class="block text-sm font-semibold text-gray-600 mb-1">Chef atelier</label>
                            <input type="text" id="chefAtelier" name="chefAtelier" value="{{ old('chefAtelier', $fiche->chefAtelier) }}" required class="w-full border border-blue-200 rounded-xl px-4 py-2 bg-blue-50 focus:outline-none focus:ring-2 focus:ring-purple-400 shadow"/>
                        </div>
                        <div>
                            <label for="dateCommande" class="block text-sm font-semibold text-gray-600 mb-1">Date de commande</label>
                            <input type="date" id="dateCommande" name="dateCommande" value="{{ old('dateCommande', $fiche->dateCommande) }}" required class="w-full border border-blue-200 rounded-xl px-4 py-2 bg-blue-50 focus:outline-none focus:ring-2 focus:ring-purple-400 shadow"/>
                        </div>
                    </div>
            </section>

            <!-- Section Articles -->
            <section>
                <h2 class="text-xl font-bold text-gray-700 mb-6 border-b-2 border-purple-100 pb-2">Articles</h2>

                <a href="{{ route('fiche-commande.manage-articles', $fiche->numFiche) }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-purple-500 text-white font-semibold rounded-xl shadow-md hover:from-blue-700 hover:to-purple-600 transition">
                    <i class="fas fa-cogs mr-2"></i> Gérer les articles
                </a>
                
                <!-- table des articles -->
                <div class="mt-6 overflow-x-auto rounded-xl shadow-md border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200 bg-white rounded-xl">
                        <thead class="bg-gradient-to-r from-blue-50 via-purple-50 to-blue-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-extrabold text-blue-700 uppercase">Article demandé</th>
                                <th class="px-6 py-4 text-left text-xs font-extrabold text-blue-700 uppercase">Quantité</th>
                                <th class="px-6 py-4 text-left text-xs font-extrabold text-blue-700 uppercase">Unité</th>
                            </tr>
                        </thead>
                        <tbody id="articlesTableBody" class="divide-y divide-gray-100">
                            @forelse($fiche->articles as $article)
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
                                </tr>
                            @empty
                                <tr id="empty-article-row">
                                    <td colspan="3" class="p-4 text-center text-gray-400 italic">Aucun article ajouté.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </section>

            <!-- Section Schéma et Description -->
            <section class="mt-12">
                <h2 class="text-xl font-bold text-gray-700 mb-6 border-b-2 border-gray-100 pb-2">Schéma et Description</h2>
                <div>
                    <label for="schema" class="block text-sm font-semibold text-gray-600 mb-1">Schéma (optionnel)</label>
                        <input type="file" 
                        id="schema" 
                        name="schemaPlan" 
                        accept="image/jpeg, image/png, image/webp"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300 shadow" />

                    @if($fiche->schemaPlan)
                        <div>
                            <img id="schemaPreview" 
                            src="{{ asset('storage/' . $fiche->schemaPlan) }}" 
                            alt="Schéma de la commande" 
                            class="max-w-md max-h-32 object-contain rounded-xl border shadow-md mt-3">

                        </div>
                    @endif
                </div>
                <div class="mt-8">
                    <label for="description" class="block text-sm font-semibold text-gray-600 mb-1">Description</label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300 shadow"
                        placeholder="Description">{{ old('description', $fiche->description) }}</textarea>
                </div>
            </section>

            <div class="flex justify-end gap-5 mt-6">
                <a href="{{ route('fiche-commande.index') }}" class="px-8 py-2 rounded-xl bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300 transition flex items-center gap-2.5">
                    <i class="fa-solid fa-arrow-left"></i> Retour
                </a>
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold px-8 py-2.5 rounded-xl shadow-lg transition-all flex items-center gap-2.5">
                    <i class="fa-solid fa-save text-lg"></i> Mettre à jour
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: "{{ session('success') }}",
                showConfirmButton: true,
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'text-base p-6',
                    title: 'text-xl font-bold',
                    content: 'text-base'
                }
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: "{{ session('error') }}",
                showConfirmButton: true,
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'text-base p-6',
                    title: 'text-xl font-bold',
                    content: 'text-base'
                }
            });
        @endif
    </script>

    <script>
        document.getElementById('schema').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('schemaPreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection