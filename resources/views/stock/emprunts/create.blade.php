@extends('layout.master')

@section('title', 'Nouvel emprunt')

@section('content')
<div class="w-full bg-white/80 backdrop-blur-xl rounded-2xl shadow-2xl p-8 max-w-4xl mx-auto border border-gray-100">
    <!-- Header -->
    <div class="flex items-center justify-between mb-10 bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 px-6 py-4 rounded-xl shadow-lg">
        <h1 class="text-2xl md:text-3xl font-bold text-white flex items-center gap-3">
            <i class="fa-solid fa-hand-holding text-white"></i> Nouvel emprunt
        </h1>
        <a href="{{ route('emprunts.index') }}" 
           class="bg-white text-gray-800 font-semibold px-5 py-2.5 rounded-xl shadow hover:shadow-lg transition-all duration-200 flex items-center gap-2.5">
            <i class="fa-solid fa-arrow-left border-2 border-indigo-600 py-1 px-1.5 rounded-full text-indigo-600 text-md"></i>
            <span>Retour aux emprunts</span>
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

    <form action="{{ route('emprunts.store') }}" method="POST" class="space-y-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Article --}}
            <div>
                <label for="stock_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-box text-gray-400 mr-1"></i> Article
                </label>
                <input 
                    list="stockList" 
                    id="stock_id" 
                    name="stock_id" 
                    required 
                    autocomplete="off"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
                />
                <datalist id="stockList">
                    @foreach($stocks as $stock)
                        <option value="{{ $stock->id }}">{{ $stock->article }} (Stock actuel: {{ $stock->stockActuel }} - Atelier: {{ $stock->atelier }})</option>
                    @endforeach
                </datalist>
            </div>

            {{-- Type --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-tag text-gray-400 mr-1"></i> Type
                </label>
                <input type="text" value="Emprunt" readonly class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
            </div>

            {{-- Quantité --}}
            <div>
                <label for="quantite" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-layer-group text-gray-400 mr-1"></i> Quantité
                </label>
                <input type="number" id="quantite" name="quantite" value="{{ old('quantite') }}" placeholder="Ex: 5" min="1" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
            </div>

            {{-- Emprunteur --}}
            <div>
                <label for="reference" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-user text-gray-400 mr-1"></i> Emprunteur
                </label>
                <input list="emprunteursList" type="text" id="reference" name="reference" value="{{ old('reference') }}" placeholder="Nom ou matricule" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                <datalist id="emprunteursList">
                    <option value="5687">ILIENNEB ABDELWAKIL</option>
                    <option value="3889">NEJAH MOHAMED</option>
                    <option value="5330">YASSINE SAADINI</option>
                    <option value="5429">Amine Bouafardou</option>
                    <option value="4675">Assaka Mohamed</option>
                    {{-- Add others if needed --}}
                </datalist>
            </div>

            {{-- Date --}}
            <div>
                <label for="date_movement" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-regular fa-calendar-days text-gray-400 mr-1"></i> Date d’emprunt
                </label>
                <input type="datetime-local" id="date_movement" name="date_movement" value="{{ old('date_movement', $date) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
            </div>

            {{-- Remarque --}}
            <div class="md:col-span-2">
                <label for="note" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-file-lines text-gray-400 mr-1"></i> Remarque
                </label>
                <input type="text" id="note" name="note" value="{{ old('note') }}" placeholder="Entrer une remarque (facultatif)" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
            </div>
        </div>

        <div class="flex justify-end gap-4 mt-8">
            <a href="{{ route('emprunts.create') }}" class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold px-6 py-2 rounded-xl shadow-sm transition flex items-center gap-2">
                <i class="fa-solid fa-rotate-right"></i> Réinitialiser
            </a>
            <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold px-6 py-2 rounded-xl shadow-lg flex items-center gap-2.5">
                <i class="fa-solid fa-save"></i> Enregistrer
            </button>
        </div>
    </form>
</div>

{{-- SweetAlert --}}
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
@endsection
