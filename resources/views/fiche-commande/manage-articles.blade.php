@extends('layout.master')

@section('title', 'Gestion des articles')

@section('content')
    <div class="bg-white/80 rounded-2xl shadow-2xl p-10 border border-blue-100 backdrop-blur-lg">

        <h1 class="text-4xl font-black text-center mb-10 text-gradient bg-clip-text text-transparent bg-gradient-to-r from-indigo-800 via-blue-600 to-purple-500">
            Gestion des Articles pour la Fiche N° {{ $fiche->numFiche }}
        </h1> 
        
        {{-- les messages --}}
        {{-- @if(session('warning'))
            <x-alert type="warning" :message="session('warning')" />
        @endif --}}

        
        {{-- @if(session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif --}}

        
        @if($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800 border border-red-200">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- formulaire d'ajouter une nouvelle Article --}}
        <form action="{{ route('fiche-article.store') }}" method="POST" class="flex gap-4 mb-6 items-end">
            @csrf
            <input type="hidden" name="fiche_numFiche" value="{{ $fiche->numFiche }}">
            <input type="text" name="articleDemande" placeholder="Article demandé" class="flex-1 px-4 py-2 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none" required>
            <input type="number" name="quantite" placeholder="Quantité" min="1" class="flex-1 px-4 py-2 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none" required>
            <input type="text" name="unite" placeholder="Unité" class="flex-1 px-4 py-2 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none">
            <button type="submit"
                    class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-purple-700 transition">
                <i class="fa-solid fa-plus"></i> Ajouter
            </button>
        </form>

        {{-- tavle des articles --}}
        <div class="overflow-x-auto rounded-xl shadow-md border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200 bg-white rounded-xl">
                <thead class="bg-gradient-to-r from-blue-50 via-purple-50 to-blue-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-blue-700 uppercase">Article demandé</th>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-blue-700 uppercase">Quantité</th>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-blue-700 uppercase">Unité</th>
                        <th class="px-6 py-4 text-center text-xs font-extrabold text-blue-700 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($fiche->articles as $article)
                        <tr>
                            <td class="px-6 py-2 text-gray-700">{{ $article->articleDemande }}</td>
                            <td class="px-6 py-2 text-gray-700">{{ $article->quantite }}</td>
                            <td class="px-6 py-2 text-gray-700">
                                @if ($article->unite)
                                    {{ $article->unite }}
                                @else
                                    <span class="text-gray-400 italic">Aucune</span>
                                @endif
                            </td>
                            <td class="px-6 py-2 text-center flex justify-center gap-2">
                                <a href="{{ route('fiche-article.edit', $article->id) }}"
                                class="px-3 py-1.5 rounded-lg text-xs bg-green-100 text-green-800 hover:bg-green-200 hover:text-green-900 font-semibold">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('fiche-article.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1.5 rounded-lg text-xs bg-red-100 text-red-800 hover:text-red-900 font-semibold">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-4 text-center text-gray-400 italic">Aucun article ajouté.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6 flex justify-end">
            <a href="{{ route('fiche-commande.edit',$fiche->numFiche) }}" class="inline-flex px-4 py-2 rounded-xl bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300 transition items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Retour
            </a>
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
        @if(session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Attention',
            text: "{{ session('warning') }}",
            showConfirmButton: true,
            confirmButtonText: 'OK',
            customClass: {
                popup: 'p-4 text-sm',
                title: 'text-lg font-semibold',
                content: 'text-sm'
            }
        });
    @endif
    </script>
@endsection