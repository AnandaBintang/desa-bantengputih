<footer class="bg-green-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold text-green-400 mb-4">
                    Desa {{ $villageInfo?->name ?? 'Bantengputih' }}
                </h3>
                <p class="text-gray-300 mb-4">
                    {{ $villageInfo?->description ?? 'Desa Bantengputih adalah desa yang terletak di Kecamatan Karanggeneng, Kabupaten Lamongan. Kami berkomitmen untuk memberikan pelayanan terbaik kepada masyarakat.' }}
                </p>
                <div class="flex space-x-4">
                    <a href="https://wa.me/{{ $villageInfo?->phone ?? '#' }}" target="_blank"
                        class="text-gray-300 hover:text-green-400 transition-colors duration-200">
                        <i class="fab fa-whatsapp text-2xl"></i>
                    </a>
                    <a href="https://facebook.com/{{ $villageInfo?->facebook ?? '#' }}" target="_blank"
                        class="text-gray-300 hover:text-green-400 transition-colors duration-200">
                        <i class="fab fa-facebook text-2xl"></i>
                    </a>
                    <a href="mailto:{{ $villageInfo?->email ?? '#' }}"
                        class="text-gray-300 hover:text-green-400 transition-colors duration-200">
                        <i class="fas fa-envelope text-2xl"></i>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-green-400 mb-4">Menu Utama</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}"
                            class="text-gray-300 hover:text-green-400 transition-colors duration-200">Beranda</a></li>
                    <li><a href="{{ route('about') }}"
                            class="text-gray-300 hover:text-green-400 transition-colors duration-200">Tentang Kami</a>
                    </li>
                    <li><a href="{{ route('news.index') }}"
                            class="text-gray-300 hover:text-green-400 transition-colors duration-200">Berita</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-green-400 mb-4">Layanan</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('complaints.create') }}"
                            class="text-gray-300 hover:text-green-400 transition-colors duration-200">Pengaduan</a></li>
                    <li><a href="{{ route('transparency') }}"
                            class="text-gray-300 hover:text-green-400 transition-colors duration-200">Transparansi</a>
                    </li>
                    <li><a href="{{ route('services') }}"
                            class="text-gray-300 hover:text-green-400 transition-colors duration-200">Informasi
                            Layanan</a></li>
                    <li><a href="{{ route('contact') }}"
                            class="text-gray-300 hover:text-green-400 transition-colors duration-200">Kontak</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-green-400 mb-4">Kontak</h4>
                <div class="space-y-3 text-gray-300">
                    <p class="flex items-start space-x-2">
                        <i class="fas fa-map-marker-alt mt-1"></i>
                        <span>{{ $villageInfo?->address ?? 'Desa Bantengputih, Kec. Karanggeneng, Kab. Lamongan' }}</span>
                    </p>
                    <p class="flex items-center space-x-2">
                        <i class="fas fa-phone"></i>
                        <span>{{ $villageInfo?->phone ? '+62 ' . substr($villageInfo->phone, 2, 3) . ' ' . substr($villageInfo->phone, 5, 4) . ' ' . substr($villageInfo->phone, 9) : '-' }}</span>
                    </p>
                    <p class="flex items-center space-x-2">
                        <i class="fas fa-envelope"></i>
                        <span>{{ $villageInfo?->email ?? '-' }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="border-t border-green-700 mt-8 pt-8 text-center text-gray-300">
            <p>&copy; {{ date('Y') }} Desa Bantengputih. Semua hak cipta dilindungi.</p>
        </div>
    </div>
</footer>
