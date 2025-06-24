@props(['data'])

<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
    <div>
        <h3 class="text-2xl font-bold mb-6" style="color: #2c5530;">
            <i class="fas fa-history text-primary mr-3"></i>Sejarah Desa
        </h3>
        <p class="text-gray-600 mb-6 leading-relaxed">
            {{ $data['history']['formation'] }}
        </p>
        <p class="text-gray-600 mb-6 leading-relaxed">
            {{ $data['history']['development'] }}
        </p>

        <h3 class="text-2xl font-bold mb-6" style="color: #2c5530;">
            <i class="fas fa-book text-primary mr-3"></i>Legenda Desa
        </h3>
        <p class="text-gray-600 mb-4 leading-relaxed">
            Asal mula nama Bantengputih memiliki dua versi cerita:
        </p>

        <div class="bg-gray-50 p-6 rounded-lg mb-6">
            <h5 class="font-semibold mb-3" style="color: #2c5530;">Versi Pertama:</h5>
            <p class="text-gray-600 text-sm leading-relaxed">
                {{ $data['legends']['version1'] }}
            </p>
        </div>

        <div class="bg-gray-50 p-6 rounded-lg mb-8">
            <h5 class="font-semibold mb-3" style="color: #2c5530;">Versi Kedua:</h5>
            <p class="text-gray-600 text-sm leading-relaxed">
                {{ $data['legends']['version2'] }}
            </p>
        </div>
    </div>

    <div>
        <img src="{{ asset('images/sejarah-bantengputih.jpg') }}" alt="Sejarah Desa"
            class="w-full h-96 object-cover rounded-lg shadow-lg mb-6"
            onerror="this.src='https://placehold.co/600x400/4CAF50/FFFFFF?text=Sejarah+Desa+Bantengputih'">

        <!-- Tabel Kepala Desa -->
        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-md">
            <div class="text-white px-4 py-3" style="background-color: #4CAF50;">
                <h4 class="font-semibold">Daftar Kepala Desa</h4>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold" style="color: #2c5530;">No</th>
                            <th class="px-4 py-3 text-left font-semibold" style="color: #2c5530;">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold" style="color: #2c5530;">Masa Jabatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($data['village_heads'] as $head)
                            <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                                <td class="px-4 py-3">{{ $head['no'] }}</td>
                                <td class="px-4 py-3 font-medium">{{ $head['name'] }}</td>
                                <td class="px-4 py-3">{{ $head['period'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
