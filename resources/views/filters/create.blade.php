@extends('layouts.app')

@section('title', 'Додати мітку')

@section('content')
    <h1>Додати нову мітку</h1>

    <form method="POST" action="{{ route('filters.store') }}" style="max-width: 600px;">
        @csrf
        @include('filters._form')

        <div style="margin-top: 20px;">
            <button type="submit"
                    style="padding: 10px 20px; background: #6c63ff; color: white; border: none; border-radius: 4px; cursor: pointer;">
                Зберегти
            </button>
            <a href="{{ route('filters.index') }}" style="margin-left: 15px; color: #666; text-decoration: none;">Скасувати</a>
        </div>
    </form>
@endsection
