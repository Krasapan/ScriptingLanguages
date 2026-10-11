<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntryRequest;
use App\Http\Requests\LandingRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\BetaTestRequestMail;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.home');
    }

    public function say(string $message = 'Привіт')
    {
        return view('site.say', ['message' => $message]);
    }

    public function entry()
    {
        return view('site.entry');
    }

    public function entryStore(EntryRequest $request)
    {
        return view('site.entry-confirm', $request->validated());
    }

    public function landing()
    {
        $studioName = "Krasapan's Games";
        return view('site.landing', compact('studioName'));
    }

    public function landingStore(LandingRequest $request)
    {
        $validatedData = $request->validated();
        Mail::to('admin@krasapansgames.test')->send(new BetaTestRequestMail($validatedData));
        return view('site.landing-confirm', $validatedData);
    }

}
