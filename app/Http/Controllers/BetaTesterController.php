<?php

namespace App\Http\Controllers;

use App\Http\Requests\BetaTesterRequest;
use App\Queries\BetaTesterFilter;
use App\Models\BetaTester;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


class BetaTesterController extends Controller
{
    public function index(Request $request, BetaTesterFilter $filter)
    {
        $lang = $request->query('lang', 'uk');

        // Валідація параметрів пошуку
        $input = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'gameTitle' => ['nullable', 'string', 'max:150'],
            'game_id' => ['nullable', 'integer', 'exists:games,game_id'],
            'sort' => ['nullable', 'string', 'max:30'],
        ]);

        // Застосування фільтрів та пагінація
        $betaTesters = $filter->apply($input)
            ->paginate(5)
            ->withQueryString(); // Зберігає параметри пошуку при переході між сторінками

        // Список усіх ігор для випадаючого списку
        $games = Game::pluck('title', 'game_id');

        return view('beta-testers.index', compact('betaTesters', 'lang', 'games'));
    }

    public function create()
    {
        return view('beta-testers.create', [
            'games' => Game::pluck('title', 'game_id'),
            'selectedGames' => [],
        ]);
    }

    public function store(BetaTesterRequest $request)
    {
        $data = $request->validated();
        $games = $data['games'] ?? [];

        // Створюємо тестувальника без масиву ігор
        $betaTester = BetaTester::create(Arr::except($data, ['games']));

        // Синхронізуємо зв'язки
        $betaTester->games()->sync($games);

        return redirect()->route('beta-testers.index');
    }

    public function show(Request $request, BetaTester $betaTester)
    {
        $lang = $request->query('lang', 'uk');
        // Завантажуємо гру та переклади
        $betaTester->load(['translations', 'games']);

        return view('beta-testers.show', compact('betaTester', 'lang'));
    }

    public function edit(BetaTester $betaTester)
    {
        $betaTester->load(['translations', 'games']);

        return view('beta-testers.edit', [
            'betaTester' => $betaTester,
            'games' => Game::pluck('title', 'game_id'),
            'selectedGames' => $betaTester->games->pluck('game_id')->all(),
        ]);
    }

    public function update(BetaTesterRequest $request, BetaTester $betaTester)
    {
        $data = $request->validated();
        $games = $data['games'] ?? [];

        // Оновлюємо дані тестувальника без ігор
        $betaTester->update(Arr::except($data, ['games']));

        // Синхронізуємо зв'язки
        $betaTester->games()->sync($games);

        // Логіка оновлення перекладів (з попередньої лаби)
        if ($request->has('translations')) {
            foreach ($request->input('translations') as $locale => $text) {
                if (!empty($text)) {
                    $betaTester->translations()->updateOrCreate(
                        ['locale' => $locale],
                        ['experience' => $text]
                    );
                }
            }
        }

        return redirect()->route('beta-testers.index');
    }

    public function destroy(BetaTester $betaTester)
    {
        $betaTester->delete();
        return redirect()->route('beta-testers.index');
    }
}
