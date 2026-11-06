@extends('layouts.app')

@section('title', 'Блог')

@section('content')
    <h1>Блог</h1>

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
