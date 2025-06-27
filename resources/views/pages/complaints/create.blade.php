<x-layouts.app title="Pengaduan Online - Desa Bantengputih"
    description="Sampaikan aspirasi, keluhan, atau saran Anda untuk kemajuan Desa Banteng Putih. Kami siap mendengarkan dan menindaklanjuti setiap masukan dari masyarakat."
    keywords="pengaduan online, aspirasi masyarakat, keluhan desa, bantengputih">

    <!-- Hero Section -->
    <section class="py-16 lg:py-20" style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Pengaduan Online
            </h1>
            <p class="text-xl text-white opacity-90 max-w-3xl mx-auto">
                Sampaikan aspirasi, keluhan, atau saran Anda untuk kemajuan Desa Banteng Putih.
                Kami siap mendengarkan dan menindaklanjuti setiap masukan dari masyarakat.
            </p>
        </div>
    </section>

    <!-- Info Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">
                    Cara Menyampaikan Pengaduan
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Kami menyediakan beberapa cara untuk mempermudah masyarakat dalam menyampaikan pengaduan dan
                    aspirasi
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div
                    class="bg-white border-2 border-primary p-8 rounded-xl text-center shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6"
                        style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
                        <i class="fas fa-laptop text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-4">Online via WhatsApp</h3>
                    <p class="text-gray-600 mb-6">
                        Isi formulir pengaduan online yang akan langsung dikirim ke WhatsApp resmi desa
                    </p>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-clock mr-2" style="color: #4CAF50;"></i>Respon dalam 1x24 jam
                        </p>
                    </div>
                </div>

                <div
                    class="bg-white border-2 border-gray-200 p-8 rounded-xl text-center shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fab fa-whatsapp text-2xl text-green-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-4">WhatsApp Langsung</h3>
                    <p class="text-gray-600 mb-6">
                        Hubungi langsung melalui WhatsApp untuk pengaduan yang bersifat mendesak
                    </p>
                    <a href="https://wa.me/{{ $villageInfo?->phone }}" target="_blank"
                        class="inline-flex items-center bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors duration-200">
                        <i class="fab fa-whatsapp mr-2"></i>
                        Hubungi Sekarang
                    </a>
                </div>

                <div
                    class="bg-white border-2 border-gray-200 p-8 rounded-xl text-center shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-building text-2xl text-blue-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-4">Datang Langsung</h3>
                    <p class="text-gray-600 mb-6">
                        Kunjungi kantor desa untuk konsultasi langsung dengan petugas yang berwenang
                    </p>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-calendar mr-2" style="color: #4CAF50;"></i>Senin - Jumat, 08:00 - 16:00
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Complaint Form Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-8 text-white" style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
                    <h2 class="text-3xl font-bold mb-4">
                        <i class="fas fa-edit mr-3"></i>Formulir Pengaduan Online
                    </h2>
                    <p class="opacity-90">
                        Isi formulir berikut dengan lengkap dan jelas agar pengaduan Anda dapat ditindaklanjuti dengan
                        baik
                    </p>
                </div>

                <form method="POST" action="{{ route('complaints.submit') }}" class="p-8 space-y-6"
                    id="complaint-form">
                    @csrf

                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-exclamation-triangle text-red-500 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold text-red-800 mb-2">Terdapat kesalahan dalam form:</h4>
                                    <ul class="text-red-700 text-sm list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-gray-500">(Opsional)</span>
                        </label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200 @error('nama') border-red-300 @enderror"
                            placeholder='Masukkan nama lengkap atau beri "-" jika ingin merahasiakan nama' />
                        <p class="mt-1 text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            Beri "<strong>-</strong>" jika ingin merahasiakan nama Anda
                        </p>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori Pengaduan <span class="text-red-500">*</span>
                        </label>
                        <select id="kategori" name="kategori" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200 @error('kategori') border-red-300 @enderror">
                            <option value="">Pilih Kategori</option>
                            <option value="infrastruktur" {{ old('kategori') == 'infrastruktur' ? 'selected' : '' }}>
                                Infrastruktur</option>
                            <option value="pelayanan" {{ old('kategori') == 'pelayanan' ? 'selected' : '' }}>Pelayanan
                                Publik</option>
                            <option value="lingkungan" {{ old('kategori') == 'lingkungan' ? 'selected' : '' }}>
                                Lingkungan</option>
                            <option value="sosial" {{ old('kategori') == 'sosial' ? 'selected' : '' }}>Sosial
                                Kemasyarakatan</option>
                            <option value="ekonomi" {{ old('kategori') == 'ekonomi' ? 'selected' : '' }}>Ekonomi Desa
                            </option>
                            <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya
                            </option>
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Judul -->
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Pengaduan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="judul" name="judul" required value="{{ old('judul') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200 @error('judul') border-red-300 @enderror"
                            placeholder="Ringkasan singkat masalah yang dihadapi" />
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Isi Pengaduan -->
                    <div>
                        <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">
                            Isi Pengaduan <span class="text-red-500">*</span>
                        </label>
                        <textarea id="isi" name="isi" rows="6" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200 @error('isi') border-red-300 @enderror"
                            placeholder="Jelaskan secara detail masalah yang ingin Anda adukan, termasuk lokasi, waktu kejadian, dan dampak yang ditimbulkan...">{{ old('isi') }}</textarea>
                        @error('isi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- WhatsApp Notice -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-start space-x-3">
                            <i class="fab fa-whatsapp text-green-500 text-2xl mt-1"></i>
                            <div>
                                <h4 class="font-semibold text-green-800 mb-2">Pengaduan via WhatsApp</h4>
                                <p class="text-green-700 text-sm">
                                    Setelah Anda mengklik tombol "Kirim ke WhatsApp", form ini akan membuka WhatsApp
                                    di tab baru dengan pesan yang sudah terformat otomatis. Anda tinggal menekan tombol
                                    kirim di WhatsApp untuk mengirim pengaduan ke nomor resmi Desa Bantengputih.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="submit"
                            class="flex-1 text-white py-3 px-8 rounded-lg font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200"
                            style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
                            <i class="fab fa-whatsapp mr-2"></i>Kirim ke WhatsApp
                        </button>
                        <button type="reset"
                            class="flex-1 sm:flex-none bg-gray-100 text-gray-700 py-3 px-8 rounded-lg font-semibold hover:bg-gray-200 transition-colors duration-200">
                            <i class="fas fa-undo mr-2"></i>Reset Form
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">
                    Pertanyaan yang Sering Diajukan
                </h2>
                <p class="text-gray-600">
                    Temukan jawaban untuk pertanyaan umum seputar pengaduan online
                </p>
            </div>

            <div class="space-y-6">
                <div class="bg-gray-50 border border-gray-200 rounded-lg">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-100 transition-colors duration-200"
                        onclick="toggleFaq(1)">
                        <h3 class="font-semibold text-secondary">
                            Berapa lama waktu yang dibutuhkan untuk mendapat respons?
                        </h3>
                        <i class="fas fa-chevron-down transform transition-transform duration-200"
                            id="faq-icon-1"></i>
                    </button>
                    <div class="hidden px-6 pb-4" id="faq-content-1">
                        <p class="text-gray-600">
                            Kami berkomitmen memberikan respons awal dalam waktu maksimal 1x24 jam sejak pengaduan
                            diterima.
                            Untuk penanganan lebih lanjut, estimasi waktu akan disesuaikan dengan tingkat kompleksitas
                            masalah.
                        </p>
                    </div>
                </div>

                <div class="bg-gray-50 border border-gray-200 rounded-lg">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-100 transition-colors duration-200"
                        onclick="toggleFaq(2)">
                        <h3 class="font-semibold text-secondary">
                            Mengapa pengaduan dikirim melalui WhatsApp?
                        </h3>
                        <i class="fas fa-chevron-down transform transition-transform duration-200"
                            id="faq-icon-2"></i>
                    </button>
                    <div class="hidden px-6 pb-4" id="faq-content-2">
                        <p class="text-gray-600">
                            WhatsApp dipilih untuk mempermudah komunikasi dan follow-up pengaduan. Dengan WhatsApp,
                            Anda bisa mendapat respons lebih cepat dan dapat melakukan komunikasi dua arah dengan
                            petugas desa.
                        </p>
                    </div>
                </div>

                <div class="bg-gray-50 border border-gray-200 rounded-lg">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-100 transition-colors duration-200"
                        onclick="toggleFaq(3)">
                        <h3 class="font-semibold text-secondary">
                            Bisakah saya mengirim pengaduan tanpa mencantumkan nama?
                        </h3>
                        <i class="fas fa-chevron-down transform transition-transform duration-200"
                            id="faq-icon-3"></i>
                    </button>
                    <div class="hidden px-6 pb-4" id="faq-content-3">
                        <p class="text-gray-600">
                            Ya, Anda dapat mengirim pengaduan secara anonim. Cukup beri tanda "-" pada kolom nama
                            atau kosongkan kolom nama tersebut. Pengaduan anonim akan tetap kami proses dengan baik.
                        </p>
                    </div>
                </div>

                <div class="bg-gray-50 border border-gray-200 rounded-lg">
                    <button
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-100 transition-colors duration-200"
                        onclick="toggleFaq(4)">
                        <h3 class="font-semibold text-secondary">
                            Jenis pengaduan apa saja yang dapat disampaikan?
                        </h3>
                        <i class="fas fa-chevron-down transform transition-transform duration-200"
                            id="faq-icon-4"></i>
                    </button>
                    <div class="hidden px-6 pb-4" id="faq-content-4">
                        <p class="text-gray-600">
                            Berbagai jenis pengaduan dapat disampaikan, antara lain: masalah infrastruktur, pelayanan
                            publik,
                            lingkungan, sosial kemasyarakatan, ekonomi desa, dan masalah lainnya yang berkaitan dengan
                            penyelenggaraan pemerintahan desa.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Alternative Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">
                    Kontak Alternatif
                </h2>
                <p class="text-gray-600">
                    Hubungi kami melalui saluran komunikasi lainnya
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="bg-white p-8 rounded-xl shadow-lg text-center hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-phone text-2xl text-blue-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-4">Telepon</h3>
                    <p class="text-gray-600 mb-4">Hubungi langsung untuk urusan mendesak</p>
                    <a href="tel:+{{ $villageInfo?->phone }}"
                        class="font-semibold hover:underline transition-colors duration-200" style="color: #4CAF50;">
                        {{ $villageInfo?->phone ? '+62 ' . substr($villageInfo->phone, 2, 3) . ' ' . substr($villageInfo->phone, 5, 4) . ' ' . substr($villageInfo->phone, 9) : '-' }}</span>
                    </a>
                </div>

                <div
                    class="bg-white p-8 rounded-xl shadow-lg text-center hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-envelope text-2xl text-red-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-4">Email</h3>
                    <p class="text-gray-600 mb-4">Kirim email untuk pengaduan tertulis</p>
                    <a href="mailto:{{ $villageInfo?->email }}"
                        class="font-semibold hover:underline transition-colors duration-200" style="color: #4CAF50;">
                        {{ $villageInfo?->email }}
                    </a>
                </div>

                <div
                    class="bg-white p-8 rounded-xl shadow-lg text-center hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-map-marker-alt text-2xl text-gray-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondary mb-4">Kunjungi Kami</h3>
                    <p class="text-gray-600 mb-4">Datang langsung ke kantor desa</p>
                    <p class="font-semibold" style="color: #4CAF50;">
                        {{ $villageInfo?->address }}<br>
                        Senin - Jumat, 08:00 - 16:00
                    </p>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            function toggleFaq(index) {
                const content = document.getElementById(`faq-content-${index}`);
                const icon = document.getElementById(`faq-icon-${index}`);

                if (content.classList.contains('hidden')) {
                    content.classList.remove('hidden');
                    icon.classList.add('rotate-180');
                } else {
                    content.classList.add('hidden');
                    icon.classList.remove('rotate-180');
                }
            }

            document.getElementById('complaint-form').addEventListener('submit', function(e) {
                e.preventDefault();

                const kategori = document.getElementById('kategori').value;
                const judul = document.getElementById('judul').value.trim();
                const isi = document.getElementById('isi').value.trim();

                if (!kategori || !judul || !isi) {
                    alert('Mohon lengkapi semua field yang wajib diisi (*)');
                    return false;
                }

                const submitBtn = e.target.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                submitBtn.disabled = true;

                const formData = new FormData(this);

                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                                    'content') ||
                                document.querySelector('input[name="_token"]').value
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.open(data.whatsapp_url, '_blank');

                            alert('Pengaduan berhasil diproses! WhatsApp akan terbuka di tab baru.');

                            this.reset();
                        } else {
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    })
                    .finally(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    });
            });
        </script>
    @endpush

</x-layouts.app>
