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
        // Get home directory (works on Mac, Windows, Linux)
        $homePath = getenv('HOME') ?: getenv('USERPROFILE');
        $secretFile = $homePath . '/.arthon-dev-auth';
        
        // Check if secret file EXISTS (no content check)
        $hasSecretFile = file_exists($secretFile);
        
        if (!$hasSecretFile) {
            $this->command->error('============================================');
            $this->command->error('❌ AUTHORIZATION FILE NOT FOUND!');
            $this->command->error('============================================');
            $this->command->warn("Looking for: {$secretFile}");
            $this->command->warn('');
            $this->command->warn('This computer is not authorized to create an admin user.');
            $this->command->warn('');
            $this->command->warn('To authorize this computer, create the file:');
            $this->command->warn('');
            $this->command->warn('  🍎 Mac/Linux:');
            $this->command->warn('     touch ~/.arthon-dev-auth');
            $this->command->warn('     or');
            $this->command->warn('     echo "anything" > ~/.arthon-dev-auth');
            $this->command->warn('');
            $this->command->warn('  🪟 Windows (CMD):');
            $this->command->warn('     type nul > %USERPROFILE%\.arthon-dev-auth');
            $this->command->warn('     or');
            $this->command->warn('     echo anything > %USERPROFILE%\.arthon-dev-auth');
            $this->command->warn('');
            $this->command->warn('  🪟 Windows (PowerShell):');
            $this->command->warn('     New-Item -Path $env:USERPROFILE\.arthon-dev-auth -ItemType File');
            $this->command->error('============================================');
            return;
        }
        
        // Secret file exists - create admin user
        $this->command->info('============================================');
        $this->command->info('✅ Authorization verified!');
        $this->command->info("📍 Authorization file: {$secretFile}");
        $this->command->info('============================================');
        
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
        
        $this->command->info('✅ Admin user created successfully!');
        $this->command->info("Name: {$adminName}");
        $this->command->info("Email: {$adminEmail}");
        $this->command->info('============================================');
        
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