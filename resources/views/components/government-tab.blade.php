@props(['data'])

<h3 class="text-3xl font-bold text-center mb-12" style="color: #2c5530;">
    Struktur Organisasi dan Tata Kerja Pemerintah Desa Bantengputih
</h3>

<!-- Struktur Bergaris -->
<div class="bg-white rounded-xl shadow-lg p-8 overflow-x-auto">
    <!-- Kepala Desa -->
    <div class="flex justify-center mb-8">
        <div class="text-center">
            <div class="bg-gradient-to-r p-6 rounded-xl shadow-lg inline-block min-w-[250px]"
                style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
                <img src="{{ $data['structure']['kepala_desa']['photo'] }}" alt="Kepala Desa"
                    class="w-16 h-16 rounded-full mx-auto mb-3 border-3 border-white">
                <h4 class="text-lg font-bold text-white">KEPALA DESA</h4>
                <p class="text-white font-semibold">{{ $data['structure']['kepala_desa']['name'] }}</p>
                <p class="text-white opacity-90 text-sm">{{ $data['structure']['kepala_desa']['period'] }}</p>
            </div>
        </div>
    </div>

    <!-- Garis Vertikal ke Sekretaris -->
    <div class="flex justify-center mb-4">
        <div class="w-px h-12 bg-gray-400"></div>
    </div>

    <!-- Sekretaris Desa -->
    <div class="flex justify-center mb-8">
        <div class="text-center">
            <div class="bg-white border-2 p-6 rounded-xl shadow-lg inline-block min-w-[250px]"
                style="border-color: #4CAF50;">
                <img src="{{ $data['structure']['sekretaris_desa']['photo'] }}" alt="Sekretaris Desa"
                    class="w-16 h-16 rounded-full mx-auto mb-3">
                <h4 class="text-lg font-bold" style="color: #2c5530;">
                    {{ $data['structure']['sekretaris_desa']['position'] }}</h4>
                <p class="font-semibold" style="color: #2c5530;">{{ $data['structure']['sekretaris_desa']['name'] }}</p>
            </div>
        </div>
    </div>

    <!-- Garis Vertikal -->
    <div class="flex justify-center mb-4">
        <div class="w-px h-12 bg-gray-400"></div>
    </div>

    <!-- Garis Horizontal untuk Kepala Seksi dan Kepala Urusan -->
    <div class="flex justify-center mb-8">
        <div class="flex items-center">
            <div class="w-32 h-px bg-gray-400"></div>
            <div class="w-4 h-4 bg-gray-400 rounded-full mx-2"></div>
            <div class="w-32 h-px bg-gray-400"></div>
        </div>
    </div>

    <!-- Kepala Seksi dan Kepala Urusan -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-16 mb-12">
        <!-- Kepala Seksi -->
        <div class="text-center">
            <h4 class="text-xl font-semibold mb-8" style="color: #2c5530;">KEPALA SEKSI</h4>
            <div class="flex justify-center mb-4">
                <div class="w-px h-8 bg-gray-400"></div>
            </div>
            <div class="flex justify-center mb-8">
                <div class="flex items-center">
                    <div class="w-16 h-px bg-gray-400"></div>
                    <div class="w-3 h-3 bg-gray-400 rounded-full mx-2"></div>
                    <div class="w-16 h-px bg-gray-400"></div>
                    <div class="w-3 h-3 bg-gray-400 rounded-full mx-2"></div>
                    <div class="w-16 h-px bg-gray-400"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                @foreach ($data['structure']['kepala_seksi'] as $kasi)
                    <div class="text-center">
                        <div class="flex justify-center mb-2">
                            <div class="w-px h-8 bg-gray-400"></div>
                        </div>
                        <div
                            class="bg-white border border-gray-200 p-4 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                            <img src="{{ $kasi['photo'] }}" alt="{{ $kasi['position'] }}"
                                class="w-12 h-12 rounded-full mx-auto mb-3">
                            <h5 class="text-sm font-bold mb-2" style="color: #2c5530;">{{ $kasi['position'] }}</h5>
                            @if ($kasi['name'])
                                <p class="text-xs font-semibold" style="color: #2c5530;">{{ $kasi['name'] }}</p>
                            @endif
                            <p class="text-xs text-gray-600">{{ $kasi['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Kepala Urusan -->
        <div class="text-center">
            <h4 class="text-xl font-semibold mb-8" style="color: #2c5530;">KEPALA URUSAN</h4>
            <div class="flex justify-center mb-4">
                <div class="w-px h-8 bg-gray-400"></div>
            </div>
            <div class="flex justify-center mb-8">
                <div class="flex items-center">
                    <div class="w-16 h-px bg-gray-400"></div>
                    <div class="w-3 h-3 bg-gray-400 rounded-full mx-2"></div>
                    <div class="w-16 h-px bg-gray-400"></div>
                    <div class="w-3 h-3 bg-gray-400 rounded-full mx-2"></div>
                    <div class="w-16 h-px bg-gray-400"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                @foreach ($data['structure']['kepala_urusan'] as $kaur)
                    <div class="text-center">
                        <div class="flex justify-center mb-2">
                            <div class="w-px h-8 bg-gray-400"></div>
                        </div>
                        <div
                            class="bg-white border border-gray-200 p-4 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                            <img src="{{ $kaur['photo'] }}" alt="{{ $kaur['position'] }}"
                                class="w-12 h-12 rounded-full mx-auto mb-3">
                            <h5 class="text-sm font-bold mb-1" style="color: #2c5530;">{{ $kaur['position'] }}</h5>
                            @if ($kaur['name'])
                                <p class="text-xs font-semibold" style="color: #2c5530;">{{ $kaur['name'] }}</p>
                            @endif
                            <p class="text-xs text-gray-600">{{ $kaur['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Garis Vertikal ke Kepala Dusun -->
    <div class="flex justify-center mb-4">
        <div class="w-px h-12 bg-gray-400"></div>
    </div>

    <!-- Kepala Dusun -->
    <div class="text-center">
        <h4 class="text-xl font-semibold mb-8" style="color: #2c5530;">KEPALA DUSUN</h4>
        <div class="flex justify-center mb-4">
            <div class="w-px h-8 bg-gray-400"></div>
        </div>
        <div class="flex justify-center mb-8">
            <div class="flex items-center">
                <div class="w-24 h-px bg-gray-400"></div>
                <div class="w-4 h-4 bg-gray-400 rounded-full mx-2"></div>
                <div class="w-24 h-px bg-gray-400"></div>
                <div class="w-4 h-4 bg-gray-400 rounded-full mx-2"></div>
                <div class="w-24 h-px bg-gray-400"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @foreach ($data['structure']['kepala_dusun'] as $kadus)
                <div class="text-center">
                    <div class="flex justify-center mb-4">
                        <div class="w-px h-12 bg-gray-400"></div>
                    </div>
                    <div
                        class="bg-white border border-gray-200 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ $kadus['photo'] }}" alt="{{ $kadus['position'] }}"
                            class="w-16 h-16 rounded-full mx-auto mb-4">
                        <h5 class="text-lg font-bold mb-2" style="color: #2c5530;">{{ $kadus['position'] }}</h5>
                        @if ($kadus['name'])
                            <p class="text-sm font-semibold" style="color: #2c5530;">{{ $kadus['name'] }}</p>
                        @endif
                        <p class="text-sm text-gray-600">{{ $kadus['dusun'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Keterangan Struktur -->
<div class="mt-12 bg-gray-50 p-8 rounded-xl">
    <h4 class="text-xl font-semibold text-center mb-6" style="color: #2c5530;">
        <i class="fas fa-info-circle mr-2" style="color: #4CAF50;"></i>Keterangan Struktur Organisasi
    </h4>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-4 rounded-lg shadow-sm border-l-4" style="border-color: #4CAF50;">
            <h5 class="font-semibold mb-2" style="color: #2c5530;">Sekretaris Desa</h5>
            <p class="text-sm text-gray-600">
                Membantu Kepala Desa dalam menyelenggarakan administrasi pemerintahan, administrasi pembangunan, dan
                administrasi kemasyarakatan
            </p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm border-l-4" style="border-color: #45a049;">
            <h5 class="font-semibold mb-2" style="color: #2c5530;">Kepala Seksi</h5>
            <p class="text-sm text-gray-600">
                Melaksanakan tugas operasional sesuai bidang kerjanya dan bertanggung jawab kepada Kepala Desa melalui
                Sekretaris Desa
            </p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm border-l-4" style="border-color: #4CAF50;">
            <h5 class="font-semibold mb-2" style="color: #2c5530;">Kepala Urusan</h5>
            <p class="text-sm text-gray-600">
                Membantu Sekretaris Desa dalam urusan administrasi sesuai dengan bidangnya masing-masing
            </p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm border-l-4" style="border-color: #45a049;">
            <h5 class="font-semibold mb-2" style="color: #2c5530;">Kepala Dusun</h5>
            <p class="text-sm text-gray-600">
                Memimpin penyelenggaraan pemerintahan di tingkat dusun dan bertanggung jawab kepada Kepala Desa
            </p>
        </div>
    </div>
</div>
