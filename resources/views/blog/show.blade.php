@extends('layouts.app')

@section('title', $blog->title)

@section('content')
    <article style="max-width: 800px; margin: 0 auto;">
        <h1>{{ $blog->title }}</h1>

        <div style="color: #666; font-size: 14px; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
            <span>Категорія: <strong>{{ $blog->category?->category_name ?? 'Без категорії' }}</strong></span>
            <span style="margin-left: 20px;">Автор: <strong>{{ $blog->author?->name ?? 'Редакція' }}</strong></span>
            <span style="margin-left: 20px;">Дата: {{ $blog->dt_created->format('d.m.Y H:i') }}</span>
        </div>

        @if($blog->description)
            <p style="font-size: 18px; font-style: italic; color: #444; margin-bottom: 30px;">
                {{ $blog->description }}
            </p>
        @endif

        <div style="line-height: 1.6; font-size: 16px;">
            {!! nl2br(e($blog->text ?? 'Текст відсутній.')) !!}
        </div>
    </article>

    <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee;">
        <a href="{{ route('blog.index') }}">← Повернутися до списку</a>
    </div>
@endsection
