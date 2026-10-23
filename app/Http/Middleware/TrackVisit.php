<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        \App\Models\Tracker::create([
            'page' => $request->path(),
            'ip' => $request->ip(),
            'status' => $response->getStatusCode(),
            'method' => $request->method(), // Отримуємо GET, POST тощо
            // Зберігаємо додаткові дані в JSON
            'meta' => [
                'user_agent' => $request->userAgent(),
                'query_params' => $request->query(), // Зберігає параметри URL (наприклад, ?age=20)
            ],
            'visited_at' => now(),
        ]);

        return $response;
    }
}
