<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Aksi Cepat
        </x-slot>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($actions as $action)
                @php
                    $colors = [
                        'success' => [
                            'bg' => 'rgb(34, 197, 94)',
                            'border' => 'rgb(34, 197, 94)',
                            'text' => 'rgb(34, 197, 94)',
                        ],
                        'info' => [
                            'bg' => 'rgb(59, 130, 246)',
                            'border' => 'rgb(59, 130, 246)',
                            'text' => 'rgb(59, 130, 246)',
                        ],
                        'warning' => [
                            'bg' => 'rgb(251, 191, 36)',
                            'border' => 'rgb(251, 191, 36)',
                            'text' => 'rgb(251, 191, 36)',
                        ],
                        'primary' => [
                            'bg' => 'rgb(251, 191, 36)',
                            'border' => 'rgb(251, 191, 36)',
                            'text' => 'rgb(251, 191, 36)',
                        ],
                        'danger' => [
                            'bg' => 'rgb(239, 68, 68)',
                            'border' => 'rgb(239, 68, 68)',
                            'text' => 'rgb(239, 68, 68)',
                        ],
                        'zinc' => [
                            'bg' => 'rgb(156, 163, 175)',
                            'border' => 'rgb(156, 163, 175)',
                            'text' => 'rgb(156, 163, 175)',
                        ],
                    ];
                    $color = $colors[$action['color']] ?? $colors['primary'];
                @endphp

                <a href="{{ $action['url'] }}"
                    class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-md transition-all duration-200 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-750 group"
                    style="--action-color: {{ $color['text'] }}; --action-border: {{ $color['border'] }};"
                    onmouseover="this.style.borderColor = '{{ $color['border'] }}'"
                    onmouseout="this.style.borderColor = ''">
                    <div class="flex-shrink-0">
                        @switch($action['icon'])
                            @case('heroicon-o-newspaper')
                                <x-heroicon-o-newspaper class="w-8 h-8" style="color: {{ $color['text'] }}" />
                            @break

                            @case('heroicon-o-document-plus')
                                <x-heroicon-o-document-plus class="w-8 h-8" style="color: {{ $color['text'] }}" />
                            @break

                            @case('heroicon-o-photo')
                                <x-heroicon-o-photo class="w-8 h-8" style="color: {{ $color['text'] }}" />
                            @break

                            @case('heroicon-o-shopping-bag')
                                <x-heroicon-o-shopping-bag class="w-8 h-8" style="color: {{ $color['text'] }}" />
                            @break

                            @default
                                <x-heroicon-o-newspaper class="w-8 h-8" style="color: {{ $color['text'] }}" />
                        @endswitch
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $action['label'] }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
