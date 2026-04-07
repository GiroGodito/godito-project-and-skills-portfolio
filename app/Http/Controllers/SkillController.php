<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    // public function index(Request $request)
    // {
    //     $skills = Skill::cursorPaginate(6);
        
    //     return response()->json([
    //         'data' => $skills->items(),
    //         'next_cursor' => $skills->nextCursor() ? $skills->nextCursor()->encode() : null,
    //         'prev_cursor' => $skills->previousCursor() ? $skills->previousCursor()->encode() : null,
    //         'has_more_pages' => $skills->hasMorePages(),
    //     ]);
    // }

    public function index(Request $request)  // <<<<< THIS METHOD NEEDS UPDATING
    {
        // <<<<< ADD THIS BLOCK AT THE BEGINNING
        if ($request->has('all')) {
            $skills = Skill::orderBy('name')->get();
            return response()->json([
                'data' => $skills,
                'next_cursor' => null,
                'prev_cursor' => null,
                'has_more_pages' => false,
            ]);
        }
        // <<<<< END OF ADDED BLOCK
        
        $skills = Skill::cursorPaginate(6);
        
        return response()->json([
            'data' => $skills->items(),
            'next_cursor' => $skills->nextCursor() ? $skills->nextCursor()->encode() : null,
            'prev_cursor' => $skills->previousCursor() ? $skills->previousCursor()->encode() : null,
            'has_more_pages' => $skills->hasMorePages(),
        ]);
    }
    
    /**
     * Store a new skill
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:skills',
            //'percentage' => 'required|integer|min:0|max:100'
        ]);

        $skill = Skill::create($request->only('name'));
        
        // FIX: Return JSON instead of redirect
        return response()->json([
            'success' => true,
            'message' => 'Skill added successfully!',
            'data' => $skill
        ]);
    }

    /**
     * Update an existing skill
     */
    public function update(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:skills,name,' . $id,
            //'percentage' => 'required|integer|min:0|max:100'
        ]);

        $skill->update($request->only('name'));
        
        // FIX: Return JSON instead of redirect
        return response()->json([
            'success' => true,
            'message' => 'Skill updated successfully!',
            'data' => $skill
        ]);
    }

    /**
     * Delete a skill
     */
    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        
        // FIX: Return JSON instead of redirect
        return response()->json([
            'success' => true,
            'message' => 'Skill deleted successfully!'
        ]);
    }
}