@extends('layout.master')

@section('title', 'Tableau de bord')
@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 mb-12">
        <x-dashboard-card 
            icon="fas fa-boxes-stacked" 
            title="Stocks" 
            :count="$stocksCount" 
            color="blue" />

        <x-dashboard-card 
        icon="fa-solid fa-circle-arrow-down" 
        title="Les entrées" 
        :count="$entreesCount" 
        color="green"
        padding="px-3 py-1.5"/>

        <x-dashboard-card 
            icon="fa-solid fa-circle-arrow-up" 
            title="les sorties" 
            :count="$sortiesCount" 
            color="red"
            padding="px-3 py-1.5"/>


        <x-dashboard-card 
            icon="fa-solid fa-hand-holding" 
            title="les emprunts" 
            :count="$empruntsCount" 
            color="orange"
            padding="p-0"/>
    </div>

    {{-- Charts Section --}}
    <div class="grid grid-cols-1 gap-8">
        <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
            <h3 class="text-lg font-bold text-gray-700 mb-4">
                <i class="fas fa-chart-line text-indigo-500 mr-2"></i> Top mouvements du stock
            </h3>
            <canvas id="stockMovementsChart"></canvas>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 ">
            <h3 class="text-lg font-bold text-gray-700 mb-4">
                <i class="fas fa-arrow-down text-red-500 mr-2"></i> Top sorties
            </h3>
            
            <div class="flex flex-col lg:flex-row gap-6">
                <ul class="flex-1 space-y-2">
                    @foreach($sortieLabels as $i => $label)
                        <li class="flex justify-between items-center bg-red-50 px-3 py-2 rounded-xl">
                            <span class="font-medium text-gray-700">{{ $label }}</span>
                            <span class="font-bold text-red-600">
                                {{ $sortieQuantites[$i] }} ({{ $sortiePercentages[$i] }}%)
                            </span>
                        </li>
                    @endforeach
                </ul>

                <div class="flex-1">
                    <canvas id="sortiesChart"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
            <h3 class="text-lg font-bold text-gray-700 mb-4">
                <i class="fa-solid fa-tools text-blue-500 mr-2"></i> catégories et leur total
            </h3>
            <ul class="space-y-2.5">
                @foreach($categorieCounts as $categorie)
                    <li class="flex justify-between items-center bg-blue-50 px-3 py-2 rounded-lg hover:shadow">
                        <span class="font-medium text-gray-700">{{ $categorie->categorie }}</span>
                        <span class="font-bold text-blue-600">{{ $categorie->total }}</span>
                    </li>
                @endforeach
            </ul>
        </div>


    </div>

   

    <div class="bg-white p-6 mt-10 rounded-2xl shadow-lg border border-gray-100">
        <h3 class="text-lg font-bold text-gray-700 mb-4">
            <i class="fas fa-history text-blue-500 mr-2"></i> Derniers mouvements de stock
        </h3>

        <div class="overflow-x-auto rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Article</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-600">Type</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-600">Quantité</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-600">Date</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-600">Note</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-center">
                    @foreach($recentStockMovements as $movement)
                        <tr>
                            <td class="px-4 py-2 text-left text-gray-700">{{ $movement->stock->article }}</td>
                            <td class="px-4 py-2 capitalize">{{ $movement->type }}</td>
                            <td class="px-4 py-2">{{ $movement->quantite }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($movement->date_movement)->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2">{{ Str::limit($movement->note, 40, '...') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>









<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx1 = document.getElementById('stockMovementsChart').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: @json($stockLabels),
            datasets: [{
                label: 'Entrées',
                data: @json($stockEntrees),
                backgroundColor: 'rgba(59,130,246,0.7)'
            },{
                label: 'Sorties',
                data: @json($stockSorties),
                backgroundColor: 'rgba(168,85,247,0.7)'
            }]
        }
    });
    const ctxSorties = document.getElementById('sortiesChart').getContext('2d');
    new Chart(ctxSorties, {
        type: 'doughnut',
        data: {
            labels: @json($sortieLabels),
            datasets: [{
                data: @json($sortieQuantites),
                backgroundColor: [
                    '#EF4444','#F87171','#B91C1C','#FCA5A5','#DC2626',
                    '#FECDD3','#991B1B','#FECACA','#B91C1C','#FCA5A5'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let value = context.raw;
                            let total = context.dataset.data.reduce((a,b)=>a+b,0);
                            let percentage = ((value/total)*100).toFixed(1);
                            return context.label + ': ' + value + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
