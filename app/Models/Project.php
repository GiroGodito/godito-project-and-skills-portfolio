<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    protected $fillable = [
        'title',
        'status',
        'description',
        'image',
        'github_link',
        'demo_link'
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class,'skill_project');
    }

    public function getImageUrlAttribute()
    {
        if(!$this->image)
        {
            return null;
        }

        if(filter_var($this->image, FILTER_VALIDATE_URL))
        {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }

    protected static function booted()
    {
        static::deleting(function ($project) {
            // Delete thumbnail
            if ($project->image) {
                $path = str_replace('/storage/', '', $project->image);
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
            
            // Delete all screenshots (files + database)
            foreach ($project->screenshots as $screenshot) {
                $screenshotPath = str_replace('/storage/', '', $screenshot->image);
                if (Storage::disk('public')->exists($screenshotPath)) {
                    Storage::disk('public')->delete($screenshotPath);
                }
                $screenshot->delete();
            }
        });
    }

    public function screenshots()
    {
        return $this->hasMany(ProjectScreenshot::class)->orderBy('created_at');
    }
}
