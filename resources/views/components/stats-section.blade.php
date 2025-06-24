@props(['stats' => []])

<section class="py-20 bg-gradient-to-r from-green-600 to-green-700"
    style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-white text-center mb-12">
            Desa Bantengputih dalam Angka
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8" id="stats-container">
            @foreach ($stats as $index => $stat)
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-xl p-8 text-center transform hover:scale-105 transition-all duration-300 stat-card"
                    data-target="{{ $stat['value'] }}" data-index="{{ $index }}">
                    <div
                        class="bg-white bg-opacity-20 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="{{ $stat['icon'] }} text-2xl text-white"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-2 counter" data-target="{{ $stat['value'] }}">
                        0
                    </h3>
                    <p class="text-white opacity-90">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Counter animation for stats
        function animateCounters() {
            const counters = document.querySelectorAll('.counter');

            counters.forEach(counter => {
                const target = parseFloat(counter.getAttribute('data-target'));
                const speed = 2000; // Duration in milliseconds
                const increment = target / (speed / 16); // 60fps
                let count = 0;

                const updateCounter = () => {
                    if (count < target) {
                        count += increment;
                        if (count > target) count = target;

                        // Handle decimal numbers (like 179.01)
                        if (target % 1 !== 0) {
                            counter.innerText = count.toFixed(2);
                        } else {
                            counter.innerText = Math.floor(count).toLocaleString();
                        }

                        requestAnimationFrame(updateCounter);
                    } else {
                        // Final value
                        if (target % 1 !== 0) {
                            counter.innerText = target.toFixed(2);
                        } else {
                            counter.innerText = target.toLocaleString();
                        }
                    }
                };

                updateCounter();
            });
        }

        // Intersection Observer to trigger animation when stats come into view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target); // Only animate once
                }
            });
        }, {
            threshold: 0.5 // Trigger when 50% of the element is visible
        });

        // Observe the stats container
        const statsContainer = document.getElementById('stats-container');
        if (statsContainer) {
            observer.observe(statsContainer);
        }
    });
</script>
