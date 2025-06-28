<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12" style="color: #2c5530;">
            Layanan Unggulan
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <a href="{{ route('products.index') }}"
                class="group bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('images/banner-produk-desa.jpg') }}" alt="Produk Desa"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                        onerror="this.onerror=null;this.src='https://placehold.co/400x200/4CAF50/FFFFFF?text=Produk+Desa';">
                </div>
                <div class="p-6 text-center">
                    <i class="fas fa-shopping-basket text-3xl mb-4" style="color: #4CAF50;"></i>
                    <h3 class="text-xl font-bold mb-3" style="color: #2c5530;">
                        Produk Desa
                    </h3>
                    <p class="text-gray-600">
                        Berbagai produk unggulan dari warga desa dengan kualitas terbaik
                    </p>
                </div>
            </a>

            <a href="{{ route('complaints.create') }}"
                class="group bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('images/banner-pengaduan-online.jpg') }}" alt="Pengaduan Online"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                        onerror="this.onerror=null;this.src='https://placehold.co/400x200/4CAF50/FFFFFF?text=Pengaduan+Online';">
                </div>
                <div class="p-6 text-center">
                    <i class="fas fa-comments text-3xl mb-4" style="color: #4CAF50;"></i>
                    <h3 class="text-xl font-bold mb-3" style="color: #2c5530;">
                        Pengaduan Online
                    </h3>
                    <p class="text-gray-600">
                        Layanan pengaduan masyarakat secara online yang mudah dan cepat
                    </p>
                </div>
            </a>

            <a href="{{ route('transparency') }}"
                class="group bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('images/banner-transparansi.png') }}" alt="Transparansi"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                        onerror="this.onerror=null;this.src='https://placehold.co/400x200/4CAF50/FFFFFF?text=Transparansi';">
                </div>
                <div class="p-6 text-center">
                    <i class="fas fa-chart-line text-3xl mb-4" style="color: #4CAF50;"></i>
                    <h3 class="text-xl font-bold mb-3" style="color: #2c5530;">
                        Transparansi
                    </h3>
                    <p class="text-gray-600">
                        Informasi keuangan dan kinerja desa yang transparan dan akuntabel
                    </p>
                </div>
            </a>
        </div>
    </div>
</section>
