<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Profile;
class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::truncate();
        
        Profile::create([
            'tagline' => '3rd Year BS Information Technology',
            'bio' => 'An aspiring developer from Dapitan City, Zamboanga del Norte, passionate about building robust web applications and exploring the world of cybersecurity. Currently expanding my skills in Laravel while strengthening my expertise in ASP.NET Core, React, and other emerging technologies.',
            'avatar' => null
        ]);
    }
}