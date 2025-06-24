@props(['title', 'icon', 'active' => false])

<div class="relative group">
    <button
        class="nav-link {{ $active ? 'text-green-600' : 'text-green-800' }} hover:text-green-600 font-medium transition-colors duration-300 flex items-center space-x-2">
        <i class="{{ $icon }}"></i>
        <span>{{ $title }}</span>
        <i class="fas fa-chevron-down text-xs transform group-hover:rotate-180 transition-transform duration-300"></i>
    </button>
    <div
        class="absolute top-full left-0 w-56 bg-white shadow-xl rounded-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transform translate-y-2 group-hover:translate-y-0 transition-all duration-300">
        {{ $slot }}
    </div>
</div>
