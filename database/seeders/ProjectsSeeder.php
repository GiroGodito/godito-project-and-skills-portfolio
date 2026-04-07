<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon; 
use Illuminate\Support\Facades\DB;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         $now = Carbon::now();
        
        $projects = [
            [
                'id' => 3,
                'title' => 'SeamsApp',
                'status' => 'learning',
                'description' => 'The project utilized ASP.NET Core Web API through Swagger UI enumerating endpoints. This API serves as the backend server for the SeamsWeb. This project is not mine however I have collaborated with Den Mark Enoy and Jeevon M. Ricafort. My contributions mainly lies on developing the record-attendance endpoint and soon to be approved FileUpload/StudentPhoto endpoint and implementation of EntityFramework migrations in the project for easy syncing with db state changes.',
                'image' => 'storage/projects/c543vP0zxSXWCvTwlzOjKcBUceuMgEhgCGHyNnxe.png',
                'github_link' => null,
                'demo_link' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'title' => 'SeamsWeb',
                'status' => 'learning',
                'description' => 'The project utilized React Typescript for the frontend, which utilized SeamsApp backend. This is a web application showcasing QR scanning feature for tracking attendance, and a general dashboard for students. This project is not mine however I have collaborated with Den Mark Enoy and Jeevon M. Ricafort in the integration process. My main contribution to this project is the integration between the QR scanning feature with the backend /record-attendance endpoint from the SeamsApp.',
                'image' => 'storage/projects/QgGCUgtD0bHI8J94uLqq14Knjpf0T7MZSNmXDkUL.png',
                'github_link' => null,
                'demo_link' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'title' => 'SETUP_CONNECT',
                'status' => 'in_progress',
                'description' => 'SETUP_CONNECT is a modern web application built for the Department of Science and Technology (DOST) usinga full-stack architecture with Laravel backend and React frontend. We work in teams to accomplish particular modules by each sprint. Our team handles the list of messages feature.',
                'image' => 'storage/projects/4tUiSmSoK6y6dWybgwOeCk2q1E7PRrnKfSotUKBV.png',
                'github_link' => null,
                'demo_link' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'title' => 'LosFon',
                'status' => 'deployed',
                'description' => 'LosFon is a Lost and Found System developed for the Safety and Security Officer (SSO) office for tracking lost and found items. The system utilized DevExpress WinForm UI with C# being the main language and SQLite being the database used. We the Code Crunch Trio (Me, Zein Aliswag, Ivan Paul Intong) makes this project possible in the first place.',
                'image' => 'storage/projects/AstIKs08WsKtXVArZn7etpzHDtFyUK9klrKNwZ7m.png',
                'github_link' => null,
                'demo_link' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 7,
                'title' => 'Element Information System',
                'status' => 'learning',
                'description' => 'This project was created for the sole purpose of learning Hands-On PHP CRUD operation utilizing no framework approach (No Laravel, Symfony, CodeIgnite, etc.) in preparation for Laravel technology. I take inspiration of the periodic table as sample project idea and made it simple just enough to start exploring PHP. I have utilized card view approach in displaying the data mimicking the structure of an element in the periodic table as those are displayed as cards.',
                'image' => 'storage/projects/kx8JGyyscyA7jUBOryKj4xctsPYoNj7ExjSZ1EPr.png',
                'github_link' => null,
                'demo_link' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        
        DB::table('projects')->insert($projects);
    }
}
