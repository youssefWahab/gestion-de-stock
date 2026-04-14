@props(['type' => 'info', 'message' => null])

@php
    $styles = [
        'success' => 'bg-green-50 text-green-700 border border-green-200',
        'warning' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
        'info'    => 'bg-blue-50 text-blue-700 border border-blue-200',
    ];

    $icons = [
        'success' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        'warning' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        'info'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    ];
@endphp

<div {{ $attributes->merge(['class' => "mb-4 p-4 rounded-lg flex items-center gap-3 shadow-sm {$styles[$type]}"]) }}>
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        {!! $icons[$type] !!}
    </svg>
    <p>{{ $message }}</p>
    <button onclick="this.parentElement.remove()" class="ml-auto font-bold hover:opacity-70">✕</button>
</div>