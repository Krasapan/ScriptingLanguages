<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        // Якщо в URL є ?lang=..., зберігаємо його в сесію
        if ($request->has('lang')) {
            $lang = $request->get('lang');
            if (in_array($lang, ['uk', 'en', 'fr'])) {
                app()->setLocale($lang);
                session()->put('locale', $lang);
            }
        }
        // Інакше беремо мову з сесії (або стандартну з конфігу)
        elseif (session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
        }

        return $next($request);
    }
}
