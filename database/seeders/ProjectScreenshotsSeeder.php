<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon; 
use Illuminate\Support\Facades\DB;

class ProjectScreenshotsSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        
        $screenshots = [
            // Project ID 3 (5 screenshots) - SeamsApp
            ['project_id' => 3, 'image' => 'storage/project-screenshots/DVAizFWQTd5EmF7kegKEI62rabDCti6tJLCh65Fh.png', 'created_at' => $now, 'updated_at' => $now],
            ['project_id' => 3, 'image' => 'storage/project-screenshots/7baEDMyoONlXKuOE4QicMhyFBUeoSWHB67IZmXO5.png', 'created_at' => $now, 'updated_at' => $now],
            ['project_id' => 3, 'image' => 'storage/project-screenshots/KXlSSYRetsdJHz05IbJqHkx4L0nqShfOUKoYoyZw.png', 'created_at' => $now, 'updated_at' => $now],
            ['project_id' => 3, 'image' => 'storage/project-screenshots/TVLJ226jCxXBLkvKWM7MrpeP4v0gwqT51T1ivqU0.png', 'created_at' => $now, 'updated_at' => $now],
            ['project_id' => 3, 'image' => 'storage/project-screenshots/9hXBeBg5329dxPlyscBn4qT4cb4L5F6QjxxEWdsG.png', 'created_at' => $now, 'updated_at' => $now],
            
            // Project ID 4 (5 screenshots) - SeamsWeb
            ['project_id' => 4, 'image' => 'storage/project-screenshots/K0pxd9uaDURwYSLq3wBBQugifvP9YRu4GpJf8aeH.png', 'created_at' => $now, 'updated_at' => $now],
            ['project_id' => 4, 'image' => 'storage/project-screenshots/XqjJfBvIMivbN2tRkzY0h67PHklKmKR1Pqj3BUd3.png', 'created_at' => $now, 'updated_at' => $now],
            ['project_id' => 4, 'image' => 'storage/project-screenshots/Z7H1WJb1y5tu19ArQZqdEneb8DD9w5KsRawh3Hee.png', 'created_at' => $now, 'updated_at' => $now],
            ['project_id' => 4, 'image' => 'storage/project-screenshots/AV8eVwGgNGDPV1J4gJYRg8dXDpz3DpLT4E8fmIvx.png', 'created_at' => $now, 'updated_at' => $now],
            ['project_id' => 4, 'image' => 'storage/project-screenshots/ro5kvdiNk4Mj5Yoiuo94w7h08YhxHKoQPgypF0kw.png', 'created_at' => $now, 'updated_at' => $now],
            
            // Project ID 5 (7 screenshots) - SETUP_CONNECT
            ['project_id' => 5, 'image' => 'storage/project-screenshots/JMjTjys4D6JjGCEM1yCrIUiTKKsv9UNZusxCp67G.png', 'created_at' => $now, 'updated_at' => $now],
            ['project_id' => 5, 'image' => 'storage/project-screenshots/gddacBuImPByAmupvxn5VrdbQNihl7UskhBVYtDC.png', 'created_at' => $now, 'updated_at' => $now],
            ['project_id' => 5, 'image' => 'storage/project-screenshots/re2exhKBmQkAoEwRtg1DOAmkOr3AsKonCxUixRvk.png', 'created_at' => $now, 'updated_at' => $now],
            ['project_id' => 5, 'image' => 'storage/project-screenshots/I5JXRGPQSa9OKbfyZ9dpvWlh5ycyzW7cyE06OwHn.png', 'created_at' => $now, 'updated_at' => $now],
            ['project_id' => 5, 'image' => 'storage/project-screenshots/b02bnlyhkgr6n7hzSVESey1mE5Ax5Ddxu31nlnIm.png', 'created_at' => $now, 'updated_at' => $now],
            ['project_id' => 5, 'image' => 'storage/project-screenshots/T7wVVFBGFIeooqT66MV51MDpSi34OHWHv6Sack27.png', 'created_at' => $now, 'updated_at' => $now],
            ['project_id' => 5, 'image' => 'storage/project-screenshots/PA5kZUNRu4kQLGi7TliXj4Hz0tDXMFVvsOTnLbRG.png', 'created_at' => $now, 'updated_at' => $now],
            
            // Project ID 6 (4 screenshots) - LosFon
            ['project_id' => 6, 'image' => 'storage/project-screenshots/XIx3FAV2z7RcbXgARD01KEaW9Be3bJropbxQuIvX.png', 'created_at' => $now, 'updated_at' => $now],
            ['project_id' => 6, 'image' => 'storage/project-screenshots/UswFX3GPItxMpkOq0N53PKwveHOit2Ur42xWTKKy.png', 'created_at' => $now, 'updated_at' => $now],
            ['project_id' => 6, 'image' => 'storage/project-screenshots/kBa7WE374TzLKzTdSzRvl3xFuQbJeKFmEjgJczvd.png', 'created_at' => $now, 'updated_at' => $now],
            ['project_id' => 6, 'image' => 'storage/project-screenshots/s9QdtDJrhWl9T51edNL20eer7KMtQKK8ZxrowHep.png', 'created_at' => $now, 'updated_at' => $now],
        ];
        
        DB::table('project_screenshots')->truncate();
        DB::table('project_screenshots')->insert($screenshots);
    }
}