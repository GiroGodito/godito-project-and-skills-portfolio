<?php
namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Profile;

class PortfolioController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('name')->paginate(6);
        $projects = Project::with('skills')->orderBy('created_at','desc')->paginate(2);
        $profile = Profile::first();
        return view('welcome', compact('skills', 'projects', 'profile'));
    }
}