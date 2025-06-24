@props(['stat'])

<div class="text-center">
    <div class="text-3xl md:text-4xl font-bold mb-2"
        style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
        {{ $stat['number'] }}
    </div>
    <p class="text-gray-600">{{ $stat['label'] }}</p>
</div>
