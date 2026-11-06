@extends('layouts.app')
@section('content')
    <h1>Додати запис блогу</h1>
    <form method="POST" action="{{ route('blog.store') }}">
        @csrf
        @include('blog._form')
        <button type="submit">Зберегти</button>
    </form>
@endsection
