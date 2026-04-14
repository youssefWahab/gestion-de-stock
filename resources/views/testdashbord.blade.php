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
    $totalEntrees = array_sum(array_map(fn($s) => $s['type'] == 'Entrée' ? $s['quantite'] : 0, $stocks));
    $totalSorties = array_sum(array_map(fn($s) => $s['type'] == 'Sortie' ? $s['quantite'] : 0, $stocks));
@endphp

<div class="p-8 bg-gray-50 rounded-2xl shadow-lg border border-gray-100">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 pb-4 border-b border-gray-200">Tableau de bord - Stock</h1>
    
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

    {{-- Charts and Recent Movements --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Mouvements de stock</h2>
            <canvas id="stockChart"></canvas>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
            <h2 class="text-lg font-bold text-gray-800 p-6 pb-4">Derniers Mouvements</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100 text-gray-700 font-semibold">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">Article</th>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">Chantier</th>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">Quantité</th>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($stocks as $s)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $s['article'] }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $s['chantier'] }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $s['quantite'] }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold
                                        {{ $s['type'] == 'Entrée' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $s['type'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($s['date'])->format('d M, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('stockChart').getContext('2d');
        const stockChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Entrées', 'Total Sorties', 'Stock Restant'],
                datasets: [{
                    label: 'Quantité',
                    data: [{{ $totalEntrees }}, {{ $totalSorties }}, {{ $totalEntrees - $totalSorties }}],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.8)', // Entrées (Greenish)
                        'rgba(255, 99, 132, 0.8)', // Sorties (Reddish)
                        'rgba(153, 102, 255, 0.8)' // Stock Restant (Purplish)
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                }
            }
        });
    });
</script>
@endpush