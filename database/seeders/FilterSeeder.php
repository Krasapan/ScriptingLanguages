<?php

namespace Database\Seeders;

use App\Models\Filter;
use Illuminate\Database\Seeder;

class FilterSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Початковий рівень', 'Практика', 'Теорія', 'Лабораторна робота', 'Огляд', 'Довідка'];
        foreach ($names as $name) {
            Filter::create(['filter_name' => $name]);
        }
    }
}
