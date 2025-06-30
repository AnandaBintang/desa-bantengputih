<x-layouts.app title="Informasi Layanan - Desa Bantengputih"
    description="Dapatkan informasi lengkap tentang berbagai layanan administrasi dan pelayanan publik yang tersedia di Desa Bantengputih"
    keywords="layanan desa, administrasi, produk hukum, bantengputih">

    <!-- Hero Section with Green Gradient -->
    <section class="py-16 lg:py-20" style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Informasi Layanan
            </h1>
            <p class="text-xl text-white opacity-90 max-w-3xl mx-auto">
                Dapatkan informasi lengkap tentang berbagai layanan administrasi dan pelayanan publik yang tersedia
                di Desa Bantengputih
            </p>
        </div>
    </section>

    <!-- Service Navigation Tabs -->
    <section class="pt-16 pb-12 bg-white">
        <div class="flex flex-wrap justify-center gap-4">
            <button onclick="showServiceTab('produk-hukum')"
                class="service-tab-btn active px-8 py-4 rounded-lg font-semibold transition-all duration-200 shadow-lg"
                style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%); color: white;"
                data-tab="produk-hukum">
                <i class="fas fa-gavel mr-2"></i>Produk Hukum
            </button>
            <button onclick="showServiceTab('informasi-publik')"
                class="service-tab-btn px-8 py-4 rounded-lg font-semibold transition-all duration-200 bg-gray-200 text-gray-700 hover:bg-gray-300"
                data-tab="informasi-publik">
                <i class="fas fa-info-circle mr-2"></i>Informasi Publik
            </button>
        </div>
    </section>

    <!-- Service Content Sections -->
    <!-- Produk Hukum Tab -->
    <section id="service-produk-hukum" class="service-content py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">
                    Produk Hukum Desa
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Kumpulan peraturan dan keputusan resmi yang berlaku di Desa Banteng Putih
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Peraturan Desa -->
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <div class="flex items-center mb-6">
                        <div class="bg-blue-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-gavel text-2xl text-blue-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-secondary">
                            Peraturan Desa
                        </h3>
                    </div>
                    <div class="space-y-4">
                        @forelse($peraturanDesa as $document)
                            <div
                                class="border border-gray-200 rounded-lg p-4 hover:border-primary transition-colors duration-200">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-semibold text-secondary">
                                        {{ $document->title }}
                                    </h4>
                                    <span class="text-sm text-gray-500">
                                        {{ strtoupper($document->file_extension ?? 'PDF') }} -
                                        {{ $document->file_size }}
                                    </span>
                                </div>
                                @if ($document->description)
                                    <div class="text-gray-600 text-sm mb-3">
                                        {!! $document->description !!}
                                    </div>
                                @endif
                                <div class="flex space-x-2">
                                    <a href="{{ route('services.download', $document) }}"
                                        class="text-white px-4 py-2 rounded-lg text-sm hover:opacity-90 transition-all duration-200"
                                        style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
                                        <i class="fas fa-download mr-1"></i>Unduh
                                    </a>
                                    @if ($document->isPdf())
                                        <a href="{{ route('services.preview', $document) }}" target="_blank"
                                            class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-200 transition-colors duration-200">
                                            <i class="fas fa-eye mr-1"></i>Lihat
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-folder-open text-4xl mb-4" style="color: #4CAF50; opacity: 0.5;"></i>
                                <p>Belum ada peraturan desa yang tersedia</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Keputusan Kepala Desa -->
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <div class="flex items-center mb-6">
                        <div class="bg-green-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-stamp text-2xl text-green-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-secondary">
                            Keputusan Kepala Desa
                        </h3>
                    </div>
                    <div class="space-y-4">
                        @forelse($keputusanKades as $document)
                            <div
                                class="border border-gray-200 rounded-lg p-4 hover:border-primary transition-colors duration-200">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-semibold text-secondary">
                                        {{ $document->title }}
                                    </h4>
                                    <span class="text-sm text-gray-500">
                                        {{ strtoupper($document->file_extension ?? 'PDF') }} -
                                        {{ $document->file_size }}
                                    </span>
                                </div>
                                @if ($document->description)
                                    <div class="text-gray-600 text-sm mb-3">
                                        {!! $document->description !!}
                                    </div>
                                @endif
                                <div class="flex space-x-2">
                                    <a href="{{ route('services.download', $document) }}"
                                        class="text-white px-4 py-2 rounded-lg text-sm hover:opacity-90 transition-all duration-200"
                                        style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
                                        <i class="fas fa-download mr-1"></i>Unduh
                                    </a>
                                    @if ($document->isPdf())
                                        <a href="{{ route('services.preview', $document) }}" target="_blank"
                                            class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-200 transition-colors duration-200">
                                            <i class="fas fa-eye mr-1"></i>Lihat
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-folder-open text-4xl mb-4" style="color: #4CAF50; opacity: 0.5;"></i>
                                <p>Belum ada keputusan kepala desa yang tersedia</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Informasi Publik Tab -->
    <section id="service-informasi-publik" class="service-content py-20 bg-white hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">
                    Informasi Publik
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Akses informasi penting dan terbaru seputar Desa Bantengputih
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Data Kependudukan -->
                <div class="bg-gray-50 rounded-xl shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="p-3 rounded-full mr-4"
                            style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-secondary">
                            Data Kependudukan
                        </h3>
                    </div>
                    <p class="text-gray-700 mb-4">
                        Informasi statistik penduduk dan demografi desa
                    </p>
                    <a href="{{ route('population') }}" class="font-semibold hover:underline" style="color: #4CAF50;">
                        Lihat Detail
                    </a>
                </div>

                <!-- Laporan Keuangan -->
                <div class="bg-gray-50 rounded-xl shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="p-3 rounded-full mr-4"
                            style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
                            <i class="fas fa-chart-bar text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-secondary">
                            Laporan Keuangan
                        </h3>
                    </div>
                    <p class="text-gray-700 mb-4">
                        Transparansi penggunaan anggaran desa
                    </p>
                    <a href="{{ route('transparency') }}" class="font-semibold hover:underline"
                        style="color: #4CAF50;">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Document Modal -->
    <div id="documentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-2xl w-full max-h-96 overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 id="modalTitle" class="text-xl font-bold text-secondary"></h3>
                        <button onclick="closeDocumentModal()" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <div id="modalContent" class="space-y-3">
                        <!-- Document list will be populated here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Initialize service tab functionality
            document.addEventListener("DOMContentLoaded", function() {
                showServiceTab("produk-hukum");
            });

            function showServiceTab(tabName) {
                // Hide all service content sections
                const serviceContents = document.querySelectorAll(".service-content");
                serviceContents.forEach((section) => {
                    section.classList.add("hidden");
                });

                // Remove active class and reset colors from all tabs
                const serviceTabs = document.querySelectorAll(".service-tab-btn");
                serviceTabs.forEach((tab) => {
                    tab.classList.remove("active");
                    tab.style.background = '';
                    tab.style.color = '';
                    tab.classList.remove("shadow-lg");
                    tab.classList.add("bg-gray-200", "text-gray-700");
                });

                // Show the selected tab content and set it active
                const activeTab = document.getElementById(`service-${tabName}`);
                if (activeTab) {
                    activeTab.classList.remove("hidden");
                    const selectedTabBtn = document.querySelector(
                        `.service-tab-btn[data-tab="${tabName}"]`
                    );
                    if (selectedTabBtn) {
                        selectedTabBtn.classList.add("active");
                        selectedTabBtn.classList.remove("bg-gray-200", "text-gray-700");
                        selectedTabBtn.style.background = "linear-gradient(135deg, #4CAF50 0%, #45a049 100%)";
                        selectedTabBtn.style.color = "white";
                        selectedTabBtn.classList.add("shadow-lg");
                    }
                }
            }

            function showDocumentModal(type) {
                const modal = document.getElementById('documentModal');
                const modalTitle = document.getElementById('modalTitle');
                const modalContent = document.getElementById('modalContent');

                let documents = [];
                let title = '';

                modalTitle.textContent = title;
                modalContent.innerHTML = '';

                if (documents.length === 0) {
                    modalContent.innerHTML = '<p class="text-center text-gray-500">Belum ada dokumen tersedia</p>';
                } else {
                    documents.forEach(doc => {
                        const docElement = document.createElement('div');
                        docElement.className =
                            'flex items-center justify-between p-3 border border-gray-200 rounded-lg';
                        docElement.innerHTML = `
                            <div class="flex-1">
                                <h4 class="font-semibold text-secondary">${doc.title}</h4>
                                ${doc.description ? `<p class="text-sm text-gray-600">${doc.description}</p>` : ''}
                                <span class="text-xs text-gray-500">${doc.file_extension ? doc.file_extension.toUpperCase() : 'PDF'} - ${doc.file_size || '0 MB'}</span>
                            </div>
                            <div class="flex space-x-2">
                                <a href="/layanan/${doc.id}/download" class="text-white px-3 py-1 rounded text-sm hover:opacity-90" style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
                                    <i class="fas fa-download mr-1"></i>Unduh
                                </a>
                                ${(doc.file_extension && doc.file_extension.toLowerCase() === 'pdf') ? `
                                                                                                                                                                                                                                                                                                                                                    <a href="/layanan/${doc.id}/preview" target="_blank" class="bg-gray-100 text-gray-700 px-3 py-1 rounded text-sm hover:bg-gray-200">
                                                                                                                                                                                                                                                                                                                                                        <i class="fas fa-eye mr-1"></i>Lihat
                                                                                                                                                                                                                                                                                                                                                    </a>
                                                                                                                                                                                                                                                                                                                                                ` : ''}
                            </div>
                        `;
                        modalContent.appendChild(docElement);
                    });
                }

                modal.classList.remove('hidden');
            }

            function closeDocumentModal() {
                document.getElementById('documentModal').classList.add('hidden');
            }

            // Close modal when clicking outside
            document.getElementById('documentModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeDocumentModal();
                }
            });
        </script>
    @endpush

</x-layouts.app>
