@extends('layouts.app')
@section('title', $betaTester->name)
@section('content')

    <div style="margin-bottom: 20px;">
        Мова:
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'uk']) }}">Українська</a> |
        <a href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}">English</a>
    </div>

    <h1>Картка тестувальника: {{ $betaTester->name }}</h1>

    <p><strong>Email:</strong> {{ $betaTester->email }}</p>
    <p><strong>Вік:</strong> {{ $betaTester->age }}</p>
    <p><strong>Платформа:</strong> {{ $betaTester->platform }}</p>
    <p><strong>Досвід:</strong> {{ $betaTester->getTranslatedExperience($lang) }}</p>

    <div style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 8px; border: 1px solid #eee;">
        <h3 style="margin-top: 0;">Призначені ігри:</h3>
        @if($betaTester->games->isNotEmpty())
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($betaTester->games as $game)
                    <li>
                        <strong>{{ $game->title }}</strong>
                        ({{ $game->genre }})
                    </li>
                @endforeach
            </ul>
        @else
            <p style="margin: 0; color: #777;">Тестувальник ще не призначений на жодну гру.</p>
        @endif
    </div>

    <p>
        <a href="{{ route('beta-testers.edit', $betaTester) }}">Редагувати</a> |
        <a href="{{ route('beta-testers.index') }}">Повернутися до списку</a>
    </p>

    <form method="POST" action="{{ route('beta-testers.destroy', $betaTester) }}" style="margin-top: 15px;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Ви впевнені?')">Видалити запис</button>
    </form>
@endsection
