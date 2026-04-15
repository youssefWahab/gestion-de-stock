@extends('layout.master')

@section('title', 'Nouveau retour')

@section('content')
<div class="w-full bg-white/80 backdrop-blur-xl rounded-2xl shadow-2xl p-8 max-w-4xl mx-auto border border-gray-100">
    <!-- Header -->
    <div class="flex items-center justify-between mb-10 bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4 rounded-xl shadow-lg">
        <h1 class="text-2xl md:text-3xl font-bold text-white flex items-center gap-3">
            <i class="fa-solid fa-rotate-left"></i> Nouveau Retour
        </h1>
        <a href="{{ route('retours.index') }}" 
            class="bg-white text-gray-800 font-semibold px-5 py-2.5 rounded-xl shadow hover:shadow-lg transition-all duration-200 flex items-center gap-2.5">
            <i class="fa-solid fa-arrow-left border-2 border-blue-500 py-1 px-1.5 rounded-full text-blue-500 text-md"></i>
            <span>Retour aux retours</span>
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
    <form action="{{ route('retours.store') }}" method="POST" class="space-y-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Article --}}
            <div>
                <label for="sortie_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-box text-gray-400 mr-1"></i> Article
                </label>
                <input 
                    list="sortiesList" 
                    id="sortie_id" 
                    name="sortie_id" 
                    required 
                    autocomplete="off"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
                />

                <datalist id="sortiesList">
                    @foreach($sorties as $sortie)
                        <option value="{{ $sortie->id }}">{{ $sortie->stock->article }} (Sorties: {{ $sortie->quantite }} - Reference : {{ $sortie->reference }})</option>
                    @endforeach
                </datalist>

            </div>

            {{-- Type --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-tag text-gray-400 mr-1"></i> Type
                </label>
                <input type="text" value="Retour" readonly class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
            </div>

            {{-- Quantité --}}
            <div>
                <label for="quantite" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-layer-group text-gray-400 mr-1"></i> Quantité
                </label>
                <input type="number" id="quantite" name="quantite" value="{{ old('quantite') }}" placeholder="Ex: 20" min="1" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
            </div>

            <div>
                <label for="reference" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-receipt text-gray-400 mr-1"></i> Bon de livraison / Nom
                </label>
                <input type="text" id="reference" name="reference" value="{{ old('reference') }}" placeholder="Ex: BL-2023-001" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
            </div>

            {{-- Date --}}
            <div>
                <label for="date_movement" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-regular fa-calendar-days text-gray-400 mr-1"></i> Date de retour
                </label>
                <input type="datetime-local" id="date_movement" name="date_movement" value="{{ old('date_movement', $date) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
            </div>

            {{-- Note --}}
            <div class="md:col-span-2">
                <label for="note" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-file-lines text-gray-400 mr-1"></i> Remarque
                </label>
                <input type="text" id="note" name="note" value="{{ old('note') }}" placeholder="Entrer une remarque" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
            </div>
        </div>

        <div class="flex justify-end gap-4 mt-8">
            <a href="{{ route('retours.create')}}" 
               class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold px-6 py-2 rounded-xl shadow-sm transition flex items-center gap-2">
                <i class="fa-solid fa-rotate-right"></i> Réinitialiser
            </a>
            <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold px-6 py-2 rounded-xl shadow-lg flex items-center gap-2.5">
                <i class="fa-solid fa-save"></i> Enregistrer
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
