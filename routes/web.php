<?php

use App\Http\Controllers\ProjectScreenshotController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User; // ✅ ADD THIS
use App\Http\Controllers\PortfolioProfileController; //ADD THIS BY CLAUDE

// ========== PORTFOLIO PROFILE ==========
Route::get('/profile-data', [PortfolioProfileController::class, 'show']); // public
Route::middleware('auth')->group(function () {
    Route::post('/portfolio-profile', [PortfolioProfileController::class, 'update']); // protected
});

// ======== START PROJECT SCREENSHOT SECTION ========
Route::get('/projects/{project}/screenshots', [ProjectScreenshotController::class, 'index']);
Route::post('/projects/{project}/screenshots', [ProjectScreenshotController::class, 'upload']);
Route::delete('/screenshots/{screenshot}', [ProjectScreenshotController::class, 'destroy']);
// ======== END PROJECT SCREENSHOT SECTION ==========

// Route::get('/', [PortfolioController::class, 'index']);

// Route::get('/portfolio', [PortfolioController::class, 'index']);
// TO this:
Route::get('/', function() {
    return redirect('/portfolio');
});
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');

Route::get('/dashboard', function () {

    $skills = Skill::paginate(6);
    $projects = Project::with('skills')->paginate(2);
    
    $lastProject = Project::max('updated_at');
    $lastSkill = Skill::max('updated_at');
    $lastPivot = DB::table('skill_project')->max('updated_at');
    $lastScreenshot = DB::table('project_screenshots')->max('created_at');
    $lastActivity = auth()->user()->last_activity_at; // ✅ ADD THIS
    
    $dates = array_filter([$lastProject, $lastSkill, $lastPivot, $lastScreenshot, $lastActivity]);
    $lastUpdated = !empty($dates) ? max($dates) : null;
    $lastUpdated = $lastUpdated ? date('M d, Y', strtotime($lastUpdated)) : '-';
    
    return view('dashboard', compact('skills', 'projects', 'lastUpdated'));

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========== SKILLS MANAGEMENT ==========
Route::get('/skills', [SkillController::class, 'index']);      // Get paginated skills
Route::post('/skills', [SkillController::class, 'store']);     // Create new skill
Route::put('/skills/{id}', [SkillController::class, 'update']); // Update skill
Route::delete('/skills/{id}', [SkillController::class, 'destroy']); // Delete skill

// ========== PROJECTS MANAGEMENT ==========
Route::get('/projects', [ProjectController::class, 'index']);   // Get paginated projects
Route::get('/projects/{project}', [ProjectController::class, 'show']); // View single project
Route::post('/projects', [ProjectController::class, 'store']);  // Create project with image
Route::put('/projects/{id}', [ProjectController::class, 'update']); // Update project with image
Route::delete('/projects/{id}', [ProjectController::class, 'destroy']); // Delete project

// ========== LAST UPDATED ==========
Route::get('/last-updated', function () {
    $lastProject = Project::max('updated_at');
    $lastSkill = Skill::max('updated_at');
    $lastPivot = DB::table('skill_project')->max('updated_at');
    $lastScreenshot = DB::table('project_screenshots')->max('created_at');
    $lastActivity = auth()->user()->last_activity_at; // ✅ ADD THIS
    
    $dates = array_filter([$lastProject, $lastSkill, $lastPivot, $lastScreenshot, $lastActivity]);
    $lastUpdated = !empty($dates) ? max($dates) : null;
    
    return response()->json([
        'last_updated' => $lastUpdated ? date('M d, Y', strtotime($lastUpdated)) : '-'
    ]);
})->middleware(['auth']);

// ========== TRACK ADMIN ACTIVITY ==========
Route::post('/track-activity', function () {
    $user = User::find(auth()->id());
    if ($user) {
        $user->last_activity_at = now();
        $user->save();
    }
    return response()->json(['success' => true]);
})->middleware(['auth']);

require __DIR__.'/auth.php';