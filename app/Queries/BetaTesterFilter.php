<?php

namespace App\Queries;

use App\Models\BetaTester;
use Illuminate\Database\Eloquent\Builder;

class BetaTesterFilter
{
    // Білий список дозволених колонок для сортування
    private const SORTABLE = [
        'name' => 'beta_testers.name',
        'age' => 'beta_testers.age',
        'games_count' => 'games_count', // Віртуальна колонка з withCount()
    ];

    public function apply(array $input): Builder
    {
        $query = BetaTester::query()
            ->select('beta_testers.*')       // 1. Спочатку задаємо базові колонки
            ->with(['translations', 'games']) // 2. Підвантажуємо зв'язки
            ->withCount('games');            // 3. Тепер withCount додасть свій підзапит до вже вибраних колонок

        // Пошук за ім'ям тестувальника
        $query->when(
            $input['name'] ?? null,
            fn (Builder $q, $value) => $q->where('beta_testers.name', 'like', "%{$value}%")
        );

        // Пошук за назвою гри (через зв'язок N:N)
        $query->when(
            $input['gameTitle'] ?? null,
            fn (Builder $q, $value) => $q->whereHas(
                'games',
                fn (Builder $related) => $related->where('title', 'like', "%{$value}%")
            )
        );

        // Фільтрація за конкретною грою (випадаючий список)
        $query->when(
            $input['game_id'] ?? null,
            fn (Builder $q, $value) => $q->whereHas(
                'games',
                fn (Builder $related) => $related->whereKey($value)
            )
        );

        return $this->sort($query, $input['sort'] ?? null);
    }

    private function sort(Builder $query, ?string $sort): Builder
    {
        $desc = str_starts_with($sort ?? '', '-');
        $field = $desc ? substr($sort, 1) : $sort;

        if (!isset(self::SORTABLE[$field])) {
            // Сортування за замовчуванням
            return $query->orderByDesc('beta_testers.id');
        }

        return $query->orderBy(
            self::SORTABLE[$field],
            $desc ? 'desc' : 'asc'
        );
    }
}
