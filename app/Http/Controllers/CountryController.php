<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;

class CountryController extends Controller
{
    // Відображення списку країн
    public function index()
    {
        $countries = Country::query()
            ->orderBy('name')
            ->paginate(5);

        return view('country.index', compact('countries'));
    }

    // Відображення форми створення
    public function create()
    {
        return view('country.create');
    }

    // Збереження нової країни
    public function store(CountryRequest $request)
    {
        Country::create($request->validated());

        return redirect()->route('country.index');
    }

    // Перегляд окремої країни
    public function show(Country $country)
    {
        return view('country.show', compact('country'));
    }

    // Відображення форми редагування
    public function edit(Country $country)
    {
        return view('country.edit', compact('country'));
    }

    // Збереження змін
    public function update(
        CountryRequest $request,
        Country $country
    ) {
        $country->update($request->validated());

        return redirect()->route('country.index');
    }

    // Видалення країни
    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('country.index');
    }
}
