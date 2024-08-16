<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Genre;
use App\Models\MiscTexts;
use App\Models\Picture;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Picture::factory()->create([
            'image' => 'test.jpg',
        ]);

        Genre::factory()->create([
            'name' => 'Rock',
        ]);
        Artist::factory(30)->create();

        

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            PortfolioSeeder::class,
            MiscTextsSeeder::class,
        ]);
    }
}
