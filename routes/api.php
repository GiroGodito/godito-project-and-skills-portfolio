<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ProjectController;

// ========== SKILLS MANAGEMENT ==========
Route::get('/skills', [SkillController::class, 'index']);      // Get paginated skills
Route::post('/skills', [SkillController::class, 'store']);     // Create new skill
Route::put('/skills/{id}', [SkillController::class, 'update']); // Update skill
Route::delete('/skills/{id}', [SkillController::class, 'destroy']); // Delete skill

// ========== PROJECTS MANAGEMENT ==========
Route::get('/projects', [ProjectController::class, 'index']);   // Get paginated projects
Route::post('/projects', [ProjectController::class, 'store']);  // Create project with image
Route::put('/projects/{id}', [ProjectController::class, 'update']); // Update project with image
Route::delete('/projects/{id}', [ProjectController::class, 'destroy']); // Delete project