@extends('layout.master')

@section('title', 'Nouvelle Production')

@section('content')
    <div class="bg-white/95 rounded-2xl shadow-xl p-8 max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-10 flex items-center gap-3">
            <i class="fa-solid fa-sitemap text-blue-600"></i>
            Nouvelle production
        </h1>
        {{-- Errors --}}
        @if(session('error'))
            <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800 border border-red-200 flex items-center gap-3">
                {{ session('error') }}
                <button onclick="this.parentElement.remove()" class="ml-auto font-bold hover:opacity-70">✕</button>
            </div>
        @endif

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

        <form action="{{ route('production.store') }}" method="POST" class="space-y-10">
            @csrf

            {{-- Section: Détails de la production --}}
            <div class="p-6 bg-gray-50 rounded-2xl border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-700 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-indigo-500"></i>
                    Détails de la production
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label for="chantier" class="block text-sm font-semibold text-gray-600 mb-2">Chantier</label>
                        <input type="text" name="chantier" id="chantier" placeholder="Entrez la chantier" required class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition"/>
                    </div>

                    <div>
                        <label for="numBonTransfert" class="block text-sm font-semibold text-gray-600 mb-2">
                            N° Bon de transfert
                        </label>
                        <input type="text" name="numBonTransfert" id="numBonTransfert" placeholder="BT-001"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm text-gray-700 placeholder-gray-400 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition" required>
                    </div>
                </div>
            </div>

            {{-- Section: Détails des articles produits --}}
            <div class="p-6 bg-gray-50 rounded-2xl border border-gray-200 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-700 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-cubes text-purple-600"></i>
                    Ajouter des articles de production
                </h3>

                {{-- Inputs --}}
                <div class="grid grid-cols-1 md:grid-cols-2  gap-4 mb-4">
                    <div>
                        <input type="text" list="articleList" id="articleInput" placeholder="Article" autocomplete="off" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:outline-none transition">
                        <datalist id="articleList">
                            @foreach ($stocks as $stock)
                                <option data-id="{{ $stock->id }}" value="{{ $stock->article }}"></option>
                            @endforeach
                        </datalist>
                    </div>
                    <div>
                        <input type="number" id="quantiteInput" placeholder="Quantité"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:outline-none transition">
                    </div>
                    <div>
                        <input type="text" id="uniteInput" placeholder="Unité"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:outline-none transition">
                    </div>
                    <div>
                        <input type="number" step="0.01" id="prixInput" placeholder="Prix"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 focus:outline-none transition">
                    </div>
                </div>
                <div class="flex ">
                    <button type="button" id="addArticleBtn"
                            class="w-full md:w-auto px-12 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-plus"></i> Ajouter
                    </button>
                </div>

                {{-- Table of selected articles --}}
                <div class="mt-6 overflow-x-auto rounded-xl shadow-md border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-blue-50 via-purple-50 to-blue-100 sticky top-0 z-10">
                            <tr>
                                <th class="px-6 py-3 text-xs font-extrabold text-blue-700 uppercase tracking-widest">Article</th>
                                <th class="px-6 py-3 text-xs font-extrabold text-blue-700 uppercase tracking-widest">Quantité</th>
                                <th class="px-6 py-3 text-xs font-extrabold text-blue-700 uppercase tracking-widest">Unité</th>
                                <th class="px-6 py-3 text-xs font-extrabold text-blue-700 uppercase tracking-widest">Prix</th>
                                <th class="px-6 py-3 text-xs font-extrabold text-blue-700 uppercase tracking-widest">Action</th>
                            </tr>
                        </thead>
                        <tbody id="articleTableBody" class="bg-white divide-y divide-gray-100 text-center">
                            <tr id="article-empty-row">
                                <td colspan="5" class="p-4 text-center bg-white text-gray-400 font-medium italic">
                                    Aucun article ajouté.
                                </td>
                            </tr>
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
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div>
                        <label for="produitFinale" class="block text-sm font-semibold text-gray-600 mb-2">produit fini</label>
                        <input type="text" name="produitFinale" id="produitFinale" placeholder="Etrez le nom" required class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition">
                    </div>
                    <div>
                        <label for="quantite" class="block text-sm font-semibold text-gray-600 mb-2">Quantité</label>
                        <input type="number" name="quantite" id="quantiteProduitInput" min="1" placeholder="EX : 20" required class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition">
                    </div>
                    <div>
                        <label for="unite" class="block text-sm font-semibold text-gray-600 mb-2">Unité</label>
                        <input type="text" name="unite" id="unite" placeholder="Unité" required class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition">
                    </div>
                    <div>
                        <label for="coutReviens" class="block text-sm font-semibold text-gray-600 mb-2">
                            Coût de revient unitaire
                        </label>
                        <input type="number" step="0.01" name="coutReviens" id="coutReviensInput" placeholder="EX:1499" required class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-gray-700  focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition">
                    </div>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end items-center gap-4">
                <a href="{{ route('production.index') }}" class="px-8 py-2.5 rounded-xl bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300 transition flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Retour
                </a>
                <button type="submit" id="saveBtn"
                    class="bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold px-8 py-3 rounded-xl shadow-lg  hover:from-blue-700 hover:to-purple-700 transition flex items-center gap-2.5">
                    <i class="fa-solid fa-save"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const addBtn = document.getElementById("addArticleBtn");
            const tableBody = document.getElementById("articleTableBody");
            const emptyRow = document.getElementById("article-empty-row");
            const quantiteProductionInput = document.getElementById("quantiteProduitInput");
            const coutReviensInput = document.getElementById("coutReviensInput");

            const updateTableState = () => {
                const rowCount = tableBody.querySelectorAll('tr:not(#article-empty-row)').length;
                emptyRow.style.display = rowCount === 0 ? 'table-row' : 'none';
            };

            const calculerCoutReviens = () => {
                let totalCout = 0;

                // Loop through all hidden inputs of prix and quantite
                tableBody.querySelectorAll("tr").forEach(row => {
                    const prix = parseFloat(row.querySelector("input[name='prix[]']")?.value || 0);
                    const quantite = parseFloat(row.querySelector("input[name='quantites[]']")?.value || 0);
                    totalCout += prix * quantite;
                });

                const quantiteProduction = parseFloat(quantiteProductionInput.value) || 0;
                const coutUnitaire = quantiteProduction > 0 ? (totalCout / quantiteProduction) : 0;

                coutReviensInput.value = coutUnitaire.toFixed(2);
            };

            updateTableState();

            // addBtn.addEventListener("click", () => {
            //     const article = document.getElementById("articleInput").value.trim();
            //     const quantite = document.getElementById("quantiteInput").value.trim();
            //     const unite = document.getElementById("uniteInput").value.trim();
            //     const prix = document.getElementById("prixInput").value.trim();

            //     if (!article || !quantite) {
            //         alert("Veuillez remplir tous les champs avant d'ajouter un article.");
            //         return;
            //     }

            //     const row = document.createElement("tr");
            //     row.innerHTML = `
            //         <td class="px-4 py-2 text-gray-700 font-medium">
            //             ${article}
            //             <input type="hidden" name="articles[]" value="${article}">
            //         </td>
            //         <td class="px-4 py-2 text-gray-700">
            //             ${quantite}
            //             <input type="hidden" name="quantites[]" value="${quantite}">
            //         </td>
            //         <td class="px-4 py-2 text-gray-700">
            //             ${unite || "Aucune"}
            //             <input type="hidden" name="unites[]" value="${unite}">
            //         </td>
            //         <td class="px-4 py-2 text-gray-700">
            //             ${prix || 0}
            //             <input type="hidden" name="prix[]" value="${prix}">
            //         </td>
            //         <td class="px-4 py-2 text-center">
            //             <button type="button" onclick="removeArticleRow(this)" 
            //                 class="px-3 py-1.5 rounded-lg text-xs bg-red-100 text-red-800 hover:text-red-800 font-semibold transition">
            //                 <i class="fa-solid fa-trash"></i>
            //             </button>
            //         </td>
            //     `;
            //     tableBody.appendChild(row);

            //     updateTableState();
            //     calculerCoutReviens(); // recalc after adding

            //     // reset inputs
            //     document.getElementById("articleInput").value = '';
            //     document.getElementById("quantiteInput").value = '';
            //     document.getElementById("uniteInput").value = '';
            //     document.getElementById("prixInput").value = '';
            // });
            addBtn.addEventListener("click", () => {
                const articleInput = document.getElementById("articleInput");
                const articleName = articleInput.value.trim();
                const quantite = document.getElementById("quantiteInput").value.trim();
                const unite = document.getElementById("uniteInput").value.trim();
                const prix = document.getElementById("prixInput").value.trim();

                if (!articleName || !quantite) {
                    alert("Veuillez remplir tous les champs avant d'ajouter un article.");
                    return;
                }

                // get the data-id from datalist
                const option = Array.from(document.getElementById("articleList").options).find(opt => opt.value === articleName);
                const articleId = option ? option.dataset.id : '';

                const row = document.createElement("tr");
                row.innerHTML = `
                    <td class="px-4 py-2 text-gray-700 font-medium">
                        ${articleName}
                        <input type="hidden" name="articles[]" value="${articleId}">
                    </td>
                    <td class="px-4 py-2 text-gray-700">
                        ${quantite}
                        <input type="hidden" name="quantites[]" value="${quantite}">
                    </td>
                    <td class="px-4 py-2 text-gray-700">
                        ${unite || "Aucune"}
                        <input type="hidden" name="unites[]" value="${unite}">
                    </td>
                    <td class="px-4 py-2 text-gray-700">
                        ${prix || 0}
                        <input type="hidden" name="prix[]" value="${prix}">
                    </td>
                    <td class="px-4 py-2 text-center">
                        <button type="button" onclick="removeArticleRow(this)" 
                            class="px-3 py-1.5 rounded-lg text-xs bg-red-100 text-red-800 hover:text-red-800 font-semibold transition">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);

                updateTableState();
                calculerCoutReviens();

                // reset inputs
                articleInput.value = '';
                document.getElementById("quantiteInput").value = '';
                document.getElementById("uniteInput").value = '';
                document.getElementById("prixInput").value = '';
            });


            window.removeArticleRow = (btn) => {
                btn.closest("tr").remove();
                updateTableState();
                calculerCoutReviens(); // recalc after removing
            };

            // Recalculate when production quantity changes
            quantiteProductionInput.addEventListener("input", calculerCoutReviens);
        });
    </script>
    {{-- <script>
        document.addEventListener("DOMContentLoaded", () => {
            const addBtn = document.getElementById("addArticleBtn");
            const tableBody = document.getElementById("articleTableBody");
            const emptyRow = document.getElementById("article-empty-row");
            const quantiteProductionInput = document.getElementById("quantiteProduitInput");
            const coutReviensInput = document.getElementById("coutReviensInput");

            const updateTableState = () => {
                const rowCount = tableBody.querySelectorAll('tr:not(#article-empty-row)').length;
                emptyRow.style.display = rowCount === 0 ? 'table-row' : 'none';
            };

            const calculerCoutReviens = () => {
                let totalCout = 0;

                // Loop through all hidden inputs of prix and quantite
                tableBody.querySelectorAll("tr").forEach(row => {
                    const prix = parseFloat(row.querySelector("input[name='prix[]']")?.value || 0);
                    const quantite = parseFloat(row.querySelector("input[name='quantites[]']")?.value || 0);
                    totalCout += prix * quantite;
                });

                const quantiteProduction = parseFloat(quantiteProductionInput.value) || 0;
                const coutUnitaire = quantiteProduction > 0 ? (totalCout / quantiteProduction) : 0;

                coutReviensInput.value = coutUnitaire.toFixed(2);
            };

            updateTableState();
            addBtn.addEventListener("click", () => {
            const articleInput = document.getElementById("articleInput");
            const articleName = articleInput.value.trim();
            const quantite = document.getElementById("quantiteInput").value.trim();
            const unite = document.getElementById("uniteInput").value.trim();
            const prix = document.getElementById("prixInput").value.trim();

            if (!articleName || !quantite) {
                alert("Veuillez remplir tous les champs avant d'ajouter un article.");
                return;
            }

            // get the data-id from datalist
            const option = Array.from(document.getElementById("articleList").options)
                                .find(opt => opt.value === articleName);
            const articleId = option ? option.dataset.id : '';

            const row = document.createElement("tr");
            row.innerHTML = `
                <td class="px-4 py-2 text-gray-700 font-medium">
                    ${articleName}
                    <input type="hidden" name="articles[]" value="${articleId}">
                </td>
                <td class="px-4 py-2 text-gray-700">
                    ${quantite}
                    <input type="hidden" name="quantites[]" value="${quantite}">
                </td>
                <td class="px-4 py-2 text-gray-700">
                    ${unite || "Aucune"}
                    <input type="hidden" name="unites[]" value="${unite}">
                </td>
                <td class="px-4 py-2 text-gray-700">
                    ${prix || 0}
                    <input type="hidden" name="prix[]" value="${prix}">
                </td>
                <td class="px-4 py-2 text-center">
                    <button type="button" onclick="removeArticleRow(this)" 
                        class="px-3 py-1.5 rounded-lg text-xs bg-red-100 text-red-800 hover:text-red-800 font-semibold transition">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            `;
            tableBody.appendChild(row);

            updateTableState();
            calculerCoutReviens();

            // reset inputs
            articleInput.value = '';
            document.getElementById("quantiteInput").value = '';
            document.getElementById("uniteInput").value = '';
            document.getElementById("prixInput").value = '';
        });
    });
    </script> --}}


@endsection
