<?php

namespace Database\Seeders;

use App\Models\BetaTester;
use App\Models\BetaTesterTranslation;
use Illuminate\Database\Seeder;

class BetaTesterSeeder extends Seeder
{
    public function run(): void
    {
        // Створюємо 7 тестувальників
        for ($i = 1; $i <= 7; $i++) {
            $tester = BetaTester::create([
                'name' => "Тестувальник $i",
                'email' => "tester$i@kpi.ua",
                'age' => 18 + $i,
                'platform' => $i % 2 == 0 ? 'PC' : 'Mobile',
                'experience' => "Оригінальний опис досвіду №$i (Українська за замовчуванням)",
            ]);

            // Додаємо український переклад
            BetaTesterTranslation::create([
                'beta_tester_id' => $tester->id,
                'locale' => 'uk',
                'experience' => "Український переклад: досвід тестування ігор №$i.",
            ]);

            // Додаємо англійський переклад
            BetaTesterTranslation::create([
                'beta_tester_id' => $tester->id,
                'locale' => 'en',
                'experience' => "English translation: game testing experience #$i.",
            ]);
        }
    }
}
