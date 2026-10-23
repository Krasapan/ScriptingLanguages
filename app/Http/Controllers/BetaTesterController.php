<?php

namespace App\Http\Controllers;

use App\Http\Requests\BetaTesterRequest;
use App\Models\BetaTester;
use Illuminate\Http\Request;

class BetaTesterController extends Controller
{
    public function index(Request $request)
    {
        $query = BetaTester::query();

        if ($request->filled('age')) {
            $query->where('age', $request->age);
        }

        $betaTesters = $query->orderBy('name')->paginate(5)->withQueryString();

        return view('beta-testers.index', compact('betaTesters'));
    }

    public function create()
    {
        return view('beta-testers.create');
    }

    public function store(BetaTesterRequest $request)
    {
        BetaTester::create($request->validated());

        return redirect()->route('beta-testers.index');
    }

    public function show(BetaTester $betaTester)
    {
        return view('beta-testers.show', compact('betaTester'));
    }

    public function edit(BetaTester $betaTester)
    {
        return view('beta-testers.edit', compact('betaTester'));
    }

    public function update(BetaTesterRequest $request, BetaTester $betaTester)
    {
        $betaTester->update($request->validated());

        return redirect()->route('beta-testers.index');
    }

    public function destroy(BetaTester $betaTester)
    {
        $betaTester->delete();

        return redirect()->route('beta-testers.index');
    }
}
