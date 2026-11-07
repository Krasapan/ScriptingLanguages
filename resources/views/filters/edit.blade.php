@extends('layouts.app')

@section('title', 'Редагувати мітку')

@section('content')
    <h1>Редагування мітки: {{ $filter->filter_name }}</h1>

    <form method="POST" action="{{ route('filters.update', $filter) }}" style="max-width: 600px;">
        @csrf
        @method('PUT') {{-- Обов'язково для оновлення --}}

        @include('filters._form')

        <div style="margin-top: 20px;">
            <button type="submit"
                    style="padding: 10px 20px; background: #6c63ff; color: white; border: none; border-radius: 4px; cursor: pointer;">
                Зберегти зміни
            </button>
            <a href="{{ route('filters.index') }}" style="margin-left: 15px; color: #666; text-decoration: none;">Скасувати</a>
        </div>
    </form>
@endsection
