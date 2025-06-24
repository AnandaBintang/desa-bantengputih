<x-layouts.app :title="$title" :description="$description" :keywords="$keywords" :ogTitle="$ogTitle" :ogDescription="$ogDescription"
    :ogImage="$ogImage">

    <x-slot name="head">
        <!-- Page-specific structured data -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebPage",
            "name": "{{ $title }}",
            "description": "{{ $description }}",
            "url": "{{ request()->url() }}",
            "mainEntity": {
                "@type": "GovernmentOrganization",
                "name": "Pemerintah Desa Bantengputih",
                "address": {
                    "@type": "PostalAddress",
                    "addressLocality": "Karanggeneng",
                    "addressRegion": "Lamongan",
                    "addressCountry": "ID"
                }
            }
        }
        </script>

        <style>
            /* Custom animations */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fadeInUp {
                animation: fadeInUp 1s ease-out;
            }

            .animation-delay-300 {
                animation-delay: 0.3s;
                animation-fill-mode: both;
            }

            .animation-delay-600 {
                animation-delay: 0.6s;
                animation-fill-mode: both;
            }

            /* Hero button styles */
            .hero-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 12px 32px;
                border-radius: 8px;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.3s ease;
                transform: translateY(0);
            }

            .hero-btn:hover {
                transform: translateY(-2px) scale(1.05);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            }

            .hero-btn-primary {
                background-color: #4CAF50;
                color: white;
            }

            .hero-btn-primary:hover {
                background-color: #45a049;
            }

            .hero-btn-outline {
                border: 2px solid white;
                color: white;
                background-color: transparent;
            }

            .hero-btn-outline:hover {
                background-color: white;
                color: #4CAF50;
            }

            /* Navigation buttons */
            .nav-btn {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background-color: rgba(255, 255, 255, 0.2);
                backdrop-filter: blur(10px);
                color: white;
                border: none;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s ease;
                z-index: 30;
            }

            .nav-btn:hover {
                background-color: rgba(255, 255, 255, 0.3);
                transform: translateY(-50%) scale(1.1);
            }

            .nav-btn-left {
                left: 20px;
            }

            .nav-btn-right {
                right: 20px;
            }

            /* Dots */
            .dots-container {
                position: absolute;
                bottom: 30px;
                left: 50%;
                transform: translateX(-50%);
                display: flex;
                gap: 12px;
                z-index: 30;
            }

            .dot {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background-color: rgba(255, 255, 255, 0.5);
                border: none;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .dot:hover {
                background-color: rgba(255, 255, 255, 0.8);
                transform: scale(1.2);
            }

            .dot.active {
                background-color: white;
                transform: scale(1.3);
            }
        </style>
    </x-slot>

    <!-- Hero Slider with semantic HTML -->
    <section aria-label="Hero slider showcasing Desa Bantengputih">
        <x-hero-slider :slides="$heroSlides" />
    </section>

    <!-- Welcome Section -->
    <section aria-label="Welcome to Desa Bantengputih">
        <x-welcome-section />
    </section>

    <!-- Stats Section -->
    <section aria-label="Village statistics">
        <x-stats-section :stats="$stats" />
    </section>

    <!-- Features Section -->
    <section aria-label="Featured services">
        <x-features-section />
    </section>

    <!-- News Preview Section -->
    <section aria-label="Latest news from the village">
        <x-news-preview :news="$latestNews" />
    </section>
</x-layouts.app>
