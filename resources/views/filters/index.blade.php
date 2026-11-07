@extends('layouts.app')

@section('title', 'Довідник міток')

@section('content')
    <h1>Довідник міток</h1>

    <p style="margin-bottom: 20px;">
        <a href="{{ route('filters.create') }}" style="display: inline-block; padding: 8px 15px; background-color: #6c63ff; color: white; text-decoration: none; border-radius: 4px;">
            + Додати мітку
        </a>
    </p>

    <table style="width: 100%; border-collapse: collapse; background: white; border: 1px solid #e8e8e8;">
        <thead>
        <tr style="background: #f8f9fa; text-align: left; border-bottom: 2px solid #dee2e6;">
            <th style="padding: 12px; border: 1px solid #dee2e6; width: 50px;">#</th>
            <th style="padding: 12px; border: 1px solid #dee2e6;">Назва мітки</th>
            <th style="padding: 12px; border: 1px solid #dee2e6;">Опис</th>
            <th style="padding: 12px; border: 1px solid #dee2e6; width: 180px;">Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($filters as $i => $filter)
            <tr style="border-bottom: 1px solid #dee2e6;">
                <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $filters->firstItem() + $i }}</td>
                <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $filter->filter_name }}</td>
                <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $filter->filter_description ?? '—' }}</td>
                <td style="padding: 12px; border: 1px solid #dee2e6;">
                    <a href="{{ route('filters.edit', $filter) }}" style="color: #2d3a4d; text-decoration: none; margin-right: 15px;">
                        Редагувати
                    </a>

                    <form method="POST" action="{{ route('filters.destroy', $filter) }}" style="display: inline-block;" onsubmit="return confirm('Ви впевнені, що хочете видалити цю мітку?');">
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
                <td colspan="4" style="padding: 20px; text-align: center; color: #777;">
                    Міток не знайдено.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $filters->links() }}
    </div>
@endsection
