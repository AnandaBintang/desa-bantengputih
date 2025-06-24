@props(['profileData', 'visionMissionData', 'governmentData', 'mapData'])

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Tab Navigation -->
        <div class="mb-12">
            <div class="overflow-x-auto">
                <div class="flex justify-center min-w-max border-b border-gray-200 px-4">
                    <button onclick="showTab('profil')"
                        class="tab-btn px-6 py-3 mx-2 mb-4 font-semibold text-primary border-b-2 border-primary transition-colors duration-300 whitespace-nowrap"
                        id="profil-tab">
                        <i class="fas fa-info-circle mr-2"></i>Profil Desa
                    </button>
                    <button onclick="showTab('visi-misi')"
                        class="tab-btn px-6 py-3 mx-2 mb-4 font-semibold text-gray-600 hover:text-primary transition-colors duration-300 whitespace-nowrap"
                        id="visi-misi-tab">
                        <i class="fas fa-eye mr-2"></i>Visi & Misi
                    </button>
                    <button onclick="showTab('pemerintahan')"
                        class="tab-btn px-6 py-3 mx-2 mb-4 font-semibold text-gray-600 hover:text-primary transition-colors duration-300 whitespace-nowrap"
                        id="pemerintahan-tab">
                        <i class="fas fa-users mr-2"></i>Pemerintahan
                    </button>
                    <button onclick="showTab('peta')"
                        class="tab-btn px-6 py-3 mx-2 mb-4 font-semibold text-gray-600 hover:text-primary transition-colors duration-300 whitespace-nowrap"
                        id="peta-tab">
                        <i class="fas fa-map-marker-alt mr-2"></i>Peta Desa
                    </button>
                </div>
            </div>
        </div>

        <!-- Tab Content -->
        <div id="profil" class="tab-content">
            <x-profile-tab :data="$profileData" />
        </div>

        <div id="visi-misi" class="tab-content hidden">
            <x-vision-mission-tab :data="$visionMissionData" />
        </div>

        <div id="pemerintahan" class="tab-content hidden">
            <x-government-tab :data="$governmentData" />
        </div>

        <div id="peta" class="tab-content hidden">
            <x-map-tab :data="$mapData" />
        </div>
    </div>
</section>

<script>
    // Tab functionality
    function showTab(tabName) {
        // Hide all tab contents
        const tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(content => {
            content.classList.add('hidden');
        });

        // Remove active class from all tab buttons
        const tabButtons = document.querySelectorAll('.tab-btn');
        tabButtons.forEach(button => {
            button.classList.remove('text-primary', 'border-b-2', 'border-primary');
            button.classList.add('text-gray-600');
        });

        // Show selected tab content
        document.getElementById(tabName).classList.remove('hidden');

        // Add active class to selected tab button
        const activeButton = document.getElementById(tabName + '-tab');
        activeButton.classList.remove('text-gray-600');
        activeButton.classList.add('text-primary', 'border-b-2', 'border-primary');
    }
</script>
