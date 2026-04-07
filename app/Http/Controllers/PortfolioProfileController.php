<?php
namespace App\Http\Controllers;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioProfileController extends Controller
{
    /**
     * Get the profile data
     */
    public function show()
    {
        $profile = Profile::first();
        return response()->json($profile);
    }

    /**
     * Update the profile
     */
    public function update(Request $request)
    {
        $request->validate([
            'tagline' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:10240'
        ]);

        $profile = Profile::first();

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($profile->avatar) {
                $oldPath = str_replace('/storage/', '', $profile->avatar);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $profile->avatar = '/storage/' . $path;
        }

        $profile->tagline = $request->tagline;
        $profile->bio = $request->bio;
        $profile->save();

        return response()->json([
            'message' => 'Profile updated successfully!',
            'profile' => $profile
        ]);
    }
}