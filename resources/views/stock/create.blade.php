@extends('layout.master')

@section('title', 'Ajouter article')

@section('content')
<div class="w-full bg-white/80 backdrop-blur-xl rounded-2xl shadow-2xl p-8 max-w-4xl mx-auto border border-gray-100">
    <div class="flex items-center justify-between mb-10 bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 px-6 py-4 rounded-xl shadow-lg">
        <h1 class="text-2xl md:text-3xl font-bold text-white flex items-center gap-3">
            <i class="fa-solid fa-boxes-stacked"></i> Ajouter un article
        </h1>
        <a href="{{ route('stock.index') }}" 
            class="bg-white text-gray-800 font-semibold px-5 py-2.5 rounded-xl shadow hover:shadow-lg transition-all duration-200 flex items-center gap-2.5">
                <i class="fa-solid fa-arrow-left border-2 border-indigo-600 py-1 px-1.5 rounded-full text-indigo-600 text-md"></i>
                <span>Retour au stock</span>
            </a>
    </div>

    {{-- Errors --}}
    @if($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800 border border-red-200 shadow-md">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('stock.store') }}" method="POST" class="space-y-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Article --}}
            <div  class="md:col-span-2">
                <label for="article" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-box text-indigo-500 mr-1"></i> Article
                </label>
                <input type="text" id="article" name="article" value="{{ old('article') }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" 
                       placeholder="Nom de l'article" required>
            </div>

            {{-- Stock Actuel --}}
            <div>
                <label for="stock_actuel" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-boxes-stacked text-purple-500 mr-1"></i> Stock actuel
                </label>
                <input type="number" id="stockActuelInput" name="stockActuel" value="{{ old('stockActuel') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
                    placeholder="Stock disponible">
            </div>

             {{-- Atelier --}}
            <div>
                <label for="atelier" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-building text-indigo-500 mr-1"></i> Atelier
                </label>
                <select id="atelier" name="atelier" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" required>
                    <option value="" disabled>Nom du atelier</option>
                    <option value="soudor"   {{ old('atelier') == 'soudor' ? 'selected' : '' }}>Soudor</option>
                    <option value="marbre" {{ old('atelier') == 'marbre' ? 'selected' : '' }}>Marber</option>
                    <option value="ba 13" {{ old('atelier') == 'ba 13' ? 'selected' : '' }}>BA 13</option>
                    <option value="aluminium" selected {{ old('atelier') == 'aluminium' ? 'selected' : '' }}>Aluminium</option>
                    <option value="bois" selected {{ old('atelier') == 'bois' ? 'selected' : '' }}>Bois</option>
                    <option value="amv" {{ old('atelier') == 'amv' ? 'selected' : '' }}>AMV</option>
                </select>

            </div>

            {{-- Stock Initial --}}
            <div>
                <label for="stockInitial" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-warehouse text-indigo-500 mr-1"></i> Stock initial
                </label>
                <input type="number" id="stockInitial" name="stockInitial" value="{{ old('stockInitial') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
                    placeholder="Stock initial">
            </div>

            {{-- Minimum --}}
            <div>
                <label for="minimum" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-triangle-exclamation text-red-500 mr-1"></i> Minimum
                </label>
                <input type="number" id="minimum" name="minimum" value="{{ old('minimum') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-400 transition"
                    placeholder="Quantité minimum" min="0">
            </div>

            {{-- Unite --}}
            <div>
                <label for="unite" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-ruler-combined text-indigo-500 mr-1"></i> Unité
                </label>
                <input type="text" id="unite" name="unite" value="{{ old('unite','U') }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" 
                       placeholder="Unité de mesure (ex: kg, m, pcs)" required>
            </div>


            {{-- Entrée --}}
            <div>
                <label for="entree" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-circle-arrow-down text-green-500 mr-1"></i> Entrée
                </label>
                <input type="number" id="entreeInput" name="entree" value="{{ old('entree',0) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 transition"
                       placeholder="Quantité entrée" min="0">
            </div>

            {{-- Sortie --}}
            <div>
                <label for="sortie" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-circle-arrow-up text-red-500 mr-1"></i> Sortie
                </label>
                <input type="number" id="sortieInput" name="sortie" value="{{ old('sortie',0) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-400 transition"
                       placeholder="Quantité sortie" min="0">
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-4 mt-8">
            <a href="{{ route('stock.create')}}" 
               class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold px-6 py-2 rounded-xl shadow-sm transition flex items-center gap-2">
                <i class="fa-solid fa-rotate-right"></i> Réinitialiser
            </a>
            <button type="submit" 
                    class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold px-6 py-2 rounded-xl shadow-lg transition flex items-center gap-2.5">
                <i class="fa-solid fa-save"></i> Enregistrer
            </button>
        </div>
    </div>
    </form>
</div>

    <!-- Script for auto stock calculation -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const entreeInput = document.getElementById('entreeInput');
            const sortieInput = document.getElementById('sortieInput');
            const stockActuelInput = document.getElementById('stockActuelInput');
            const stockInitialInput = document.getElementById('stockInitial');

            function updateStockActuel() {
                const entree = parseFloat(entreeInput.value) || 0;
                const sortie = parseFloat(sortieInput.value) || 0;
                const stockActuel = entree - sortie;
                stockActuelInput.value = stockActuel >= 0 ? stockActuel : 0;

                // ✅ Stock initial = Stock actuel (auto-sync)
                stockInitialInput.value = stockActuelInput.value;
            }

            entreeInput.addEventListener('input', updateStockActuel);
            sortieInput.addEventListener('input', updateStockActuel);
            stockActuelInput.addEventListener('input', () => {
                stockInitialInput.value = stockActuelInput.value;
            });
            updateStockActuel();
        });
    </script>
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
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Êtes-vous sûr ?',
                        text: "Cette action est irréversible.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Oui, supprimer',
                        cancelButtonText: 'Annuler',
                        customClass: {
                            popup: 'p-4 text-sm',
                            title: 'text-lg font-semibold',
                            content: 'text-sm'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // ✅ only submit if confirmed
                        }
                    });
                });
            });
        });
    </script>
@endsection
