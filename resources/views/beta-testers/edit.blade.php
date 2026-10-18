@extends('layouts.app')
@section('title', 'Редагувати тестувальника')
@section('content')
    <h1>Редагувати дані тестувальника</h1>

    <form method="POST" action="{{ route('beta-testers.update', $betaTester) }}">
        @csrf
        @method('PUT')
        @include('beta-testers._form')
        <button type="submit">Зберегти зміни</button>
    </form>

    <p style="margin-top: 15px;">
        <a href="{{ route('beta-testers.index') }}">Повернутися до списку</a>
    </p>
@endsection
