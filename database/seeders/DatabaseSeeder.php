<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Delete ALL the secret file checking code above
    
        $adminName = config('admin.name');
        $adminEmail = config('admin.email');
        $adminPassword = config('admin.password');
        
        User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => $adminName,
                'email' => $adminEmail,
                'password' => Hash::make($adminPassword),
                'email_verified_at' => now(),
            ]
        );
        
        // Call other seeders (uncomment when ready)
        $this->call([
            ProfileSeeder::class,
            SkillsSeeder::class,
            ProjectsSeeder::class,
            ProjectSkillsSeeder::class,
            ProjectScreenshotsSeeder::class,
        ]);
    }
}