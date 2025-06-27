<x-layouts.app title="Kontak - {{ $villageInfo?->name ?? 'Desa Bantengputih' }}"
    description="Hubungi {{ $villageInfo?->name ?? 'Desa Bantengputih' }} melalui berbagai saluran komunikasi yang tersedia. Kami siap melayani dan membantu masyarakat."
    keywords="kontak desa, alamat desa, telepon desa, email desa, {{ $villageInfo?->name ?? 'bantengputih' }}">

    <!-- Hero Section -->
    <section class="py-20" style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Hubungi Kami
            </h1>
            <p class="text-xl text-white opacity-90 max-w-3xl mx-auto">
                Kami siap melayani dan membantu masyarakat {{ $villageInfo?->name ?? 'Desa Bantengputih' }}.
                Jangan ragu untuk menghubungi kami melalui berbagai saluran komunikasi yang tersedia.
            </p>
        </div>
    </section>

    <!-- Contact Information Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">
                    Informasi Kontak
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Berbagai cara untuk menghubungi dan mengunjungi kantor
                    {{ $villageInfo?->name ?? 'Desa Bantengputih' }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Address -->
                <div
                    class="bg-white border-2 border-gray-200 p-8 rounded-xl text-center shadow-lg hover:shadow-xl hover:border-primary transition-all duration-300">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6"
                        style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
                        <i class="fas fa-map-marker-alt text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-4">Alamat</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $villageInfo?->address ?? 'Desa Bantengputih, Kecamatan Karanggeneng, Kabupaten Lamongan, Provinsi Jawa Timur' }}
                    </p>
                </div>

                <!-- Phone -->
                <div
                    class="bg-white border-2 border-gray-200 p-8 rounded-xl text-center shadow-lg hover:shadow-xl hover:border-primary transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-phone text-2xl text-blue-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-4">Telepon</h3>
                    <p class="text-gray-600 mb-4">Hubungi kami langsung</p>
                    @if ($villageInfo?->phone)
                        <a href="tel:{{ $villageInfo->phone }}"
                            class="text-primary font-semibold hover:text-accent text-lg transition-colors duration-200">
                            {{ $villageInfo->phone }}
                        </a>
                    @else
                        <span class="text-gray-400">Belum tersedia</span>
                    @endif
                </div>

                <!-- Email -->
                <div
                    class="bg-white border-2 border-gray-200 p-8 rounded-xl text-center shadow-lg hover:shadow-xl hover:border-primary transition-all duration-300">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-envelope text-2xl text-red-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-4">Email</h3>
                    <p class="text-gray-600 mb-4">Kirim pesan elektronik</p>
                    @if ($villageInfo?->email)
                        <a href="mailto:{{ $villageInfo->email }}"
                            class="text-primary font-semibold hover:text-accent transition-colors duration-200 break-words text-lg">
                            {{ $villageInfo->email }}
                        </a>
                    @else
                        <span class="text-gray-400">Belum tersedia</span>
                    @endif
                </div>

                <!-- Office Hours -->
                <div
                    class="bg-white border-2 border-gray-200 p-8 rounded-xl text-center shadow-lg hover:shadow-xl hover:border-primary transition-all duration-300">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-clock text-2xl text-yellow-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-4">Jam Kerja</h3>
                    <div class="text-gray-600 space-y-2">
                        <p><strong>Senin - Jumat</strong><br>08:00 - 16:00 WIB</p>
                        <p><strong>Sabtu</strong><br>08:00 - 12:00 WIB</p>
                        <p class="text-red-500"><strong>Minggu: Tutup</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Media & Quick Contact Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">
                    Media Sosial & Kontak Cepat
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Ikuti media sosial kami untuk mendapatkan informasi terbaru atau hubungi langsung untuk urusan
                    mendesak
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- WhatsApp -->
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fab fa-whatsapp text-3xl text-green-500"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-secondary">WhatsApp</h3>
                            <p class="text-gray-600">Chat langsung dengan kami</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">
                        Untuk pertanyaan cepat, konsultasi, atau informasi mendesak, silakan hubungi kami melalui
                        WhatsApp.
                        Kami siap membantu Anda 24/7.
                    </p>
                    @if ($villageInfo?->whatsapp_url)
                        <div class="flex space-x-4">
                            <a href="{{ $villageInfo->whatsapp_url }}" target="_blank"
                                class="flex-1 bg-green-500 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-600 transition-colors duration-200 text-center">
                                <i class="fab fa-whatsapp mr-2"></i>Chat Sekarang
                            </a>
                            <button onclick="copyWhatsApp('{{ $villageInfo->phone }}')"
                                class="bg-gray-100 text-gray-700 py-3 px-6 rounded-lg font-semibold hover:bg-gray-200 transition-colors duration-200">
                                <i class="fas fa-copy mr-2"></i>Salin
                            </button>
                        </div>
                    @else
                        <div class="bg-gray-100 text-gray-500 py-3 px-6 rounded-lg text-center">
                            WhatsApp belum tersedia
                        </div>
                    @endif
                </div>

                <!-- Website -->
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fab fa-facebook text-3xl text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-secondary">Facebook</h3>
                            <p class="text-gray-600">Halaman media sosial resmi</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">
                        Ikuti halaman Facebook resmi kami untuk mendapatkan update terbaru, foto kegiatan,
                        dan berinteraksi langsung dengan {{ $villageInfo?->name ?? 'desa' }}.
                    </p>
                    @if ($villageInfo?->facebook)
                        <div class="flex space-x-4">
                            <a href="{{ $villageInfo->facebook }}" target="_blank"
                                class="flex-1 text-white py-3 px-6 rounded-lg font-semibold transition-colors duration-200 text-center"
                                style="background-color: #2563eb;" onmouseover="this.style.backgroundColor='#1d4ed8'"
                                onmouseout="this.style.backgroundColor='#2563eb'">
                                <i class="fab fa-facebook mr-2"></i>Ikuti Halaman
                            </a>
                            <button onclick="shareWebsite('{{ $villageInfo->phone }}')"
                                class="bg-gray-100 text-gray-700 py-3 px-6 rounded-lg font-semibold hover:bg-gray-200 transition-colors duration-200">
                                <i class="fas fa-share mr-2"></i>Bagikan
                            </button>
                        </div>
                    @else
                        <div class="bg-gray-100 text-gray-500 py-3 px-6 rounded-lg text-center">
                            Facebook belum tersedia
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">
                    Lokasi & Petunjuk Arah
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Temukan lokasi kantor {{ $villageInfo?->name ?? 'Desa Bantengputih' }} dan dapatkan petunjuk arah
                    untuk kunjungan langsung
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Map -->
                <div class="col-span-2">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15840.024424363823!2d112.30963945!3d-7.008563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e77edb55e68e2d1%3A0x8d6bfadd0472d792!2sBantengputih%2C%20Karang%20Geneng%2C%20Lamongan%20Regency%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1750428136801!5m2!1sen!2sid"
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" class="w-full">
                        </iframe>
                    </div>
                </div>

                <!-- Directions -->
                <div class="space-y-6">
                    <div class="bg-gray-50 p-6 rounded-xl">
                        <h3 class="text-xl font-bold text-secondary mb-4">
                            <i class="fas fa-route text-primary mr-2"></i>Petunjuk Arah
                        </h3>
                        <div class="space-y-4 text-gray-600">
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-car text-primary mt-1"></i>
                                <div>
                                    <p class="font-semibold">Dengan Kendaraan Pribadi</p>
                                    <p class="text-sm">
                                        Dari pusat kota Lamongan, ambil jalan menuju Kecamatan Karanggeneng,
                                        ikuti papan petunjuk {{ $villageInfo?->name ?? 'Desa Bantengputih' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-bus text-primary mt-1"></i>
                                <div>
                                    <p class="font-semibold">Transportasi Umum</p>
                                    <p class="text-sm">
                                        Naik bus jurusan Karanggeneng dari terminal Lamongan, turun di Karanggeneng,
                                        lanjut dengan angkot atau ojek ke
                                        {{ $villageInfo?->name ?? 'Desa Bantengputih' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 p-6 rounded-xl">
                        <h4 class="text-lg font-bold text-blue-800 mb-3">
                            <i class="fas fa-info-circle mr-2"></i>Informasi Penting
                        </h4>
                        <ul class="text-blue-700 text-sm space-y-2">
                            <li>• Parkir tersedia di halaman kantor</li>
                            <li>• Dekat dengan masjid dan sekolah</li>
                            <li>• Mudah dijangkau dengan kendaraan umum</li>
                        </ul>
                    </div>

                    <div class="flex space-x-4">
                        <a href="https://maps.google.com/directions/?api=1&destination=Bantengputih,Karang+Geneng,Lamongan+Regency,East+Java"
                            target="_blank"
                            class="flex-1 bg-primary text-white py-3 px-4 rounded-lg font-semibold hover:bg-accent transition-colors duration-200 text-center text-sm">
                            <i class="fas fa-directions mr-2"></i>Buka di Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Actions Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">
                    Aksi Cepat
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Layanan dan informasi yang sering dibutuhkan masyarakat
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Pengaduan -->
                <div
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-comments text-2xl text-orange-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-4">Pengaduan Online</h3>
                    <p class="text-gray-600 mb-6">
                        Sampaikan keluhan atau aspirasi Anda melalui sistem pengaduan online
                    </p>
                    <a href="{{ route('complaints.create') }}"
                        class="inline-block text-white py-3 px-6 rounded-lg font-semibold transition-colors duration-200"
                        style="background-color: #f97316;" onmouseover="this.style.backgroundColor='#ea580c'"
                        onmouseout="this.style.backgroundColor='#f97316'">
                        <i class="fas fa-edit mr-2"></i>Buat Pengaduan
                    </a>
                </div>

                <!-- Layanan -->
                <div
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-file-alt text-2xl text-purple-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-4">Informasi Layanan</h3>
                    <p class="text-gray-600 mb-6">
                        Lihat berbagai layanan administratif yang tersedia di {{ $villageInfo?->name ?? 'desa' }}
                    </p>
                    <a href="{{ route('services') }}"
                        class="inline-block text-white py-3 px-6 rounded-lg font-semibold transition-colors duration-200"
                        style="background-color: #8b5cf6;" onmouseover="this.style.backgroundColor='#7c3aed'"
                        onmouseout="this.style.backgroundColor='#8b5cf6'">
                        <i class="fas fa-list mr-2"></i>Lihat Layanan
                    </a>
                </div>

                <!-- Berita -->
                <div
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-newspaper text-2xl text-green-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-4">Berita & Kegiatan</h3>
                    <p class="text-gray-600 mb-6">
                        Ikuti berita terbaru dan kegiatan yang sedang berlangsung di
                        {{ $villageInfo?->name ?? 'desa' }}
                    </p>
                    <a href="{{ route('news.index') }}"
                        class="inline-block bg-green-500 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-600 transition-colors duration-200">
                        <i class="fas fa-eye mr-2"></i>Baca Berita
                    </a>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Copy WhatsApp number function
            function copyWhatsApp(phone) {
                if (!phone) {
                    alert('Nomor WhatsApp tidak tersedia');
                    return;
                }

                navigator.clipboard.writeText(phone).then(function() {
                    alert('Nomor WhatsApp berhasil disalin!');
                }).catch(function() {
                    alert('Gagal menyalin nomor WhatsApp');
                });
            }

            // Share website function
            function shareWebsite(website) {
                if (!website) {
                    alert('Website tidak tersedia');
                    return;
                }

                if (navigator.share) {
                    navigator.share({
                        title: '{{ $villageInfo?->name ?? 'Desa Bantengputih' }}',
                        text: 'Kunjungi website resmi {{ $villageInfo?->name ?? 'Desa Bantengputih' }}',
                        url: website
                    });
                } else {
                    // Fallback for browsers that don't support Web Share API
                    const url = encodeURIComponent(website);
                    window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
                }
            }
        </script>
    @endpush

</x-layouts.app>
