@extends('layout.master')
@section('title', 'Tableau de bord - Stock')
@section('content')

@php
// Sample data simulating database
$stocks = [
    ['article' => 'Ciment', 'chantier' => 'Chantier A', 'quantite' => 50, 'type' => 'Entrée', 'date' => '2025-09-01'],
    ['article' => 'Sable', 'chantier' => 'Chantier B', 'quantite' => 30, 'type' => 'Sortie', 'date' => '2025-09-02'],
    ['article' => 'Briques', 'chantier' => 'Chantier A', 'quantite' => 100, 'type' => 'Entrée', 'date' => '2025-09-03'],
    ['article' => 'Ciment', 'chantier' => 'Chantier B', 'quantite' => 20, 'type' => 'Sortie', 'date' => '2025-09-04'],
];

// Calculations
$totalArticles = count(array_unique(array_column($stocks, 'article')));
$totalEntrees = array_sum(array_map(fn($s)=> $s['type']=='Entrée'? $s['quantite']:0, $stocks));
$totalSorties = array_sum(array_map(fn($s)=> $s['type']=='Sortie'? $s['quantite']:0, $stocks));

// Data for charts
$articles = array_unique(array_column($stocks, 'article'));
$quantitesEntree = [];
$quantitesSortie = [];
foreach($articles as $art) {
    $quantitesEntree[] = array_sum(array_map(fn($s) => $s['article']==$art && $s['type']=='Entrée'? $s['quantite']:0, $stocks));
    $quantitesSortie[] = array_sum(array_map(fn($s) => $s['article']==$art && $s['type']=='Sortie'? $s['quantite']:0, $stocks));
}
@endphp

{{-- Dashboard Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
        {{-- Total Articles --}}
        <div class="bg-white rounded-xl shadow-md p-6 flex items-center gap-4 border border-gray-200">
            <div class="flex items-center justify-center w-12 h-12 bg-blue-100 text-blue-600 rounded-full">
                <i class="fa-solid fa-box-open text-xl"></i>
            </div>
            <div>
                <div class="text-sm font-semibold uppercase text-gray-500">Articles Uniques</div>
                <div class="text-2xl font-bold text-gray-800">{{ $totalArticles }}</div>
            </div>
        </div>

        {{-- Total Entrées --}}
        <div class="bg-white rounded-xl shadow-md p-6 flex items-center gap-4 border border-gray-200">
            <div class="flex items-center justify-center w-12 h-12 bg-green-100 text-green-600 rounded-full">
                <i class="fa-solid fa-arrow-down text-xl"></i>
            </div>
            <div>
                <div class="text-sm font-semibold uppercase text-gray-500">Total Entrées</div>
                <div class="text-2xl font-bold text-gray-800">{{ $totalEntrees }}</div>
            </div>
        </div>

        {{-- Total Sorties --}}
        <div class="bg-white rounded-xl shadow-md p-6 flex items-center gap-4 border border-gray-200">
            <div class="flex items-center justify-center w-12 h-12 bg-red-100 text-red-600 rounded-full">
                <i class="fa-solid fa-arrow-up text-xl"></i>
            </div>
            <div>
                <div class="text-sm font-semibold uppercase text-gray-500">Total Sorties</div>
                <div class="text-2xl font-bold text-gray-800">{{ $totalSorties }}</div>
            </div>
        </div>

        {{-- Stock Restant --}}
        <div class="bg-white rounded-xl shadow-md p-6 flex items-center gap-4 border border-gray-200">
            <div class="flex items-center justify-center w-12 h-12 bg-purple-100 text-purple-600 rounded-full">
                <i class="fa-solid fa-chart-line text-xl"></i>
            </div>
            <div>
                <div class="text-sm font-semibold uppercase text-gray-500">Stock Restant</div>
                <div class="text-2xl font-bold text-gray-800">{{ $totalEntrees - $totalSorties }}</div>
            </div>
        </div>
    </div>

{{-- Charts Section --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
    {{-- Entrée vs Sortie --}}
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Entrée vs Sortie</h2>
        <canvas id="stockChart" class="w-full h-64"></canvas>
    </div>
    {{-- Quantité par Article --}}
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Quantité par Article</h2>
        <canvas id="articleChart" class="w-full h-64"></canvas>
    </div>
</div>

{{-- Recent Movements Table --}}
<div class="bg-white rounded-2xl shadow-lg overflow-x-auto p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Mouvements récents</h2>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100 text-gray-700 font-semibold">
            <tr>
                <th class="px-4 py-3 text-left">Article</th>
                <th class="px-4 py-3 text-left">Chantier</th>
                <th class="px-4 py-3 text-left">Quantité</th>
                <th class="px-4 py-3 text-left">Type</th>
                <th class="px-4 py-3 text-left">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($stocks as $s)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-2">{{ $s['article'] }}</td>
                    <td class="px-4 py-2">{{ $s['chantier'] }}</td>
                    <td class="px-4 py-2">{{ $s['quantite'] }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $s['type']=='Entrée' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $s['type'] }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ $s['date'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const stockCtx = document.getElementById('stockChart').getContext('2d');
    new Chart(stockCtx, {
        type: 'bar',
        data: {
            labels: ['Entrée', 'Sortie'],
            datasets: [{
                label: 'Quantité',
                data: [{{ $totalEntrees }}, {{ $totalSorties }}],
                backgroundColor: ['#10B981', '#EF4444'],
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 20 } }
            }
        }
    });

    const articleCtx = document.getElementById('articleChart').getContext('2d');
    new Chart(articleCtx, {
        type: 'bar',
        data: {
            labels: @json($articles),
            datasets: [
                {
                    label: 'Entrée',
                    data: @json($quantitesEntree),
                    backgroundColor: '#10B981',
                    borderRadius: 6
                },
                {
                    label: 'Sortie',
                    data: @json($quantitesSortie),
                    backgroundColor: '#EF4444',
                    borderRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { tooltip: { mode: 'index', intersect: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>

@endsection
