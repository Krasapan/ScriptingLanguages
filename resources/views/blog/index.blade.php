@extends('layouts.app')

@section('title', 'Блог')

@section('content')
    <h1>Блог</h1>

    <nav class="blog-filters" style="margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap;">
        <a href="{{ route('blog.index') }}" style="padding: 5px 10px; border: 1px solid #ddd; border-radius: 4px; text-decoration: none; color: #999; {{ !$filterId ? 'background-color: #6c63ff; color: white;' : '' }}">Усі записи</a>
        @foreach ($filters as $id => $name)
            <a href="{{ route('blog.index', ['filter' => $id]) }}" style="padding: 5px 10px; border: 1px solid #ddd; border-radius: 4px; text-decoration: none; color: #999; {{ $filterId == $id ? 'background-color: #6c63ff; color: white;' : '' }}">
                {{ $name }}
            </a>
        @endforeach
    </nav>

    <p style="margin-bottom: 20px;">
        <a href="{{ route('blog.admin') }}">Перейти до адміністрування</a>
    </p>

    <div class="blog-grid">
        @forelse ($blogs as $blog)
            @include('blog._item', ['blog' => $blog])
        @empty
            <p>Записів поки немає.</p>
        @endforelse
    </div>

    <div style="margin-top: 20px;">
        {{ $blogs->links() }}
    </div>

@endsection
