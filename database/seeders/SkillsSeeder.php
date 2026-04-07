<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon; 
use Illuminate\Support\Facades\DB;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $now = Carbon::now();
        
        $skills = [
            [
                'id' => 2,
                'name' => 'PHP',
                'created_at' => '2026-03-30 09:49:50',
                'updated_at' => '2026-04-01 12:32:39',
            ],
            [
                'id' => 5,
                'name' => 'SQLite',
                'created_at' => '2026-04-01 09:11:52',
                'updated_at' => '2026-04-02 03:31:00',
            ],
            [
                'id' => 6,
                'name' => 'MySQL',
                'created_at' => '2026-04-01 09:14:11',
                'updated_at' => '2026-04-01 09:14:11',
            ],
            [
                'id' => 18,
                'name' => 'C#',
                'created_at' => '2026-04-01 11:29:04',
                'updated_at' => '2026-04-01 11:29:04',
            ],
            [
                'id' => 23,
                'name' => 'Laravel',
                'created_at' => '2026-04-02 06:30:06',
                'updated_at' => '2026-04-02 06:30:06',
            ],
            [
                'id' => 24,
                'name' => 'MSSQL',
                'created_at' => '2026-04-02 06:37:42',
                'updated_at' => '2026-04-02 06:37:42',
            ],
            [
                'id' => 28,
                'name' => 'React',
                'created_at' => '2026-04-03 13:05:21',
                'updated_at' => '2026-04-03 13:05:21',
            ],
        ];
        
        DB::table('skills')->insert($skills);
    }
}
