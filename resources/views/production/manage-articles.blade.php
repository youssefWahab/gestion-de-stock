@extends('layout.master')

@section('title', 'Gestion des articles')

@section('content')
    <div class="bg-white/80 rounded-2xl shadow-2xl py-8 px-5 border border-blue-100 backdrop-blur-lg">

        <h1 class="text-4xl font-black text-center mb-10 text-gradient bg-clip-text text-transparent bg-gradient-to-r from-indigo-700 via-blue-600 to-purple-500">
            Gestion des Articles pour la demande  N° {{ $production->numBonCommande }}
        </h1>

        {{-- Success Message --}}
        @if(session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Add Article Form --}}
       <form action="{{ route('production-article.store') }}" method="POST" class="bg-white p-4 rounded-2xl shadow-md flex flex-col md:flex-row gap-3 mb-6 items-end">
            @csrf
            <input type="hidden" name=" numProduction" value="{{ $production->numProduction }}">
            <div class="flex-1 flex flex-col w-full md:w-full">
                <label for="articleDemande" class="mb-1 text-gray-600 font-medium">Article demandé</label>
                <input type="text" name="articleDemande" id="articleDemande" placeholder="Nom de l'article" class="w-full px-4 py-2 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none transition" required>
            </div>
            <div class="flex flex-col w-full md:w-24">
                <label for="quantite" class="mb-1 text-gray-600 font-medium">Quantité</label>
                <input type="number" name="quantite" id="quantite" placeholder="0" min="1"
                    class="w-full px-4 py-2 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none transition"
                    required>
            </div>
            <div class="flex flex-col w-full md:w-24">
                <label for="unite" class="mb-1 text-gray-600 font-medium">Unité</label>
                <input type="text" name="unite" id="unite" placeholder="Unité"
                    class="w-full px-4 py-2 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none transition">
            </div>
            <div class="flex flex-col w-full md:w-28">
                <label for="prix" class="mb-1 text-gray-600 font-medium">Prix</label>
                <input type="number" name="prix" id="prix" placeholder="0" min="1"
                    class="w-full px-4 py-2 border border-purple-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none transition" />
            </div>

            <button type="submit"
                    class="w-full md:w-auto px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-plus"></i> Ajouter
            </button>
        </form>




        {{-- Articles Table --}}
        <div class="overflow-x-auto rounded-xl shadow-md border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200 bg-white rounded-xl">
                <thead class="bg-gradient-to-r from-blue-50 via-purple-50 to-blue-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-extrabold text-blue-700 uppercase">Article demandé</th>
                        <th class="px-6 py-4 text-xs font-extrabold text-blue-700 uppercase">Quantité</th>
                        <th class="px-6 py-4 text-xs font-extrabold text-blue-700 uppercase">Unité</th>
                        <th class="px-6 py-4 text-xs font-extrabold text-blue-700 uppercase">Prix</th>
                        <th class="px-6 py-4 text-xs font-extrabold text-blue-700 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-center">
                    @forelse($production->articles as $article)
                        <tr>
                            <td class="px-4 py-2 text-gray-700">{{ $article->articleDemande }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $article->quantite }}</td>
                            <td class="px-4 py-2 text-gray-700">
                                @if ($article->unite)
                                    {{ $article->unite }}
                                @else
                                    <span class="text-gray-400 italic">Aucune</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-gray-700">
                                @if ($article->prix)
                                    {{ $article->prix}}
                                @else
                                    <span class="text-gray-400 italic">Aucune</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center flex justify-center gap-2">
                                <a href="{{ route('production-article.edit', $article->id) }}" class="px-3 py-1.5 rounded-lg text-xs bg-green-100 text-green-800 hover:text-green-900 font-semibold">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('production-article.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?');">
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
            <a href="{{ route('production.edit',$production->numProduction) }}" class="inline-flex px-4 py-2 rounded-xl bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300 transition items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Retour
            </a>
            {{-- <x-return-button >Retour</x-return-button> --}}
        </div>
    </div>
@endsection
