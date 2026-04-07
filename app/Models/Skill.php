<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name'];
    protected $withCount = ['projects'];
    
    public function projects()
    {
        return $this->belongsToMany(Project::class,'skill_project');
    }
}
