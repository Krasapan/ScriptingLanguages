@extends('layouts.app')

@section('title', 'Редагування запису')

@section('content')
    <h1>Редагування запису: {{ $blog->title }}</h1>

    <form method="POST" action="{{ route('blog.update', $blog) }}">
        @csrf
        @method('PUT') {{-- Обов'язково для оновлення --}}

        @include('blog._form')

        <div style="margin-top: 15px;">
            <button type="submit">Зберегти зміни</button>
            <a href="{{ route('blog.show', $blog) }}" style="margin-left: 15px;">Скасувати</a>
        </div>
    </form>
@endsection
