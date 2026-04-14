@props(['icon', 'title', 'count', 'color' => 'indigo', 'padding' => 'px-2.5 py-2'])

<div class="bg-white p-3.5 rounded-xl shadow-md border border-{{ $color }}-100 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
    <div class="flex flex-col">
        <div class="flex items-center justify-between">
            <h2 class="font-medium text-gray-500 tracking-wide">{{ $title }}</h2>
            <div class="bg-{{ $color }}-100 text-{{ $color }}-600 {{ $padding }} px-2.5 py-2 rounded-full ">
                <i class="{{ $icon }} text-2xl"></i>
            </div>
        </div>
        <p class="text-3xl font-bold text-{{ $color }}-800">{{ $count }}</p>
        <div class="w-full bg-{{ $color }}-100 h-1.5 rounded-full mt-1">
            <div class="bg-{{ $color }}-600 h-1.5 rounded-full w-3/4"></div> <!-- example filled portion -->
        </div>
    </div>
</div>
