@extends('layouts.app')
@section('title', $betaTester->name)
@section('content')
    <h1>Картка тестувальника: {{ $betaTester->name }}</h1>

    <p><strong>Email:</strong> {{ $betaTester->email }}</p>
    <p><strong>Вік:</strong> {{ $betaTester->age }}</p>
    <p><strong>Платформа:</strong> {{ $betaTester->platform }}</p>
    <p><strong>Досвід:</strong> {{ $betaTester->experience ?? 'Не вказано' }}</p>

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
