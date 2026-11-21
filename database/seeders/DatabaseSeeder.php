<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $frieren = Media::create(['title' => "Frieren: Beyond Journey's End", 'type' => 'anime', 'year' => 2023, 'score' => 9.2, 'genres' => ['Adventure', 'Award Winning', 'Drama'], 'episodes' => 28]);
        Media::create(['title' => 'Fullmetal Alchemist: Brotherhood', 'type' => 'anime', 'year' => 2009, 'score' => 9.1, 'genres' => ['Action', 'Adventure', 'Drama'], 'episodes' => 64]);
        $steins = Media::create(['title' => 'Steins;Gate', 'type' => 'anime', 'year' => 2011, 'score' => 9.1, 'genres' => ['Drama', 'Sci-Fi', 'Suspense'], 'episodes' => 24]);
        Media::create(['title' => 'Attack on Titan Season 3', 'type' => 'anime', 'year' => 2019, 'score' => 9.1, 'genres' => ['Action', 'Drama', 'Suspense'], 'episodes' => 10]);
        $berserk = Media::create(['title' => 'Berserk', 'type' => 'manga', 'year' => 1989, 'score' => 9.4, 'genres' => ['Action', 'Adventure', 'Drama'], 'chapters' => 364]);

        $user = User::create(['name' => 'Salsabila', 'email' => 'salsabila@example.com', 'password' => 'password']);
        $user->media()->attach([$frieren->id, $steins->id, $berserk->id]);

        User::create(['name' => 'Budi', 'email' => 'budi@example.com', 'password' => 'password']);
    }
}
