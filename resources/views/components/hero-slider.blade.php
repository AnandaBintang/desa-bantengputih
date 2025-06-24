@props(['slides' => []])

<section class="relative h-screen overflow-hidden">
    <div class="hero-slider relative w-full h-full" x-data="heroSlider()">
        @foreach ($slides as $index => $slide)
            <div class="slide absolute inset-0 transition-opacity duration-1000 ease-in-out"
                :class="{
                    'opacity-100 z-20': currentSlide === {{ $index }},
                    'opacity-0 z-10': currentSlide !==
                        {{ $index }}
                }">

                <img src="{{ $slide['image'] }}" alt="{{ $slide['alt'] }}" class="w-full h-full object-cover"
                    onerror="this.src='{{ $slide['fallback'] }}'">

                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                    <div class="text-center text-white max-w-4xl px-4">
                        <h1 class="text-4xl md:text-6xl font-bold mb-4 animate-fadeInUp">
                            {{ $slide['title'] }}
                        </h1>
                        <p class="text-lg md:text-xl mb-8 animate-fadeInUp animation-delay-300">
                            {{ $slide['subtitle'] }}
                        </p>
                        <div
                            class="flex flex-col sm:flex-row gap-4 justify-center animate-fadeInUp animation-delay-600">
                            @foreach ($slide['buttons'] as $button)
                                <a href="{{ $button['url'] }}" class="hero-btn {{ $button['class'] }}">
                                    <i class="{{ $button['icon'] }} mr-2"></i>{{ $button['text'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Navigation buttons -->
        <button @click="previousSlide()" class="nav-btn nav-btn-left" aria-label="Previous slide">
            <i class="fas fa-chevron-left text-xl"></i>
        </button>
        <button @click="nextSlide()" class="nav-btn nav-btn-right" aria-label="Next slide">
            <i class="fas fa-chevron-right text-xl"></i>
        </button>

        <!-- Dots indicator -->
        <div class="dots-container">
            @foreach ($slides as $index => $slide)
                <button @click="goToSlide({{ $index }})" class="dot"
                    :class="{ 'active': currentSlide === {{ $index }} }"
                    aria-label="Go to slide {{ $index + 1 }}">
                </button>
            @endforeach
        </div>
    </div>
</section>

<script>
    function heroSlider() {
        return {
            currentSlide: 0,
            totalSlides: {{ count($slides) }},
            autoplayInterval: null,

            init() {
                this.startAutoplay();
            },

            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                this.resetAutoplay();
            },

            previousSlide() {
                this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                this.resetAutoplay();
            },

            goToSlide(index) {
                this.currentSlide = index;
                this.resetAutoplay();
            },

            startAutoplay() {
                this.autoplayInterval = setInterval(() => {
                    this.nextSlide();
                }, 5000);
            },

            stopAutoplay() {
                if (this.autoplayInterval) {
                    clearInterval(this.autoplayInterval);
                }
            },

            resetAutoplay() {
                this.stopAutoplay();
                this.startAutoplay();
            }
        }
    }
</script>
