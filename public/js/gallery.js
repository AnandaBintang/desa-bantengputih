// Function to show the selected gallery tab
function showGalleryTab(tab) {
    currentType = tab;

    // Hide all gallery content
    document.querySelectorAll('.gallery-content').forEach(content => {
        content.classList.add('hidden');
    });

    // Show selected gallery content
    const selectedContent = document.getElementById(`gallery-${tab}`);
    if (selectedContent) {
        selectedContent.classList.remove('hidden');
    }

    // Reset all tabs
    document.querySelectorAll('.gallery-tab-btn').forEach(btn => {
        btn.style.color = '#6B7280';
        btn.style.borderBottomColor = 'transparent';
        btn.classList.remove('text-green-500');
        btn.classList.add('text-gray-600');
    });

    // Activate selected tab
    const activeTab = document.getElementById(`${tab}-tab`);
    if (activeTab) {
        activeTab.style.color = '#4CAF50';
        activeTab.style.borderBottomColor = '#4CAF50';
        activeTab.classList.remove('text-gray-600');
        activeTab.classList.add('text-green-500');
    }
}

let currentPage = 1;
let currentType = 'photo';
let currentCategory = 'all';
let isLoading = false;

// Function to open photo lightbox
function openLightbox(src, title, description = '') {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDescription = document.getElementById('lightbox-description');

    if (lightbox && lightboxImage && lightboxTitle) {
        lightboxImage.src = src;
        lightboxImage.alt = title;
        lightboxTitle.textContent = title;
        if (lightboxDescription) {
            lightboxDescription.innerHTML = description;
        }
        lightbox.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
}

// Function to close photo lightbox
function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    if (lightbox) {
        lightbox.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
}

// Function to open video lightbox
function openVideoLightbox(videoSrc, title, description = '') {
    const videoLightbox = document.getElementById('video-lightbox');
    const lightboxVideo = document.getElementById('lightbox-video');
    const videoTitle = document.getElementById('video-lightbox-title');
    const videoDescription = document.getElementById('video-lightbox-description');

    if (videoLightbox && lightboxVideo && videoTitle) {
        // Set video sources
        const sources = lightboxVideo.querySelectorAll('source');
        sources[0].src = videoSrc; // MP4
        sources[1].src = videoSrc; // WebM (same for now)
        sources[2].src = videoSrc; // OGG (same for now)

        // Set poster (thumbnail)
        lightboxVideo.poster = '';

        // Load the video
        lightboxVideo.load();

        // Set title and description
        videoTitle.textContent = title;
        if (videoDescription) {
            videoDescription.innerHTML = description;
        }

        // Show lightbox
        videoLightbox.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');

        // Auto play after a short delay
        setTimeout(() => {
            lightboxVideo.play().catch(e => {
                console.log('Auto-play prevented:', e);
            });
        }, 500);
    }
}

// Function to close video lightbox
function closeVideoLightbox() {
    const videoLightbox = document.getElementById('video-lightbox');
    const lightboxVideo = document.getElementById('lightbox-video');

    if (videoLightbox && lightboxVideo) {
        // Pause and reset video
        lightboxVideo.pause();
        lightboxVideo.currentTime = 0;

        // Hide lightbox
        videoLightbox.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
}

// Function to load more content via AJAX
function loadMoreContent(type) {
    if (isLoading) return;

    isLoading = true;
    const button = document.querySelector(`[onclick="loadMoreContent('${type}')"]`);
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';
    button.disabled = true;

    fetch(`/gallery/load-more?type=${type}&category=${currentCategory}&page=${currentPage + 1}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.items && data.items.length > 0) {
            appendItems(data.items, type);
            currentPage = data.current_page;

            if (!data.has_more) {
                button.style.display = 'none';
            }
        }
    })
    .catch(error => {
        console.error('Error loading more content:', error);
        alert('Error loading content. Please try again.');
    })
    .finally(() => {
        isLoading = false;
        button.innerHTML = originalText;
        button.disabled = false;
    });
}

// Function to append new items to the grid
function appendItems(items, type) {
    const container = type === 'photo' ?
        document.getElementById('photo-grid') :
        document.querySelector('#gallery-video .grid');

    items.forEach(item => {
        const element = type === 'photo' ?
            createPhotoElement(item) :
            createVideoElement(item);
        container.appendChild(element);
    });
}

// Function to create photo element
function createPhotoElement(photo) {
    const div = document.createElement('div');
    div.className = 'photo-item group cursor-pointer';
    div.setAttribute('data-category', photo.category);
    div.onclick = () => openLightbox(photo.large_src, photo.title);

    div.innerHTML = `
        <div class="relative overflow-hidden rounded-lg shadow-lg bg-white">
            <img src="${photo.src}" alt="${photo.title}"
                 class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300" />
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-gray-800 mb-1">${photo.title}</h3>
                <p class="text-sm text-gray-600">${photo.description}</p>
            </div>
        </div>
    `;

    return div;
}

// Function to create video element
function createVideoElement(video) {
    const div = document.createElement('div');
    div.className = 'video-item bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300';

    div.innerHTML = `
        <div class="relative cursor-pointer" onclick="openVideoLightbox('${video.video_url}', '${video.title}', '${video.description}')">
            <img src="${video.thumbnail}" alt="${video.title}" class="w-full h-48 object-cover" />
            <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center group hover:bg-opacity-40 transition-all duration-200">
                <div class="bg-white bg-opacity-90 hover:bg-opacity-100 rounded-full w-16 h-16 flex items-center justify-center transition-all duration-200 group-hover:scale-110 shadow-lg">
                    <i class="fas fa-play text-2xl ml-1"
                       style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
                </div>
            </div>
            <div class="absolute bottom-2 right-2 bg-black bg-opacity-80 text-white px-2 py-1 rounded text-xs font-medium">
                ${video.duration}
            </div>
            <div class="absolute top-2 left-2 bg-red-600 text-white px-2 py-1 rounded text-xs font-medium">
                <i class="fas fa-video mr-1"></i>VIDEO
            </div>
        </div>
        <div class="p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">${video.title}</h3>
            <p class="text-gray-600 mb-4 line-clamp-3">${video.description}</p>
            <div class="flex items-center justify-between text-sm text-gray-500">
                <span><i class="fas fa-eye mr-1"></i>${video.views} views</span>
                <span><i class="fas fa-calendar mr-1"></i>${video.date}</span>
            </div>
        </div>
    `;

    return div;
}

// Update filter function to reset pagination
function filterPhotos(category) {
    currentCategory = category;
    currentPage = 1;

    // Show/hide photos based on category
    document.querySelectorAll('.photo-item').forEach(item => {
        const itemCategory = item.dataset.category;
        if (category === 'all' || itemCategory === category) {
            item.style.display = 'block';
            item.style.opacity = '0';
            setTimeout(() => {
                item.style.opacity = '1';
            }, 50);
        } else {
            item.style.display = 'none';
        }
    });

    // Update active category button
    document.querySelectorAll('.photo-filter-btn').forEach(btn => {
        btn.style.background = '';
        btn.style.boxShadow = '';
        btn.classList.remove('text-white', 'transform', 'scale-105');
        btn.classList.add('bg-gray-200', 'text-gray-700');
    });

    const activeBtn = document.querySelector(`[data-filter="${category}"]`);
    if (activeBtn) {
        activeBtn.style.background = 'linear-gradient(135deg, #4CAF50 0%, #45a049 100%)';
        activeBtn.style.boxShadow = '0 4px 15px rgba(76, 175, 80, 0.3)';
        activeBtn.classList.remove('bg-gray-200', 'text-gray-700');
        activeBtn.classList.add('text-white', 'transform', 'scale-105');
    }
}

// Initialize gallery when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize with photo tab active
    showGalleryTab('foto');

    // Initialize with all photos showing
    filterPhotos('all');

    // Add keyboard navigation for lightboxes
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
            closeVideoLightbox();
        }
    });

    // Add click outside to close lightboxes
    const lightbox = document.getElementById('lightbox');
    const videoLightbox = document.getElementById('video-lightbox');

    if (lightbox) {
        lightbox.addEventListener('click', function(e) {
            if (e.target === this) {
                closeLightbox();
            }
        });
    }

    if (videoLightbox) {
        videoLightbox.addEventListener('click', function(e) {
            if (e.target === this) {
                closeVideoLightbox();
            }
        });
    }
});

// Legacy function for backward compatibility
function playVideo(videoId) {
    // This function is kept for backward compatibility
    // The new implementation uses openVideoLightbox directly
    console.log('Playing video:', videoId);
}
