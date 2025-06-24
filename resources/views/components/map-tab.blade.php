@props(['data'])

<div class="text-center mb-8">
    <h3 class="text-3xl font-bold mb-4" style="color: #2c5530;">Peta Wilayah Desa Bantengputih</h3>
    <p class="text-gray-600 max-w-2xl mx-auto">
        Desa Bantengputih terletak di wilayah strategis Kecamatan Karanggeneng dengan kondisi geografis yang mendukung
        aktivitas pertanian dan perikanan
    </p>
</div>

<!-- Koordinat Geografis -->
<div class="bg-gradient-to-r p-6 rounded-xl text-white mb-8"
    style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
    <div class="text-center">
        <h4 class="text-xl font-bold mb-4">
            <i class="fas fa-globe-asia mr-2"></i>Koordinat Geografis
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white bg-opacity-20 p-4 rounded-lg">
                <h5 class="font-semibold mb-2">Lintang Selatan</h5>
                <p class="text-lg font-bold">{{ $data['coordinates']['latitude'] }}</p>
            </div>
            <div class="bg-white bg-opacity-20 p-4 rounded-lg">
                <h5 class="font-semibold mb-2">Bujur Timur</h5>
                <p class="text-lg font-bold">{{ $data['coordinates']['longitude'] }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Peta Google Maps -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15840.024424363823!2d112.30963945!3d-7.008563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e77edb55e68e2d1%3A0x8d6bfadd0472d792!2sBantengputih%2C%20Karang%20Geneng%2C%20Lamongan%20Regency%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1750428136801!5m2!1sen!2sid"
        width="100%" height="400" style="border:0;" allowfullscreen="true" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade" class="w-full">
    </iframe>
</div>

<!-- Batas Wilayah -->
<div class="bg-white p-8 rounded-xl shadow-lg mb-8">
    <h4 class="text-2xl font-bold text-center mb-8" style="color: #2c5530;">
        <i class="fas fa-compass mr-3" style="color: #4CAF50;"></i>Batas Wilayah Administratif
    </h4>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="text-center p-6 bg-gradient-to-b from-blue-50 to-blue-100 rounded-xl border border-blue-200">
            <i class="fas fa-arrow-up text-3xl text-blue-600 mb-4"></i>
            <h5 class="font-bold mb-2" style="color: #2c5530;">Sebelah Utara</h5>
            <p class="text-sm text-gray-600">{{ $data['boundaries']['north'] }}</p>
        </div>
        <div class="text-center p-6 bg-gradient-to-b from-green-50 to-green-100 rounded-xl border border-green-200">
            <i class="fas fa-arrow-right text-3xl text-green-600 mb-4"></i>
            <h5 class="font-bold mb-2" style="color: #2c5530;">Sebelah Timur</h5>
            <p class="text-sm text-gray-600">{{ $data['boundaries']['east'] }}</p>
        </div>
        <div class="text-center p-6 bg-gradient-to-b from-yellow-50 to-yellow-100 rounded-xl border border-yellow-200">
            <i class="fas fa-arrow-down text-3xl text-yellow-600 mb-4"></i>
            <h5 class="font-bold mb-2" style="color: #2c5530;">Sebelah Selatan</h5>
            <p class="text-sm text-gray-600">{{ $data['boundaries']['south'] }}</p>
        </div>
        <div class="text-center p-6 bg-gradient-to-b from-red-50 to-red-100 rounded-xl border border-red-200">
            <i class="fas fa-arrow-left text-3xl text-red-600 mb-4"></i>
            <h5 class="font-bold mb-2" style="color: #2c5530;">Sebelah Barat</h5>
            <p class="text-sm text-gray-600">{{ $data['boundaries']['west'] }}</p>
        </div>
    </div>
</div>

<!-- Informasi Geografis dan Luas Wilayah -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Informasi Geografis -->
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h4 class="text-xl font-bold text-center mb-6" style="color: #2c5530;">
            <i class="fas fa-mountain mr-2" style="color: #4CAF50;"></i>Kondisi Geografis
        </h4>
        <div class="space-y-4">
            @foreach ($data['geography'] as $key => $value)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <span class="font-semibold capitalize"
                        style="color: #2c5530;">{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                    <span class="text-gray-600">{{ $value }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Luas Wilayah -->
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h4 class="text-xl font-bold text-center mb-6" style="color: #2c5530;">
            <i class="fas fa-ruler-combined mr-2" style="color: #4CAF50;"></i>Luas Wilayah
        </h4>
        <div class="text-center mb-6">
            <div class="text-white p-4 rounded-lg inline-block" style="background-color: #4CAF50;">
                <h5 class="text-2xl font-bold">{{ $data['area']['total'] }}</h5>
                <p class="text-sm opacity-90">Total Luas Wilayah</p>
            </div>
        </div>
        <div class="space-y-3">
            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                <h6 class="font-semibold mb-2" style="color: #2c5530;">Tanah Sawah & Sawah Tambak</h6>
                <p class="text-lg font-bold text-green-600">{{ $data['area']['rice_field'] }}</p>
                <div class="text-sm text-gray-600 mt-2">
                    <p>• Irigasi Teknis: {{ $data['area']['breakdown']['irrigation_technical'] }}</p>
                    <p>• Irigasi Setengah Teknis: {{ $data['area']['breakdown']['irrigation_semi_technical'] }}</p>
                    <p>• Tadah Hujan: {{ $data['area']['breakdown']['rain_fed'] }}</p>
                </div>
            </div>
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                <h6 class="font-semibold mb-2" style="color: #2c5530;">Tanah Bukan Sawah</h6>
                <p class="text-lg font-bold text-blue-600">{{ $data['area']['non_rice_field'] }}</p>
                <div class="text-sm text-gray-600 mt-2">
                    <p>• Pekarangan/Bangunan: {{ $data['area']['breakdown']['residential'] }}</p>
                    <p>• Lain-lain (saluran, telaga, jalan, makam): {{ $data['area']['breakdown']['others'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pembagian Wilayah Administratif -->
<div class="bg-white p-8 rounded-xl shadow-lg">
    <h4 class="text-2xl font-bold text-center mb-8" style="color: #2c5530;">
        <i class="fas fa-sitemap mr-3" style="color: #4CAF50;"></i>Pembagian Wilayah Administratif
    </h4>

    <!-- Struktur Dusun -->
    <div class="mb-8">
        <div class="text-center mb-6">
            <div class="bg-gradient-to-r p-4 rounded-xl inline-block"
                style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
                <h5 class="text-lg font-bold text-white">DESA BANTENGPUTIH</h5>
                <p class="text-white opacity-90 text-sm">
                    {{ $data['administrative_division']['dusun'] }} Dusun •
                    {{ $data['administrative_division']['rw'] }} RW •
                    {{ $data['administrative_division']['rt'] }} RT
                </p>
            </div>
        </div>

        <!-- Connecting Lines -->
        <div class="flex justify-center mb-6">
            <div class="w-px h-8 bg-gray-400"></div>
        </div>
        <div class="flex justify-center mb-8">
            <div class="flex items-center">
                <div class="w-20 h-px bg-gray-400"></div>
                <div class="w-3 h-3 bg-gray-400 rounded-full mx-2"></div>
                <div class="w-20 h-px bg-gray-400"></div>
                <div class="w-3 h-3 bg-gray-400 rounded-full mx-2"></div>
                <div class="w-20 h-px bg-gray-400"></div>
            </div>
        </div>

        <!-- Dusun Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $colors = ['green', 'blue', 'yellow'];
            @endphp
            @foreach ($data['administrative_division']['detail'] as $index => $division)
                <div class="text-center">
                    <div class="flex justify-center mb-4">
                        <div class="w-px h-8 bg-gray-400"></div>
                    </div>
                    <div
                        class="bg-gradient-to-b from-{{ $colors[$index] }}-100 to-{{ $colors[$index] }}-200 p-6 rounded-xl border-2 border-{{ $colors[$index] }}-300 shadow-lg">
                        <i class="fas fa-home text-3xl text-{{ $colors[$index] }}-600 mb-4"></i>
                        <h5 class="text-lg font-bold mb-2" style="color: #2c5530;">DUSUN
                            {{ strtoupper($division['dusun']) }}</h5>
                        <div class="bg-white p-3 rounded-lg shadow-sm">
                            <p class="text-sm text-gray-600">{{ $division['rw'] }} RW • {{ $division['rt'] }} RT</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Tabel Pembagian Wilayah -->
    <div class="bg-gray-50 p-6 rounded-lg">
        <h5 class="text-lg font-semibold text-center mb-4" style="color: #2c5530;">Detail Pembagian Wilayah
            Administratif</h5>
        <div class="overflow-x-auto">
            <table class="w-full text-center">
                <thead>
                    <tr class="text-white" style="background-color: #4CAF50;">
                        <th class="py-3 px-4 rounded-tl-lg">No</th>
                        <th class="py-3 px-4">Dusun</th>
                        <th class="py-3 px-4">Jumlah RW</th>
                        <th class="py-3 px-4 rounded-tr-lg">Jumlah RT</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($data['administrative_division']['detail'] as $index => $division)
                        <tr class="border-b border-gray-200">
                            <td class="py-3 px-4 font-semibold">{{ $index + 1 }}</td>
                            <td class="py-3 px-4">{{ ucfirst($division['dusun']) }}</td>
                            <td class="py-3 px-4">{{ $division['rw'] }}</td>
                            <td class="py-3 px-4">{{ $division['rt'] }}</td>
                        </tr>
                    @endforeach
                    <tr class="text-white font-bold" style="background-color: #4CAF50;">
                        <td class="py-3 px-4 rounded-bl-lg" colspan="2">JUMLAH</td>
                        <td class="py-3 px-4">{{ $data['administrative_division']['rw'] }}</td>
                        <td class="py-3 px-4 rounded-br-lg">{{ $data['administrative_division']['rt'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
