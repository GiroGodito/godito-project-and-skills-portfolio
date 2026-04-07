<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectScreenshot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectScreenshotController extends Controller
{
    /**
     * Get paginated screenshots for a project (supports infinite scroll)
     */
    public function index(Project $project, Request $request)
    {
        $perPage = $request->get('per_page', 20);
        
        $screenshots = $project->screenshots()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        
        return response()->json([
            'data' => $screenshots->items(),
            'current_page' => $screenshots->currentPage(),
            'last_page' => $screenshots->lastPage(),
            'per_page' => $screenshots->perPage(),
            'total' => $screenshots->total(),
            'has_more_pages' => $screenshots->hasMorePages(),
            'next_page_url' => $screenshots->nextPageUrl(),
        ]);
    }
    
    /**
     * Upload multiple screenshots for a project
     */
    public function upload(Request $request, Project $project)
    {
        $request->validate([
            'screenshots' => 'required|array',
            'screenshots.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $uploaded = [];
        
        foreach ($request->file('screenshots') as $image) {
            $path = $image->store('project-screenshots', 'public');
            
            $screenshot = $project->screenshots()->create([
                'image' => '/storage/' . $path
            ]);
            
            $uploaded[] = $screenshot;
        }

        return response()->json([
            'success' => true,
            'message' => count($uploaded) . ' screenshot(s) uploaded successfully',
            'screenshots' => $uploaded
        ]);
    }
    
    /**
     * Delete a single screenshot
     */
    public function destroy(ProjectScreenshot $screenshot)
    {
        // Delete physical file
        $path = str_replace('/storage/', '', $screenshot->image);
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
        
        // Delete database record
        $screenshot->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Screenshot deleted successfully'
        ]);
    }
}