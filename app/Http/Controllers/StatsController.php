<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracker;

class StatsController extends Controller
{
    public function detail(Request $request)
    {
        $type = $request->query('type', 'page');
        $item = $request->query('item');

        if (!in_array($type, ['page', 'ip'], true)) {
            abort(400, 'Неприпустимий тип фільтрації.');
        }

        $rows = Tracker::query()
            ->when($item, fn ($query, $value) => $query->where($type, $value))
            ->orderByDesc('visited_at')
            ->paginate(15)
            ->withQueryString();

        return view('stats.detail', compact('rows', 'type', 'item'));
    }

    public function pages(Request $request)
    {
        $type = $request->query('type', 'page');
        // Додали 'method' до дозволених типів
        if (!in_array($type, ['page', 'ip', 'method'], true)) {
            abort(400, 'Неприпустимий тип фільтрації.');
        }

        $rows = Tracker::query()
            ->selectRaw("$type, count(*) as hits, count(distinct ip) as visitors, max(visited_at) as last_visit")
            ->groupBy($type)
            ->orderByDesc('hits')
            ->paginate(15)
            ->withQueryString();

        return view('stats.pages', compact('rows', 'type'));
    }
}
