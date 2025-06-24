@props(['icon'])

<a
    {{ $attributes->merge(['class' => 'flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-green-600 transition-colors duration-200']) }}>
    <i class="{{ $icon }} text-green-600 w-4"></i>
    <span>{{ $slot }}</span>
</a>
