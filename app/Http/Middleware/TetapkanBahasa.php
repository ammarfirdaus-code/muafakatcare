<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/** Bahasa ikut URL: /en/... = Inggeris, selain itu Bahasa Melayu. Terjemahan: lang/en.json. */
class TetapkanBahasa
{
    public function handle(Request $request, Closure $next): Response
    {
        app()->setLocale($request->segment(1) === 'en' ? 'en' : 'ms');

        return $next($request);
    }
}
