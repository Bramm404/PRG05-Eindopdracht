<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $genres = [
            'Adventure',
            'Action',
            'Soulslike',
            'Multiplayer',
            'Co-op',
            'RPG',
            'Strategy',
            'Simulation',
            'Sports',
            'Horror',
            'Platformer',
            'Racing',
            'Battle Royale',
            'Puzzle',
            'Survival',
            'Singleplayer',
            'First Person Shooter',
            'Third Person Shooter'
        ];

        foreach ($genres as $genre) {
            Genre::updateOrCreate(['name' => $genre]);
        }
    }
}
