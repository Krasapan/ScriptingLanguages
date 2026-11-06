<?php

namespace App\Http\Controllers;

use App\Http\Requests\BetaTesterRequest;
use App\Models\BetaTester;
use Illuminate\Http\Request;

class BetaTesterController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->query('lang', 'uk');
        $query = BetaTester::query();

        if ($request->filled('age')) {
            $query->where('age', $request->age);
        }

        $betaTesters = $query->with('translations')->orderBy('name')->paginate(5)->withQueryString();

        return view('beta-testers.index', compact('betaTesters', 'lang'));
    }

    public function create()
    {
        return view('beta-testers.create');
    }

    public function store(BetaTesterRequest $request)
    {
        $betaTester = BetaTester::create($request->validated());

        if ($request->has('translations')) {
            foreach ($request->input('translations') as $locale => $text) {
                if (!empty($text)) {
                    $betaTester->translations()->create([
                        'locale' => $locale,
                        'experience' => $text,
                    ]);
                }
            }
        }

        return redirect()->route('beta-testers.index');
    }

    public function show(Request $request, BetaTester $betaTester)
    {
        $lang = $request->query('lang', 'uk');
        // Завантажуємо переклади для конкретного тестувальника
        $betaTester->load('translations');

        return view('beta-testers.show', compact('betaTester', 'lang'));
    }

    public function edit(BetaTester $betaTester)
    {
        // ДОДАНО: завантажуємо переклади, щоб форма могла їх відобразити
        $betaTester->load('translations');

        return view('beta-testers.edit', compact('betaTester'));
    }

    public function update(BetaTesterRequest $request, BetaTester $betaTester)
    {
        $betaTester->update($request->validated());

        if ($request->has('translations')) {
            foreach ($request->input('translations') as $locale => $text) {
                // Якщо текст не порожній - оновлюємо або створюємо
                if (!empty($text)) {
                    $betaTester->translations()->updateOrCreate(
                        ['locale' => $locale], // Умова пошуку
                        ['experience' => $text] // Дані для оновлення/створення
                    );
                } else {
                    // (Опціонально) Якщо поле очистили, можна видалити переклад
                    $betaTester->translations()->where('locale', $locale)->delete();
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
