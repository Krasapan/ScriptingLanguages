@extends('layouts.app')

@section('title', 'Адміністрування блогу')

@section('content')

    <h1>Адміністрування блогу</h1>

    <p style="margin-bottom: 20px;">
        <a href="{{ route('blog.create') }}" style="display: inline-block; padding: 8px 15px; background-color: #6c63ff; color: white; text-decoration: none; border-radius: 5px;">
            + Додати запис
        </a>
    </p>

    {{-- CASE 3: Форма пошуку та фільтрації --}}
    <form method="GET" action="{{ route('blog.admin') }}" style="margin-bottom: 25px; display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end; background: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #e8e8e8;">
        <div>
            <label for="title" style="display: block; font-size: 14px; margin-bottom: 5px; font-weight: 500;">Заголовок</label>
            <input type="text" id="title" name="title" value="{{ request('title') }}" placeholder="Пошук за заголовком" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 200px;">
        </div>
        <div>
            <label for="categoryName" style="display: block; font-size: 14px; margin-bottom: 5px; font-weight: 500;">Назва категорії</label>
            <input type="text" id="categoryName" name="categoryName" value="{{ request('categoryName') }}" placeholder="Назва категорії" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 200px;">
        </div>
        <div>
            <label for="category_id" style="display: block; font-size: 14px; margin-bottom: 5px; font-weight: 500;">Категорія</label>
            <select id="category_id" name="category_id" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 180px;">
                <option value="">Усі категорії</option>
                @foreach ($categories as $id => $name)
                    <option value="{{ $id }}" @selected(request('category_id') == $id)>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="filter_id" style="display: block; font-size: 14px; margin-bottom: 5px; font-weight: 500;">Мітка</label>
            <select id="filter_id" name="filter_id" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 180px;">
                <option value="">Усі мітки</option>
                @foreach ($filters as $id => $name)
                    <option value="{{ $id }}" @selected(request('filter_id') == $id)>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Зберігаємо поточне сортування при відправці форми --}}
        <input type="hidden" name="sort" value="{{ request('sort') }}">

        <div>
            <button type="submit" style="padding: 9px 20px; background: #6c63ff; color: white; border: none; border-radius: 4px; cursor: pointer;">Знайти</button>
            <a href="{{ route('blog.admin') }}" style="padding: 9px 15px; color: #666; text-decoration: none; font-size: 14px;">Скинути</a>
        </div>
    </form>

    <table style="width: 100%; border-collapse: collapse; background: white; border: 1px solid #e8e8e8;">
        <thead>
        <tr style="background: #f8f9fa; text-align: left; border-bottom: 2px solid #dee2e6;">
            <th style="padding: 12px; border: 1px solid #dee2e6; width: 50px;">№</th>

            {{-- CASE 2: Сортування за заголовком --}}
            @php
                $currentSort = request('sort');
                $nextSortTitle = $currentSort === 'title' ? '-title' : 'title';
            @endphp
            <th style="padding: 12px; border: 1px solid #dee2e6;">
                <a href="{{ route('blog.admin', array_merge(request()->except('sort', 'page'), ['sort' => $nextSortTitle])) }}" style="text-decoration: none; color: #333;">
                    Заголовок
                    @if ($currentSort === 'title') ↑
                    @elseif ($currentSort === '-title') ↓
                    @endif
                </a>
            </th>

            {{-- CASE 2: Сортування за категорією --}}
            @php
                $nextSortCategory = $currentSort === 'categoryName' ? '-categoryName' : 'categoryName';
            @endphp
            <th style="padding: 12px; border: 1px solid #dee2e6;">
                <a href="{{ route('blog.admin', array_merge(request()->except('sort', 'page'),['sort' => $nextSortCategory])) }}" style="text-decoration: none; color: #333;">
                    Категорія
                    @if ($currentSort === 'categoryName') ↑
                    @elseif ($currentSort === '-categoryName') ↓
                    @endif
                </a>
            </th>

            <th style="padding: 12px; border: 1px solid #dee2e6;">Мітки</th>

            {{-- CASE 2: Сортування за датою --}}
            @php
                $nextSortCreated = $currentSort === 'created' ? '-created' : 'created';
            @endphp
            <th style="padding: 12px; border: 1px solid #dee2e6; width: 120px;">
                <a href="{{ route('blog.admin', array_merge(request()->except('sort', 'page'), ['sort' => $nextSortCreated])) }}" style="text-decoration: none; color: #333;">
                    Дата
                    @if ($currentSort === 'created') ↑
                    @elseif ($currentSort === '-created') ↓
                    @endif
                </a>
            </th>

            <th style="padding: 12px; border: 1px solid #dee2e6; width: 180px;">Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($blogs as $i => $blog)
            <tr style="border-bottom: 1px solid #dee2e6;">
                <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $blogs->firstItem() + $i }}</td>

                <td style="padding: 12px; border: 1px solid #dee2e6;">
                    <a href="{{ route('blog.show', $blog) }}" style="color: #6c63ff; text-decoration: none;">
                        {{ $blog->title }}
                    </a>
                </td>

                {{-- Виводимо категорію з nullsafe оператором --}}
                <td style="padding: 12px; border: 1px solid #dee2e6;">
                    {{ $blog->category?->category_name ?? '—' }}
                </td>

                {{-- Виводимо мітки --}}
                <td style="padding: 12px; border: 1px solid #dee2e6;">
                    @forelse ($blog->filters as $filter)
                        <span style="display: inline-block; padding: 4px 8px; background: #e9ecef; border-radius: 12px; font-size: 12px; margin: 2px;">
                            {{ $filter->filter_name }}
                        </span>
                    @empty
                        <span style="color: #777;">—</span>
                    @endforelse
                </td>

                <td style="padding: 12px; border: 1px solid #dee2e6;">
                    {{ $blog->dt_created->format('d.m.Y') }}
                </td>

                <td style="padding: 12px; border: 1px solid #dee2e6;">
                    <a href="{{ route('blog.edit', $blog) }}" style="color: #2d3a4d; text-decoration: none; margin-right: 15px;">
                        Редагувати
                    </a>

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
                {{-- Збільшили colspan до 6, бо тепер 6 колонок --}}
                <td colspan="6" style="padding: 20px; text-align: center; color: #777;">
                    Записів не знайдено.
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
