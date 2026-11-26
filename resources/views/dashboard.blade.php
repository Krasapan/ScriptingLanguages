@extends('layouts.app')

@section('title', 'Особистий кабінет')

@section('content')
    <h1>Особистий кабінет</h1>

    <div style="background: #f8f9fa; border: 1px solid #e8e8e8; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
        <p style="margin: 0; font-size: 18px;">
            Вітаємо, <strong>{{ auth()->user()->name }}</strong>!
        </p>
        <p style="margin: 5px 0 0 0; color: #666;">
            Ви успішно увійшли в систему.
        </p>
    </div>

    <h2>Ваші записи в блозі</h2>

    @if($blogs->isEmpty())
        <div style="padding: 30px; text-align: center; background: white; border: 1px solid #e8e8e8; border-radius: 8px; color: #777;">
            Ви ще не створили жодного запису в блозі.
        </div>
    @else
        <table style="width: 100%; border-collapse: collapse; background: white; border: 1px solid #e8e8e8;">
            <thead>
            <tr style="background: #f8f9fa; text-align: left; border-bottom: 2px solid #dee2e6;">
                <th style="padding: 12px; border: 1px solid #dee2e6;">Заголовок</th>
                <th style="padding: 12px; border: 1px solid #dee2e6; width: 150px;">Дата створення</th>
                <th style="padding: 12px; border: 1px solid #dee2e6; width: 120px;">Дії</th>
            </tr>
            </thead>
            <tbody>
            @foreach($blogs as $blog)
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 12px; border: 1px solid #dee2e6;">
                        <a href="{{ route('blog.show', $blog) }}" style="color: #6c63ff; text-decoration: none; font-weight: 500;">
                            {{ $blog->title }}
                        </a>
                    </td>
                    <td style="padding: 12px; border: 1px solid #dee2e6;">
                        {{ $blog->dt_created->format('d.m.Y') }}
                    </td>
                    <td style="padding: 12px; border: 1px solid #dee2e6;">
                        <a href="{{ route('blog.edit', $blog) }}" style="color: #2d3a4d; text-decoration: none; font-weight: 500;">
                            Редагувати
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
