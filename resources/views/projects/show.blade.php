<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Back Button - Conditional based on authentication -->
            <div class="mb-6">
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-400 hover:text-white transition group">
                        <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Dashboard
                    </a>
                @else
                    <a href="{{ url('/portfolio') }}" class="inline-flex items-center text-gray-400 hover:text-white transition group">
                        <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Portfolio
                    </a>
                @endauth
            </div>

            <!-- Project Card -->
            <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
                
                <!-- Hero Image Section -->
                <div class="relative h-96 md:h-[500px] overflow-hidden">
                    @if($project->image)
                        <img src="{{ asset($project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center">
                            <svg class="w-32 h-32 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent"></div>
                    
                    <!-- Title, Status Badge, and Buttons -->
                    <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
                        <div class="flex items-center justify-between gap-4 flex-wrap">
                            <div class="flex items-center gap-3 flex-wrap">
                                <h1 class="text-3xl md:text-5xl font-bold text-white drop-shadow-lg">{{ $project->title }}</h1>
                                
                                @if($project->status === 'deployed')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-black/60 backdrop-blur-sm text-green-400 border border-green-400/30 shadow-lg">
                                        <span class="w-2 h-2 bg-green-400 rounded-full mr-1.5 animate-pulse"></span>
                                        Deployed
                                    </span>
                                @elseif($project->status === 'in_progress')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-black/60 backdrop-blur-sm text-yellow-400 border border-yellow-400/30 shadow-lg">
                                        <span class="w-2 h-2 bg-yellow-400 rounded-full mr-1.5"></span>
                                        In Progress
                                    </span>
                                @elseif($project->status === 'learning')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-black/60 backdrop-blur-sm text-blue-400 border border-blue-400/30 shadow-lg">
                                        <span class="w-2 h-2 bg-blue-400 rounded-full mr-1.5"></span>
                                        Learning
                                    </span>
                                @elseif($project->status === 'on_hold')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-black/60 backdrop-blur-sm text-gray-400 border border-gray-400/30 shadow-lg">
                                        <span class="w-2 h-2 bg-gray-400 rounded-full mr-1.5"></span>
                                        On Hold
                                    </span>
                                @elseif($project->status === 'archived')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-black/60 backdrop-blur-sm text-gray-500 border border-gray-500/30 shadow-lg">
                                        <span class="w-2 h-2 bg-gray-500 rounded-full mr-1.5"></span>
                                        Archived
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-black/60 backdrop-blur-sm text-blue-400 border border-blue-400/30 shadow-lg">
                                        <span class="w-2 h-2 bg-blue-400 rounded-full mr-1.5"></span>
                                        Learning
                                    </span>
                                @endif
                            </div>
                            
                            <div class="flex items-center gap-3">
                                @if($project->demo_link && $project->demo_link !== '#' && $project->demo_link !== '')
                                    <a href="{{ $project->demo_link }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-5 py-2.5 bg-red-600 hover:bg-red-700 rounded-lg text-white font-medium transition transform hover:scale-105 shadow-lg">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                        Live Demo
                                    </a>
                                @endif
                                
                                @if($project->github_link && $project->github_link !== '#' && $project->github_link !== '')
                                    <a href="{{ $project->github_link }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-5 py-2.5 bg-gray-900 border border-white hover:bg-gray-600 rounded-lg text-white font-medium transition transform hover:scale-105 shadow-lg">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path>
                                        </svg>
                                        GitHub
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Section -->
                <div class="p-6 md:p-8">
                    
                    <!-- Description -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold text-white mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            Description
                        </h2>
                        <div class="text-gray-300 leading-relaxed text-justify">
                            {{ trim($project->description) }}
                        </div>
                    </div>

                    <!-- Technologies Used -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold text-white mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Technologies Used
                        </h2>
                        <div class="flex flex-wrap gap-2">
                            @forelse($project->skills as $skill)
                                <span class="px-3 py-1.5 bg-gray-700 text-gray-300 rounded-full text-sm font-medium hover:bg-red-500/20 hover:text-red-400 transition">
                                    {{ $skill->name }}
                                </span>
                            @empty
                                <p class="text-gray-400">No technologies listed</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- ========== PROJECT SCREENSHOTS SECTION ========== -->
                    @if($project->screenshots && $project->screenshots->count() > 0)
                        @php
                            $totalImages = $project->screenshots->count();

                            /**
                             * Explicit grid placement: [col-start, row-start, col-span, row-span]
                             * 4-column grid. Every cell is accounted for — zero gaps by design.
                             */
                            $layouts = [
                                1 => [
                                    [1, 1, 4, 2],
                                ],
                                2 => [
                                    [1, 1, 2, 1],
                                    [3, 1, 2, 1],
                                ],
                                3 => [
                                    [1, 1, 2, 2],
                                    [3, 1, 2, 1],
                                    [3, 2, 2, 1],
                                ],
                                4 => [
                                    [1, 1, 1, 1],
                                    [2, 1, 1, 1],
                                    [3, 1, 1, 1],
                                    [4, 1, 1, 1],
                                ],
                                5 => [
                                    [1, 1, 2, 2],
                                    [3, 1, 1, 1],
                                    [4, 1, 1, 1],
                                    [3, 2, 1, 1],
                                    [4, 2, 1, 1],
                                ],
                                6 => [
                                    [1, 1, 2, 2],
                                    [3, 1, 1, 1],
                                    [4, 1, 1, 1],
                                    [3, 2, 1, 1],
                                    [4, 2, 1, 1],
                                    [1, 3, 4, 1],
                                ],
                                7 => [
                                    [1, 1, 2, 2],
                                    [3, 1, 1, 1],
                                    [4, 1, 1, 1],
                                    [3, 2, 1, 1],
                                    [4, 2, 1, 1],
                                    [1, 3, 2, 1],
                                    [3, 3, 2, 1],
                                ],
                                8 => [
                                    [1, 1, 2, 2],
                                    [3, 1, 1, 1],
                                    [4, 1, 1, 1],
                                    [3, 2, 1, 1],
                                    [4, 2, 1, 1],
                                    [1, 3, 1, 1],
                                    [2, 3, 1, 1],
                                    [3, 3, 2, 1],
                                ],
                                9 => [
                                    [1, 1, 2, 2],
                                    [3, 1, 1, 1],
                                    [4, 1, 1, 1],
                                    [3, 2, 1, 1],
                                    [4, 2, 1, 1],
                                    [1, 3, 1, 1],
                                    [2, 3, 1, 1],
                                    [3, 3, 1, 1],
                                    [4, 3, 1, 1],
                                ],
                                10 => [
                                    [1, 1, 2, 2],
                                    [3, 1, 1, 1],
                                    [4, 1, 1, 1],
                                    [3, 2, 1, 1],
                                    [4, 2, 1, 1],
                                    [1, 3, 1, 1],
                                    [2, 3, 1, 1],
                                    [3, 3, 1, 1],
                                    [4, 3, 1, 1],
                                    [1, 4, 4, 1],
                                ],
                            ];

                            if ($totalImages > 10) {
                                $layout = $layouts[10];
                                $row = 5;
                                $col = 1;
                                for ($i = 10; $i < $totalImages; $i++) {
                                    $layout[] = [$col, $row, 1, 1];
                                    $col++;
                                    if ($col > 4) {
                                        $col = 1;
                                        $row++;
                                    }
                                }
                                // Stretch last item to fill its row
                                $last = count($layout) - 1;
                                $layout[$last][2] = 5 - $layout[$last][0];
                            } else {
                                $layout = $layouts[$totalImages] ?? $layouts[9];
                            }
                        @endphp
                        
                        <div class="mb-8">
                            <h2 class="text-2xl font-semibold text-white mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Project Gallery
                                <span class="ml-2 text-sm text-gray-400">({{ $totalImages }} photos)</span>
                            </h2>
                            
                            <style>
                                .bento-grid {
                                    display: grid;
                                    grid-template-columns: repeat(4, 1fr);
                                    gap: 1rem;
                                }

                                .bento-item {
                                    position: relative;
                                    cursor: pointer;
                                    overflow: hidden;
                                    border-radius: 0.75rem;
                                    transition: transform 0.3s ease;
                                    min-height: 180px;
                                    border: 2px solid rgba(255, 255, 255, 0.2);
                                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                                }

                                .bento-item:hover {
                                    border-color: #ef4444;
                                    transform: translateY(-4px);
                                    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
                                }

                                .bento-item img {
                                    width: 100%;
                                    height: 100%;
                                    object-fit: cover;
                                    transition: transform 0.5s ease;
                                    display: block;
                                }

                                .bento-item:hover img {
                                    transform: scale(1.05);
                                }

                                /* Lightbox border styles */
                                .lightbox-border-wrapper {
                                    display: inline-block;
                                    border-radius: 0.75rem;
                                    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
                                }

                                .lightbox-image {
                                    display: block;
                                    border-radius: 0.65rem;
                                    border: 2px solid rgba(255, 255, 255, 0.1);
                                }

                                @keyframes borderPulse {
                                    0%, 100% {
                                        border-color: rgba(239, 68, 68, 0.3);
                                    }
                                    50% {
                                        border-color: rgba(239, 68, 68, 0.8);
                                    }
                                }

                                /* .lightbox-border-wrapper:hover .lightbox-image {
                                    animation: borderPulse 2s infinite;
                                } */

                                @media (max-width: 768px) {
                                    .bento-grid {
                                        grid-template-columns: repeat(2, 1fr);
                                        gap: 0.75rem;
                                    }

                                    .bento-item {
                                        grid-column: span 1 !important;
                                        grid-row: span 1 !important;
                                        min-height: 140px;
                                    }

                                    .bento-item:last-child {
                                        grid-column: 1 / -1 !important;
                                        grid-row: span 1 !important;
                                    }
                                }
                            </style>
                            
                            <div class="bento-grid">
                                @foreach($project->screenshots as $index => $screenshot)
                                    @php
                                        $pos = $layout[$index] ?? [1, 'auto', 1, 1];
                                        [$colStart, $rowStart, $colSpan, $rowSpan] = $pos;
                                        $gridStyle = "grid-column: {$colStart} / span {$colSpan}; grid-row: {$rowStart} / span {$rowSpan};";
                                    @endphp

                                    <div class="bento-item group"
                                         style="{{ $gridStyle }}"
                                         data-index="{{ $index }}"
                                         onclick="openLightbox('{{ asset($screenshot->image) }}', '{{ $project->title }}', {{ $index }})">

                                        <img src="{{ asset($screenshot->image) }}"
                                             alt="Screenshot {{ $loop->iteration }} of {{ $project->title }}"
                                             loading="lazy">

                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
                                            <div class="absolute bottom-0 left-0 right-0 p-3">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-white text-xs font-medium bg-black/50 px-2 py-1 rounded-full backdrop-blur-sm">
                                                        {{ $loop->iteration }} / {{ $totalImages }}
                                                    </span>
                                                    <svg class="w-5 h-5 text-white bg-black/50 rounded-full p-1 backdrop-blur-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="text-center mt-4 text-xs text-gray-500">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                                </svg>
                                Click any image to view full size
                            </div>
                        </div>
                    @endif

                    <!-- Project Metadata -->
                    <div class="border-t border-gray-700 pt-6">
                        <div class="flex flex-wrap gap-6 text-sm text-gray-400">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Last Updated: {{ $project->updated_at->format('F j, Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 bg-black/95 hidden items-center justify-center z-50" onclick="closeLightbox()">
        <div class="relative max-w-7xl mx-4" onclick="event.stopPropagation()">
            <div class="lightbox-border-wrapper">
                <img id="lightboxImage" src="" alt="" class="lightbox-image max-h-[85vh] w-auto shadow-2xl">
            </div>
            <p id="lightboxCaption" class="text-center text-gray-400 mt-4"></p>
            
            <!-- Navigation Arrows -->
            <button onclick="previousImage()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button onclick="nextImage()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </div>

    <script>
      
        window.screenshots = [];

        window.currentImageIndex = window.currentImageIndex || 0;

        @foreach($project->screenshots as $index => $screenshot)
            window.screenshots.push('{{ asset($screenshot->image) }}');
        @endforeach

        function openLightbox(imageUrl, title, index = 0) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightboxImage');
            const lightboxCaption = document.getElementById('lightboxCaption');

            window.currentImageIndex = index;
            lightboxImage.src = imageUrl;
            lightboxCaption.textContent = `${index + 1} of ${screenshots.length} — Use arrow keys or click arrows to navigate`;
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = '';
        }

        function previousImage() {
            if (window.screenshots.length === 0) return;
            window.currentImageIndex = (window.currentImageIndex - 1 + window.screenshots.length) % window.screenshots.length;
            updateLightboxImage();
        }

        function nextImage() {
            if (window.screenshots.length === 0) return;
            window.currentImageIndex = (window.currentImageIndex + 1) % window.screenshots.length;
            updateLightboxImage();
        }

        function updateLightboxImage() {
            const lightboxImage = document.getElementById('lightboxImage');
            const lightboxCaption = document.getElementById('lightboxCaption');
            
            lightboxImage.src = window.screenshots[window.currentImageIndex];
            lightboxCaption.textContent = `${window.currentImageIndex + 1} of ${window.screenshots.length} — Use arrow keys or click arrows to navigate`;
        }

        document.addEventListener('keydown', function(e) {
            const lightbox = document.getElementById('lightbox');
            if (lightbox && lightbox.classList.contains('flex')) {
                if (e.key === 'Escape') {
                    closeLightbox();
                } else if (e.key === 'ArrowLeft') {
                    previousImage();
                } else if (e.key === 'ArrowRight') {
                    nextImage();
                }
            }
        });
    </script>

    <style>
        .group img { transition: all 0.3s ease; }
    </style>
</x-app-layout>