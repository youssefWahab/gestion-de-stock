@extends('layout.master')

@section('title', 'Sorties de Stock')

@section('content')
    <div class="w-full bg-white/90 rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-7 bg-gradient-to-r from-purple-500 via-indigo-500 to-purple-600 p-5 rounded-xl shadow-lg">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-white flex items-start gap-3">
                    <i class="fa-solid fa-circle-arrow-up text-4xl"></i> <span>Les sorties de stock</span>
                </h1>
                <p class="mt-1.5 text-white ml-2">Gérer tous les mouvements de type « sortie » du stock.</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('sorties.create') }}" class="bg-white text-gray-800 font-semibold px-6 py-2.5 rounded-xl shadow hover:shadow-lg transition-all duration-200 flex items-center gap-3">
                    <i class="fa-solid fa-plus py-0.5  px-1 rounded-full text-indigo-600 text-md"></i>
                    <span>Ajouter</span>
                </a>

                <a href="{{ route('stock.index') }}" class=" text-white font-semibold px-7 py-1.5 border-2 border-white/90 rounded-xl transition-all duration-200 flex items-center gap-3">
                    <i class="fa-solid fa-boxes-stacked text-lg"></i>
                    <span>Stock</span>
                </a>
            </div>
        </div>

        {{-- Success Message --}}
        {{-- @if(session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif --}}

        <!-- Filter Section -->
        <form action="{{ route('sorties.index') }}" method="GET" class="mb-8 px-5 py-3.5 bg-white rounded-xl shadow-lg border border-gray-100">
            <div class="flex items-center justify-between mb-3.5">
                <h2 class="text-2xl font-semibold text-gray-700 flex items-center gap-2">
                    <i class="fa-solid fa-filter text-indigo-600"></i> 
                    Filtrer les sorties
                </h2>
                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold px-6 py-2 rounded-xl shadow hover:from-blue-700 hover:to-purple-700 transition flex items-center gap-2">
                        <i class="fa-solid fa-search"></i> Rechercher
                    </button>

                    <a href="{{ route('sorties.index') }}" class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-meddium px-6 py-2 rounded-xl shadow-sm transition  flex items-center gap-2">
                        <i class="fa-solid fa-rotate-right"></i> Réinitialiser
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Filter by Search --}}
                <div>
                    <label for="article" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fa-solid fa-box text-gray-400 mr-1"></i> Search
                    </label>
                    <input type="text" id="search" name="filterSearch" 
                        value="{{ request('filterSearch') }}"
                        class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300 transition" 
                        placeholder="Filtrer par search">
                </div>

                {{-- Filter by Date mouvement --}}
                <div>
                    <label for="date_movement" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fa-solid fa-calendar-days text-gray-400 mr-1"></i> Date mouvement
                    </label>
                    <input type="date" id="date_movement" name="filterDateMovement" 
                        value="{{ request('filterDateMovement') }}"
                        class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
                </div>

                {{-- Quantité min --}}
                <div>
                    <label for="quantite_min" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fa-solid fa-arrow-down-1-9 text-green-500 mr-1"></i> Quantité min
                    </label>
                    <input type="number" step="0.01" id="quantite_min" name="quantiteMin" 
                        value="{{ request('quantiteMin') }}"
                        class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300 transition" 
                        placeholder="Min">
                </div>

                {{-- Quantité max --}}
                <div>
                    <label for="quantite_max" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fa-solid fa-arrow-up-9-1 text-red-500 mr-1"></i> Quantité max
                    </label>
                    <input type="number" step="0.01" id="quantite_max" name="quantiteMax" 
                        value="{{ request('quantiteMax') }}"
                        class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300 transition" 
                        placeholder="Max">
                </div>
            </div>
        </form>

        {{-- Table Sorties --}}
        <div class="bg-white rounded-xl overflow-x-auto shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-50 via-purple-50 to-blue-100 shadow">
                    <tr>
                        <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">Article</th>
                        <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">Quantité</th>
                        <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">Date de sortie</th>
                        <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">Reference</th>
                        {{-- <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">Remarque</th> --}}
                        <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-center">
                    @forelse($sorties as $sortie)
                        <tr class="hover:bg-blue-50/40 transition">
                            <td class="px-4 py-3">{{ $sortie->stock->article }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center rounded px-3 py-1 text-sm font-semibold bg-red-100 text-red-800">
                                    {{ $sortie->quantite }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                {{ $sortie->date_movement->format('Y-m-d H:i') }}
                            </td>
                            <td class="px-4 py-3">
                                @if ($sortie->reference)
                                    {{ Str::limit($sortie->reference,30) }}
                                @else
                                    Aucune référence
                                @endif
                            </td>
                            {{-- <td class="px-4 py-3">
                                @if ($sortie->note)
                                    {{ Str::limit($sortie->note,28) }}
                                @else
                                    Aucune remarque
                                @endif
                            </td> --}}
                            <td class="px-4 py-3 flex flex-wrap gap-3 justify-center">
                                <a href="{{ route('sorties.show', $sortie->id) }}" class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-800 rounded-lg text-xs font-semibold hover:bg-blue-200 transition" title="Voir">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('sorties.edit', $sortie->id) }}" class="inline-flex items-center px-3 py-2  bg-green-100 text-green-800 rounded-lg text-xs font-semibold hover:text-green-900 hover:bg-green-200 transition" title="Modifier">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('sorties.destroy', $sortie->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete-btn inline-flex items-center px-3 py-2 bg-red-100 text-red-800 rounded-lg text-xs font-semibold hover:text-red-900 hover:bg-red-200 transition" title="Supprimer">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-400">Aucune sortie enregistrée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $sorties->links() }}
        </div>
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