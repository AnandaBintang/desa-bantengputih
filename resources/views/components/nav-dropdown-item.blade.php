@props(['icon', 'active' => false])

<a
    {{ $attributes->merge(['class' => 'flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-green-600 transition-colors duration-200' . ($active ? ' bg-green-50 text-green-700 border-r-2 border-green-500' : '')]) }}>
    <i class="{{ $icon }} {{ $active ? 'text-green-700' : 'text-green-600' }} w-4"></i>
    <span>{{ $slot }}</span>
</a>
