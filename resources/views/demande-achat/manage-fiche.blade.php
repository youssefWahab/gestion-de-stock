@extends('layout.master')

@section('title', 'Changer de Fiche de Commande')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl p-10 border border-gray-200">
    
    {{-- Header --}}
    <div class="flex items-center gap-4 mb-10">
        <div class="flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-indigo-600 to-purple-600 shadow-lg">
            <i class="fa-solid fa-exchange-alt text-white text-2xl"></i>
        </div>
        <div>
            <div class="text-xs uppercase tracking-widest text-indigo-700 font-bold">Gestion des fiches</div>
            <div class="text-2xl font-extrabold text-gray-800">Changer une fiche de commande</div>
        </div>
    </div>

    {{-- formulaire de changer la fiche --}}
    <form action="{{ route('demande-achat.change',$demande->id) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1  gap-8 items-end">
            {{-- Ancienne fiche --}}
            <div>
                <label for="old_fiche" class="block text-sm font-semibold text-gray-600 mb-2">
                    Ancienne fiche
                </label>
                <input type="text" value="Fiche N° {{ $fiche->numFiche}} ({{ $fiche->nomDemandeur}} - {{ $fiche->atelier}})" id="old_fiche" name="old_fiche" placeholder="Ex: 101" readonly required class="w-full rounded-xl border border-gray-200 outline-none p-3 shadow-sm">
            </div>

            <div>
                <span class="text-gray-500 font-semibold">Changer avec</span>
            </div>

            {{-- Nouvelle Fiche --}}
            <div>
                <label for="new_fiche" class="block text-sm font-semibold text-gray-600 mb-2">
                    Nouvelle fiche
                </label>
                <input type="number" id="new_fiche" name="new_fiche" placeholder="Ex: 202" required list="fiches_suggestions"
                    class="w-full rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-300 p-3 shadow-sm">

                {{-- Suggestions --}}
                <datalist id="fiches_suggestions">
                    @foreach ($fiches as $fiche)
                    <option value="{{ $fiche->numFiche}}">
                        Fiche N° {{ $fiche->numFiche}} ({{ $fiche->nomDemandeur}} - {{ $fiche->atelier}})
                    </option>
                    @endforeach
                </datalist>

            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold shadow-md hover:from-indigo-700 hover:to-purple-700 transition flex items-center gap-2">
                <i class="fa-solid fa-check-circle"></i> Confirmer le changement
            </button>
        </div>
    </form>
</div>
@endsection