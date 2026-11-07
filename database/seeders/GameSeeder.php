<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $games = [
            ['title' => 'Стандартна стратегія', 'genre' => 'Strategy'],
            ['title' => 'Просто платформер', 'genre' => 'Platformer'],
            ['title' => 'Звичайний 3Д шутер', 'genre' => 'FPS'],
            ['title' => 'Типовий горрор', 'genre' => 'Horror'],
        ];

        foreach ($games as $game) {
            Game::create($game);
        }
    }
}
