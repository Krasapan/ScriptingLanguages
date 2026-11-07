<?php

namespace App\Http\Controllers;

use App\Http\Requests\BetaTesterRequest;
use App\Models\BetaTester;
use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Arr;

class BetaTesterController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->query('lang', 'uk');
        $query = BetaTester::query();

        if ($request->filled('age')) {
            $query->where('age', $request->age);
        }

        $betaTesters = $query->with('translations')
            ->withCount('games')
            ->orderBy('name')
            ->paginate(5)
            ->withQueryString();

        return view('beta-testers.index', compact('betaTesters', 'lang'));
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
