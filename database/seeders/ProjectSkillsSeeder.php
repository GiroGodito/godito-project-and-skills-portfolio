<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon; 
use Illuminate\Support\Facades\DB;

class ProjectSkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         $now = Carbon::now();
        
        $skillProjects = [
            // skill_id, project_id
            ['skill_id' => 5, 'project_id' => 6, 'created_at' => $now, 'updated_at' => $now],  // SQLite -> LosFon
            ['skill_id' => 6, 'project_id' => 5, 'created_at' => $now, 'updated_at' => $now],  // MySQL -> SETUP_CONNECT
            ['skill_id' => 18, 'project_id' => 3, 'created_at' => $now, 'updated_at' => $now], // C# -> SeamsApp
            ['skill_id' => 18, 'project_id' => 6, 'created_at' => $now, 'updated_at' => $now], // C# -> LosFon
            ['skill_id' => 2, 'project_id' => 5, 'created_at' => $now, 'updated_at' => $now],  // PHP -> SETUP_CONNECT
            ['skill_id' => 23, 'project_id' => 5, 'created_at' => $now, 'updated_at' => $now], // Laravel -> SETUP_CONNECT
            ['skill_id' => 24, 'project_id' => 3, 'created_at' => $now, 'updated_at' => $now], // MSSQL -> SeamsApp
            ['skill_id' => 28, 'project_id' => 4, 'created_at' => $now, 'updated_at' => $now], // React -> SeamsWeb
            ['skill_id' => 28, 'project_id' => 5, 'created_at' => $now, 'updated_at' => $now], // React -> SETUP_CONNECT
            ['skill_id' => 2, 'project_id' => 7, 'created_at' => $now, 'updated_at' => $now],  // PHP -> Element Information System
        ];
        
        DB::table('skill_project')->insert($skillProjects);
    }
}
