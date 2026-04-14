@extends('layout.master')

@section('title', 'Fiche de commande')
@section('content')
    <div class="w-full bg-white/90 rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-7 bg-gradient-to-r from-purple-500 via-indigo-500 to-purple-600 p-5 rounded-xl shadow-lg">
            <h1 class="text-2xl md:text-3xl font-bold text-white flex items-center gap-4">
                <i class="fa-solid fa-file-contract"></i> Fiches de commande
            </h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('fiche-commande.create') }}" class="bg-white text-gray-800 font-semibold px-5 py-2.5 rounded-xl shadow hover:shadow-lg transition-all duration-200 flex items-center gap-2.5">
                    <i class="fa-solid fa-plus border-2 border-indigo-600 py-0.5  px-1 rounded-full text-indigo-600 text-md"></i>
                    <span>Nouvelle fiche</span>
                </a>

                <a href="{{ route('fiche-article.index') }}" class=" text-white font-semibold px-4 py-1 border-2 border-white/90 rounded-lg transition-all duration-200 flex items-center gap-2.5">
                    <i class="far fa-file-lines text-xl"></i>
                    <span>Voir les articles</span>
                </a>
            </div>
        </div>
        {{-- errors --}}
        {{-- @if(session('error'))
            <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800 border border-red-200 flex items-center gap-3">
                {{ session('error') }}
                <button onclick="this.parentElement.remove()" class="ml-auto font-bold hover:opacity-70">✕</button>
            </div>
        @endif --}}

        {{-- Success --}}
        {{-- @if(session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif --}}

        
        {{-- Filter Section --}}
        <form action="{{ route('fiche-commande.index') }}" method="GET" class="mb-8 px-4 py-3 bg-white rounded-xl shadow-md border border-gray-100">
            <div class="flex items-center justify-between mb-3.5">
                <h2 class="text-2xl font-semibold text-gray-700 flex items-center gap-2">
                    <i class="fa-solid fa-filter text-indigo-600"></i> 
                    Filtrer les fiches
                </h2>
                <div class="flex justify-end gap-4">
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold px-6 py-2 rounded-xl shadow hover:from-blue-700 hover:to-purple-700 transition flex items-center gap-2">
                        <i class="fa-solid fa-search"></i> Rechercher
                    </button>

                    <a href="{{ route('fiche-commande.index') }}" class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-meddium px-6 py-2 rounded-xl shadow-sm transition  flex items-center gap-2">
                        <i class="fa-solid fa-rotate-right"></i> Réinitialiser
                    </a>
                    {{-- <a href="{{ route('fiche-commande.index') }}" 
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-6 py-2 rounded-xl shadow transition">
                        Réinitialiser
                    </a> --}}
                </div>

            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="filterNumFiche" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fa-solid fa-hashtag text-gray-400 mr-1"></i> N° Fiche
                    </label>
                    <input type="text" id="filterNumFiche" name="filterNumFiche" value="{{ request('filterNumFiche') }}" placeholder="Filtrer par numéro" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                </div>
                <div>
                    <label for="filterNom" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fa-solid fa-user-tag text-gray-400 mr-1"></i> Nom demandeur
                    </label>
                    <input type="text" id="filterNom" name="filterNom" value="{{ request('filterNom') }}" placeholder="Filtrer par nom" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                </div>
                <div>
                    <label for="filterChantier" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fa-solid fa-building text-gray-400 mr-1"></i> Chantier
                    </label>
                    <input type="text" id="filterChantier" name="filterChantier" value="{{ request('filterChantier') }}" placeholder="Filtrer par chantier" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                </div>
                <div>
                    <label for="filterAtelier" class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fa-solid fa-calendar-days text-gray-400 mr-1"></i> Atelier
                    </label>
                    <input list="atelierList" id="filterAtelier" name="filterAtelier" value="{{ request('filterAtelier') }}" placeholder="Filtrer par atelier" autocomplete="off" class="w-full border-gray-300 rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                    <datalist id="atelierList">
                        @foreach($fiches->pluck('atelier')->unique() as $atelier)
                            <option value="{{ $atelier }}">{{ $atelier }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
        </form>

        {{-- Table des fiches --}}
        <div class="bg-white rounded-xl overflow-x-auto shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-50 via-purple-50 to-blue-100 shadow">
                    <tr>
                        <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest rounded-tl">
                            <i class="fa-solid fa-hashtag mr-1 text-blue-400"></i> N° Fiche
                        </th>
                        <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                            <i class="fa-solid fa-user mr-1 text-blue-400"></i> Nom
                        </th>
                        <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                            <i class="fa-solid fa-building mr-1 text-blue-400"></i> Chantier
                        </th>
                        <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                            <i class="fa-solid fa-calendar-days mr-1 text-blue-400"></i> Atelier
                        </th>
                        <th class="px-4 py-4 text-xs font-extrabold text-blue-700 uppercase tracking-widest rounded-tr">
                            <i class="fa-solid fa-gears mr-1 text-blue-400"></i> Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-center">
                    @forelse($fiches as $fiche)
                        <tr class="hover:bg-blue-50/30 transition">
                            <td class="px-4 py-2 font-mono font-bold text-blue-700 ">{{ $fiche->numFiche }}</td>
                            <td class="px-4 py-2">{{ $fiche->nomDemandeur }}</td>
                            <td class="px-4 py-2">{{ $fiche->chantier }}</td>
                            <td class="px-4 py-2">{{ $fiche->atelier }}</td>
                            <td class="px-4 py-2 min-w-52 flex flex-wrap gap-2 justify-center">
                                <a href="{{route('fiche-commande.show',$fiche->numFiche)}}" class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-lg text-xs font-semibold hover:bg-blue-200 transition" title="Voir">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{route('fiche-commande.edit',$fiche->numFiche)}}" class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-800 rounded-lg text-xs font-semibold hover:bg-indigo-200 transition" title="Modifier">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="{{ route('fiche-commande.generate', $fiche->numFiche) }}" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-lg text-xs font-semibold hover:bg-green-200 transition" title="Installer">
                                    <i class="fa-solid fa-download"></i>
                                </a>
                                {{-- <form action="{{ route('fiche-commande.destroy',$fiche->numFiche)}}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 rounded-lg text-xs font-semibold hover:bg-red-200 transition" title="Supprimer">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form> --}}
                                <form action="{{ route('fiche-commande.destroy',$fiche->numFiche)}}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"  {{-- ⬅️ prevent auto-submit --}}
                                            class="delete-btn inline-flex items-center px-3 py-1 bg-red-100 text-red-800 rounded-lg text-xs font-semibold hover:bg-red-200 transition" 
                                            title="Supprimer">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-400">Aucune fiche de commande trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $fiches->links() }}
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
