@extends('layout.master')

@section('title', 'Ajouter une fiche de commande')

@section('content')
    <div class="bg-white/80 rounded-2xl shadow-2xl p-10 border border-blue-100 backdrop-blur-lg">

        <h1 class="text-5xl font-black bg-clip-text text-transparent bg-gradient-to-r from-indigo-800 via-blue-600 to-purple-500 mb-12 text-center gap-3">
            <span class="inline-block animate-pulse">📝</span>
            Nouvelle fiche de commande
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

        <form action="{{ route('fiche-commande.store') }}" method="POST" class="space-y-12" enctype="multipart/form-data">
            @csrf
            {{-- Section Demandeur --}}
            <section>
                <h2 class="text-xl font-bold text-gray-700 mb-6 border-b-2 border-blue-100 pb-2 flex items-center gap-2">
                    <span class="inline-block w-3 h-3 bg-blue-500 rounded-full"></span>
                    Demandeur
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <label for="nomDemandeur" class="block text-sm font-semibold text-gray-600 mb-1">Nom</label>
                        <input type="text" id="nomDemandeur" name="nomDemandeur" value="{{ old('nomDemandeur') }}" class="w-full border border-blue-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-400 transition shadow bg-blue-50/60" required placeholder="Entrez le nom" />
                    </div>
                    <div>
                        <label for="chantier" class="block text-sm font-semibold text-gray-600 mb-1">Chantier</label>
                        <input type="text" id="chantier" name="chantier" value="{{ old('chantier') }}" class="w-full border border-blue-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-purple-400 transition shadow bg-blue-50/60" required placeholder="Entrez le chantier"/>
                    </div>
                    <div>
                        <label for="atelier" class="block text-sm font-semibold text-gray-600 mb-1">Atelier</label>
                        <input type="text" id="atelier" name="atelier" value="{{ old('atelier') }}" class="w-full border border-blue-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-purple-400 transition shadow bg-blue-50/60" required placeholder="Entrez le nom"/>
                    </div>
                    <div>
                        <label for="chefAtelier" class="block text-sm font-semibold text-gray-600 mb-1">Chef atelier</label>
                        <input type="text" id="chefAtelier" name="chefAtelier" value="{{ old('chefAtelier') }}" class="w-full border border-blue-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-purple-400 transition shadow bg-blue-50/60" required placeholder="Entrez le nom"/>
                    </div>
                    <div>
                        <label for="dateCommande" class="block text-sm font-semibold text-gray-600 mb-1">Date de commande</label>
                        <input type="date" id="dateCommande" name="dateCommande" value="{{ old('dateCommande', date('Y-m-d')) }}" required class="w-full border border-blue-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-purple-400 transition shadow bg-blue-50/60"/>
                    </div>
                    <div>
                        <label for="numFiche" class="block text-sm font-semibold text-gray-600 mb-1">Numéro de fiche de commande</label>
                        <input type="text" id="numFiche" name="numFiche" value="{{ old('numFiche') }}" placeholder="entrez le numéro" required class="w-full border border-blue-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-purple-400 transition shadow bg-blue-50/60"/>
                    </div>
                </div>
            </section>

            {{--  Section Articles --}}
            <section>
                <h2 class="text-xl font-bold text-gray-700 mb-6 border-b-2 border-purple-100 pb-2 flex items-center gap-2">
                    <span class="inline-block w-3 h-3 bg-purple-500 rounded-full"></span>
                    Articles
                </h2>

                <div class="flex flex-col md:flex-row gap-4 mb-4 items-end">
                    <input type="text" id="articleInput" placeholder="Article demandé" class="w-full md:flex-1 px-4 py-2.5 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none">
                    <input type="number" id="quantiteInput" placeholder="Quantité" min="1" class="w-full md:flex-1 px-4 py-2.5 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none">
                    <input type="text" id="uniteInput" placeholder="Unité (optionnel)" class="w-full md:flex-1 px-4 py-2.5 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none">

                    <button type="button" id="addArticleBtn" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> Ajouter
                    </button>
                </div>

                {{-- Affichage des articles --}}
                <div class="mt-6 overflow-x-auto rounded-xl shadow-md border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200 bg-white rounded-xl">
                        <thead class="bg-gradient-to-r from-blue-50 via-purple-50 to-blue-100 sticky top-0 z-10">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest rounded-tl-xl">Article demandé</th>
                                <th class="px-6 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest">Quantité</th>
                                <th class="px-6 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest">Unité</th>
                                <th class="px-6 py-4 text-center text-xs font-extrabold text-blue-700 uppercase tracking-widest rounded-tr-xl">Action</th>
                            </tr>
                        </thead>
                        {{-- <tbody id="articlesTableBody" class="divide-y divide-gray-100">
                            <tr id="empty-article-row">
                                <td colspan="4" class="p-4 text-center text-gray-400 font-medium italic">Aucun article ajouté.</td>
                            </tr>
                        </tbody> --}}
                        <tbody id="articlesTableBody" class="divide-y divide-gray-100">
                            @if(old('articles'))
                                @foreach(old('articles') as $index => $article)
                                    <tr id="empty-article-row" style="display: none;">
                                        <td colspan="4" class="p-4 text-center text-gray-400 font-medium italic">Aucun article ajouté.</td>
                                    </tr>
                                    <tr data-article="{{ $article }}">
                                        <td class="px-4 py-2 text-gray-700 font-medium">
                                            {{ $article }}
                                            <input type="hidden" name="articles[]" value="{{ $article }}">
                                        </td>
                                        <td class="px-7 py-2 text-gray-700">
                                            {{ old('quantites')[$index] ?? '' }}
                                            <input type="hidden" name="quantites[]" value="{{ old('quantites')[$index] ?? '' }}">
                                        </td>
                                        <td class="px-7 py-2 text-gray-700">
                                            {{ old('unites')[$index] ?? 'Aucune' }}
                                            <input type="hidden" name="unites[]" value="{{ old('unites')[$index] ?? '' }}">
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            <button type="button" onclick="removeArticle('{{ $article }}')" class="px-3 py-1.5 rounded-xl text-xs bg-red-100 text-red-800 hover:bg-red-200 font-semibold transition">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr id="empty-article-row">
                                    <td colspan="4" class="p-4 text-center text-gray-400 font-medium italic">Aucun article ajouté.</td>
                                </tr>
                            @endif
                        </tbody>

                    </table>
                </div>
            </section>

        <!-- Section Schéma et Description -->
            <section>
                <h2 class="text-xl font-bold text-gray-700 mb-6 border-b-2 border-gray-100 pb-2 flex items-center gap-2">
                    <span class="inline-block w-3 h-3 bg-gray-500 rounded-full"></span>
                    Schéma et Description
                </h2>
                <div>
                    <label for="schema" class="block text-sm font-semibold text-gray-600 mb-1">Schéma (optionnel)</label>
                    <input type="file" id="schema" name="schemaPlan"  accept="image/jpeg, image/png, image/webp" class="w-full border border-gray-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300 transition shadow" />
                </div>
                <div class="mt-8">
                    <label for="description" class="block text-sm font-semibold text-gray-600 mb-1">Description</label>
                    <textarea id="description" name="description" rows="3"  placeholder="Description" class="w-full border border-gray-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300 transition shadow">{{ old('description') }}</textarea>
                </div>
            </section>

            <div class="flex justify-end gap-5 mt-6">
                <a href="{{ route('fiche-commande.index') }}"
                    class="px-8 py-2.5 rounded-xl bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300 transition flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Retour
                </a>
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold px-10 py-2.5 rounded-xl shadow-lg transition-all duration-200 transform flex items-center gap-2.5">
                    <i class="fa-solid fa-save"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const addBtn = document.getElementById("addArticleBtn");
            const articleInput = document.getElementById("articleInput");
            const quantiteInput = document.getElementById("quantiteInput");
            const uniteInput = document.getElementById("uniteInput");
            const tableBody = document.getElementById("articlesTableBody");
            const emptyRow = document.getElementById("empty-article-row");

            const updateTableState = () => {
                const rowCount = tableBody.querySelectorAll('tr:not(#empty-article-row)').length;
                emptyRow.style.display = rowCount === 0 ? 'table-row' : 'none';
            };

            updateTableState();

            addBtn.addEventListener("click", () => {
                const article = articleInput.value.trim();
                const quantite = quantiteInput.value;
                const unite = uniteInput.value.trim() || null;

                if (!article || !quantite) {
                    alert("Veuillez remplir l'article et la quantité.");
                    return;
                }

                if (tableBody.querySelector(`tr[data-article="${article}"]`)) {
                    alert("Cet article est déjà ajouté.");
                    return;
                }

                const row = document.createElement("tr");
                row.dataset.article = article;
                row.innerHTML = `
                    <td class="px-4 py-2 text-gray-700 font-medium">
                        ${article}<input type="hidden" name="articles[]" value="${article}">
                    </td>
                    <td class="px-7 py-2 text-gray-700 ">
                        ${quantite}<input type="hidden" name="quantites[]" value="${quantite}">
                    </td>
                    <td class="px-7 py-2 text-gray-700">
                        ${unite || 'Aucune'}<input type="hidden" name="unites[]" value="${unite}">
                    </td>
                    <td class="px-4 py-2 text-center space-x-2">
                        <button type="button" onclick="removeArticle('${article}')" class="px-3 py-1.5 rounded-lg text-xs bg-red-100 text-red-800 hover:text-red-800 font-semibold transition">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
                updateTableState();

                articleInput.value = '';
                quantiteInput.value = '';
                uniteInput.value = '';
            });

            window.removeArticle = (article) => {
                tableBody.querySelector(`tr[data-article="${article}"]`).remove();
                updateTableState();
            };
        });
    </script>

@endsection