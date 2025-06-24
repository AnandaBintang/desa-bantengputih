<x-layouts.app :title="$title" :description="$description" :keywords="$keywords" :ogTitle="$ogTitle" :ogDescription="$ogDescription"
    :ogImage="$ogImage">

    <x-slot name="head">
        <!-- Page-specific structured data -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "AboutPage",
            "name": "{{ $title }}",
            "description": "{{ $description }}",
            "url": "{{ request()->url() }}",
            "mainEntity": {
                "@type": "GovernmentOrganization",
                "name": "Pemerintah Desa Bantengputih",
                "leader": {
                    "@type": "Person",
                    "name": "Musthofa",
                    "jobTitle": "Kepala Desa"
                },
                "address": {
                    "@type": "PostalAddress",
                    "addressLocality": "Karanggeneng",
                    "addressRegion": "Lamongan",
                    "addressCountry": "ID"
                }
            }
        }
        </script>
    </x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r py-16 lg:py-20"
        style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Tentang Desa Bantengputih
            </h1>
            <p class="text-xl text-white opacity-90 max-w-3xl mx-auto">
                Mengenal lebih dekat sejarah, visi misi, dan struktur pemerintahan Desa Bantengputih yang terus
                berkembang menuju kemajuan
            </p>
        </div>
    </section>

    <!-- Tabs Section -->
    <x-about-tabs :profileData="$profileData" :visionMissionData="$visionMissionData" :governmentData="$governmentData" :mapData="$mapData" />
</x-layouts.app>
