@extends('layouts.app')

@section('title', 'Адміністрування блогу')

@section('content')

    <h1>Адміністрування блогу</h1>

    <p style="margin-bottom: 20px;">
        <a href="{{ route('blog.create') }}" style="display: inline-block; padding: 8px 15px; background-color: #6c63ff; color: white; text-decoration: none; border-radius: 5px;">
            + Додати запис
        </a>
    </p>

    <table style="width: 100%; border-collapse: collapse; background: white; border: 1px solid #e8e8e8;">
        <thead>
        <tr style="background: #f8f9fa; text-align: left; border-bottom: 2px solid #dee2e6;">
            <th style="padding: 12px; border: 1px solid #dee2e6; width: 50px;">№</th>
            <th style="padding: 12px; border: 1px solid #dee2e6;">Заголовок</th>
            <th style="padding: 12px; border: 1px solid #dee2e6; width: 150px;">Категорія</th>
            <th style="padding: 12px; border: 1px solid #dee2e6; width: 120px;">Дата</th>
            <th style="padding: 12px; border: 1px solid #dee2e6; width: 180px;">Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($blogs as $i => $blog)
            <tr style="border-bottom: 1px solid #dee2e6;">
                {{-- Наскрізна нумерація з урахуванням сторінки пагінації --}}
                <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $blogs->firstItem() + $i }}</td>

                <td style="padding: 12px; border: 1px solid #dee2e6;">
                    <a href="{{ route('blog.show', $blog) }}" style="color: #6c63ff; text-decoration: none;">
                        {{ $blog->title }}
                    </a>
                </td>

                {{-- Використовуємо nullsafe оператор, якщо категорію видалили --}}
                <td style="padding: 12px; border: 1px solid #dee2e6;">
                    {{ $blog->category?->category_name ?? '—' }}
                </td>

                <td style="padding: 12px; border: 1px solid #dee2e6;">
                    {{ $blog->dt_created->format('d.m.Y') }}
                </td>

                <td style="padding: 12px; border: 1px solid #dee2e6;">
                    <a href="{{ route('blog.edit', $blog) }}" style="color: #2d3a4d; text-decoration: none; margin-right: 15px;">
                        Редагувати
                    </a>

                    {{-- Форма для видалення з підтвердженням --}}
                    <form method="POST" action="{{ route('blog.destroy', $blog) }}" style="display: inline-block;" onsubmit="return confirm('Ви впевнені, що хочете видалити цей запис?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: #dc3545; cursor: pointer; padding: 0; font-size: 16px; text-decoration: underline;">
                            Видалити
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="padding: 20px; text-align: center; color: #777;">
                    Записів немає.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{-- Блок пагінації --}}
    <div style="margin-top: 20px;">
        {{ $blogs->links() }}
    </div>

@endsection
