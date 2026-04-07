<x-app-layout>
    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-gray-800 rounded-xl border border-gray-700 mb-6">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2 text-white">
                        Welcome back, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-gray-400">
                        Manage your portfolio projects and skills from this dashboard.
                    </p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-gray-800 rounded-xl border border-gray-700">
                    <div class="p-6">
                        <div class="text-3xl font-bold text-red-500 mb-2" id="projectsTotal">{{ $projects->total() }}</div>
                        <div class="text-gray-400">Total Projects</div>
                    </div>
                </div>
                <div class="bg-gray-800 rounded-xl border border-gray-700">
                    <div class="p-6">
                        <div class="text-3xl font-bold text-red-500 mb-2" id="skillsTotal">{{ $skills->total() }}</div>
                        <div class="text-gray-400">Skills Tracked</div>
                    </div>
                </div>
                <div class="bg-gray-800 rounded-xl border border-gray-700">
                    <div class="p-6">
                        <div class="text-3xl font-bold text-red-500 mb-2" id="lastUpdated">
                            {{ $lastUpdated }}
                        </div>
                        <div class="text-gray-400">Last Updated</div>
                    </div>
                </div>
            </div>

            <!-- PROFILE SECTION -->
            <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden mb-6">
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold text-white">👤 Portfolio Profile</h3>
                        <button type="button" onclick="openProfileModal()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-all duration-300">
                            Edit Profile
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <div id="profileDisplay" class="flex gap-6">
                        <div class="flex-shrink-0">
                            <div id="profileAvatar" class="w-32 h-32 rounded-full bg-gray-700 overflow-hidden">
                                <img id="avatarImg" src="" alt="Profile" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="flex-1">
                            <div id="profileTagline" class="text-xl font-semibold text-white mb-2">Loading...</div>
                            <div id="profileBio" class="text-gray-400">Loading...</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Edit Modal -->
            <div id="profileModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50" onclick="if(event.target === this) closeProfileModal()">
                <div class="bg-gray-800 rounded-xl border border-gray-700 max-w-2xl w-full mx-4 p-6">
                    <h3 class="text-2xl font-semibold text-white mb-4">Edit Portfolio Profile</h3>
                    <form id="profileForm" enctype="multipart/form-data" data-turbo="false">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Profile Avatar</label>
                            <div class="flex items-center gap-4">
                                <div id="currentAvatar" class="w-20 h-20 rounded-full bg-gray-700 overflow-hidden">
                                    <img id="currentAvatarImg" src="" alt="Current avatar" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <input type="file" id="avatarInput" name="avatar" accept="image/png, image/jpeg, image/jpg" class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-red-500 focus:border-red-500 transition">
                                    <p class="text-xs text-gray-500 mt-1">Max 10MB. JPG, PNG only.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Tagline</label>
                            <input type="text" id="profileTaglineInput" name="tagline" maxlength="255" class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-red-500 focus:border-red-500 transition">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Bio / About</label>
                            <textarea id="profileBioInput" name="bio" rows="6" class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-red-500 focus:border-red-500 transition"></textarea>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="closeProfileModal()" class="px-4 py-2 border border-gray-600 rounded-lg text-gray-400 hover:bg-gray-700 transition">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">Save Profile</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SKILLS SECTION -->
            <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden mb-6">
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold text-white">💻 Manage Skills</h3>
                        <button type="button" onclick="openSkillModal()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-all duration-300">
                            + Add New Skill
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <div id="skillsContainer"></div>
                    <div id="skillsPagination" class="flex justify-center mt-6"></div>
                </div>
            </div>

            <!-- PROJECTS SECTION -->
            <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
                <div class="p-6 border-b border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold text-white">📁 Manage Projects</h3>
                        <button type="button" onclick="openProjectModal()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-all duration-300">
                            + Add New Project
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <div id="projectsContainer"></div>
                    <div id="projectsPagination" class="flex justify-center mt-6"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Skill Modal -->
    <div id="skillModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50" onclick="if(event.target === this) closeSkillModal()">
        <div class="bg-gray-800 rounded-xl border border-gray-700 max-w-md w-full mx-4 p-6">
            <h3 class="text-2xl font-semibold text-white mb-4" id="skillModalTitle">Add New Skill</h3>
            <form id="skillForm" data-turbo="false">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Skill Name</label>
                    <input type="text" id="skillName" name="name" required class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-red-500 focus:border-red-500 transition">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeSkillModal()" class="px-4 py-2 border border-gray-600 rounded-lg text-gray-400 hover:bg-gray-700 transition">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">Save Skill</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Project Modal -->
    <div id="projectModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50" onclick="if(event.target === this) closeProjectModal()">
        <div class="bg-gray-800 rounded-xl border border-gray-700 max-w-3xl w-full mx-4 p-6 max-h-[90vh] overflow-y-auto">
            <h3 class="text-2xl font-semibold text-white mb-4" id="projectModalTitle">Add New Project</h3>
            <form id="projectForm" enctype="multipart/form-data" data-turbo="false">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Project Title</label>
                    <input type="text" id="projectTitle" name="title" required class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-red-500 focus:border-red-500 transition">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Project Status</label>
                    <select id="projectStatus" name="status" class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-red-500 focus:border-red-500 transition">
                        <option value="deployed">🚀 Deployed (Live)</option>
                        <option value="in_progress">⚙️ In Progress</option>
                        <option value="learning">📚 Learning/Practice</option>
                        <option value="on_hold">⏸️ On Hold</option>
                        <option value="archived">📦 Archived</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                    <textarea id="projectDescription" name="description" rows="4" required class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-red-500 focus:border-red-500 transition"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Project Thumbnail Image</label>
                    <div class="border-2 border-dashed border-gray-600 rounded-lg p-4 text-center hover:border-red-500 transition cursor-pointer" onclick="document.getElementById('projectImageInput').click()">
                        <div id="imagePreview" class="hidden mb-3">
                            <img id="imagePreviewImg" class="mx-auto max-h-32 rounded-lg object-cover">
                        </div>
                        <div id="imageUploadPlaceholder">
                            <svg class="mx-auto h-12 w-12 text-gray-500" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-400">Click to upload thumbnail</p>
                        </div>
                    </div>
                    <input type="file" id="projectImageInput" name="image" accept="image/png, image/jpeg, image/jpg" class="hidden" onchange="previewImage(this)">
                </div>

                <!-- Screenshots Upload Section -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-2">📸 Project Screenshots (Multiple)</label>
                    <div class="border-2 border-dashed border-gray-600 rounded-lg p-4 text-center hover:border-red-500 transition cursor-pointer" onclick="document.getElementById('screenshotsInput').click()">
                        <svg class="mx-auto h-10 w-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="mt-2 text-sm text-gray-400">Click to select multiple screenshots</p>
                        <p class="text-xs text-gray-500">Order = selection order (1st selected = 1st in gallery)</p>
                    </div>
                    <input type="file" id="screenshotsInput" name="screenshots[]" multiple accept="image/png, image/jpeg, image/jpg" class="hidden" onchange="previewScreenshots(this)">
                    <div id="screenshotsPreview" class="mt-3 grid grid-cols-3 gap-2"></div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Technologies</label>
                    <div id="techList" class="grid grid-cols-2 gap-2 p-3 border border-gray-600 rounded-lg bg-gray-700 max-h-40 overflow-y-auto"></div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-2">GitHub Link</label>
                    <input type="url" id="projectGithub" name="github_link" class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-red-500 focus:border-red-500 transition">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Demo Link</label>
                    <input type="url" id="projectDemo" name="demo_link" class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:ring-red-500 focus:border-red-500 transition">
                </div>

                <!-- Existing Screenshots Container -->
                <div id="existingScreenshotsContainer" class="mb-4 hidden">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Existing Screenshots</label>
                    <div id="existingScreenshotsList" class="grid grid-cols-3 gap-2"></div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeProjectModal()" class="px-4 py-2 border border-gray-600 rounded-lg text-gray-400 hover:bg-gray-700 transition">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">Save Project</button>
                </div>
            </form>
        </div>
    </div>

    <script>
// ========== FIX: Use window. to prevent redeclaration errors ==========
window.currentSkillCursor = window.currentSkillCursor || null;
window.currentProjectCursor = window.currentProjectCursor || null;
window.editingSkillId = window.editingSkillId || null;
window.editingProjectId = window.editingProjectId || null;
window.totalSkillsCount = window.totalSkillsCount || {{ $skills->total() }};
window.totalProjectsCount = window.totalProjectsCount || {{ $projects->total() }};
window.deletedScreenshotIds = window.deletedScreenshotIds || [];
window.existingScreenshots = window.existingScreenshots || [];

// ========== Helper Functions ==========
function formatCount(count, elementId) {
    const element = document.getElementById(elementId);
    if (!element) return;
    
    if (count > 99) {
        element.innerText = '99+';
        element.title = `${count.toLocaleString()} total`;
        element.style.cursor = 'help';
        element.style.borderBottom = '1px dotted rgba(156, 163, 175, 0.5)';
    } else {
        element.innerText = count.toString();
        element.title = '';
        element.style.cursor = '';
        element.style.borderBottom = '';
    }
}

function previewImage(input) {
    const preview = document.getElementById('imagePreviewImg');
    const previewContainer = document.getElementById('imagePreview');
    const placeholder = document.getElementById('imageUploadPlaceholder');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/[&<>]/g, function(m) {
        if (m === '&') return '&amp;';
        if (m === '<') return '&lt;';
        if (m === '>') return '&gt;';
        return m;
    });
}

function getStatusBadge(status) {
    const statusMap = {
        'deployed': { 
            wrapper: 'bg-black/60 backdrop-blur-sm text-green-400 border border-green-400/30', 
            dot: 'bg-green-400 animate-pulse', 
            label: 'Deployed' 
        },
        'in_progress': { 
            wrapper: 'bg-black/60 backdrop-blur-sm text-yellow-400 border border-yellow-400/30', 
            dot: 'bg-yellow-400', 
            label: 'In Progress' 
        },
        'learning': { 
            wrapper: 'bg-black/60 backdrop-blur-sm text-blue-400 border border-blue-400/30', 
            dot: 'bg-blue-400', 
            label: 'Learning' 
        },
        'on_hold': { 
            wrapper: 'bg-black/60 backdrop-blur-sm text-gray-400 border border-gray-400/30', 
            dot: 'bg-gray-400', 
            label: 'On Hold' 
        },
        'archived': { 
            wrapper: 'bg-black/60 backdrop-blur-sm text-gray-500 border border-gray-500/30', 
            dot: 'bg-gray-500', 
            label: 'Archived' 
        }
    };
    
    const style = statusMap[status] || statusMap['learning'];
    
    return `<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium ${style.wrapper}">
                <span class="w-1.5 h-1.5 ${style.dot} rounded-full mr-1"></span>
                ${style.label}
            </span>`;
}

// ========== Tech List ==========
async function loadTechList() {
    const response = await fetch('/skills?all=true');
    const data = await response.json();
    const techList = document.getElementById('techList');
    if (!techList) return;
    techList.innerHTML = '';
    
    if (data.data && data.data.length > 0) {
        data.data.forEach(skill => {
            techList.innerHTML += `
                <label class="flex items-center space-x-2 text-gray-300">
                    <input type="checkbox" name="technologies[]" value="${escapeHtml(skill.name)}" class="rounded border-gray-600 bg-gray-600 text-red-500 focus:ring-red-500">
                    <span class="text-sm">${escapeHtml(skill.name)}</span>
                </label>
            `;
        });
    } else {
        techList.innerHTML = '<p class="text-gray-400 text-sm text-center py-4">No skills available. Create some skills first.</p>';
    }
}

// ========== SKILLS FUNCTIONS ==========
async function fetchSkills() {
    const url = window.currentSkillCursor ? `/skills?cursor=${window.currentSkillCursor}` : '/skills';
    const response = await fetch(url);
    const data = await response.json();
    
    const container = document.getElementById('skillsContainer');
    if (container && data.data) {
        if (data.data.length === 0) {
            container.innerHTML = '<div class="text-center py-8 text-gray-400">No skills yet. Click "Add New Skill" to get started.</div>';
        } else {
            let html = '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">';
            data.data.forEach(skill => {
                const projectCount = skill.projects_count || 0;
                const hasProjects = projectCount > 0;
                const badgeBg = hasProjects ? 'bg-red-900/40' : 'bg-gray-700';
                const iconColor = hasProjects ? 'text-red-400' : 'text-gray-400';
                const textColor = hasProjects ? 'text-red-400' : 'text-gray-300';
                
                html += `
                    <div class="flex items-center justify-between p-4 rounded-xl bg-gray-800/50 border border-gray-700 hover:border-red-500/50 hover:bg-gray-800 transition-all duration-300 group">
                        <div class="flex-1">
                            <div class="flex items-center gap-3">
                                <span class="font-medium text-white text-lg">${escapeHtml(skill.name)}</span>
                                <div class="flex items-center gap-1.5 ${badgeBg} px-2.5 py-1 rounded-full">
                                    <svg class="w-3.5 h-3.5 ${iconColor}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span class="text-xs font-semibold ${textColor}">${projectCount} ${projectCount === 1 ? 'project' : 'projects'} applied</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2 ml-4 opacity-70 group-hover:opacity-100 transition-opacity">
                            <button onclick="editSkill(${skill.id}, '${escapeHtml(skill.name)}')" class="p-1.5 text-blue-400 hover:text-blue-300 hover:bg-blue-500/10 rounded-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button onclick="deleteSkill(${skill.id})" class="p-1.5 text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
            container.innerHTML = html;
        }
    }
    
    const pagination = document.getElementById('skillsPagination');
    if (pagination && (data.next_cursor || data.prev_cursor)) {
        let html = `<div class="flex justify-center gap-2 flex-wrap">`;
        html += `<button onclick="changeSkillPage('prev')" ${!data.prev_cursor ? 'disabled' : ''} class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 bg-gray-700 text-white ${!data.prev_cursor ? 'opacity-50 cursor-not-allowed' : 'hover:bg-red-600'}">← Prev</button>`;
        html += `<button onclick="changeSkillPage('next')" ${!data.next_cursor ? 'disabled' : ''} class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 bg-gray-700 text-white ${!data.next_cursor ? 'opacity-50 cursor-not-allowed' : 'hover:bg-red-600'}">Next →</button>`;
        html += `</div>`;
        pagination.innerHTML = html;
    } else {
        pagination.innerHTML = '';
    }
    
    formatCount(window.totalSkillsCount, 'skillsTotal');
}

async function changeSkillPage(direction) {
    const url = window.currentSkillCursor ? `/skills?cursor=${window.currentSkillCursor}` : '/skills';
    const response = await fetch(url);
    const data = await response.json();
    
    if (direction === 'next' && data.next_cursor) {
        window.currentSkillCursor = data.next_cursor;
        await fetchSkills();
    } else if (direction === 'prev' && data.prev_cursor) {
        window.currentSkillCursor = data.prev_cursor;
        await fetchSkills();
    }
}

async function deleteSkill(id) {
    if (!confirm('Delete this skill?')) return;
    
    const response = await fetch(`/skills/${id}`, {
        method: 'DELETE',
        headers: { 
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    });
    
    if (response.ok) {
        await trackActivity();
        window.totalSkillsCount--;
        formatCount(window.totalSkillsCount, 'skillsTotal');
        await refreshLastUpdated();
        window.currentSkillCursor = null;
        await fetchSkills();
        await loadTechList();
        await fetchProjects();
        alert('Skill deleted successfully!');
    } else {
        const error = await response.json();
        alert(error.message || 'Error deleting skill');
    }
}

function openSkillModal() {
    window.editingSkillId = null;
    document.getElementById('skillModalTitle').innerText = 'Add New Skill';
    document.getElementById('skillForm').reset();
    document.getElementById('skillModal').classList.remove('hidden');
    document.getElementById('skillModal').classList.add('flex');
}

function editSkill(id, name) {
    window.editingSkillId = id;
    document.getElementById('skillModalTitle').innerText = 'Edit Skill';
    document.getElementById('skillName').value = name;
    document.getElementById('skillModal').classList.remove('hidden');
    document.getElementById('skillModal').classList.add('flex');
}

function closeSkillModal() {
    document.getElementById('skillModal').classList.add('hidden');
    document.getElementById('skillModal').classList.remove('flex');
    window.editingSkillId = null;
}

async function saveSkill() {
    const name = document.getElementById('skillName').value;
    const isEdit = window.editingSkillId !== null;
    const url = isEdit ? `/skills/${window.editingSkillId}` : '/skills';
    
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ 
                name: name, 
                _method: isEdit ? 'PUT' : 'POST'
            })
        });
        
        const contentType = response.headers.get('content-type');
        
        if (contentType && contentType.includes('application/json')) {
            const data = await response.json();
            
            if (response.ok) {
                await trackActivity();
                closeSkillModal();
                
                if (!isEdit) {
                    window.totalSkillsCount++;
                    formatCount(window.totalSkillsCount, 'skillsTotal');
                }
                
                await refreshLastUpdated();
                window.currentSkillCursor = null;
                await fetchSkills();
                await loadTechList();
                alert(isEdit ? 'Skill updated!' : 'Skill added!');
            } else if (response.status === 422) {
                const errorMsg = data.errors?.name?.[0] || data.message;
                alert(errorMsg);
            } else {
                alert(data.message || 'Error saving skill');
            }
        } else {
            console.error('Expected JSON but got HTML');
            alert('Server error. Please check if you are logged in.');
        }
        
    } catch (error) {
        console.error('Error:', error);
        alert('Network error. Please try again.');
    }
}

// ========== PROJECTS FUNCTIONS ==========
async function fetchProjects() {
    const url = window.currentProjectCursor ? `/projects?cursor=${window.currentProjectCursor}` : '/projects';
    const response = await fetch(url);
    const data = await response.json();
    
    const container = document.getElementById('projectsContainer');
    if (container && data.data) {
        if (data.data.length === 0) {
            container.innerHTML = '<div class="text-center py-8 text-gray-400">No projects yet. Click "Add New Project" to get started.</div>';
        } else {
            let html = '<div class="grid grid-cols-1 md:grid-cols-2 gap-3">';
            data.data.forEach(project => {
                const skillsHtml = project.skills.map(s => `<span class="px-2 py-1 text-xs rounded-full bg-gray-700 text-gray-300">${escapeHtml(s.name)}</span>`).join('');
               html += `
                    <div class="group rounded-xl border border-gray-700 hover:border-red-500/50 transition-all duration-300 bg-gray-800/50 overflow-hidden hover:shadow-lg hover:shadow-red-500/10 flex flex-col h-full">
                        <div class="relative overflow-hidden aspect-video p-3">
                            <img src="${project.image || 'https://via.placeholder.com/600x400'}" alt="${escapeHtml(project.title)}" class="w-full h-full object-cover rounded-lg">
                        </div>
                        <div class="p-4 flex-1 flex flex-col">
                            <div class="flex items-center justify-start gap-3 mb-2">
                                <h3 class="text-lg font-semibold text-white">${escapeHtml(project.title)}</h3>
                                ${getStatusBadge(project.status)}
                            </div>
                            <p class="text-gray-400 text-sm mb-3 line-clamp-3 flex-1 text-justify">${escapeHtml(project.description)}</p>
                            <div class="flex flex-wrap gap-1.5 mb-3 justify-start">
                                ${skillsHtml}
                            </div>
                        </div>
                        <div class="px-4 pb-4 flex justify-end items-center gap-2 border-t border-gray-700 pt-3 mt-auto">
                            <a href="/projects/${project.id}" class="p-1.5 text-gray-400 hover:text-white hover:bg-gray-700 rounded-lg transition" title="View Details">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            <button onclick='editProject(${project.id}, ${JSON.stringify(project.title)}, ${JSON.stringify(project.description)}, ${JSON.stringify(project.github_link || '')}, ${JSON.stringify(project.demo_link || '')}, ${JSON.stringify(project.image || '')}, ${JSON.stringify(project.skills.map(s => s.name))}, ${JSON.stringify(project.screenshots || [])}, ${JSON.stringify(project.status || "learning")})' class="p-1.5 text-blue-400 hover:text-blue-300 hover:bg-blue-500/10 rounded-lg transition" title="Edit Project">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button onclick="deleteProject(${project.id})" class="p-1.5 text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg transition" title="Delete Project">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
            container.innerHTML = html;
        }
    }
    
    const pagination = document.getElementById('projectsPagination');
    if (pagination && (data.next_cursor || data.prev_cursor)) {
        let html = `<div class="flex justify-center gap-2 flex-wrap">`;
        html += `<button onclick="changeProjectPage('prev')" ${!data.prev_cursor ? 'disabled' : ''} class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 bg-gray-700 text-white ${!data.prev_cursor ? 'opacity-50 cursor-not-allowed' : 'hover:bg-red-600'}">← Prev</button>`;
        html += `<button onclick="changeProjectPage('next')" ${!data.next_cursor ? 'disabled' : ''} class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 bg-gray-700 text-white ${!data.next_cursor ? 'opacity-50 cursor-not-allowed' : 'hover:bg-red-600'}">Next →</button>`;
        html += `</div>`;
        pagination.innerHTML = html;
    } else {
        pagination.innerHTML = '';
    }
    
    formatCount(window.totalProjectsCount, 'projectsTotal');
}

async function changeProjectPage(direction) {
    const url = window.currentProjectCursor ? `/projects?cursor=${window.currentProjectCursor}` : '/projects';
    const response = await fetch(url);
    const data = await response.json();
    
    if (direction === 'next' && data.next_cursor) {
        window.currentProjectCursor = data.next_cursor;
        await fetchProjects();
    } else if (direction === 'prev' && data.prev_cursor) {
        window.currentProjectCursor = data.prev_cursor;
        await fetchProjects();
    }
}

async function deleteProject(id) {
    if (!confirm('Delete this project?')) return;
    
    const response = await fetch(`/projects/${id}`, {
        method: 'DELETE',
        headers: { 
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    });
    
    if (response.ok) {
        await trackActivity();
        window.totalProjectsCount--;
        formatCount(window.totalProjectsCount, 'projectsTotal');
        await refreshLastUpdated();
        window.currentProjectCursor = null;
        await fetchProjects();
        await fetchSkills();
        await loadTechList();
        alert('Project deleted successfully!');
    } else {
        const error = await response.json();
        alert(error.message || 'Error deleting project');
    }
}

function openProjectModal() {
    window.editingProjectId = null;
    window.deletedScreenshotIds = [];
    window.existingScreenshots = [];
    document.getElementById('projectModalTitle').innerText = 'Add New Project';
    document.getElementById('projectForm').reset();
    document.getElementById('imagePreview').classList.add('hidden');
    document.getElementById('imageUploadPlaceholder').classList.remove('hidden');
    document.getElementById('screenshotsPreview').innerHTML = '';
    document.getElementById('screenshotsInput').value = '';
    document.getElementById('existingScreenshotsContainer').classList.add('hidden');
    document.querySelectorAll('input[name="technologies[]"]').forEach(cb => cb.checked = false);
    document.getElementById('projectModal').classList.remove('hidden');
    document.getElementById('projectModal').classList.add('flex');
}

function editProject(id, title, description, github, demo, image, skills, screenshots = [], status = 'learning') {
    window.editingProjectId = id;
    window.deletedScreenshotIds = [];
    window.existingScreenshots = screenshots;
    
    document.getElementById('projectModalTitle').innerText = 'Edit Project';
    document.getElementById('projectTitle').value = title;
    document.getElementById('projectDescription').value = description;
    document.getElementById('projectGithub').value = github;
    document.getElementById('projectDemo').value = demo;
    document.getElementById('projectStatus').value = status;
    
    if (image && image !== '') {
        document.getElementById('imagePreviewImg').src = image;
        document.getElementById('imagePreview').classList.remove('hidden');
        document.getElementById('imageUploadPlaceholder').classList.add('hidden');
    } else {
        document.getElementById('imagePreview').classList.add('hidden');
        document.getElementById('imageUploadPlaceholder').classList.remove('hidden');
    }
    
    document.querySelectorAll('input[name="technologies[]"]').forEach(cb => cb.checked = false);
    if (skills && skills.length) {
        skills.forEach(skill => {
            const checkbox = document.querySelector(`input[name="technologies[]"][value="${skill}"]`);
            if (checkbox) checkbox.checked = true;
        });
    }
    
    displayExistingScreenshots(screenshots);
    document.getElementById('screenshotsInput').value = '';
    document.getElementById('screenshotsPreview').innerHTML = '';
    
    document.getElementById('projectModal').classList.remove('hidden');
    document.getElementById('projectModal').classList.add('flex');
}

function closeProjectModal() {
    document.getElementById('projectModal').classList.add('hidden');
    document.getElementById('projectModal').classList.remove('flex');
    window.editingProjectId = null;
}

async function saveProject() {
    const form = document.getElementById('projectForm');
    const isEdit = window.editingProjectId !== null;
    
    // ===== ADD URL VALIDATION (optional but better UX) =====
    const githubLink = document.getElementById('projectGithub').value;
    const demoLink = document.getElementById('projectDemo').value;
    
    function isValidUrl(string) {
        if (!string) return true;
        try {
            const url = new URL(string);
            return url.protocol === 'http:' || url.protocol === 'https:';
        } catch (_) {
            return false;
        }
    }
    
    if (githubLink && !isValidUrl(githubLink)) {
        alert('Please enter a valid URL for GitHub link (e.g., https://github.com/username/repo)');
        return;
    }
    
    if (demoLink && !isValidUrl(demoLink)) {
        alert('Please enter a valid URL for Demo link (e.g., https://example.com)');
        return;
    }
    // ===== END URL VALIDATION =====
    
    const url = isEdit ? `/projects/${window.editingProjectId}` : '/projects';
    const formData = new FormData(form);
    
    const screenshotsFile = document.getElementById('screenshotsInput').files;
    formData.delete('screenshots[]');
    
    if (isEdit) {
        formData.append('_method', 'PUT');
    }
    
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: formData
        });
        
        if (response.ok) {
            // Success handling (your existing code)
            await trackActivity();
            const result = await response.json();
            const projectId = result.project.id;
            
            if (window.deletedScreenshotIds.length > 0) {
                for (const screenshotId of window.deletedScreenshotIds) {
                    await fetch(`/screenshots/${screenshotId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json'
                        }
                    });
                }
                window.deletedScreenshotIds = [];
            }
            
            if (screenshotsFile.length > 0) {
                const screenshotFormData = new FormData();
                for (let i = 0; i < screenshotsFile.length; i++) {
                    screenshotFormData.append('screenshots[]', screenshotsFile[i]);
                }
                
                await fetch(`/projects/${projectId}/screenshots`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    body: screenshotFormData
                });
            }
            
            closeProjectModal();
            
            if (!isEdit) {
                window.totalProjectsCount++;
                formatCount(window.totalProjectsCount, 'projectsTotal');
            }

            await refreshLastUpdated();
            window.currentProjectCursor = null;
            await fetchProjects();
            await fetchSkills();
            await loadTechList();
            alert(isEdit ? 'Project updated!' : 'Project added!');
            
        } else if (response.status === 422) {
            // ===== HANDLE VALIDATION ERRORS =====
            const errors = await response.json();
            let errorMessage = '';
            
            if (errors.errors) {
                if (errors.errors.github_link) {
                    errorMessage = 'GitHub Link: ' + errors.errors.github_link[0];
                } else if (errors.errors.demo_link) {
                    errorMessage = 'Demo Link: ' + errors.errors.demo_link[0];
                } else {
                    // Get first validation error
                    const firstError = Object.values(errors.errors)[0];
                    errorMessage = firstError ? firstError[0] : 'Please check your input';
                }
            } else {
                errorMessage = errors.message || 'Validation error. Please check your input.';
            }
            
            alert(errorMessage);
            // ===== END VALIDATION ERROR HANDLING =====
            
        } else {
            // Handle other errors
            let errorMessage = 'Error saving project';
            try {
                const error = await response.json();
                errorMessage = error.message || 'Error saving project';
            } catch (e) {
                errorMessage = 'Error saving project';
            }
            alert(errorMessage);
        }
        
    } catch (error) {
        console.error('Error:', error);
        alert('Network error. Please try again.');
    }
}

// ========== Screenshot Functions ==========
function previewScreenshots(input) {
    const container = document.getElementById('screenshotsPreview');
    if (!container) return;
    container.innerHTML = '';
    
    if (input.files && input.files.length > 0) {
        Array.from(input.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative group';
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg border border-gray-600">
                    <div class="absolute top-1 right-1">
                        <span class="text-xs bg-black/70 text-white px-1.5 py-0.5 rounded">${index + 1}</span>
                    </div>
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center rounded-lg">
                        <button type="button" onclick="removeScreenshotPreview(${index})" class="text-red-500 text-sm hover:text-red-400">Remove</button>
                    </div>
                `;
                container.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    }
}

function removeScreenshotPreview(index) {
    const input = document.getElementById('screenshotsInput');
    const dt = new DataTransfer();
    const files = Array.from(input.files);
    files.splice(index, 1);
    files.forEach(file => dt.items.add(file));
    input.files = dt.files;
    previewScreenshots(input);
}

function displayExistingScreenshots(screenshots) {
    const container = document.getElementById('existingScreenshotsContainer');
    const list = document.getElementById('existingScreenshotsList');
    
    if (screenshots && screenshots.length > 0) {
        container.classList.remove('hidden');
        list.innerHTML = '';
        
        screenshots.forEach((screenshot, index) => {
            const div = document.createElement('div');
            div.className = 'relative group';
            div.innerHTML = `
                <img src="${screenshot.image}" class="w-full h-24 object-cover rounded-lg border border-gray-600">
                <div class="absolute top-1 right-1">
                    <span class="text-xs bg-black/70 text-white px-1.5 py-0.5 rounded">${index + 1}</span>
                </div>
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center rounded-lg">
                    <button type="button" onclick="deleteExistingScreenshot(${screenshot.id})" class="text-red-500 text-sm hover:text-red-400">Delete</button>
                </div>
            `;
            list.appendChild(div);
        });
    } else {
        container.classList.add('hidden');
    }
}

async function deleteExistingScreenshot(screenshotId) {
    if (!confirm('Remove this screenshot? It will be deleted when you save the project.')) return;
    window.deletedScreenshotIds.push(screenshotId);
    window.existingScreenshots = window.existingScreenshots.filter(s => s.id !== screenshotId);
    displayExistingScreenshots(window.existingScreenshots);
}

// ========== Activity & Last Updated ==========
async function trackActivity() {
    try {
        await fetch('/track-activity', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        });
    } catch (error) {
        console.error('Error tracking activity:', error);
    }
}

async function refreshLastUpdated() {
    try {
        const response = await fetch('/last-updated');
        const data = await response.json();
        const lastUpdatedEl = document.getElementById('lastUpdated');
        if (lastUpdatedEl) lastUpdatedEl.innerText = data.last_updated;
    } catch (error) {
        console.error('Error refreshing last updated:', error);
    }
}

// ========== PROFILE FUNCTIONS ==========
async function fetchProfile() {
    try {
        const response = await fetch('/profile-data');
        const profile = await response.json();
        
        if (profile) {
            const taglineEl = document.getElementById('profileTagline');
            const bioEl = document.getElementById('profileBio');
            const avatarImg = document.getElementById('avatarImg');
            
            if (taglineEl) taglineEl.innerText = profile.tagline || 'No tagline set';
            if (bioEl) bioEl.innerText = profile.bio || 'No bio available';
            
            if (avatarImg) {
                avatarImg.src = profile.avatar || '/profilepicc-removebg-preview.png';
            }
            
            window.currentProfile = profile;
        }
    } catch (error) {
        console.error('Error fetching profile:', error);
    }
}

function previewProfileAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const previewImg = document.getElementById('currentAvatarImg');
            if (previewImg) previewImg.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function openProfileModal() {
    if (window.currentProfile) {
        const avatarImg = document.getElementById('currentAvatarImg');
        const taglineInput = document.getElementById('profileTaglineInput');
        const bioInput = document.getElementById('profileBioInput');
        
        if (avatarImg) avatarImg.src = window.currentProfile.avatar || '/profilepicc-removebg-preview.png';
        if (taglineInput) taglineInput.value = window.currentProfile.tagline || '';
        if (bioInput) bioInput.value = window.currentProfile.bio || '';
    }
    const modal = document.getElementById('profileModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

function closeProfileModal() {
    const modal = document.getElementById('profileModal');
    const avatarInput = document.getElementById('avatarInput');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    if (avatarInput) avatarInput.value = '';
}

async function saveProfile(event) {
    event.preventDefault();
    
    const formData = new FormData();
    const tagline = document.getElementById('profileTaglineInput')?.value || '';
    const bio = document.getElementById('profileBioInput')?.value || '';
    const avatar = document.getElementById('avatarInput')?.files[0];
    
    formData.append('tagline', tagline);
    formData.append('bio', bio);
    if (avatar) {
        formData.append('avatar', avatar);
    }
    
    try {
        const response = await fetch('/portfolio-profile', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        });
        
        if (response.ok) {
            await trackActivity();
            await fetchProfile();
            await refreshLastUpdated();
            closeProfileModal();
            alert('Profile updated successfully!');
        } else {
            const error = await response.json();
            alert(error.message || 'Error updating profile');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Network error. Please try again.');
    }
}

// ========== INITIALIZATION ==========
function initDashboard() {
    // Only run if we're on the dashboard page
    if (!document.getElementById('skillsContainer')) return;
    
    fetchProfile();
    loadTechList();
    fetchSkills();
    fetchProjects();
    formatCount(window.totalSkillsCount, 'skillsTotal');
    formatCount(window.totalProjectsCount, 'projectsTotal');
}

// Run on initial load
initDashboard();

// ========== ATTACH FORM EVENT LISTENERS FOR TURBO ==========
function attachFormListeners() {
    // Skill Form
    const skillForm = document.getElementById('skillForm');
    if (skillForm && !skillForm.hasAttribute('data-listener-attached')) {
        skillForm.setAttribute('data-listener-attached', 'true');
        skillForm.addEventListener('submit', function(e) {
            e.preventDefault();
            saveSkill();
        });
    }
    
    // Project Form
    const projectForm = document.getElementById('projectForm');
    if (projectForm && !projectForm.hasAttribute('data-listener-attached')) {
        projectForm.setAttribute('data-listener-attached', 'true');
        projectForm.addEventListener('submit', function(e) {
            e.preventDefault();
            saveProject();
        });
    }
    
    // Profile Form
    const profileForm = document.getElementById('profileForm');
    if (profileForm && !profileForm.hasAttribute('data-listener-attached')) {
        profileForm.setAttribute('data-listener-attached', 'true');
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            saveProfile(e);
        });
    }
    
    // Avatar Input
    const avatarInput = document.getElementById('avatarInput');
    if (avatarInput && !avatarInput.hasAttribute('data-listener-attached')) {
        avatarInput.setAttribute('data-listener-attached', 'true');
        avatarInput.addEventListener('change', function(e) {
            previewProfileAvatar(this);
        });
    }
}

// Attach listeners on initial load
attachFormListeners();

// Re-run after Turbo navigation
window.turboLoadCount = window.turboLoadCount || 0;
document.addEventListener('turbo:load', function() {
    window.turboLoadCount++;
    
    // Re-attach form listeners after Turbo navigation
    attachFormListeners();
    
    // Only re-initialize if needed
    if (window.turboLoadCount > 1 && document.getElementById('skillsContainer')) {
        // Reset cursor states
        window.currentSkillCursor = null;
        window.currentProjectCursor = null;
        
        // Re-initialize everything
        fetchProfile();
        loadTechList();
        fetchSkills();
        fetchProjects();
        formatCount(window.totalSkillsCount, 'skillsTotal');
        formatCount(window.totalProjectsCount, 'projectsTotal');
    }
});
</script>
</x-app-layout>