<nav class="bg-white shadow-lg fixed top-0 w-full z-50 transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <img src="{{ $villageInfo?->logo ? asset('storage/' . $villageInfo->logo) : asset('images/logo.png') }}"
                    alt="Logo Desa" class="w-10 h-10 rounded-full"
                    onerror="this.src='https://placehold.co/40x40/4CAF50/FFFFFF?text=LOGO'">
                <span
                    class="text-xl font-bold text-green-800">{{ strtoupper($villageInfo?->name ?? 'BANTENGPUTIH') }}</span>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-8">
                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                    <i class="fas fa-home"></i>
                    <span>Beranda</span>
                </x-nav-link>

                <!-- Profil Dropdown -->
                <x-nav-dropdown title="Profil Desa" icon="fas fa-info-circle" :active="request()->routeIs(['about', 'gallery', 'news.*'])">
                    <x-nav-dropdown-item href="{{ route('about') }}" icon="fas fa-building" :active="request()->routeIs('about')">
                        Tentang Kami
                    </x-nav-dropdown-item>
                    <x-nav-dropdown-item href="{{ route('gallery') }}" icon="fas fa-images" :active="request()->routeIs('gallery')">
                        Galeri
                    </x-nav-dropdown-item>
                    <x-nav-dropdown-item href="{{ route('news.index') }}" icon="fas fa-newspaper" :active="request()->routeIs('news.*')">
                        Berita & Kegiatan
                    </x-nav-dropdown-item>
                </x-nav-dropdown>

                <!-- Layanan Dropdown -->
                <x-nav-dropdown title="Layanan" icon="fas fa-cogs" :active="request()->routeIs(['services*', 'complaints*', 'transparency*', 'population*'])">
                    <x-nav-dropdown-item href="{{ route('services') }}" icon="fas fa-file-alt" :active="request()->routeIs(['services*', 'population*'])">
                        Informasi Layanan
                    </x-nav-dropdown-item>
                    <x-nav-dropdown-item href="{{ route('complaints.create') }}" icon="fas fa-comments"
                        :active="request()->routeIs('complaints*')">
                        Pengaduan Online
                    </x-nav-dropdown-item>
                    <x-nav-dropdown-item href="{{ route('transparency') }}" icon="fas fa-chart-line" :active="request()->routeIs('transparency*')">
                        Transparansi
                    </x-nav-dropdown-item>
                </x-nav-dropdown>

                <x-nav-link href="{{ route('products.index') }}">
                    <i class="fas fa-box"></i>
                    <span>Produk Desa</span>
                </x-nav-link>

                <x-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">
                    <i class="fas fa-phone"></i>
                    <span>Kontak</span>
                </x-nav-link>
            </div>

            <!-- Mobile menu button -->
            <div class="lg:hidden">
                <button id="mobile-menu-button"
                    class="text-gray-700 hover:text-green-600 focus:outline-none focus:text-green-600 transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <x-mobile-menu />
    </div>
</nav>
