@extends('layout.master')

@section('title', 'Demande d\'achat')

@section('content')
    <div class="bg-white/80 rounded-2xl shadow-lg p-10 border border-blue-100 backdrop-blur-lg">
        <h1 class="text-5xl text-center font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-indigo-700 via-blue-600 to-purple-500 mb-12 drop-shadow-lg tracking-tight leading-snug">
            Nouvelle demande d'achat
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

        <form action="{{ route('demande-achat.store')}}" method="POST" class="space-y-12">
            @csrf

            {{-- Informations sur la demande --}}
            <section>
                <h2 class="text-xl font-bold text-gray-700 mb-6 border-b-2 border-blue-100 pb-2 flex items-center gap-2">
                    <span class="inline-block w-3 h-3 bg-blue-500 rounded-full"></span>
                    Informations sur la demande
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3">
                    <div>
                        <label for="numFiche" class="block text-sm font-semibold text-gray-600 mb-2">
                            N° de fiche de commande :
                        </label>
                        <select id="numFiche" name="numFiche"  class="w-full border border-blue-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm transition" required>
                            <option value="">Sélectionnez une fiche</option>
                            @foreach ($fiches as $fiche)
                                <option value="{{ $fiche->numFiche }}">{{ $fiche->numFiche }} - {{ $fiche->nomDemandeur }} ({{ $fiche->atelier }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="numBonCommande" class="block text-sm font-semibold text-gray-600 mb-2">
                            N° de bon de commande :
                        </label>
                        <input type="text" id="numBonCommande" name="numBonCommande" placeholder="Entrez le numéro" value="{{ old('numBonCommande') }}" required class="w-full border border-blue-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400 shadow-sm transition"/>
                    </div>

                    <div>
                        <label for="atelier" class="block text-sm font-semibold text-gray-600 mb-2">Atelier :</label>
                        <input type="text" id="atelier" name="atelier" placeholder="Entrez le nom de l'atelier" value="{{ old('atelier') }}" required  class="w-full border border-blue-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400 shadow-sm transition"/>
                    </div>

                    <div>
                        <label for="natureTravaux" class="block text-sm font-semibold text-gray-600 mb-2">Nature de travaux :</label>
                        <input type="text" id="natureTravaux" name="natureTravaux" placeholder="Entrez la nature des travaux" value="{{ old('natureTravaux') }}" class="w-full border border-blue-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400 shadow-sm transition"/>
                    </div>
                </div>
            </section>

            {{-- Section Articles --}}
            <section>
                <h2 class="text-xl font-bold text-gray-700 mb-4 border-b-2 border-purple-100 pb-2 flex items-center gap-2">
                    <span class="inline-block w-3 h-3 bg-purple-500 rounded-full"></span>
                    Les articles
                </h2>

                <div class="bg-white mb-6 rounded-xl flex flex-wrap gap-3 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label for="articleInput" class="text-gray-600 font-medium">Article demandé :</label>
                        <input type="text" list="articleList" id="articleInput" placeholder="Nom de l'article" autocomplete="off" class="w-full px-4 py-2 mt-1.5 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none transition shadow-sm">
                        <datalist id="articleList">
                            @foreach ($stocks as $stock)
                                <option data-id="{{ $stock->id }}" value="{{ $stock->article }}"></option>
                            @endforeach
                        </datalist>
                    </div>

                    <div class="flex flex-col w-24 min-w-[80px]">
                        <label for="quantiteInput" class="mb-1.5 text-gray-600 font-medium">Quantité</label>
                        <input type="number" id="quantiteInput" placeholder="0" min="1" class="w-full px-4 py-2 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none transition shadow-sm">
                    </div>

                    <div class="flex flex-col w-24 min-w-[80px]">
                        <label for="uniteInput" class="mb-1.5 text-gray-600 font-medium">Unité <span class="text-red-600 text-xl">*</span></label>
                        <input type="text" id="uniteInput" placeholder="Unité" class="w-full px-4 py-2 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none transition shadow-sm">
                    </div>

                    <div class="flex flex-col w-28 min-w-[100px]">
                        <label for="prixInput" class="mb-1.5 text-gray-600 font-medium">Prix <span class="text-red-600 text-xl">*</span></label>
                        <input type="number" id="prixInput" placeholder="0" step="0.01"
                            class="w-full px-4 py-2 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none transition shadow-sm">
                    </div>

                    <div class="flex flex-col md:w-auto">
                        <button type="button" id="addArticleBtn"
                            class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center justify-center gap-2 min-w-[120px]">
                            <i class="fa-solid fa-plus"></i> Ajouter
                        </button>
                    </div>
                </div>

                {{-- Table Articles --}}
                <div class="overflow-x-auto rounded-xl shadow-md border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200 bg-white rounded-xl">
                        <thead class="bg-gradient-to-r from-blue-50 via-purple-50 to-blue-100 sticky top-0 z-10">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest rounded-tl-xl">Article demandé</th>
                                <th class="px-6 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest">Quantité</th>
                                <th class="px-6 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest">Unité</th>
                                <th class="px-6 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest">Prix</th>
                                <th class="px-6 py-4 text-center text-xs font-extrabold text-blue-700 uppercase tracking-widest rounded-tr-xl">Action</th>
                            </tr>
                        </thead>
                        <tbody id="articlesTableBody" class="divide-y divide-gray-100">
                            <tr id="empty-article-row">
                                <td colspan="5" class="p-4 text-center text-gray-400 font-medium italic">Aucun article ajouté.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <div class="flex justify-end gap-5 mt-8">
                <a href="{{ route('demande-achat.index') }}" class="px-8 py-2.5 rounded-xl bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300 transition flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Retour
                </a>
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold px-10 py-2.5 rounded-xl shadow-lg transition-all duration-200 transform hover:scale-105 flex items-center gap-2.5">
                    <i class="fa-solid fa-save"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>

        
    {{-- <script>
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
    </script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const addBtn = document.getElementById("addArticleBtn");
            const articleInput = document.getElementById("articleInput");
            const quantiteInput = document.getElementById("quantiteInput");
            const uniteInput = document.getElementById("uniteInput");
            const prixInput = document.getElementById("prixInput");
            const tableBody = document.getElementById("articlesTableBody");
            const emptyRow = document.getElementById("empty-article-row");
            const articleList = document.getElementById("articleList");

            const updateTableState = () => {
                const rowCount = tableBody.querySelectorAll('tr:not(#empty-article-row)').length;
                emptyRow.style.display = rowCount === 0 ? 'table-row' : 'none';
            };

            updateTableState();

            // addBtn.addEventListener("click", () => {
            //     const articleName = articleInput.value.trim();
            //     const quantite = quantiteInput.value;
            //     const unite = uniteInput.value.trim() || null;
            //     const prix = prixInput ? prixInput.value || 0 : 0;

            //     if (!articleName || !quantite) {
            //         alert("Veuillez remplir l'article et la quantité.");
            //         return;
            //     }

            //     if (tableBody.querySelector(`tr[data-article="${articleName}"]`)) {
            //         alert("Cet article est déjà ajouté.");
            //         return;
            //     }

            //     const matchedOption = Array.from(articleList.options).find(opt => opt.value === articleName);

            //     let hiddenInput = '';
            //     if (matchedOption) {
            //         hiddenInput = `<input type="hidden" name="articles[]" value='${JSON.stringify({
            //             article: matchedOption.dataset.id,
            //             qte: quantite,
            //             unite: unite,
            //             prix: prix
            //         })}'>`;
            //     } else {
            //         hiddenInput = `<input type="hidden" name="is_new[]" value='${JSON.stringify({
            //             article: articleName,
            //             qte: quantite,
            //             unite: unite,
            //             prix: prix
            //         })}'>`;
            //     }

            //     const row = document.createElement("tr");
            //     row.dataset.article = articleName;
            //     row.innerHTML = `
            //         <td class="px-4 py-2 text-gray-700 font-medium">
            //             ${articleName}
            //             ${hiddenInput}
            //         </td>
            //         <td class="px-7 py-2 text-gray-700">${quantite}</td>
            //         <td class="px-7 py-2 text-gray-700">${unite || 'Aucune'}</td>
            //         <td class="px-7 py-2 text-gray-700">${prix}</td>
            //         <td class="px-4 py-2 text-center space-x-2">
            //             <button type="button" onclick="removeArticle('${articleName}')" class="px-3 py-1.5 rounded-lg text-xs bg-red-100 text-red-800 hover:text-red-800 font-semibold transition">
            //                 <i class="fa-solid fa-trash"></i>
            //             </button>
            //         </td>
            //     `;
            //     tableBody.appendChild(row);
            //     updateTableState();

            //     articleInput.value = '';
            //     quantiteInput.value = '';
            //     uniteInput.value = '';
            //     if (prixInput) prixInput.value = '';
            // });
            addBtn.addEventListener("click", () => {
                const articleName = articleInput.value.trim();
                const quantite = quantiteInput.value;
                const unite = uniteInput.value.trim() || null;
                const prix = prixInput ? prixInput.value || 0 : 0;

                if (!articleName || !quantite) {
                    alert("Veuillez remplir l'article et la quantité.");
                    return;
                }

                if (tableBody.querySelector(`tr[data-article="${articleName}"]`)) {
                    alert("Cet article est déjà ajouté.");
                    return;
                }

                // Vérifier si l’article correspond à une option existante
                const matchedOption = Array.from(articleList.options).find(opt => opt.value === articleName);
                const articleValue = matchedOption ? matchedOption.dataset.id : articleName;

                const row = document.createElement("tr");
                row.dataset.article = articleName;
                row.innerHTML = `
                    <td class="px-4 py-2 text-gray-700 font-medium">
                        ${articleName}
                        <input type="hidden" name="articles[]" value="${articleValue}">
                    </td>
                    <td class="px-7 py-2 text-gray-700">
                        ${quantite}
                        <input type="hidden" name="quantites[]" value="${quantite}">
                    </td>
                    <td class="px-7 py-2 text-gray-700">
                        ${unite || 'Aucune'}
                        <input type="hidden" name="unites[]" value="${unite || ''}">
                    </td>
                    <td class="px-7 py-2 text-gray-700">
                        ${prix || 0}
                        <input type="hidden" name="prix[]" value="${prix}">
                    </td>
                    <td class="px-4 py-2 text-center space-x-2">
                        <button type="button" onclick="removeArticle('${articleName}')" 
                            class="px-3 py-1.5 rounded-lg text-xs bg-red-100 text-red-800 hover:text-red-800 font-semibold transition">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
                updateTableState();

                // reset inputs
                articleInput.value = '';
                quantiteInput.value = '';
                uniteInput.value = '';
                if (prixInput) prixInput.value = '';
            });


            window.removeArticle = (article) => {
                tableBody.querySelector(`tr[data-article="${article}"]`).remove();
                updateTableState();
            };
        });
    </script>


@endsection