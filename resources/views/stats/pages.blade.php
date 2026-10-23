@extends('layouts.app')
@section('content')

    <h1>Статистика відвідувань</h1>
    <p>
        <a href="{{ route('stats.pages', ['type' => 'page']) }}">За сторінками</a> |
        <a href="{{ route('stats.pages', ['type' => 'ip']) }}">За IP-адресами</a> |
        <a href="{{ route('stats.pages', ['type' => 'method']) }}">За HTTP-методами</a>
    </p>

    <table border="1" cellpadding="5" style="border-collapse: collapse; width: 100%;">
        <thead>
        <tr>
            <th>{{ $type === 'page' ? 'Сторінка' : 'IP-адреса' }}</th>
            <th>Кількість звернень (hits)</th>
            <th>Унікальних відвідувачів</th>
            <th>Останній візит</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($rows as $row)
            <tr>
                <td>
                    <a href="{{ route('stats.detail', ['type' => $type, 'item' => $row->{$type}]) }}">
                        {{ $row->{$type} }}
                    </a>
                </td>
                <td>{{ $row->hits }}</td>
                <td>{{ $row->visitors }}</td>
                <td>{{ \Carbon\Carbon::parse($row->last_visit)->format('d.m.Y H:i:s') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $rows->links() }}
@endsection
