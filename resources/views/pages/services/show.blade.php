<x-layouts.app :title="$document->title . ' - Desa Bantengputih'" :description="$document->description ?? 'Dokumen layanan Desa Bantengputih'" keywords="dokumen, layanan, bantengputih">

    <main class="pt-16">
        <!-- Breadcrumb -->
        <section class="py-6 bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('home') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary">
                                <i class="fas fa-home mr-2"></i>Beranda
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <a href="{{ route('services') }}"
                                    class="text-sm font-medium text-gray-700 hover:text-primary">Layanan</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <span
                                    class="text-sm font-medium text-gray-500">{{ Str::limit($document->title, 50) }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </section>

        <!-- Document Detail -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <div class="text-center mb-8">
                        <div
                            class="bg-primary p-4 rounded-full w-20 h-20 mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-file-alt text-3xl text-white"></i>
                        </div>
                        <h1 class="text-3xl font-bold text-secondary mb-4">{{ $document->title }}</h1>

                        <div class="flex justify-center items-center space-x-6 text-sm text-gray-600 mb-6">
                            <div class="flex items-center">
                                <i class="fas fa-tag mr-2"></i>
                                <span>{{ $document->type }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-file mr-2"></i>
                                <span>{{ strtoupper($document->file_extension) }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-hdd mr-2"></i>
                                <span>{{ $document->file_size }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar mr-2"></i>
                                <span>{{ $document->uploaded_at ? $document->uploaded_at->format('d M Y') : $document->created_at->format('d M Y') }}</span>
                            </div>
                        </div>

                        @if ($document->description)
                            <p class="text-gray-700 mb-8">{{ $document->description }}</p>
                        @endif

                        <div class="flex justify-center space-x-4">
                            <a href="{{ route('services.download', $document) }}"
                                class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-accent transition-colors duration-200">
                                <i class="fas fa-download mr-2"></i>Unduh Dokumen
                            </a>

                            @if ($document->isPdf())
                                <a href="{{ route('services.preview', $document) }}" target="_blank"
                                    class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition-colors duration-200">
                                    <i class="fas fa-eye mr-2"></i>Lihat Preview
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="mt-8 text-center">
                    <a href="{{ route('services') }}"
                        class="inline-flex items-center text-primary hover:text-accent font-semibold">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Layanan
                    </a>
                </div>
            </div>
        </section>
    </main>

</x-layouts.app>
