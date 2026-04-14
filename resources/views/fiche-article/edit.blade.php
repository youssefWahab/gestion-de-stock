@extends('layout.master')

@section('title', 'Modifier Article')

@section('content')
    <div class="bg-white/80 rounded-2xl shadow-2xl p-10 border border-blue-100 backdrop-blur-lg max-w-2xl mx-auto">

        <h1 class="text-3xl font-bold text-center mb-8 text-gradient bg-clip-text text-transparent bg-gradient-to-r from-indigo-800 via-blue-600 to-purple-500">
            Modifier l'article {{$article->articleDemande}}
        </h1>

        {{-- Success Message --}}
        @if(session('success'))
            <x-alert type="success" :message="session('success')" />
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

        <form action="{{ route('fiche-article.update', $article->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="articleDemande" class="block text-sm font-semibold text-gray-600 mb-1">Article demandé</label>
                <input type="text" id="articleDemande" name="articleDemande" value="{{ old('articleDemande', $article->articleDemande) }}"
                    class="w-full border border-purple-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" required>
            </div>

            <div>
                <label for="quantite" class="block text-sm font-semibold text-gray-600 mb-1">Quantité</label>
                <input type="number" id="quantite" name="quantite" value="{{ old('quantite', $article->quantite) }}" min="1"
                    class="w-full border border-purple-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" required>
            </div>
            <div>
                <label for="unite" class="block text-sm font-semibold text-gray-600 mb-1">Quantité</label>
                <input type="text" id="unite" name="unite" value="{{ old('unite', $article->unite) }}" class="w-full border border-purple-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none">
            </div>

            <div class="flex justify-end gap-4 mt-6">
                <x-return-button >Retour</x-return-button>
                <button type="submit"
                        class="px-6 py-2 rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold shadow-lg hover:from-blue-700 hover:to-purple-700 transition">
                    <i class="fa-solid fa-pen"></i> Modifier
                </button>
            </div>
        </form>
    </div>
@endsection