<div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
</div>

@if ($paginator->hasPages())
    <nav class="flex justify-center">
        <div class="flex items-center space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 text-gray-400 cursor-not-allowed">
                    <i class="fas fa-chevron-left"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="px-3 py-2 text-gray-600 hover:text-primary transition-colors duration-200">
                    <i class="fas fa-chevron-left"></i>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-3 py-2 text-gray-400">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="px-4 py-2 bg-primary text-white rounded-lg font-semibold">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                                class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="px-3 py-2 text-gray-600 hover:text-primary transition-colors duration-200">
                    <i class="fas fa-chevron-right"></i>
                </a>
            @else
                <span class="px-3 py-2 text-gray-400 cursor-not-allowed">
                    <i class="fas fa-chevron-right"></i>
                </span>
            @endif
        </div>
    </nav>
@endif
