@extends('layouts.app')

@section('title', 'Бета-тестувальники')

@section('content')

    <h1>Список бета-тестувальників</h1>

    {{-- Перемикач мов (залишаємо з попередньої лаби) --}}
    <div style="margin-bottom: 15px; font-size: 16px;">
        Мова:
        @foreach(\App\Models\BetaTester::AVAILABLE_LOCALES as $code => $name)
            <a href="{{ request()->fullUrlWithQuery(['lang' => $code]) }}"
               style="font-weight: {{ $lang == $code ? 'bold' : 'normal' }}; text-decoration: none; color: #6c63ff;">
                {{ $name }}
            </a>
            @if(!$loop->last) | @endif
        @endforeach
    </div>

    <p>
        <a href="{{ route('beta-testers.create') }}" style="color: #6c63ff; text-decoration: none; font-weight: bold;">
            + Додати тестувальника
        </a>
    </p>

    {{-- ФОРМА ПОШУКУ ТА ФІЛЬТРАЦІЇ --}}
    <form method="GET" action="{{ route('beta-testers.index') }}" style="margin-bottom: 25px; display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end; background: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #e8e8e8;">
        <div>
            <label for="name" style="display: block; font-size: 14px; margin-bottom: 5px; font-weight: 500;">Ім'я</label>
            <input type="text" id="name" name="name" value="{{ request('name') }}" placeholder="Пошук за ім'ям" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 180px;">
        </div>
        <div>
            <label for="gameTitle" style="display: block; font-size: 14px; margin-bottom: 5px; font-weight: 500;">Назва гри</label>
            <input type="text" id="gameTitle" name="gameTitle" value="{{ request('gameTitle') }}" placeholder="Пошук за грою" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 180px;">
        </div>
        <div>
            <label for="game_id" style="display: block; font-size: 14px; margin-bottom: 5px; font-weight: 500;">Гра (список)</label>
            <select id="game_id" name="game_id" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 180px;">
                <option value="">Усі ігри</option>
                @foreach ($games as $id => $title)
                    <option value="{{ $id }}" @selected(request('game_id') == $id)>{{ $title }}</option>
                @endforeach
            </select>
        </div>

        {{-- Зберігаємо поточне сортування та мову --}}
        <input type="hidden" name="sort" value="{{ request('sort') }}">
        <input type="hidden" name="lang" value="{{ $lang }}">

        <div>
            <button type="submit" style="padding: 9px 20px; background: #6c63ff; color: white; border: none; border-radius: 4px; cursor: pointer;">Знайти</button>
            <a href="{{ route('beta-testers.index', ['lang' => $lang]) }}" style="padding: 9px 15px; color: #666; text-decoration: none; font-size: 14px;">Скинути</a>
        </div>
    </form>

    <table style="width: 100%; border-collapse: collapse; background: white; border: 1px solid #e8e8e8; margin-bottom: 20px;">
        <thead>
        <tr style="background: #f8f9fa; text-align: left; border-bottom: 2px solid #dee2e6;">
            <th style="padding: 12px; border: 1px solid #dee2e6; width: 50px;">#</th>

            {{-- Сортування за ім'ям --}}
            @php
                $currentSort = request('sort');
                $nextSortName = $currentSort === 'name' ? '-name' : 'name';
            @endphp
            <th style="padding: 12px; border: 1px solid #dee2e6;">
                <a href="{{ route('beta-testers.index', array_merge(request()->except('sort', 'page'), ['sort' => $nextSortName])) }}" style="text-decoration: none; color: #333;">
                    Ім'я
                    @if ($currentSort === 'name') ↑ @elseif ($currentSort === '-name') ↓ @endif
                </a>
            </th>

            <th style="padding: 12px; border: 1px solid #dee2e6;">Email</th>
            <th style="padding: 12px; border: 1px solid #dee2e6; width: 80px;">Вік</th>
            <th style="padding: 12px; border: 1px solid #dee2e6; width: 120px;">Платформа</th>
            <th style="padding: 12px; border: 1px solid #dee2e6;">Досвід</th>

            {{-- Сортування за кількістю ігор --}}
            @php
                $nextSortGames = $currentSort === 'games_count' ? '-games_count' : 'games_count';
            @endphp
            <th style="padding: 12px; border: 1px solid #dee2e6; width: 100px; text-align: center;">
                <a href="{{ route('beta-testers.index', array_merge(request()->except('sort', 'page'), ['sort' => $nextSortGames])) }}" style="text-decoration: none; color: #333;">
                    Ігор
                    @if ($currentSort === 'games_count') ↑ @elseif ($currentSort === '-games_count') ↓ @endif
                </a>
            </th>

            <th style="padding: 12px; border: 1px solid #dee2e6; width: 100px;">Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($betaTesters as $i => $tester)
            <tr style="border-bottom: 1px solid #dee2e6;">
                <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $betaTesters->firstItem() + $i }}</td>
                <td style="padding: 12px; border: 1px solid #dee2e6;">
                    <a href="{{ route('beta-testers.show', $tester) }}" style="color: #6c63ff; text-decoration: none;">
                        {{ $tester->name }}
                    </a>
                </td>
                <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $tester->email }}</td>
                <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $tester->age }}</td>
                <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $tester->platform }}</td>
                <td style="padding: 12px; border: 1px solid #dee2e6;">
                    {{ $tester->getTranslatedExperience($lang) }}
                </td>

                {{-- Виведення кількості ігор (завдяки withCount) --}}
                <td style="padding: 12px; border: 1px solid #dee2e6; text-align: center;">
                    <span style="display: inline-block; padding: 4px 8px; background: #e9ecef; border-radius: 12px; font-weight: bold; font-size: 14px;">
                        {{ $tester->games_count }}
                    </span>
                </td>

                <td style="padding: 12px; border: 1px solid #dee2e6;">
                    <a href="{{ route('beta-testers.edit', $tester) }}" style="color: #2d3a4d; text-decoration: none; font-weight: 500;">
                        Редагувати
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" style="padding: 20px; text-align: center; color: #777;">
                    Тестувальників не знайдено.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div style="margin-top: 30px;">
        {{ $betaTesters->links() }}
    </div>

@endsection
