@extends('layouts.app')
@section('title', 'Заявку прийнято')
@section('content')
    <div style="text-align: center; padding: 60px 0;">
        <h1>Дякуємо, {{ $name }}!</h1>
        <p>Вашу заявку на бета-тест успішно надіслано.</p>

        <div style="margin-top: 30px; display: inline-block; text-align: left; background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #eee;">
            <strong>Перевірте ваші дані:</strong><br>
            Email: {{ $email }}<br>
            @if($message)
                Коментар: {{ $message }}
            @endif
        </div>

        <p style="margin-top: 40px;">
            <a href="{{ route('landing') }}" style="color: #6c63ff; text-decoration: none; font-weight: bold;">← Повернутися на головну</a>
        </p>
    </div>
@endsection
