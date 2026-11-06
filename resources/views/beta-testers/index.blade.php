@extends('layouts.app')

@section('title', 'Бета-тестувальники')

@section('content')

    <h1>Список бета-тестувальників</h1>

    {{-- Динамічний перемикач мов --}}
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

    {{-- Форма фільтрації за віком --}}
    <form method="GET" action="{{ route('beta-testers.index') }}" style="margin-bottom: 25px; display: flex; gap: 10px; align-items: center;">
        <label for="age" style="font-size: 14px; font-weight: 500;">Фільтр за віком:</label>
        <input type="number" id="age" name="age" value="{{ request('age') }}" placeholder="Наприклад, 20" style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px;">
        <button type="submit" style="padding: 6px 15px; background: #6c63ff; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Фільтрувати
        </button>
        @if(request('age'))
            <a href="{{ route('beta-testers.index') }}" style="color: #666; text-decoration: none; font-size: 14px;">Скинути</a>
        @endif
    </form>

    <table style="width: 100%; border-collapse: collapse; background: white; border: 1px solid #e8e8e8; margin-bottom: 20px;">
        <thead>
        <tr style="background: #f8f9fa; text-align: left; border-bottom: 2px solid #dee2e6;">
            <th style="padding: 12px; border: 1px solid #dee2e6; width: 50px;">#</th>
            <th style="padding: 12px; border: 1px solid #dee2e6;">Ім'я</th>
            <th style="padding: 12px; border: 1px solid #dee2e6;">Email</th>
            <th style="padding: 12px; border: 1px solid #dee2e6; width: 80px;">Вік</th>
            <th style="padding: 12px; border: 1px solid #dee2e6; width: 120px;">Платформа</th>
            {{-- ДОДАНО: Заголовок для нової колонки --}}
            <th style="padding: 12px; border: 1px solid #dee2e6;">Досвід</th>
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

                {{-- ДОДАНО: Виведення перекладу всередині циклу --}}
                <td style="padding: 12px; border: 1px solid #dee2e6;">
                    {{ $tester->getTranslatedExperience($lang) }}
                </td>

                <td style="padding: 12px; border: 1px solid #dee2e6;">
                    <a href="{{ route('beta-testers.edit', $tester) }}" style="color: #2d3a4d; text-decoration: none; font-weight: 500;">
                        Редагувати
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="padding: 20px; text-align: center; color: #777;">
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
