@extends('layout.master')

@section('title', 'Demandes d\'achat')

@section('content')
    <div class="w-full bg-white/90 rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-7 bg-gradient-to-r from-purple-500 via-indigo-500 to-purple-600 p-5 rounded-xl shadow-lg">
            <h1 class="text-2xl md:text-3xl font-bold text-white flex items-center gap-4">
                <i class="fa-solid fa-file-invoice-dollar"></i> Demandes d'achat
            </h1>

            <div class="flex items-center gap-3">
                <a href="{{ route('demande-achat.create') }}" class="bg-white text-gray-800 font-semibold px-4 py-2 rounded-lg shadow hover:shadow-lg transition-all duration-200 flex items-center gap-2.5">
                    {{-- <i class="fa-solid fa-plus text-indigo-600 text-xl"></i> --}}
                    <i class="fa-solid fa-plus border-2 border-indigo-600 py-0.5  px-1 rounded-full text-indigo-600 text-md"></i>
                    <span>Nouvelle demande</span>
                </a>

                <a href="{{ route('demande-achat.rapport') }}" class="bg-gradient-to-r from-blue-700 to-purple-700  hover:from-blue-800 text-white font-semibold px-5 py-1.5 rounded-xl shadow hover:shadow-lg transition-all duration-200 flex items-center gap-2">
                    <i class="fa-solid fa-clock-rotate-left text-xl"></i>
                    <span>Historique</span>
                </a>
                <a href="{{ route('article-achat.index') }}" class=" text-white font-semibold px-4 py-1 border-2 border-white/90 rounded-lg transition-all duration-200 flex items-center gap-2.5">
                    <i class="far fa-file-lines text-xl"></i>
                    <span>Voir les articles</span>
                </a>
            </div>
        </div>


        {{-- Success Message --}}
        @if(session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        {{-- Errors --}}
        @if(session('error'))
            <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800 border border-red-200 flex items-center gap-3">
                {{ session('error') }}
                <button onclick="this.parentElement.remove()" class="ml-auto font-bold hover:opacity-70">✕</button>
            </div>
        @endif

        <form action="{{ route('demande-achat.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 items-end gap-4 mb-9 px-2.5 py-4 bg-white rounded-xl shadow border border-gray-100">
            <div>
                <label for="filterNumFiche" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-hashtag text-gray-400 mr-1"></i> N° Fiche
                </label>
                <input type="text" id="filterNumFiche" name="filterNumFiche" value="{{ request('filterNumFiche') }}" class="w-full rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" placeholder="Filtrer par numéro de fiche">
            </div>
            <div>
                <label for="filterBonCommande" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-file-invoice text-gray-400 mr-1"></i> Bon de commande
                </label>
                <input type="text" id="filterBonCommande" name="filterBonCommande" value="{{ request('filterBonCommande') }}" class="w-full rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" placeholder="Filtrer par bon de commande">
            </div>
            <div>
                <label for="filterAtelier" class="block text-sm font-semibold text-gray-700 mb-1">
                    <i class="fa-solid fa-box text-gray-400 mr-1"></i> Atelier
                </label>
                <input list="atelierList" type="text" id="filterAtelier" name="filterAtelier" value="{{ request('filterAtelier') }}" class="w-full rounded-lg px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition" placeholder="Filtrer par atelier" autocomplete="off">
                <datalist id="atelierList">
                    @foreach($ateliers as $atelier)
                        <option value="{{ $atelier->atelier }}"></option>
                    @endforeach
                </datalist>
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold px-6 py-2 rounded-xl shadow hover:from-blue-700 hover:to-purple-700 transition flex items-center gap-2">
                    <i class="fa-solid fa-search"></i> Rechercher
                </button>

                <a href="{{ route('demande-achat.index') }}" class="bg-white hover:bg-gray-100 text-gray-700 font-semibold border border-gray-300 px-3 py-1 rounded-lg shadow-sm transition flex items-center gap-2">
                    <i class="fa-solid fa-rotate-right text-xl"></i> <span class="hidden 2xl:inline">Reinitialiser</span>
                </a>
            </div>
        </form>


        {{-- table des demandes --}}
        <div class="bg-white rounded-xl overflow-x-auto shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-50 via-purple-50 to-blue-100 shadow">
                    <tr>
                        <th class="px-4 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest rounded-tl">
                            <i class="fa-solid fa-hashtag mr-1 text-blue-400"></i> N° Fiche
                        </th>
                        <th class="px-4 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                            Bon de commande
                        </th>
                        <th class="px-4 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                            Atelier
                        </th>
                        <th class="px-4 py-4 text-left text-xs font-extrabold text-blue-700 uppercase tracking-widest">
                            Nature de travaux
                        </th>
                        <th class="px-4 py-4 text-center text-xs font-extrabold text-blue-700 uppercase tracking-widest rounded-tr">
                            <i class="fa-solid fa-gears mr-1 text-blue-400"></i> Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($demandes as $demande)
                        <tr class="hover:bg-blue-50/30 transition">
                            <td class="px-4 py-2 font-mono font-bold text-blue-700 text-gray-500 flex items-center"><i class="fa-solid fa-hashtag text-gray-400 text-sm"></i><span class="text-sm text-gray-400">-</span>{{ $demande->numFiche }}</td>
                            <td class="px-4 py-2">{{ $demande->numBonCommande }}</td>
                            <td class="px-4 py-2">{{ $demande->atelier }}</td>
                            <td class="px-4 py-2">{{ Str::limit($demande->natureTravaux, 30, '...') }}</td>
                            <td class="px-4 py-2 flex flex-wrap gap-2 justify-center">
                                <a href="{{ route('demande-achat.show', $demande->id) }}" class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-lg text-xs font-semibold hover:bg-blue-200 transition" title="Voir">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{route('demande-achat.edit',$demande->id)}}" class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-800 rounded-lg text-xs font-semibold hover:bg-indigo-200 transition" title="Modifier">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="{{ route('demande-achat.generate', $demande->id) }}" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-lg text-xs font-semibold hover:bg-green-200 transition" title="Installer">
                                    <i class="fa-solid fa-download"></i>
                                </a>
                                <form action="{{ route('demande-achat.destroy',$demande->id)}}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 rounded-lg text-xs font-semibold hover:bg-red-200 transition" title="Supprimer" onclick="return confirm('Supprimer cette demande ?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-400">Aucune demande trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $demandes->links() }}
        </div>
    </div>
@endsection