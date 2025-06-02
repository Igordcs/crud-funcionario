@props([
    'href' => '#',
    'icon' => 'fas fa-question-circle',
    'iconBg' => 'bg-gray-100',
    'iconColor' => 'text-gray-600',
    'title' => '',
    'description' => ''
])

<a href="{{ $href }}" class="transform transition hover:scale-105 focus:outline-none">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
        <div class="p-6 flex items-center h-full">
            <div class="{{ $iconBg }} p-4 rounded-full mr-4">
                <i class="{{ $icon }} {{ $iconColor }} text-2xl"></i>
            </div>
            <div class="flex-grow">
                <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
                <p class="text-gray-600">{{ $description }}</p>
            </div>
            <div class="text-gray-400 ml-4">
                <i class="fas fa-chevron-right"></i>
            </div>
        </div>
    </div>
</a>