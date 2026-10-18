<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BetaTesterSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('beta_testers')->insert([
            [
                'name' => 'Олександр Коваленко',
                'email' => 'kovalenko@kpi.ua',
                'age' => 20,
                'platform' => 'PC',
                'experience' => 'Досвід у RPG та Strategy іграх понад 5 років.',
            ],
            [
                'name' => 'Марія Шевченко',
                'email' => 'shevchenko@kpi.ua',
                'age' => 22,
                'platform' => 'Mobile',
                'experience' => 'Активний тестувальник мобільних проєктів.',
            ],
            [
                'name' => 'Дмитро Бондаренко',
                'email' => 'bondarenko@kpi.ua',
                'age' => 19,
                'platform' => 'Console',
                'experience' => 'Грає на PlayStation та Xbox.',
            ],
            [
                'name' => 'Анна Мельник',
                'email' => 'melnyk@kpi.ua',
                'age' => 21,
                'platform' => 'PC',
                'experience' => 'Фанах іннді-ігор та екшенів.',
            ],
            [
                'name' => 'Максим Ткаченко',
                'email' => 'tkachenko@kpi.ua',
                'age' => 23,
                'platform' => 'PC',
                'experience' => 'Геймдев-ентузіаст, тестує фізику рушіїв.',
            ],
            [
                'name' => 'Юлія Павленко',
                'email' => 'pavlenko@kpi.ua',
                'age' => 20,
                'platform' => 'Mobile',
                'experience' => 'Любить головоломки та казуальні ігри.',
            ],
        ]);
    }
}
