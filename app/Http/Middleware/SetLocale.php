<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $request->query('lang');

        if (in_array($locale, ['en', 'uk'])) {
            App::setLocale($locale);
        } else {
            App::setLocale('uk');
        }

        return $next($request);
    }
}
