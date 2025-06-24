<!-- Photo Lightbox -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 hidden">
    <div class="relative max-w-4xl max-h-full mx-4">
        <button onclick="closeLightbox()"
            class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300 z-10 bg-black bg-opacity-50 rounded-full w-10 h-10 flex items-center justify-center">
            <i class="fas fa-times"></i>
        </button>
        <img id="lightbox-image" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
        <div
            class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent text-white p-6 rounded-b-lg">
            <h3 id="lightbox-title" class="text-xl font-semibold mb-2"></h3>
            <div id="lightbox-description" class="text-gray-300"></div>
        </div>
    </div>
</div>

<!-- Video Lightbox -->
<div id="video-lightbox" class="fixed inset-0 bg-black bg-opacity-95 flex items-center justify-center z-50 hidden">
    <div class="relative w-full max-w-5xl mx-4">
        <button onclick="closeVideoLightbox()"
            class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300 z-10 bg-black bg-opacity-50 rounded-full w-12 h-12 flex items-center justify-center">
            <i class="fas fa-times"></i>
        </button>

        <!-- Video Player Container -->
        <div class="relative bg-black rounded-lg overflow-hidden">
            <video id="lightbox-video" class="w-full h-auto max-h-screen" controls preload="metadata" poster="">
                <source src="" type="video/mp4">
                <source src="" type="video/webm">
                <source src="" type="video/ogg">
                Browser anda tidak mendukung video.
            </video>
        </div>

        <!-- Video Info -->
        <div class="bg-white p-6 rounded-b-lg">
            <h3 id="video-lightbox-title" class="text-2xl font-bold text-gray-800 mb-2"></h3>
            <p id="video-lightbox-description" class="text-gray-600"></p>
        </div>
    </div>
</div>

<script>
    function openLightbox(src, title, description = '') {
        document.getElementById('lightbox-image').src = src;
        document.getElementById('lightbox-image').alt = title;
        document.getElementById('lightbox-title').textContent = title;
        document.getElementById('lightbox').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Close lightbox on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });

    // Close lightbox on background click
    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLightbox();
        }
    });
</script>
