@props(['data'])

<div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
    <div class="bg-gradient-to-br text-white p-8 rounded-xl"
        style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
        <div class="text-center mb-6">
            <i class="fas fa-eye text-4xl mb-4"></i>
            <h3 class="text-2xl font-bold">Visi Kepala Desa</h3>
            <p class="text-sm opacity-90 mt-2">Periode 2022 - 2027</p>
        </div>
        <p class="text-lg leading-relaxed text-center font-semibold">
            "{{ $data['vision'] }}"
        </p>

        <div class="mt-6 bg-white bg-opacity-10 p-4 rounded-lg">
            <h4 class="font-semibold mb-3 text-center">Motto Pembangunan</h4>
            <div class="text-center">
                <span class="text-2xl font-bold">MANDES</span>
                <p class="text-sm opacity-90 mt-1">(Mandiri dan Sejahtera)</p>
                <p class="text-xs opacity-80 mt-2">Dalam Bahasa Jawa: Mantap</p>
            </div>
        </div>
    </div>

    <div class="bg-white border-2 p-8 rounded-xl" style="border-color: #4CAF50;">
        <div class="text-center mb-6">
            <i class="fas fa-lightbulb text-4xl mb-4" style="color: #4CAF50;"></i>
            <h3 class="text-2xl font-bold" style="color: #2c5530;">Makna Visi</h3>
        </div>

        <div class="space-y-4">
            <div class="border-l-4 pl-4" style="border-color: #4CAF50;">
                <h5 class="font-semibold mb-2" style="color: #2c5530;">Desa Mandiri</h5>
                <p class="text-sm text-gray-600">{{ $data['vision_meaning']['mandiri'] }}</p>
            </div>

            <div class="border-l-4 pl-4" style="border-color: #45a049;">
                <h5 class="font-semibold mb-2" style="color: #2c5530;">Yang Sejahtera</h5>
                <p class="text-sm text-gray-600">{{ $data['vision_meaning']['sejahtera'] }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <h5 class="font-semibold mb-2" style="color: #2c5530;">Status IDM Saat Ini</h5>
                <p class="text-sm text-gray-600">
                    <span class="font-semibold" style="color: #4CAF50;">{{ $data['current_status']['status'] }}</span>
                    (IDM = {{ $data['current_status']['idm'] }}) <br>Target:
                    <span class="font-semibold" style="color: #45a049;">{{ $data['current_status']['target'] }}</span>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Misi Section -->
<div class="mt-12">
    <div class="text-center mb-8">
        <i class="fas fa-target text-4xl mb-4" style="color: #4CAF50;"></i>
        <h3 class="text-3xl font-bold" style="color: #2c5530;">Misi Kepala Desa</h3>
        <p class="text-gray-600 mt-2">8 Misi Strategis untuk Mewujudkan Visi</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach ($data['missions'] as $index => $mission)
            <div
                class="bg-white border border-gray-200 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-start space-x-4">
                    <div class="text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm"
                        style="background-color: #4CAF50;">
                        {{ $index + 1 }}
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2" style="color: #2c5530;">
                            {{ explode(' ', $mission, 2)[0] }} {{ explode(' ', $mission, 2)[1] ?? '' }}
                        </h4>
                        <p class="text-sm text-gray-600">{{ $mission }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Indikator Ketercapaian Visi -->
<div class="mt-12 bg-gray-50 p-8 rounded-xl">
    <h4 class="text-2xl font-bold text-center mb-6" style="color: #2c5530;">
        <i class="fas fa-chart-line mr-3" style="color: #4CAF50;"></i>Indikator Ketercapaian Visi
    </h4>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($data['indicators'] as $indicator)
            <div class="bg-white p-4 rounded-lg shadow-sm">
                <i class="fas fa-check-circle mb-2" style="color: #4CAF50;"></i>
                <p class="text-sm text-gray-700">{{ $indicator }}</p>
            </div>
        @endforeach
    </div>
</div>
