<x-layouts.app :title="'Upload Foto & Video'" :description="'Bagikan foto atau video menarik tentang desa untuk memperkaya galeri dokumentasi Desa Bantengputih'" :keywords="'upload foto, upload video, desa bantengputih, galeri, dokumentasi'" :ogTitle="'Upload Foto & Video - Desa Bantengputih'" :ogDescription="'Bagikan foto atau video menarik tentang desa untuk memperkaya galeri dokumentasi Desa Bantengputih'"
    :ogImage="asset('images/og-upload.jpg')">

    <x-slot name="head">
        <!-- Page-specific structured data -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebPage",
            "name": "Upload Foto & Video",
            "description": "Bagikan foto atau video menarik tentang desa untuk memperkaya galeri dokumentasi Desa Bantengputih",
            "url": "{{ request()->url() }}"
        }
        </script>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    Berbagi Momen Bersama
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Punya foto atau video menarik tentang desa? Bagikan dengan kami untuk memperkaya galeri dokumentasi
                    Desa
                    Bantengputih
                </p>

                @if (isset($selectedType))
                    <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg inline-block">
                        <p class="text-blue-800 text-sm">
                            <i class="fas fa-info-circle mr-1"></i>
                            Anda akan mengirim: <strong>{{ $selectedType === 'photo' ? 'Foto' : 'Video' }}</strong>
                        </p>
                    </div>
                @endif
            </div>

            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Upload Form -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <form action="{{ route('guest.submit') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf

                    <!-- Guest Information -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Informasi Pengirim</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="name" name="name" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nomor Telepon
                                </label>
                                <input type="tel" id="phone" name="phone"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Content Information -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Informasi Konten</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                    Jenis Konten <span class="text-red-500">*</span>
                                </label>
                                <select id="type" name="type" required onchange="updateFileInput()"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <option value="">Pilih Jenis</option>
                                    <option value="photo"
                                        {{ old('type', $selectedType ?? '') === 'photo' ? 'selected' : '' }}>Foto
                                    </option>
                                    <option value="video"
                                        {{ old('type', $selectedType ?? '') === 'video' ? 'selected' : '' }}>Video
                                    </option>
                                </select>
                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <select id="category" name="category" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Kegiatan" {{ old('category') === 'Kegiatan' ? 'selected' : '' }}>
                                        Kegiatan</option>
                                    <option value="Infrastruktur"
                                        {{ old('category') === 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur
                                    </option>
                                    <option value="Alam" {{ old('category') === 'Alam' ? 'selected' : '' }}>Alam
                                    </option>
                                    <option value="Budaya" {{ old('category') === 'Budaya' ? 'selected' : '' }}>Budaya
                                    </option>
                                </select>
                                @error('category')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Judul <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                placeholder="Berikan judul yang menarik untuk foto/video Anda"
                                value="{{ old('title') }}">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi
                            </label>
                            <textarea id="description" name="description" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                placeholder="Ceritakan tentang foto/video ini...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Upload File</h3>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                            <div id="upload-area">
                                <div class="mb-4">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <p class="text-lg font-medium text-gray-900 mb-2">Pilih file untuk diupload</p>
                                <p class="text-sm text-gray-500 mb-4" id="file-info">
                                    @if (isset($selectedType))
                                        @if ($selectedType === 'photo')
                                            Format yang didukung: JPG, PNG, GIF, WEBP (Maks. 10MB)
                                        @else
                                            Format yang didukung: MP4, WEBM, MOV, AVI, WMV (Maks. 200MB)
                                        @endif
                                    @else
                                        Pilih jenis konten terlebih dahulu
                                    @endif
                                </p>
                                <input type="file" id="file" name="file" required class="hidden"
                                    onchange="previewFile(this)"
                                    @if (isset($selectedType)) @if ($selectedType === 'photo')
                                        accept="image/jpeg,image/png,image/gif,image/webp"
                                    @else
                                        accept="video/mp4,video/webm,video/mov,video/avi,video/wmv" @endif
                                    @endif>
                                <button type="button" onclick="document.getElementById('file').click()"
                                    class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark transition-colors">
                                    Pilih File
                                </button>
                            </div>

                            <!-- Preview Area -->
                            <div id="preview-area" class="hidden mt-6">
                                <div id="preview-content"></div>
                                <button type="button" onclick="removeFile()"
                                    class="mt-4 text-red-600 hover:text-red-800 text-sm">
                                    Hapus File
                                </button>
                            </div>
                        </div>
                        @error('file')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Terms -->
                    <div class="mb-8">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input type="checkbox" id="terms" name="terms" required
                                    class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="text-gray-700">
                                    Saya setuju bahwa foto/video yang saya kirim akan direview oleh admin dan dapat
                                    dipublikasikan di galeri Desa Bantengputih. <span class="text-red-500">*</span>
                                </label>
                                @error('terms')
                                    <p class="mt-1 text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" id="submitBtn"
                            class="bg-primary text-white px-8 py-3 rounded-lg font-medium hover:bg-primary-dark transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                            <span id="submitText">Kirim untuk Review</span>
                            <span id="loadingText" class="hidden">Mengupload...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Auto-initialize if type is pre-selected
            document.addEventListener('DOMContentLoaded', function() {
                @if (isset($selectedType))
                    updateFileInput();
                @endif
            });

            function updateFileInput() {
                const type = document.getElementById('type').value;
                const fileInput = document.getElementById('file');
                const fileInfo = document.getElementById('file-info');

                if (type === 'photo') {
                    fileInput.accept = 'image/jpeg,image/png,image/gif,image/webp';
                    fileInfo.textContent = 'Format yang didukung: JPG, PNG, GIF, WEBP (Maks. 10MB)';
                } else if (type === 'video') {
                    fileInput.accept = 'video/mp4,video/webm,video/mov,video/avi,video/wmv';
                    fileInfo.textContent = 'Format yang didukung: MP4, WEBM, MOV, AVI, WMV (Maks. 200MB)';
                } else {
                    fileInput.accept = '';
                    fileInfo.textContent = 'Pilih jenis konten terlebih dahulu';
                }

                // Reset file input
                fileInput.value = '';
                document.getElementById('preview-area').classList.add('hidden');
                document.getElementById('upload-area').classList.remove('hidden');
            }

            function previewFile(input) {
                const file = input.files[0];
                if (!file) return;

                const type = document.getElementById('type').value;
                const previewArea = document.getElementById('preview-area');
                const previewContent = document.getElementById('preview-content');
                const uploadArea = document.getElementById('upload-area');

                if (type === 'photo') {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewContent.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" class="max-w-full h-64 object-contain mx-auto rounded-lg">
                    <p class="mt-2 text-sm text-gray-600">${file.name} (${formatFileSize(file.size)})</p>
                `;
                    };
                    reader.readAsDataURL(file);
                } else if (type === 'video') {
                    previewContent.innerHTML = `
                <div class="bg-gray-100 rounded-lg p-4">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h6l2 2h6a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                    </svg>
                    <p class="text-sm text-gray-600">${file.name}</p>
                    <p class="text-xs text-gray-500">${formatFileSize(file.size)}</p>
                </div>
            `;
                }

                uploadArea.classList.add('hidden');
                previewArea.classList.remove('hidden');
            }

            function removeFile() {
                document.getElementById('file').value = '';
                document.getElementById('preview-area').classList.add('hidden');
                document.getElementById('upload-area').classList.remove('hidden');
            }

            function formatFileSize(bytes) {
                if (bytes >= 1073741824) {
                    return (bytes / 1073741824).toFixed(2) + ' GB';
                } else if (bytes >= 1048576) {
                    return (bytes / 1048576).toFixed(2) + ' MB';
                } else if (bytes >= 1024) {
                    return (bytes / 1024).toFixed(2) + ' KB';
                }
                return bytes + ' bytes';
            }

            // Handle form submission
            document.getElementById('uploadForm').addEventListener('submit', function() {
                const submitBtn = document.getElementById('submitBtn');
                const submitText = document.getElementById('submitText');
                const loadingText = document.getElementById('loadingText');

                submitBtn.disabled = true;
                submitText.classList.add('hidden');
                loadingText.classList.remove('hidden');
            });
        </script>
    @endpush

</x-layouts.app>
