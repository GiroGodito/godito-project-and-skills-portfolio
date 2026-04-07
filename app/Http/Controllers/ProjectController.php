<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{

    //===== NEWLY ADDED FUNCTION ========   
    public function show(Project $project)
    {
        $project->load(['skills', 'screenshots']);
        return view('projects.show', compact('project')); // 'show' (no folder)
    }

    public function index(Request $request)
    {
        // $projects = Project::with('skills')->paginate(4);
        
        // return response()->json([
        //     'data' => $projects->items(),
        //     'current_page' => $projects->currentPage(),
        //     'last_page' => $projects->lastPage(),
        //     'total' => $projects->total(),
        // ]);
        // ✅ Changed from paginate() to cursorPaginate()
        $projects = Project::with(['skills','screenshots'])->cursorPaginate(4);
        
        return response()->json([
            'data' => $projects->items(),
            'next_cursor' => $projects->nextCursor() ? $projects->nextCursor()->encode() : null,
            'prev_cursor' => $projects->previousCursor() ? $projects->previousCursor()->encode() : null,
            'has_more_pages' => $projects->hasMorePages(),
        ]);
    }
    
    /**
     * Store a new project with image upload
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'technologies' => 'nullable|array',
            'github_link' => 'nullable|url',
            'demo_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240'
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $imagePath = '/storage/' . $path;
        }

        // Create project
        $project = Project::create([
            'title' => $request->title,
            'status'=>$request->status ?? 'learning',
            'description' => $request->description,
            'image' => $imagePath,
            'github_link' => $request->github_link,
            'demo_link' => $request->demo_link
        ]);

        // Attach selected skills
        if ($request->has('technologies')) {
            $technologies = is_string($request->technologies) 
                ? json_decode($request->technologies, true) 
                : $request->technologies;
                
            if (!empty($technologies)) {
                $skillIds = Skill::whereIn('name', $technologies)->pluck('id');
                $project->skills()->attach($skillIds);
                $project->touch();
            }
        }
        
        // Return JSON for SPA
        return response()->json([
            'message' => 'Project added successfully!',
            'project' => $project->load(['skills','screenshots'])
        ], 201);
    }

    /**
     * Update a project with image upload
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'technologies' => 'nullable|array',
            'github_link' => 'nullable|url',
            'demo_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240'
        ]);

        // Handle image update
        $imagePath = $project->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image) {
                $oldPath = str_replace('/storage/', '', $project->image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            // Store new image
            $newPath = $request->file('image')->store('projects', 'public');
            $imagePath = '/storage/' . $newPath;
        }

        // Update project
        $project->update([
            'title' => $request->title,
            'status'=> $request->status ?? 'learning',
            'description' => $request->description,
            'image' => $imagePath,
            'github_link' => $request->github_link,
            'demo_link' => $request->demo_link
        ]);

        // Sync skills
        if ($request->has('technologies')) {
            $technologies = is_string($request->technologies) 
                ? json_decode($request->technologies, true) 
                : $request->technologies;
                
            if (!empty($technologies)) {
                $skillIds = Skill::whereIn('name', $technologies)->pluck('id');
                $project->skills()->sync($skillIds);
                $project->touch();
            } else {
                $project->skills()->sync([]);
                $project->touch();
            }
        } else {
            $project->skills()->sync([]);
            $project->touch();
        }
        
        // Return JSON for SPA
        return response()->json([
            'message' => 'Project updated successfully!',
            'project' => $project->load(['skills','screenshots'])
        ]);
    }

    /**
     * Delete a project and its image
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        
        // Delete image file
        if ($project->image) {
            $path = str_replace('/storage/', '', $project->image);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        // Delete all screenshot files 
        foreach ($project->screenshots as $screenshot) { 
            $path = str_replace('/storage/', '', $screenshot->image); 
            if (Storage::disk('public')->exists($path)) { 
                Storage::disk('public')->delete($path); 
            } 
        } 
        
        $project->skills()->detach();
        $project->delete();
        
        // Return JSON for SPA
        return response()->json([
            'message' => 'Project deleted successfully!'
        ]);
    }
}