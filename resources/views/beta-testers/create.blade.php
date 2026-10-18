@extends('layouts.app')
@section('title', 'Додати тестувальника')
@section('content')
    <h1>Додати нового тестувальника</h1>

    <form method="POST" action="{{ route('beta-testers.store') }}">
        @csrf
        @include('beta-testers._form')
        <button type="submit">Зберегти</button>
    </form>

    <p style="margin-top: 15px;">
        <a href="{{ route('beta-testers.index') }}">Повернутися до списку</a>
    </p>
@endsection
