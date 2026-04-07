<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="turbo-cache-control" content="no-cache">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Blinking animation for deployed badge -->
        <style>
            @keyframes pulse {
                0%, 100% {
                    opacity: 1;
                }
                50% {
                    opacity: 0.5;
                }
            }
            .animate-pulse {
                animation: pulse 1.5s ease-in-out infinite;
            }
            
            /* Turbo Progress Bar */
            .turbo-progress-bar {
                height: 3px;
                background-color: #ef4444;
            }

            /* Hover transition for contact links */
            .contact-link {
                transition: all 0.2s ease;
            }
        </style>
    </head>
    <body class="bg-gray-900 text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        
        <div class="flex items-center justify-center w-full lg:grow">
            <main class="flex max-w-[1200px] w-full flex-col-reverse lg:max-w-6xl lg:flex-row">
                <div class="w-full">
                    
                    <!-- ========== WELCOME SECTION ========== -->
                    <div x-data="window.profileComponent()" x-init="fetchProfile()" class="text-center mb-12">
                        <div class="inline-block px-4 py-1 mb-4 text-sm font-medium text-[#f53003] dark:text-[#FF4433] bg-[#f53003]/10 dark:bg-[#FF4433]/10 rounded-full">
                            Welcome to my portfolio
                        </div>
                        
                        <div class="flex justify-center mb-6">
                            <div class="w-32 h-32 md:w-36 md:h-36 overflow-hidden rounded-full border-4 border-[#f53003] dark:border-[#FF4433] shadow-lg">
                                <template x-if="profile && profile.avatar">
                                    <img :src="profile.avatar" 
                                        alt="Lito Arthon R. Godito" 
                                        class="w-full h-full object-cover">
                                </template>
                                <template x-if="!profile || !profile.avatar">
                                    <img src="/profilepicc-removebg-preview.png" 
                                        alt="Lito Arthon R. Godito" 
                                        class="w-full h-full object-cover">
                                </template>
                            </div>
                        </div>
                        
                        <div>
                            <h1 class="text-4xl lg:text-5xl font-bold mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">
                                Hi, I am <br> 
                                <span class="bg-gradient-to-r from-[#f53003] to-[#FF6B4A] bg-clip-text text-transparent">
                                    Lito Arthon R. Godito
                                </span>
                            </h1>
                            <p class="text-xl text-[#706f6c] dark:text-[#A1A09A] mb-4" x-text="profile ? (profile.tagline || '') : 'Loading...'"></p>
                        </div>
                        
                        <div class="flex justify-center">
                            <p class="text-[#1b1b18] dark:text-[#EDEDEC] max-w-3xl text-justify leading-relaxed" x-text="profile ? (profile.bio || '') : 'Loading...'"></p>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-700 my-12"></div>

                    <!-- ========== SKILLS SECTION ========== -->
                    <div x-data="window.skillsComponent()" x-init="fetchSkills()" class="skills-section mb-12">
                        <h2 class="text-2xl font-semibold mb-6 text-left text-[#1b1b18] dark:text-[#EDEDEC]">💻 Technologies & Skills</h2>
                        
                        <!-- No Data State -->
                        <div x-show="skills.length === 0" class="text-center py-16">
                            <div class="text-5xl mb-4 opacity-50">📚</div>
                            <p class="text-xl font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">No skills yet</p>
                            <p class="text-[#706f6c] dark:text-[#A1A09A]">Skills and technologies will be showcased here soon.</p>
                        </div>
                        
                        <!-- Skills Grid -->
                        <div x-show="skills.length > 0">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <template x-for="skill in skills" :key="skill.id">
                                    <div class="p-4 rounded-xl hover:bg-gray-800/30 transition-all duration-300">
                                        <div class="flex items-center justify-center gap-3">
                                            <span class="font-medium text-[#1b1b18] dark:text-[#EDEDEC]" x-text="skill.name"></span>
                                            <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full"
                                                 :class="(skill.projects_count || 0) > 0 ? 'bg-red-900/40' : 'bg-gray-700'">
                                                <svg class="w-3.5 h-3.5" 
                                                     :class="(skill.projects_count || 0) > 0 ? 'text-red-400' : 'text-gray-400'"
                                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                <span class="text-xs font-semibold" 
                                                      :class="(skill.projects_count || 0) > 0 ? 'text-red-400' : 'text-gray-300'"
                                                      x-text="(skill.projects_count || 0) + ' ' + ((skill.projects_count || 0) === 1 ? 'project applied' : 'projects applied')"></span>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            
                            <!-- Skills Pagination -->
                            <div x-show="nextCursor || prevCursor" class="flex justify-center mt-6 gap-2">
                                <button @click="previousPage()" 
                                        :disabled="!prevCursor"
                                        :class="{'opacity-50 cursor-not-allowed': !prevCursor, 'hover:bg-red-600': prevCursor}"
                                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 bg-gray-700 text-white">
                                    ← Prev
                                </button>
                                <button @click="nextPage()" 
                                        :disabled="!nextCursor"
                                        :class="{'opacity-50 cursor-not-allowed': !nextCursor, 'hover:bg-red-600': nextCursor}"
                                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 bg-gray-700 text-white">
                                    Next →
                                </button>
                            </div>

                            <div class="text-center mt-3 text-sm text-[#706f6c]">
                                <span x-show="!nextCursor && !prevCursor">Showing all skills</span>
                                <span x-show="nextCursor && !prevCursor">More skills available →</span>
                                <span x-show="prevCursor && !nextCursor">← End of skills</span>
                                <span x-show="prevCursor && nextCursor">← Previous | Next →</span>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-700 my-12"></div>

                    <!-- ========== PROJECTS SECTION ========== -->
                    <div x-data="window.projectsComponent()" x-init="fetchProjects()" class="projects-section mb-12">
                        <h2 class="text-2xl font-semibold mb-6 text-left text-[#1b1b18] dark:text-[#EDEDEC]">📁 Featured Projects</h2>
                        
                        <!-- No Data State -->
                        <div x-show="projects.length === 0" class="text-center py-16">
                            <div class="text-5xl mb-4 opacity-50">🚀</div>
                            <p class="text-xl font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">No projects yet</p>
                            <p class="text-[#706f6c] dark:text-[#A1A09A]">Exciting projects are in the works. Check back soon!</p>
                        </div>
                        
                        <!-- Projects Grid -->
                        <div x-show="projects.length > 0">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <template x-for="project in projects" :key="project.id">
                                    <div class="group rounded-xl border border-gray-700 hover:border-red-500/50 transition-all duration-300 bg-gray-800/50 overflow-hidden hover:shadow-lg hover:shadow-red-500/10 flex flex-col h-full">
                                        <div class="relative overflow-hidden aspect-video p-3">
                                            <img :src="project.image || 'https://via.placeholder.com/600x400'" 
                                                :alt="project.title" 
                                                class="w-full h-full object-cover rounded-lg">
                                        </div>
                                        <div class="p-4 flex-1 flex flex-col">
                                            <div class="flex items-center justify-start gap-2 mb-2 flex-wrap">
                                                <h3 class="text-lg font-semibold text-white" x-text="project.title"></h3>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium shadow-lg"
                                                      :class="getStatusClass(project.status)">
                                                    <span class="w-1.5 h-1.5 rounded-full mr-1"
                                                          :class="getStatusDotClass(project.status)"
                                                          :class="{'animate-pulse': project.status === 'deployed'}"></span>
                                                    <span x-text="getStatusLabel(project.status)"></span>
                                                </span>
                                            </div>
                                            <p class="text-gray-400 text-sm mb-3 line-clamp-3 flex-1 text-justify" x-text="project.description"></p>
                                            <div class="flex flex-wrap gap-1.5 mb-3 justify-start">
                                                <template x-for="skill in project.skills" :key="skill.id">
                                                    <span class="px-2 py-0.5 text-xs rounded-full bg-gray-700 text-gray-300" x-text="skill.name"></span>
                                                </template>
                                            </div>
                                            <div class="flex gap-3 pt-2 border-t border-gray-700 mt-auto justify-end">
                                                <a :href="'/projects/' + project.id" class="inline-flex items-center gap-1.5 text-sm text-red-500 hover:text-red-400 hover:bg-red-500/10 px-3 py-1.5 rounded-lg transition-all duration-300">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    <span>View</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            
                            <!-- Projects Pagination - FIXED: Prev disabled on first page, Next enabled when more exist -->
                            <div x-show="nextCursor || prevCursor" class="flex justify-center mt-8 gap-2">
                                <button @click="previousPage()" 
                                        :disabled="!prevCursor"
                                        :class="{'opacity-50 cursor-not-allowed': !prevCursor, 'hover:bg-red-600 hover:opacity-100': prevCursor}"
                                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 bg-gray-700 text-white">
                                    ← Prev
                                </button>
                                <button @click="nextPage()" 
                                        :disabled="!nextCursor"
                                        :class="{'opacity-50 cursor-not-allowed': !nextCursor, 'hover:bg-red-600 hover:opacity-100': nextCursor}"
                                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 bg-gray-700 text-white">
                                    Next →
                                </button>
                            </div>

                            <div class="text-center mt-3 text-sm text-[#706f6c]">
                                <span x-show="!nextCursor && !prevCursor">Showing all projects</span>
                                <span x-show="nextCursor && !prevCursor">More projects available →</span>
                                <span x-show="prevCursor && !nextCursor">← End of projects</span>
                                <span x-show="prevCursor && nextCursor">← Previous | Next →</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- ========== SIMPLE FOOTER WITH COPYRIGHT & FACEBOOK ========== -->
                    <footer class="mt-16 pt-6 pb-8 border-t border-gray-800">
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                            <!-- Copyright -->
                            <p class="text-gray-500 text-sm">
                                © {{ date('Y') }} Lito Arthon R. Godito. All rights reserved.
                            </p>
                            
                            <!-- Facebook Logo (you can edit the link below) -->
                            <a href="https://www.facebook.com/arthon.godito" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="contact-link flex items-center justify-center gap-2 text-gray-400 hover:text-[#1877F2] transition-all duration-200 group">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                <span class="text-sm font-medium">Facebook</span>
                            </a>
                        </div>
                    </footer>
                    
                </div>
            </main>
        </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif

        <script>
            // Make components globally available for Turbo
            window.profileComponent = function() {
                return {
                    profile: null,
                    
                    async fetchProfile() {
                        try {
                            const response = await fetch('/profile-data');
                            const data = await response.json();
                            this.profile = data;
                        } catch (error) {
                            console.error('Error fetching profile:', error);
                            this.profile = null;
                        }
                    }
                }
            }
            
            window.skillsComponent = function() {
                return {
                    skills: [],
                    nextCursor: null,
                    prevCursor: null,
                    
                    async fetchSkills(cursor = null) {
                        try {
                            let url = '/skills';
                            if (cursor) {
                                url += `?cursor=${cursor}`;
                            }
                            const response = await fetch(url);
                            const data = await response.json();
                            this.skills = data.data;
                            this.nextCursor = data.next_cursor;
                            this.prevCursor = data.prev_cursor;
                        } catch (error) {
                            console.error('Error fetching skills:', error);
                        }
                    },
                    
                    nextPage() {
                        if (this.nextCursor) this.fetchSkills(this.nextCursor);
                    },
                    
                    previousPage() {
                        if (this.prevCursor) this.fetchSkills(this.prevCursor);
                    }
                }
            }
            
            window.projectsComponent = function() {
                return {
                    projects: [],
                    nextCursor: null,
                    prevCursor: null,
                    
                    async fetchProjects(cursor = null) {
                        try {
                            let url = '/projects';
                            if (cursor) {
                                url += `?cursor=${cursor}`;
                            }
                            const response = await fetch(url);
                            const data = await response.json();
                            this.projects = data.data;
                            this.nextCursor = data.next_cursor;
                            this.prevCursor = data.prev_cursor;
                        } catch (error) {
                            console.error('Error fetching projects:', error);
                        }
                    },
                    
                    getStatusLabel(status) {
                        const labels = {
                            'deployed': 'Deployed',
                            'in_progress': 'In Progress',
                            'learning': 'Learning',
                            'on_hold': 'On Hold',
                            'archived': 'Archived'
                        };
                        return labels[status] || 'Learning';
                    },
                    
                    getStatusClass(status) {
                        const classes = {
                            'deployed': 'bg-black/60 backdrop-blur-sm text-green-400 border border-green-400/30',
                            'in_progress': 'bg-black/60 backdrop-blur-sm text-yellow-400 border border-yellow-400/30',
                            'learning': 'bg-black/60 backdrop-blur-sm text-blue-400 border border-blue-400/30',
                            'on_hold': 'bg-black/60 backdrop-blur-sm text-gray-400 border border-gray-400/30',
                            'archived': 'bg-black/60 backdrop-blur-sm text-gray-500 border border-gray-500/30'
                        };
                        return classes[status] || 'bg-black/60 backdrop-blur-sm text-blue-400 border border-blue-400/30';
                    },
                    
                    getStatusDotClass(status) {
                        const dotClasses = {
                            'deployed': 'bg-green-400 animate-pulse',
                            'in_progress': 'bg-yellow-400',
                            'learning': 'bg-blue-400',
                            'on_hold': 'bg-gray-400',
                            'archived': 'bg-gray-500'
                        };
                        return dotClasses[status] || 'bg-blue-400';
                    },
                    
                    nextPage() {
                        if (this.nextCursor) this.fetchProjects(this.nextCursor);
                    },
                    
                    previousPage() {
                        if (this.prevCursor) this.fetchProjects(this.prevCursor);
                    }
                }
            }
            
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        e.preventDefault();
                        targetElement.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });
        </script>
        
        <!-- Alpine JS -->
        <!-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> -->
        
    </body>
</html>