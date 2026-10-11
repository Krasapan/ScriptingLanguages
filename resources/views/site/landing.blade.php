@extends('layouts.app')

@section('title', $studioName . ' — Game Development Studio')

@section('content')

    <section class="cta" id="beta-test">
        <h2>Записатися на бета-тест</h2>
        <p>Залиште свої дані, і ми запросимо вас на закритий бета-тест нашого наступного проєкту.</p>

        <form method="POST" action="{{ route('landing.store') }}" style="max-width: 400px; margin: 0 auto; text-align: left;">
            @csrf

            <div style="margin-bottom: 15px;">
                <label for="name" style="display: block; margin-bottom: 5px; font-size: 14px;">Ім'я</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; color: #333;">
                @error('name')
                <p style="color: #ff6584; font-size: 13px; margin: 5px 0 0;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; margin-bottom: 5px; font-size: 14px;">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; color: #333;">
                @error('email')
                <p style="color: #ff6584; font-size: 13px; margin: 5px 0 0;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="message" style="display: block; margin-bottom: 5px; font-size: 14px;">Які ігрові жанри вам подобаються?</label>
                <textarea id="message" name="message" rows="3" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; color: #333;">{{ old('message') }}</textarea>
                @error('message')
                <p style="color: #ff6584; font-size: 13px; margin: 5px 0 0;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="hero-button" style="width: 100%; border: none; cursor: pointer; font-size: 16px;">
                Надіслати заявку
            </button>
        </form>
    </section>

@endsection
