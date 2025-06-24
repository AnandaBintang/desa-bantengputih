<div id="mobile-menu" class="lg:hidden hidden fixed inset-0 bg-white z-50 overflow-y-auto">
    <!-- Close button -->
    <div class="flex justify-end p-4">
        <button id="mobile-menu-close" class="text-gray-500 hover:text-gray-700">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <div class="px-6 py-4 space-y-4">
        <a href="{{ route('home') }}"
            class="block px-4 py-3 text-lg font-medium text-green-800 {{ request()->routeIs('home') ? 'border-l-4 border-green-600 bg-green-50' : 'text-gray-700 hover:text-green-600 hover:bg-gray-50' }} rounded-r-lg transition-colors duration-200">
            <i class="fas fa-home w-6 mr-4"></i>Beranda
        </a>

        <!-- Mobile Profil Dropdown -->
        <div class="mobile-dropdown">
            <button
                class="mobile-dropdown-btn w-full flex items-center justify-between px-4 py-3 text-lg font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                <span><i class="fas fa-info-circle w-6 mr-4"></i>Profil Desa</span>
                <i class="fas fa-chevron-down transform transition-transform duration-200"></i>
            </button>
            <div class="mobile-dropdown-content hidden bg-gray-50 ml-6 mt-2 rounded-lg">
                <a href="{{ route('about') }}"
                    class="block px-4 py-3 text-gray-600 hover:text-green-600 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                    <i class="fas fa-building w-5 mr-4"></i>Tentang Kami
                </a>
                <a href="{{ route('gallery') }}"
                    class="block px-4 py-3 text-gray-600 hover:text-green-600 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                    <i class="fas fa-images w-5 mr-4"></i>Galeri
                </a>
                <a href="{{ route('news.index') }}"
                    class="block px-4 py-3 text-gray-600 hover:text-green-600 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                    <i class="fas fa-newspaper w-5 mr-4"></i>Berita & Kegiatan
                </a>
            </div>
        </div>

        <!-- Mobile Layanan Dropdown -->
        <div class="mobile-dropdown">
            <button
                class="mobile-dropdown-btn w-full flex items-center justify-between px-4 py-3 text-lg font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                <span><i class="fas fa-cogs w-6 mr-4"></i>Layanan</span>
                <i class="fas fa-chevron-down transform transition-transform duration-200"></i>
            </button>
            <div class="mobile-dropdown-content hidden bg-gray-50 ml-6 mt-2 rounded-lg">
                <a href="{{ route('services') }}"
                    class="block px-4 py-3 text-gray-600 hover:text-green-600 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                    <i class="fas fa-file-alt w-5 mr-4"></i>Informasi Layanan
                </a>
                <a href="{{ route('complaints.create') }}"
                    class="block px-4 py-3 text-gray-600 hover:text-green-600 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                    <i class="fas fa-comments w-5 mr-4"></i>Pengaduan Online
                </a>
                <a href="{{ route('transparency') }}"
                    class="block px-4 py-3 text-gray-600 hover:text-green-600 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                    <i class="fas fa-chart-line w-5 mr-4"></i>Transparansi
                </a>
            </div>
        </div>

        <a href="{{ route('products.index') }}"
            class="block px-4 py-3 text-lg font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 rounded-lg transition-colors duration-200">
            <i class="fas fa-box w-6 mr-4"></i>Produk Desa
        </a>

        <a href="{{ route('contact') }}"
            class="block px-4 py-3 text-lg font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50 rounded-lg transition-colors duration-200">
            <i class="fas fa-phone w-6 mr-4"></i>Kontak
        </a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuClose = document.getElementById('mobile-menu-close');

        if (mobileMenuButton && mobileMenu && mobileMenuClose) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });

            mobileMenuClose.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
                document.body.style.overflow = 'auto';
            });

            // Close mobile menu when clicking outside
            mobileMenu.addEventListener('click', function(e) {
                if (e.target === mobileMenu) {
                    mobileMenu.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }
            });
        }

        // Mobile dropdown functionality
        document.querySelectorAll('.mobile-dropdown-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const content = this.nextElementSibling;
                const chevron = this.querySelector('.fa-chevron-down');

                if (content && chevron) {
                    content.classList.toggle('hidden');
                    chevron.classList.toggle('rotate-180');
                }
            });
        });
    });
</script>
