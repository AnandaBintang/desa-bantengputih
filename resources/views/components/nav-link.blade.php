@props(['active' => false])

<a
    {{ $attributes->merge(['class' => 'nav-link text-green-800 hover:text-green-600 font-medium transition-colors duration-300 flex items-center space-x-2' . ($active ? ' text-green-500 font-bold' : '')]) }}>
    {{ $slot }}
</a>
